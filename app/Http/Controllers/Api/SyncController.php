<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncController extends Controller
{
    public function handleRequest(Request $request, $module, $action)
    {
        // Only allow 'teachers' for now
        if ($module !== 'teachers') {
            return response()->json([
                'status' => 'error',
                'message' => "Module '{$module}' not supported."
            ], 400);
        }

        try {
            switch ($action) {
                case 'insert':
                    return $this->insertTeacher($request);
                case 'update':
                    return $this->updateTeacher($request);
                case 'delete':
                    return $this->deleteTeacher($request);
                case 'list':
                    return $this->listTeachers();
                default:
                    return response()->json([
                        'status' => 'error',
                        'message' => "Action '{$action}' not valid."
                    ], 400);
            }
        } catch (\Exception $e) {
            Log::error("API Sync Error [{$module}/{$action}]: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error while processing request.'
            ], 500);
        }
    }

    private function insertTeacher(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $teacher = Teacher::firstOrNew(['external_id' => $request->external_id]);

        $this->fillTeacherData($teacher, $request);

        $teacher->save();

        return response()->json([
            'status' => 'success',
            'message' => $teacher->wasRecentlyCreated ? 'Teacher created successfully' : 'Teacher updated successfully',
            'data' => [
                'laravel_id' => $teacher->id,
                'external_id' => $teacher->external_id
            ]
        ], 201);
    }

    private function updateTeacher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:teachers,external_id',
            // All other fields are optional for update
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $teacher = Teacher::where('external_id', $request->external_id)->first();

        $this->fillTeacherData($teacher, $request);

        $teacher->save();

        return response()->json(['status' => 'success', 'message' => 'Teacher updated successfully']);
    }

    private function deleteTeacher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:teachers,external_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $teacher = Teacher::where('external_id', $request->external_id)->first();

        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return response()->json(['status' => 'success', 'message' => 'Teacher deleted successfully']);
    }

    private function listTeachers()
    {
        $teachers = Teacher::all();

        $teachers->map(function ($teacher) {
            $teacher->photo_url = $teacher->photo_url;
            return $teacher;
        });

        return response()->json(['status' => 'success', 'data' => $teachers]);
    }

    /**
     * Helper to map request data to the Teacher model.
     */
    private function fillTeacherData(Teacher $teacher, Request $request)
    {
        $fillableFields = [
            'name',
            'designation',
            'short_intro',
            'address',
            'email',
            'phone',
            'facebook_url',
            'whatsapp_url',
            'behance_url',
            'pinterest_url',
            'linkedin_url',
            'biography',
            'skills',
            'is_active',
            'sort_order',
            'user_id',
            'department_id',
            'gender',
            'religion',
            'blood_group',
            'serial_no',
            'joining_date'
        ];

        foreach ($fillableFields as $field) {
            if ($request->has($field)) {
                $teacher->$field = $request->$field;
            }
        }

        // Process Base64 Image if provided
        if ($request->has('photo_base64') && !empty($request->photo_base64)) {
            $this->handleBase64Upload($request->photo_base64, $teacher);
        }
    }

    /**
     * Rules for insertion.
     */
    private function getValidationRules()
    {
        return [
            'external_id' => 'required|string',
            'email' => 'nullable|email',

            // Translatable Arrays
            'name' => 'required|array',
            'name.en' => 'required|string',
            'designation' => 'nullable|array',
            'short_intro' => 'nullable|array',
            'address' => 'nullable|array',
            'biography' => 'nullable|array',

            // Strings and links
            'phone' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'whatsapp_url' => 'nullable|string',
            'behance_url' => 'nullable|string',
            'pinterest_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',

            // Other fields
            'skills' => 'nullable|array',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'department_id' => 'nullable|integer',
            'gender' => 'nullable|string',
            'religion' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'serial_no' => 'nullable|string',
            'joining_date' => 'nullable|date',

            'photo_base64' => 'nullable|string',
        ];
    }

    private function handleBase64Upload($base64String, Teacher $teacher)
    {
        try {
            $image_parts = explode(";base64,", $base64String);
            if (count($image_parts) == 2) {
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1] ?? 'png';
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'teachers/' . Str::random(10) . '.' . $image_type;

                Storage::disk('public')->put($fileName, $image_base64);

                if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
                    Storage::disk('public')->delete($teacher->photo);
                }

                $teacher->photo = '/' . $fileName;
            }
        } catch (\Exception $e) {
            Log::error("Base64 Image Upload Failed: " . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Notice;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\ExamResult;
use Modules\Exam\Models\ExamSeatPlan;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\ClassRoutine;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\Subject;
use Modules\Student\Models\Student;
use Modules\Student\Models\DailyAttendanceSummary;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncController extends Controller
{
    public function handleRequest(Request $request, $module, $action)
    {
        // Normalize module aliases
        $module = match ($module) {
            'routines' => 'class-routines',
            'seat-plan', 'seatplans', 'exam-seat-plans', 'seatplan' => 'seat-plans',
            'attendance', 'attendances' => 'attendance-summaries',
            'student' => 'students',
            'teacher' => 'teachers',
            'notice' => 'notices',
            'exam' => 'exams',
            'result' => 'results',
            default => $module,
        };

        // Support teachers, notices, exams, results, students, class-routines, seat-plans, and attendance-summaries
        $supportedModules = [
            'teachers', 'notices', 'exams', 'results',
            'students', 'class-routines', 'seat-plans', 'attendance-summaries'
        ];
        if (!in_array($module, $supportedModules)) {
            return response()->json([
                'status' => 'error',
                'message' => "Module '{$module}' not supported."
            ], 400);
        }

        // Check if GET method was used on write endpoints
        if (in_array($action, ['insert', 'update', 'delete', 'bulk_insert']) && $request->isMethod('get')) {
            return response()->json([
                'status' => 'error',
                'message' => "HTTP method GET is not supported for action '{$action}'. In Postman, switch the method from GET to POST, select Body -> raw -> JSON, and paste your payload.",
            ], 405);
        }

        // Auto-decode raw JSON body if Content-Type was missing/text/plain in Postman
        $this->normalizeIncomingRequest($request, $module);

        try {
            if ($module === 'teachers') {
                switch ($action) {
                    case 'insert':
                        return $this->insertTeacher($request);
                    case 'update':
                        return $this->updateTeacher($request);
                    case 'delete':
                        return $this->deleteTeacher($request);
                    case 'list':
                        return $this->listTeachers();
                    case 'get':
                    case 'show':
                        return $this->getTeacher($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'notices') {
                switch ($action) {
                    case 'insert':
                        return $this->insertNotice($request);
                    case 'update':
                        return $this->updateNotice($request);
                    case 'delete':
                        return $this->deleteNotice($request);
                    case 'list':
                        return $this->listNotices();
                    case 'get':
                    case 'show':
                        return $this->getNotice($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'exams') {
                switch ($action) {
                    case 'insert':
                        return $this->insertExam($request);
                    case 'update':
                        return $this->updateExam($request);
                    case 'delete':
                        return $this->deleteExam($request);
                    case 'list':
                        return $this->listExams();
                    case 'get':
                    case 'show':
                        return $this->getExam($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'results') {
                switch ($action) {
                    case 'insert':
                        return $this->insertResult($request);
                    case 'bulk_insert':
                        return $this->bulkInsertResults($request);
                    case 'update':
                        return $this->updateResult($request);
                    case 'delete':
                        return $this->deleteResult($request);
                    case 'list':
                        return $this->listResults($request);
                    case 'get':
                    case 'show':
                        return $this->getResult($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'students') {
                switch ($action) {
                    case 'insert':
                        return $this->insertStudent($request);
                    case 'bulk_insert':
                        return $this->bulkInsertStudents($request);
                    case 'update':
                        return $this->updateStudent($request);
                    case 'delete':
                        return $this->deleteStudent($request);
                    case 'list':
                        return $this->listStudents($request);
                    case 'get':
                    case 'show':
                        return $this->getStudent($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'class-routines') {
                switch ($action) {
                    case 'insert':
                        return $this->insertClassRoutine($request);
                    case 'bulk_insert':
                        return $this->bulkInsertClassRoutines($request);
                    case 'update':
                        return $this->updateClassRoutine($request);
                    case 'delete':
                        return $this->deleteClassRoutine($request);
                    case 'list':
                        return $this->listClassRoutines($request);
                    case 'get':
                    case 'show':
                        return $this->getClassRoutine($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'seat-plans') {
                switch ($action) {
                    case 'insert':
                        return $this->insertSeatPlan($request);
                    case 'bulk_insert':
                        return $this->bulkInsertSeatPlans($request);
                    case 'update':
                        return $this->updateSeatPlan($request);
                    case 'delete':
                        return $this->deleteSeatPlan($request);
                    case 'list':
                        return $this->listSeatPlans($request);
                    case 'get':
                    case 'show':
                        return $this->getSeatPlan($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }

            if ($module === 'attendance-summaries') {
                switch ($action) {
                    case 'insert':
                        return $this->insertAttendanceSummary($request);
                    case 'bulk_insert':
                        return $this->bulkInsertAttendanceSummaries($request);
                    case 'update':
                        return $this->updateAttendanceSummary($request);
                    case 'delete':
                        return $this->deleteAttendanceSummary($request);
                    case 'list':
                        return $this->listAttendanceSummaries($request);
                    case 'get':
                    case 'show':
                        return $this->getAttendanceSummary($request);
                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => "Action '{$action}' not valid for module '{$module}'."
                        ], 400);
                }
            }
        } catch (\Exception $e) {
            Log::error("API Sync Error [{$module}/{$action}]: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error while processing request: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Auto-detect and normalize incoming request data across different HTTP clients.
     */
    private function normalizeIncomingRequest(Request $request, string $module): void
    {
        // 1. If $request->all() didn't capture JSON because Content-Type wasn't application/json
        $raw = $request->getContent();
        if (!empty($raw) && (empty($request->input('external_id')) && empty($request->input('name')) && empty($request->input('title')) && empty($request->input('date')) && empty($request->input('room_no')))) {
            $json = json_decode($raw, true);
            if (is_array($json)) {
                $request->merge($json);
            }
        }

        // 2. If wrapped in standard module keys
        $wrapperKeys = [
            'data', 'teacher', 'notice', 'exam', 'result',
            'student', 'routine', 'class_routine', 'seat_plan', 'seatplan',
            'exam_seat_plan', 'attendance', 'attendance_summary', 'summary'
        ];
        foreach ($wrapperKeys as $key) {
            if ($request->has($key) && is_array($request->input($key))) {
                $request->merge($request->input($key));
                break;
            } elseif ($request->has($key) && is_string($request->input($key))) {
                $decoded = json_decode($request->input($key), true);
                if (is_array($decoded)) {
                    $request->merge($decoded);
                    break;
                }
            }
        }

        // 3. If teacher and 'name' is provided as a plain string instead of an object
        if ($module === 'teachers' && $request->has('name') && is_string($request->input('name'))) {
            $nameStr = trim($request->input('name'));
            $request->merge([
                'name' => [
                    'en' => '',
                    'bn' => $nameStr,
                ]
            ]);
        }

        // 4. If 'designation' is provided as a plain string instead of an object
        if ($request->has('designation') && is_string($request->input('designation'))) {
            $desigStr = trim($request->input('designation'));
            $request->merge([
                'designation' => [
                    'en' => $desigStr,
                    'bn' => $desigStr,
                ]
            ]);
        }

        // 5. If 'title' is provided as a plain string instead of an object
        if ($request->has('title') && is_string($request->input('title'))) {
            $titleStr = trim($request->input('title'));
            $request->merge([
                'title' => [
                    'en' => $titleStr,
                    'bn' => $titleStr,
                ]
            ]);
        }

        // 6. If 'description' is provided as a plain string instead of an object
        if ($request->has('description') && is_string($request->input('description'))) {
            $descStr = trim($request->input('description'));
            $request->merge([
                'description' => [
                    'en' => $descStr,
                    'bn' => $descStr,
                ]
            ]);
        }
    }

    private function insertTeacher(Request $request)
    {
        if (empty($request->all())) {
            return response()->json([
                'status' => 'error',
                'message' => "Request payload is empty. In Postman: 1) Method must be POST, 2) Go to 'Body' tab -> select 'raw', 3) Set dropdown from 'Text' to 'JSON', and paste your payload.",
                'errors' => [
                    'external_id' => ['The external id field is required.'],
                    'name' => ['The name field is required.']
                ]
            ], 422);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules());

        $validator->after(function ($validator) use ($request) {
            $name = $request->input('name');
            if (is_array($name)) {
                $hasName = collect($name)->filter(fn ($val) => !blank($val))->isNotEmpty();
                if (!$hasName) {
                    $validator->errors()->add('name', 'At least one name translation (English or Bengali) is required.');
                }
            }
        });

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
                'external_id' => $teacher->external_id,
                'slug' => $teacher->slug,
            ]
        ], 201);
    }

    private function updateTeacher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:teachers,external_id',
            'email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $teacher = Teacher::where('external_id', $request->external_id)->first();

        $this->fillTeacherData($teacher, $request);

        $teacher->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Teacher updated successfully',
            'data' => [
                'laravel_id' => $teacher->id,
                'external_id' => $teacher->external_id,
            ]
        ]);
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

        return response()->json([
            'status' => 'success',
            'message' => 'Teacher deleted successfully',
            'data' => [
                'external_id' => $request->external_id
            ]
        ]);
    }

    private function getTeacher(Request $request)
    {
        $externalId = $request->input('external_id') ?? $request->query('external_id');
        if (!$externalId) {
            return response()->json(['status' => 'error', 'message' => 'Field external_id is required.'], 400);
        }

        $teacher = Teacher::where('external_id', $externalId)->first();
        if (!$teacher) {
            return response()->json(['status' => 'error', 'message' => "Teacher with external_id '{$externalId}' not found."], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $teacher
        ]);
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
                $val = $request->$field;
                if ($val === '') {
                    $val = null;
                }
                $teacher->$field = $val;
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
            'name.en' => 'nullable|string',
            'name.bn' => 'nullable|string',
            'designation' => 'nullable',
            'short_intro' => 'nullable',
            'address' => 'nullable',
            'biography' => 'nullable',

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

    /* -------------------------------------------------------------------------- */
    /*                              NOTICE HANDLERS                               */
    /* -------------------------------------------------------------------------- */

    private function insertNotice(Request $request)
    {
        if (empty($request->all())) {
            return response()->json([
                'status' => 'error',
                'message' => "Request payload is empty. In Postman: 1) Method must be POST, 2) Go to 'Body' tab -> select 'raw', 3) Set dropdown from 'Text' to 'JSON', and paste your payload.",
                'errors' => [
                    'external_id' => ['The external id field is required.'],
                    'title' => ['The title field is required.']
                ]
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string',
            'title' => 'required',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $validator->after(function ($validator) use ($request) {
            $title = $request->input('title');
            if (is_array($title)) {
                $hasTitle = collect($title)->filter(fn ($val) => !blank($val))->isNotEmpty();
                if (!$hasTitle) {
                    $validator->errors()->add('title', 'At least one title translation (English or Bengali) is required.');
                }
            } elseif (blank($title)) {
                $validator->errors()->add('title', 'The title field is required.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $notice = Notice::firstOrNew(['external_id' => $request->external_id]);

        $this->fillNoticeData($notice, $request);

        // Default published_at to today if new record and not provided
        if (!$notice->exists && empty($notice->published_at)) {
            $notice->published_at = now()->toDateString();
        }

        $notice->save();

        return response()->json([
            'status' => 'success',
            'message' => $notice->wasRecentlyCreated ? 'Notice created successfully' : 'Notice updated successfully',
            'data' => [
                'laravel_id' => $notice->id,
                'external_id' => $notice->external_id,
                'slug' => $notice->slug,
                'title' => $notice->getTranslations('title'),
                'published_at' => $notice->published_at?->format('Y-m-d'),
                'pdf_url' => $notice->pdf_url,
                'download_url' => $notice->pdf_url,
                'is_active' => (bool)$notice->is_active,
            ]
        ], 201);
    }

    private function updateNotice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:notices,external_id',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $notice = Notice::where('external_id', $request->external_id)->first();

        $this->fillNoticeData($notice, $request);

        $notice->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Notice updated successfully',
            'data' => [
                'laravel_id' => $notice->id,
                'external_id' => $notice->external_id,
                'slug' => $notice->slug,
                'title' => $notice->getTranslations('title'),
                'published_at' => $notice->published_at?->format('Y-m-d'),
                'pdf_url' => $notice->pdf_url,
                'download_url' => $notice->pdf_url,
                'is_active' => (bool)$notice->is_active,
            ]
        ]);
    }

    private function deleteNotice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:notices,external_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $notice = Notice::where('external_id', $request->external_id)->first();

        $this->deleteOldNoticeFile($notice);

        $notice->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Notice deleted successfully',
            'data' => [
                'external_id' => $request->external_id
            ]
        ]);
    }

    private function getNotice(Request $request)
    {
        $externalId = $request->input('external_id') ?? $request->query('external_id');
        if (!$externalId) {
            return response()->json(['status' => 'error', 'message' => 'Field external_id is required.'], 400);
        }

        $notice = Notice::where('external_id', $externalId)->first();
        if (!$notice) {
            return response()->json(['status' => 'error', 'message' => "Notice with external_id '{$externalId}' not found."], 404);
        }

        $notice->download_url = $notice->pdf_url;

        return response()->json([
            'status' => 'success',
            'data' => $notice
        ]);
    }

    private function listNotices()
    {
        $notices = Notice::orderByDesc('published_at')->orderByDesc('id')->get();

        $notices->map(function ($notice) {
            $notice->download_url = $notice->pdf_url;
            return $notice;
        });

        return response()->json(['status' => 'success', 'data' => $notices]);
    }

    private function fillNoticeData(Notice $notice, Request $request): void
    {
        if ($request->has('title')) {
            $title = $request->input('title');
            if (is_array($title)) {
                $notice->title = $title;
            } elseif (is_string($title)) {
                $notice->title = ['bn' => $title, 'en' => $title];
            }
        }

        if ($request->has('description')) {
            $desc = $request->input('description');
            if (is_array($desc)) {
                $notice->description = $desc;
            } elseif (is_string($desc)) {
                $notice->description = ['bn' => $desc, 'en' => $desc];
            } elseif (is_null($desc)) {
                $notice->description = null;
            }
        }

        if ($request->has('published_at')) {
            $val = $request->input('published_at');
            $notice->published_at = !empty($val) ? $val : null;
        }

        if ($request->has('is_active')) {
            $notice->is_active = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
        }

        // Handle file / pdf removal if explicitly requested
        if ($request->boolean('remove_file') || ($request->has('pdf') && $request->input('pdf') === null && !$request->hasFile('pdf'))) {
            $this->deleteOldNoticeFile($notice);
            $notice->pdf = null;
        }

        // Handle file / pdf upload (multipart or base64)
        $this->handleNoticeFileUpload($request, $notice);
    }

    private function handleNoticeFileUpload(Request $request, Notice $notice): void
    {
        // 1. Multipart file upload ('pdf' or 'file')
        if ($request->hasFile('pdf')) {
            $this->deleteOldNoticeFile($notice);
            $path = $request->file('pdf')->store('notices', 'public');
            $notice->pdf = $path;
            return;
        }

        if ($request->hasFile('file')) {
            $this->deleteOldNoticeFile($notice);
            $path = $request->file('file')->store('notices', 'public');
            $notice->pdf = $path;
            return;
        }

        // 2. Base64 encoded file string ('file_base64', 'pdf_base64', or 'file')
        $base64String = $request->input('file_base64') ?? $request->input('pdf_base64');
        if (empty($base64String) && is_string($request->input('file')) && str_starts_with($request->input('file'), 'data:')) {
            $base64String = $request->input('file');
        }

        if (!empty($base64String)) {
            $this->saveBase64NoticeFile($base64String, $notice, $request->input('file_name'));
        }
    }

    private function saveBase64NoticeFile(string $base64String, Notice $notice, ?string $customFileName = null): void
    {
        try {
            $extension = 'pdf';
            if (str_contains($base64String, ';base64,')) {
                [$meta, $content] = explode(';base64,', $base64String, 2);
                if (preg_match('/data:([a-zA-Z0-9\-\+\.]+\/[a-zA-Z0-9\-\+\.]+)/', $meta, $matches)) {
                    $mime = strtolower($matches[1]);
                    $extension = match ($mime) {
                        'application/pdf' => 'pdf',
                        'image/jpeg', 'image/jpg' => 'jpg',
                        'image/png' => 'png',
                        'application/msword' => 'doc',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                        default => 'pdf',
                    };
                }
                $fileData = base64_decode($content);
            } else {
                $fileData = base64_decode($base64String);
            }

            if ($customFileName && pathinfo($customFileName, PATHINFO_EXTENSION)) {
                $extension = strtolower(pathinfo($customFileName, PATHINFO_EXTENSION));
            }

            if ($fileData !== false) {
                $this->deleteOldNoticeFile($notice);
                $fileName = 'notices/' . Str::random(16) . '.' . $extension;
                Storage::disk('public')->put($fileName, $fileData);
                $notice->pdf = $fileName;
            }
        } catch (\Exception $e) {
            Log::error("Notice Base64 File Upload Failed: " . $e->getMessage());
        }
    }

    private function deleteOldNoticeFile(Notice $notice): void
    {
        if ($notice->pdf && Storage::disk('public')->exists($notice->pdf)) {
            Storage::disk('public')->delete($notice->pdf);
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                                EXAM HANDLERS                               */
    /* -------------------------------------------------------------------------- */

    private function insertExam(Request $request)
    {
        if (empty($request->all())) {
            return response()->json([
                'status' => 'error',
                'message' => "Request payload is empty. In Postman: 1) Method must be POST, 2) Body -> raw -> JSON.",
                'errors' => [
                    'external_id' => ['The external id field is required.'],
                    'name' => ['The name field is required.']
                ]
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string',
            'name' => 'required|string',
            'code' => 'nullable|string',
            'academic_year' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $exam = GlobalExam::firstOrNew(['external_id' => $request->external_id]);
        $exam->name = $request->input('name');
        if ($request->has('code')) $exam->code = $request->input('code') ?: null;
        if ($request->has('academic_year')) $exam->academic_year = $request->input('academic_year') ?: null;
        if ($request->has('is_active')) {
            $exam->is_active = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
        }

        $exam->save();

        return response()->json([
            'status' => 'success',
            'message' => $exam->wasRecentlyCreated ? 'Exam created successfully' : 'Exam updated successfully',
            'data' => [
                'laravel_id' => $exam->id,
                'external_id' => $exam->external_id,
                'name' => $exam->name,
                'code' => $exam->code,
                'academic_year' => $exam->academic_year,
                'is_active' => (bool)$exam->is_active,
            ]
        ], 201);
    }

    private function updateExam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:global_exams,external_id',
            'name' => 'nullable|string',
            'code' => 'nullable|string',
            'academic_year' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $exam = GlobalExam::where('external_id', $request->external_id)->first();
        if ($request->has('name') && !empty($request->input('name'))) {
            $exam->name = $request->input('name');
        }
        if ($request->has('code')) $exam->code = $request->input('code') ?: null;
        if ($request->has('academic_year')) $exam->academic_year = $request->input('academic_year') ?: null;
        if ($request->has('is_active')) {
            $exam->is_active = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
        }

        $exam->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Exam updated successfully',
            'data' => [
                'laravel_id' => $exam->id,
                'external_id' => $exam->external_id,
                'name' => $exam->name,
                'code' => $exam->code,
                'academic_year' => $exam->academic_year,
                'is_active' => (bool)$exam->is_active,
            ]
        ]);
    }

    private function deleteExam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:global_exams,external_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $exam = GlobalExam::where('external_id', $request->external_id)->first();
        $exam->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Exam deleted successfully',
            'data' => [
                'external_id' => $request->external_id
            ]
        ]);
    }

    private function getExam(Request $request)
    {
        $externalId = $request->input('external_id') ?? $request->query('external_id');
        if (!$externalId) {
            return response()->json(['status' => 'error', 'message' => 'Field external_id is required.'], 400);
        }

        $exam = GlobalExam::where('external_id', $externalId)->first();
        if (!$exam) {
            return response()->json(['status' => 'error', 'message' => "Exam with external_id '{$externalId}' not found."], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $exam
        ]);
    }

    private function listExams()
    {
        $exams = GlobalExam::orderByDesc('id')->get();
        return response()->json(['status' => 'success', 'data' => $exams]);
    }

    /* -------------------------------------------------------------------------- */
    /*                              RESULT HANDLERS                               */
    /* -------------------------------------------------------------------------- */

    private function insertResult(Request $request)
    {
        if (empty($request->all())) {
            return response()->json([
                'status' => 'error',
                'message' => "Request payload is empty. In Postman: 1) Method must be POST, 2) Body -> raw -> JSON.",
                'errors' => [
                    'external_id' => ['The external id field is required.'],
                    'roll_no' => ['The roll number field is required.']
                ]
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string',
            'student_name' => 'nullable|string',
            'roll_no' => 'required',
            'class_name' => 'nullable|string',
            'exam_name' => 'nullable|string',
            'gpa' => 'nullable|numeric',
            'total_marks' => 'nullable|numeric',
            'obtained_marks' => 'nullable|numeric',
            'is_published' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $result = ExamResult::firstOrNew(['external_id' => $request->external_id]);
        $this->fillResultData($result, $request);
        $result->save();

        return response()->json([
            'status' => 'success',
            'message' => $result->wasRecentlyCreated ? 'Result created successfully' : 'Result updated successfully',
            'data' => $result
        ], 201);
    }

    private function bulkInsertResults(Request $request)
    {
        $results = $request->input('results');
        if (!is_array($results) || empty($results)) {
            return response()->json([
                'status' => 'error',
                'message' => "Field 'results' must be a non-empty array of result objects."
            ], 422);
        }

        $inserted = 0;
        $updated = 0;
        $errors = [];

        foreach ($results as $index => $item) {
            if (!is_array($item) || empty($item['external_id']) || empty($item['roll_no'])) {
                $errors[] = "Index {$index}: external_id and roll_no are required.";
                continue;
            }

            try {
                $itemRequest = new Request($item);
                $result = ExamResult::firstOrNew(['external_id' => $item['external_id']]);
                $this->fillResultData($result, $itemRequest);
                $isNew = !$result->exists;
                $result->save();
                if ($isNew) {
                    $inserted++;
                } else {
                    $updated++;
                }
            } catch (\Exception $e) {
                $errors[] = "Index {$index} (ID {$item['external_id']}): " . $e->getMessage();
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Bulk processing complete. Inserted: {$inserted}, Updated: {$updated}.",
            'data' => [
                'inserted' => $inserted,
                'updated' => $updated,
                'errors' => $errors,
            ]
        ], 201);
    }

    private function updateResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:exam_results,external_id',
            'gpa' => 'nullable|numeric',
            'total_marks' => 'nullable|numeric',
            'obtained_marks' => 'nullable|numeric',
            'is_published' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $result = ExamResult::where('external_id', $request->external_id)->first();
        $this->fillResultData($result, $request);
        $result->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Result updated successfully',
            'data' => $result
        ]);
    }

    private function deleteResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string|exists:exam_results,external_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $result = ExamResult::where('external_id', $request->external_id)->first();
        $this->deleteOldMarksheetFile($result);
        $result->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Result deleted successfully',
            'data' => [
                'external_id' => $request->external_id
            ]
        ]);
    }

    private function getResult(Request $request)
    {
        $externalId = $request->input('external_id') ?? $request->query('external_id');
        if ($externalId) {
            $result = ExamResult::where('external_id', $externalId)->first();
            if (!$result) {
                return response()->json(['status' => 'error', 'message' => "Result with external_id '{$externalId}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $result]);
        }

        $rollNo = $request->input('roll_no') ?? $request->query('roll_no');
        $examId = $request->input('exam_id') ?? $request->query('exam_id');
        $classId = $request->input('class_id') ?? $request->query('class_id');

        if (!$rollNo) {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or roll_no is required.'], 400);
        }

        $query = ExamResult::where('roll_no', $rollNo);
        if ($examId) {
            $query->where(function ($q) use ($examId) {
                $q->where('exam_id', $examId)->orWhere('exam_name', $examId);
            });
        }
        if ($classId) {
            $query->where(function ($q) use ($classId) {
                $q->where('class_id', $classId)->orWhere('class_name', $classId);
            });
        }

        $result = $query->first();
        if (!$result) {
            return response()->json(['status' => 'error', 'message' => 'Result not found with provided criteria.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $result]);
    }

    private function listResults(Request $request)
    {
        $query = ExamResult::query();

        if ($request->has('exam_id')) {
            $query->where('exam_id', $request->input('exam_id'));
        }
        if ($request->has('class_id')) {
            $query->where('class_id', $request->input('class_id'));
        }
        if ($request->has('academic_year')) {
            $query->where('academic_year', $request->input('academic_year'));
        }
        if ($request->has('roll_no')) {
            $query->where('roll_no', $request->input('roll_no'));
        }

        $perPage = min((int)($request->input('per_page', 50)), 200);
        $results = $query->orderByDesc('id')->paginate($perPage);

        return response()->json(['status' => 'success', 'data' => $results]);
    }

    private function fillResultData(ExamResult $result, Request $request): void
    {
        if ($request->has('external_id')) {
            $result->external_id = $request->input('external_id');
        }

        // Resolve Exam
        $examName = $request->input('exam_name') ?? $request->input('exam');
        if (is_array($examName)) {
            $examName = $examName['name'] ?? null;
        }
        $examId = $request->input('exam_id');

        if ($examId) {
            $foundExam = GlobalExam::where('id', $examId)->orWhere('external_id', $examId)->first();
            if ($foundExam) {
                $result->exam_id = $foundExam->id;
                $result->exam_name = $foundExam->name;
            }
        }
        if (empty($result->exam_id) && !empty($examName)) {
            $result->exam_name = $examName;
            $foundExam = GlobalExam::where('name', $examName)->orWhere('external_id', $examName)->first();
            if ($foundExam) {
                $result->exam_id = $foundExam->id;
            }
        }
        if (empty($result->exam_name)) {
            $result->exam_name = 'General Examination';
        }

        // Student details
        $studentName = $request->input('student_name') ?? $request->input('student.name') ?? $request->input('name');
        if (!empty($studentName)) {
            $result->student_name = $studentName;
        }

        $rollNo = $request->input('roll_no') ?? $request->input('student.roll_no') ?? $request->input('roll');
        if (!empty($rollNo)) {
            $result->roll_no = (string) $rollNo;
        }

        $regNo = $request->input('registration_no') ?? $request->input('student.registration_no') ?? $request->input('reg_no');
        if ($request->has('registration_no') || $request->has('student.registration_no') || $request->has('reg_no')) {
            $result->registration_no = $regNo ? (string) $regNo : null;
        }

        $studentExtId = $request->input('student_external_id') ?? $request->input('student.external_id');
        if ($request->has('student_external_id') || $request->has('student.external_id')) {
            $result->student_external_id = $studentExtId ? (string) $studentExtId : null;
        }

        // Academic Class
        $className = $request->input('class_name') ?? $request->input('class') ?? $request->input('academic.class_name');
        $classId = $request->input('class_id') ?? $request->input('academic.class_id');
        if ($classId) {
            $foundClass = AcademicClass::find($classId);
            if ($foundClass) {
                $result->class_id = $foundClass->id;
                $result->class_name = $foundClass->name;
            }
        }
        if (empty($result->class_id) && !empty($className)) {
            $result->class_name = $className;
            $foundClass = AcademicClass::where('name', $className)->first();
            if ($foundClass) {
                $result->class_id = $foundClass->id;
            }
        }
        if (empty($result->class_name)) {
            $result->class_name = 'Class';
        }

        if ($request->has('section_name') || $request->has('section')) {
            $sec = $request->input('section_name') ?? $request->input('section');
            $result->section_name = $sec ?: null;
        }

        if ($request->has('group_name') || $request->has('group')) {
            $grp = $request->input('group_name') ?? $request->input('group');
            $result->group_name = $grp ?: null;
        }

        if ($request->has('academic_year') || $request->has('year')) {
            $yr = $request->input('academic_year') ?? $request->input('year');
            $result->academic_year = $yr ?: null;
        }

        // Auto-match student_id if possible
        if (empty($result->student_id)) {
            $studentQuery = Student::query();
            if (!empty($result->roll_no)) {
                $studentQuery->where('roll_no', $result->roll_no);
            }
            if (!empty($result->class_id)) {
                $studentQuery->where('class_id', $result->class_id);
            }
            $matchedStudent = $studentQuery->first();
            if ($matchedStudent) {
                $result->student_id = $matchedStudent->id;
                if (empty($result->student_name)) {
                    $result->student_name = trim($matchedStudent->first_name . ' ' . $matchedStudent->last_name);
                }
            }
        }

        if (empty($result->student_name)) {
            $result->student_name = 'Student (' . $result->roll_no . ')';
        }

        // Marks, GPA, Grade
        if ($request->has('total_marks')) $result->total_marks = $request->input('total_marks') !== '' ? $request->input('total_marks') : null;
        if ($request->has('obtained_marks')) $result->obtained_marks = $request->input('obtained_marks') !== '' ? $request->input('obtained_marks') : null;
        if ($request->has('gpa')) $result->gpa = $request->input('gpa') !== '' ? $request->input('gpa') : null;
        if ($request->has('grade')) $result->grade = $request->input('grade') ?: null;
        if ($request->has('merit_position') || $request->has('position')) {
            $result->merit_position = $request->input('merit_position') ?? $request->input('position');
        }
        if ($request->has('status')) $result->status = strtoupper($request->input('status') ?: 'PASSED');
        if ($request->has('remarks')) $result->remarks = $request->input('remarks');

        // Subjects array
        if ($request->has('subjects')) {
            $subjects = $request->input('subjects');
            $result->subjects_data = is_array($subjects) ? $subjects : json_decode($subjects, true);
        }

        // Publishing
        if ($request->has('is_published')) {
            $result->is_published = filter_var($request->input('is_published'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
        }
        if ($request->has('published_at')) {
            $result->published_at = $request->input('published_at') ?: null;
        } elseif (!$result->exists && empty($result->published_at)) {
            $result->published_at = now()->toDateString();
        }

        // Marksheet PDF removal
        if ($request->boolean('remove_marksheet') || ($request->has('pdf_marksheet') && $request->input('pdf_marksheet') === null && !$request->hasFile('marksheet'))) {
            $this->deleteOldMarksheetFile($result);
            $result->pdf_marksheet = null;
        }

        // Marksheet PDF upload
        $this->handleMarksheetFileUpload($request, $result);
    }

    private function handleMarksheetFileUpload(Request $request, ExamResult $result): void
    {
        if ($request->hasFile('marksheet')) {
            $this->deleteOldMarksheetFile($result);
            $result->pdf_marksheet = $request->file('marksheet')->store('results/marksheets', 'public');
            return;
        }
        if ($request->hasFile('file')) {
            $this->deleteOldMarksheetFile($result);
            $result->pdf_marksheet = $request->file('file')->store('results/marksheets', 'public');
            return;
        }

        $base64 = $request->input('marksheet_base64') ?? $request->input('pdf_base64') ?? $request->input('file_base64');
        if (!empty($base64)) {
            $this->saveBase64MarksheetFile($base64, $result, $request->input('file_name'));
        }
    }

    private function saveBase64MarksheetFile(string $base64String, ExamResult $result, ?string $customFileName = null): void
    {
        try {
            $extension = 'pdf';
            if (str_contains($base64String, ';base64,')) {
                [$meta, $content] = explode(';base64,', $base64String, 2);
                if (preg_match('/data:([a-zA-Z0-9\-\+\.]+\/[a-zA-Z0-9\-\+\.]+)/', $meta, $matches)) {
                    $mime = strtolower($matches[1]);
                    $extension = match ($mime) {
                        'application/pdf' => 'pdf',
                        'image/jpeg', 'image/jpg' => 'jpg',
                        'image/png' => 'png',
                        default => 'pdf',
                    };
                }
                $fileData = base64_decode($content);
            } else {
                $fileData = base64_decode($base64String);
            }

            if ($customFileName && pathinfo($customFileName, PATHINFO_EXTENSION)) {
                $extension = strtolower(pathinfo($customFileName, PATHINFO_EXTENSION));
            }

            if ($fileData !== false) {
                $this->deleteOldMarksheetFile($result);
                $fileName = 'results/marksheets/' . Str::random(16) . '.' . $extension;
                Storage::disk('public')->put($fileName, $fileData);
                $result->pdf_marksheet = $fileName;
            }
        } catch (\Exception $e) {
            Log::error("Marksheet Base64 File Upload Failed: " . $e->getMessage());
        }
    }

    private function deleteOldMarksheetFile(ExamResult $result): void
    {
        if ($result->pdf_marksheet && Storage::disk('public')->exists($result->pdf_marksheet)) {
            Storage::disk('public')->delete($result->pdf_marksheet);
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                              STUDENT HANDLERS                              */
    /* -------------------------------------------------------------------------- */

    private function insertStudent(Request $request)
    {
        if (empty($request->all())) {
            return response()->json([
                'status' => 'error',
                'message' => "Request payload is empty.",
                'errors' => ['external_id' => ['The external id field is required.']]
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'external_id' => 'required|string',
            'first_name' => 'nullable',
            'name' => 'nullable',
            'roll_no' => 'nullable',
            'email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $student = Student::firstOrNew(['external_id' => (string)$request->input('external_id')]);
        $this->fillStudentData($student, $request);
        $student->save();

        return response()->json([
            'status' => 'success',
            'message' => $student->wasRecentlyCreated ? 'Student created successfully' : 'Student updated successfully',
            'data' => $student->fresh(['academicClass', 'section'])
        ], $student->wasRecentlyCreated ? 201 : 200);
    }

    private function bulkInsertStudents(Request $request)
    {
        $studentsData = $request->input('students') ?? $request->input('data') ?? [];
        if (!is_array($studentsData) || empty($studentsData)) {
            $raw = $request->all();
            if (isset($raw[0]) && is_array($raw[0])) {
                $studentsData = $raw;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload format. Expected an array of student objects under key "students" or "data".'
                ], 422);
            }
        }

        $total = count($studentsData);
        $inserted = 0;
        $updated = 0;
        $errors = [];

        foreach ($studentsData as $idx => $item) {
            if (!is_array($item)) continue;
            $subReq = new Request($item);
            $this->normalizeIncomingRequest($subReq, 'students');

            $extId = $subReq->input('external_id') ?? $subReq->input('id');
            if (empty($extId)) {
                $errors[] = ['index' => $idx, 'error' => 'Missing external_id'];
                continue;
            }

            try {
                $student = Student::firstOrNew(['external_id' => (string)$extId]);
                $this->fillStudentData($student, $subReq);
                $isNew = !$student->exists;
                $student->save();
                if ($isNew) {
                    $inserted++;
                } else {
                    $updated++;
                }
            } catch (\Exception $e) {
                $errors[] = ['index' => $idx, 'external_id' => $extId, 'error' => $e->getMessage()];
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Bulk student sync completed: {$inserted} inserted, {$updated} updated.",
            'total_received' => $total,
            'inserted' => $inserted,
            'updated' => $updated,
            'errors' => $errors
        ], 200);
    }

    private function updateStudent(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = Student::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to update.'], 422);
        }

        $student = $query->first();
        if (!$student) {
            return response()->json(['status' => 'error', 'message' => 'Student not found.'], 404);
        }

        $this->fillStudentData($student, $request);
        $student->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Student updated successfully',
            'data' => $student->fresh(['academicClass', 'section'])
        ]);
    }

    private function deleteStudent(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = Student::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to delete.'], 422);
        }

        $student = $query->first();
        if (!$student) {
            return response()->json(['status' => 'error', 'message' => 'Student not found.'], 404);
        }

        $this->deleteOldStudentPhoto($student);
        $student->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Student deleted successfully',
            'data' => ['external_id' => $student->external_id, 'id' => $student->id]
        ]);
    }

    private function getStudent(Request $request)
    {
        $extId = $request->input('external_id') ?? $request->query('external_id');
        $id = $request->input('id') ?? $request->query('id');

        if ($extId) {
            $student = Student::with(['academicClass', 'section'])->where('external_id', $extId)->first();
            if (!$student) {
                return response()->json(['status' => 'error', 'message' => "Student with external_id '{$extId}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $student]);
        }

        if ($id) {
            $student = Student::with(['academicClass', 'section'])->find($id);
            if (!$student) {
                return response()->json(['status' => 'error', 'message' => "Student with id '{$id}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $student]);
        }

        $rollNo = $request->input('roll_no') ?? $request->query('roll_no');
        $classId = $request->input('class_id') ?? $request->query('class_id');
        if ($rollNo) {
            $q = Student::with(['academicClass', 'section'])->where('roll_no', $rollNo);
            if ($classId) {
                $q->where('class_id', $classId);
            }
            $student = $q->first();
            if ($student) {
                return response()->json(['status' => 'success', 'data' => $student]);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Student not found with provided criteria.'], 404);
    }

    private function listStudents(Request $request)
    {
        $query = Student::with(['academicClass', 'section']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->input('class_id'));
        }
        if ($request->filled('section_id')) {
            $query->where('section_id', $request->input('section_id'));
        }
        if ($request->filled('roll_no')) {
            $query->where('roll_no', $request->input('roll_no'));
        }
        if ($request->filled('group')) {
            $query->where('group', $request->input('group'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'like', "%{$s}%")
                  ->orWhere('last_name', 'like', "%{$s}%")
                  ->orWhere('roll_no', 'like', "%{$s}%")
                  ->orWhere('registration_no', 'like', "%{$s}%");
            });
        }

        $perPage = min((int)($request->input('per_page', 50)), 200);
        $students = $query->orderBy('class_id')->orderBy('roll_no')->paginate($perPage);

        return response()->json(['status' => 'success', 'data' => $students]);
    }

    private function fillStudentData(Student $student, Request $request): void
    {
        if ($request->filled('external_id')) {
            $student->external_id = (string)$request->input('external_id');
        }

        // Helper to extract or normalize translation fields
        $normalizeTrans = function ($input) {
            if (is_array($input)) {
                $en = isset($input['en']) ? trim((string)$input['en']) : null;
                $bn = isset($input['bn']) ? trim((string)$input['bn']) : null;
                $res = [];
                if (!blank($en)) $res['en'] = $en;
                if (!blank($bn)) $res['bn'] = $bn;
                return !empty($res) ? $res : null;
            }
            if (is_string($input) && trim($input) !== '') {
                return trim($input);
            }
            return null;
        };

        // 1. Names - Handle both "name" object, "first_name" / "last_name" objects, or plain strings
        $nameInput = $request->input('name');
        $firstNameInput = $request->input('first_name');
        $lastNameInput = $request->input('last_name');

        if (is_array($nameInput)) {
            $enName = isset($nameInput['en']) ? trim((string)$nameInput['en']) : '';
            $bnName = isset($nameInput['bn']) ? trim((string)$nameInput['bn']) : '';

            $firstNames = [];
            $lastNames = [];

            if ($enName !== '') {
                $parts = explode(' ', $enName, 2);
                $firstNames['en'] = $parts[0];
                if (!empty($parts[1])) $lastNames['en'] = $parts[1];
            }
            if ($bnName !== '') {
                $parts = explode(' ', $bnName, 2);
                $firstNames['bn'] = $parts[0];
                if (!empty($parts[1])) $lastNames['bn'] = $parts[1];
            }

            if (!empty($firstNames)) {
                $student->first_name = $firstNames;
            }
            if (!empty($lastNames)) {
                $student->last_name = $lastNames;
            }
        } elseif (is_string($nameInput) && trim($nameInput) !== '') {
            $parts = explode(' ', trim($nameInput), 2);
            $student->first_name = $parts[0];
            if (!empty($parts[1])) {
                $student->last_name = $parts[1];
            }
        }

        // Direct first_name / last_name inputs (can be {"en": "...", "bn": "..."} or "...")
        if ($request->has('first_name')) {
            $fn = $normalizeTrans($firstNameInput);
            if (!is_null($fn)) $student->first_name = $fn;
        }
        if ($request->has('last_name')) {
            $ln = $normalizeTrans($lastNameInput);
            if (!is_null($ln)) $student->last_name = $ln;
        }

        if (empty($student->first_name)) {
            $student->first_name = 'Student';
        }

        // 2. Translatable Family, Guardian & Address fields
        $transFields = [
            'father_name',
            'mother_name',
            'guardian_name',
            'address',
            'guardian_address',
        ];

        foreach ($transFields as $field) {
            if ($request->has($field)) {
                $val = $normalizeTrans($request->input($field));
                $student->$field = $val;
            }
        }

        // Non-translatable fields
        if ($request->has('guardian_email')) $student->guardian_email = $request->input('guardian_email');
        if ($request->has('guardian_phone')) $student->guardian_phone = $request->input('guardian_phone');
        if ($request->has('guardian_relationship')) $student->guardian_relationship = $request->input('guardian_relationship');
        if ($request->has('roll_no')) $student->roll_no = (string)$request->input('roll_no');
        if ($request->has('registration_no')) $student->registration_no = (string)$request->input('registration_no');
        if ($request->has('group')) $student->group = $request->input('group');
        if ($request->has('gender')) $student->gender = $request->input('gender');
        if ($request->has('blood_group')) $student->blood_group = $request->input('blood_group');
        if ($request->has('religion')) $student->religion = $request->input('religion');
        if ($request->has('admission_number')) $student->admission_number = $request->input('admission_number');
        if ($request->has('status')) $student->status = $request->input('status') ?: 'approved';

        // Class & Section resolution
        $classId = $request->input('class_id');
        $className = $request->input('class_name') ?? $request->input('class');
        if ($classId && AcademicClass::where('id', $classId)->exists()) {
            $student->class_id = $classId;
        } elseif ($className) {
            $foundClass = AcademicClass::where('name', $className)
                ->orWhere('name', 'like', "%{$className}%")
                ->first();
            if ($foundClass) {
                $student->class_id = $foundClass->id;
            }
        }

        $sectionId = $request->input('section_id');
        $sectionName = $request->input('section_name') ?? $request->input('section');
        if ($sectionId && Section::where('id', $sectionId)->exists()) {
            $student->section_id = $sectionId;
        } elseif ($sectionName) {
            $secQuery = Section::where('name', $sectionName);
            if ($student->class_id) {
                $secQuery->where('academic_class_id', $student->class_id);
            }
            $foundSec = $secQuery->first() ?? Section::where('name', $sectionName)->first();
            if ($foundSec) {
                $student->section_id = $foundSec->id;
            }
        }

        // Optional User Account Link
        if ($request->filled('email') && empty($student->user_id)) {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                $user = User::create([
                    'name' => trim($student->first_name . ' ' . $student->last_name),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password', '12345678')),
                    'phone' => $request->input('phone') ?? $request->input('guardian_phone'),
                ]);
                if (\Spatie\Permission\Models\Role::where('name', 'student')->exists()) {
                    $user->assignRole('student');
                }
            }
            $student->user_id = $user->id;
        }

        // Photo processing (base64 or direct)
        $photoField = $request->input('picture') ?? $request->input('photo') ?? $request->input('image');
        if ($photoField && is_string($photoField)) {
            if (str_starts_with($photoField, 'data:image') || strlen($photoField) > 300) {
                $this->saveBase64StudentPhoto($photoField, $student);
            } else {
                $student->picture = $photoField;
            }
        }
    }

    private function saveBase64StudentPhoto(string $base64String, Student $student): void
    {
        try {
            $extension = 'jpg';
            if (str_contains($base64String, ';base64,')) {
                [$meta, $content] = explode(';base64,', $base64String, 2);
                if (preg_match('/data:image\/([a-zA-Z0-9\-\+\.]+)/', $meta, $matches)) {
                    $extension = strtolower($matches[1]);
                    if ($extension === 'jpeg') $extension = 'jpg';
                }
                $fileData = base64_decode($content);
            } else {
                $fileData = base64_decode($base64String);
            }

            if ($fileData !== false) {
                $this->deleteOldStudentPhoto($student);
                $fileName = 'students/' . Str::random(20) . '.' . $extension;
                Storage::disk('public')->put($fileName, $fileData);
                $student->picture = $fileName;
            }
        } catch (\Exception $e) {
            Log::error("Student Photo Base64 Upload Failed: " . $e->getMessage());
        }
    }

    private function deleteOldStudentPhoto(Student $student): void
    {
        if ($student->picture && Storage::disk('public')->exists($student->picture)) {
            Storage::disk('public')->delete($student->picture);
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                         CLASS ROUTINE HANDLERS                             */
    /* -------------------------------------------------------------------------- */

    private function insertClassRoutine(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['status' => 'error', 'message' => "Request payload is empty."], 422);
        }

        $validator = Validator::make($request->all(), [
            'day_of_week' => 'required|string',
            'class_id' => 'nullable',
            'class_name' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $routine = null;
        if ($request->filled('external_id')) {
            $routine = ClassRoutine::where('external_id', $request->input('external_id'))->first();
        }
        if (!$routine) {
            $routine = new ClassRoutine();
        }

        $this->fillClassRoutineData($routine, $request);
        $routine->save();

        return response()->json([
            'status' => 'success',
            'message' => $routine->wasRecentlyCreated ? 'Class routine period created successfully' : 'Class routine period updated successfully',
            'data' => $routine->fresh(['academicClass', 'section', 'subject'])
        ], $routine->wasRecentlyCreated ? 201 : 200);
    }

    private function bulkInsertClassRoutines(Request $request)
    {
        $routinesData = $request->input('routines') ?? $request->input('data') ?? [];
        if (!is_array($routinesData) || empty($routinesData)) {
            $raw = $request->all();
            if (isset($raw[0]) && is_array($raw[0])) {
                $routinesData = $raw;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload format. Expected an array of routine items under key "routines" or "data".'
                ], 422);
            }
        }

        // Optional replace_existing: if true and class_id/class_name is specified, wipe previous routines for that class/section
        if ($request->boolean('replace_existing') || (isset($routinesData[0]['replace_existing']) && $routinesData[0]['replace_existing'])) {
            $targetClassId = $request->input('class_id');
            $targetSecId = $request->input('section_id');
            if ($targetClassId) {
                $delQ = ClassRoutine::where('class_id', $targetClassId);
                if ($targetSecId) $delQ->where('section_id', $targetSecId);
                $delQ->delete();
            }
        }

        $total = count($routinesData);
        $inserted = 0;
        $updated = 0;
        $errors = [];

        foreach ($routinesData as $idx => $item) {
            if (!is_array($item)) continue;
            $subReq = new Request($item);
            $this->normalizeIncomingRequest($subReq, 'class-routines');

            try {
                $extId = $subReq->input('external_id');
                $routine = null;
                if ($extId) {
                    $routine = ClassRoutine::where('external_id', $extId)->first();
                }
                $isNew = false;
                if (!$routine) {
                    $routine = new ClassRoutine();
                    $isNew = true;
                }
                $this->fillClassRoutineData($routine, $subReq);
                $routine->save();
                if ($isNew) $inserted++; else $updated++;
            } catch (\Exception $e) {
                $errors[] = ['index' => $idx, 'error' => $e->getMessage()];
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Bulk class routine sync completed: {$inserted} inserted, {$updated} updated.",
            'total_received' => $total,
            'inserted' => $inserted,
            'updated' => $updated,
            'errors' => $errors
        ], 200);
    }

    private function updateClassRoutine(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = ClassRoutine::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to update.'], 422);
        }

        $routine = $query->first();
        if (!$routine) {
            return response()->json(['status' => 'error', 'message' => 'Class routine record not found.'], 404);
        }

        $this->fillClassRoutineData($routine, $request);
        $routine->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Class routine updated successfully',
            'data' => $routine->fresh(['academicClass', 'section', 'subject'])
        ]);
    }

    private function deleteClassRoutine(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = ClassRoutine::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to delete.'], 422);
        }

        $routine = $query->first();
        if (!$routine) {
            return response()->json(['status' => 'error', 'message' => 'Class routine record not found.'], 404);
        }

        $routine->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Class routine deleted successfully',
            'data' => ['external_id' => $routine->external_id, 'id' => $routine->id]
        ]);
    }

    private function getClassRoutine(Request $request)
    {
        $extId = $request->input('external_id') ?? $request->query('external_id');
        $id = $request->input('id') ?? $request->query('id');

        if ($extId) {
            $routine = ClassRoutine::with(['academicClass', 'section', 'subject', 'teacher'])->where('external_id', $extId)->first();
            if (!$routine) {
                return response()->json(['status' => 'error', 'message' => "Class routine with external_id '{$extId}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $routine]);
        }

        if ($id) {
            $routine = ClassRoutine::with(['academicClass', 'section', 'subject', 'teacher'])->find($id);
            if (!$routine) {
                return response()->json(['status' => 'error', 'message' => "Class routine with id '{$id}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $routine]);
        }

        return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required.'], 400);
    }

    private function listClassRoutines(Request $request)
    {
        $query = ClassRoutine::with(['academicClass', 'section', 'subject', 'teacher']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->input('class_id'));
        }
        if ($request->filled('section_id')) {
            $query->where('section_id', $request->input('section_id'));
        }
        if ($request->filled('day_of_week')) {
            $query->where('day_of_week', $request->input('day_of_week'));
        }

        $perPage = min((int)($request->input('per_page', 100)), 300);
        $routines = $query->orderBy('day_of_week')->orderBy('start_time')->paginate($perPage);

        return response()->json(['status' => 'success', 'data' => $routines]);
    }

    private function fillClassRoutineData(ClassRoutine $routine, Request $request): void
    {
        if ($request->filled('external_id')) {
            $routine->external_id = (string)$request->input('external_id');
        }

        // Day of week
        $day = $request->input('day_of_week') ?? $request->input('day');
        if ($day) {
            $routine->day_of_week = ucfirst(strtolower(trim($day)));
        }

        // Times & Room
        if ($request->has('start_time')) $routine->start_time = $request->input('start_time');
        if ($request->has('end_time')) $routine->end_time = $request->input('end_time');
        if ($request->has('room')) $routine->room = (string)$request->input('room');

        // Class
        $classId = $request->input('class_id');
        $className = $request->input('class_name') ?? $request->input('class');
        if ($classId && AcademicClass::where('id', $classId)->exists()) {
            $routine->class_id = $classId;
        } elseif ($className) {
            $cls = AcademicClass::where('name', $className)->orWhere('name', 'like', "%{$className}%")->first();
            if ($cls) $routine->class_id = $cls->id;
        }

        // Section
        $sectionId = $request->input('section_id');
        $sectionName = $request->input('section_name') ?? $request->input('section');
        if ($sectionId && Section::where('id', $sectionId)->exists()) {
            $routine->section_id = $sectionId;
        } elseif ($sectionName) {
            $secQ = Section::where('name', $sectionName);
            if ($routine->class_id) $secQ->where('academic_class_id', $routine->class_id);
            $sec = $secQ->first() ?? Section::where('name', $sectionName)->first();
            if ($sec) $routine->section_id = $sec->id;
        }

        // Subject
        $subjectId = $request->input('subject_id');
        $subjectName = $request->input('subject_name') ?? $request->input('subject');
        $subjectCode = $request->input('subject_code');
        if ($subjectId && Subject::where('id', $subjectId)->exists()) {
            $routine->subject_id = $subjectId;
        } elseif ($subjectCode) {
            $sub = Subject::where('code', $subjectCode)->first();
            if ($sub) $routine->subject_id = $sub->id;
        } elseif ($subjectName) {
            $subQ = Subject::where('name', $subjectName)->orWhere('name', 'like', "%{$subjectName}%");
            if ($routine->class_id) $subQ->where('academic_class_id', $routine->class_id);
            $sub = $subQ->first();
            if ($sub) $routine->subject_id = $sub->id;
        }

        // Teacher
        $teacherId = $request->input('teacher_id');
        $teacherExtId = $request->input('teacher_external_id');
        $teacherName = $request->input('teacher_name');
        if ($teacherId) {
            $routine->teacher_id = $teacherId;
        } elseif ($teacherExtId) {
            $tch = Teacher::where('external_id', $teacherExtId)->first();
            if ($tch) $routine->teacher_id = $tch->id;
        } elseif ($teacherName) {
            $tch = Teacher::where('name', 'like', "%{$teacherName}%")->first();
            if ($tch) $routine->teacher_id = $tch->id;
        }

        // Optional Routine File PDF attachment
        $fileContent = $request->input('routine_file') ?? $request->input('file_content') ?? $request->input('file_base64');
        if ($fileContent && is_string($fileContent) && strlen($fileContent) > 300) {
            $this->saveBase64RoutineFile($fileContent, $routine, $request->input('file_name'));
        }
    }

    private function saveBase64RoutineFile(string $base64String, ClassRoutine $routine, ?string $customFileName = null): void
    {
        try {
            $extension = 'pdf';
            if (str_contains($base64String, ';base64,')) {
                [$meta, $content] = explode(';base64,', $base64String, 2);
                $fileData = base64_decode($content);
            } else {
                $fileData = base64_decode($base64String);
            }

            if ($customFileName && pathinfo($customFileName, PATHINFO_EXTENSION)) {
                $extension = strtolower(pathinfo($customFileName, PATHINFO_EXTENSION));
            }

            if ($fileData !== false) {
                $fileName = 'routines/' . Str::random(16) . '.' . $extension;
                Storage::disk('public')->put($fileName, $fileData);
                $routine->routine_file = $fileName;
            }
        } catch (\Exception $e) {
            Log::error("Class Routine Base64 File Upload Failed: " . $e->getMessage());
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                         EXAM SEAT PLAN HANDLERS                            */
    /* -------------------------------------------------------------------------- */

    private function insertSeatPlan(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['status' => 'error', 'message' => "Request payload is empty."], 422);
        }

        $validator = Validator::make($request->all(), [
            'room_no' => 'required|string',
            'exam_name' => 'nullable|string',
            'exam_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $seatPlan = null;
        if ($request->filled('external_id')) {
            $seatPlan = ExamSeatPlan::firstOrNew(['external_id' => (string)$request->input('external_id')]);
        } else {
            $seatPlan = new ExamSeatPlan();
        }

        $this->fillSeatPlanData($seatPlan, $request);
        $seatPlan->save();

        return response()->json([
            'status' => 'success',
            'message' => $seatPlan->wasRecentlyCreated ? 'Exam seat plan created successfully' : 'Exam seat plan updated successfully',
            'data' => $seatPlan
        ], $seatPlan->wasRecentlyCreated ? 201 : 200);
    }

    private function bulkInsertSeatPlans(Request $request)
    {
        $plansData = $request->input('seat_plans') ?? $request->input('plans') ?? $request->input('data') ?? [];
        if (!is_array($plansData) || empty($plansData)) {
            $raw = $request->all();
            if (isset($raw[0]) && is_array($raw[0])) {
                $plansData = $raw;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload format. Expected an array of seat plan items under key "seat_plans" or "data".'
                ], 422);
            }
        }

        $total = count($plansData);
        $inserted = 0;
        $updated = 0;
        $errors = [];

        foreach ($plansData as $idx => $item) {
            if (!is_array($item)) continue;
            $subReq = new Request($item);
            $this->normalizeIncomingRequest($subReq, 'seat-plans');

            try {
                $extId = $subReq->input('external_id');
                $plan = null;
                if ($extId) {
                    $plan = ExamSeatPlan::firstOrNew(['external_id' => (string)$extId]);
                } else {
                    $plan = new ExamSeatPlan();
                }
                $isNew = !$plan->exists;
                $this->fillSeatPlanData($plan, $subReq);
                $plan->save();
                if ($isNew) $inserted++; else $updated++;
            } catch (\Exception $e) {
                $errors[] = ['index' => $idx, 'error' => $e->getMessage()];
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Bulk seat plan sync completed: {$inserted} inserted, {$updated} updated.",
            'total_received' => $total,
            'inserted' => $inserted,
            'updated' => $updated,
            'errors' => $errors
        ], 200);
    }

    private function updateSeatPlan(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = ExamSeatPlan::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to update.'], 422);
        }

        $plan = $query->first();
        if (!$plan) {
            return response()->json(['status' => 'error', 'message' => 'Exam seat plan not found.'], 404);
        }

        $this->fillSeatPlanData($plan, $request);
        $plan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Exam seat plan updated successfully',
            'data' => $plan
        ]);
    }

    private function deleteSeatPlan(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = ExamSeatPlan::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to delete.'], 422);
        }

        $plan = $query->first();
        if (!$plan) {
            return response()->json(['status' => 'error', 'message' => 'Exam seat plan not found.'], 404);
        }

        $this->deleteOldSeatPlanFile($plan);
        $plan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Exam seat plan deleted successfully',
            'data' => ['external_id' => $plan->external_id, 'id' => $plan->id]
        ]);
    }

    private function getSeatPlan(Request $request)
    {
        $extId = $request->input('external_id') ?? $request->query('external_id');
        $id = $request->input('id') ?? $request->query('id');

        if ($extId) {
            $plan = ExamSeatPlan::where('external_id', $extId)->first();
            if (!$plan) {
                return response()->json(['status' => 'error', 'message' => "Exam seat plan with external_id '{$extId}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $plan]);
        }

        if ($id) {
            $plan = ExamSeatPlan::find($id);
            if (!$plan) {
                return response()->json(['status' => 'error', 'message' => "Exam seat plan with id '{$id}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $plan]);
        }

        // Student roll inquiry: find room for student's roll in an exam!
        $rollNo = $request->input('roll_no') ?? $request->query('roll_no');
        $examName = $request->input('exam_name') ?? $request->input('exam') ?? $request->query('exam_name');
        if ($rollNo) {
            $q = ExamSeatPlan::query();
            if ($examName) {
                $q->where(function ($sq) use ($examName) {
                    $sq->where('exam_name', 'like', "%{$examName}%")
                       ->orWhere('exam_id', $examName);
                });
            }
            $plans = $q->get();
            foreach ($plans as $p) {
                if ($p->roll_from && $p->roll_to && is_numeric($rollNo) && is_numeric($p->roll_from) && is_numeric($p->roll_to)) {
                    if ((int)$rollNo >= (int)$p->roll_from && (int)$rollNo <= (int)$p->roll_to) {
                        return response()->json(['status' => 'success', 'data' => $p, 'matched_by' => 'roll_range']);
                    }
                }
                if ($p->allocated_rolls && str_contains((string)$p->allocated_rolls, (string)$rollNo)) {
                    return response()->json(['status' => 'success', 'data' => $p, 'matched_by' => 'allocated_rolls']);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Exam seat plan not found with provided criteria.'], 404);
    }

    private function listSeatPlans(Request $request)
    {
        $query = ExamSeatPlan::query();

        if ($request->filled('exam_name')) {
            $query->where('exam_name', 'like', '%' . $request->input('exam_name') . '%');
        }
        if ($request->filled('class_name')) {
            $query->where('class_name', 'like', '%' . $request->input('class_name') . '%');
        }
        if ($request->filled('room_no')) {
            $query->where('room_no', $request->input('room_no'));
        }
        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->input('academic_year'));
        }

        $perPage = min((int)($request->input('per_page', 50)), 200);
        $plans = $query->orderBy('room_no')->paginate($perPage);

        return response()->json(['status' => 'success', 'data' => $plans]);
    }

    private function fillSeatPlanData(ExamSeatPlan $plan, Request $request): void
    {
        if ($request->filled('external_id')) {
            $plan->external_id = (string)$request->input('external_id');
        }

        // Exam
        $examName = $request->input('exam_name') ?? $request->input('exam');
        $examId = $request->input('exam_id');
        if ($examId) {
            $foundExam = GlobalExam::where('id', $examId)->orWhere('external_id', $examId)->first();
            if ($foundExam) {
                $plan->exam_id = $foundExam->id;
                $examName = $examName ?: $foundExam->name;
            } else {
                $plan->exam_id = $examId;
            }
        }
        $plan->exam_name = $examName ?: ($plan->exam_name ?: 'Exam');

        if ($request->has('academic_year')) $plan->academic_year = (string)$request->input('academic_year');

        // Class & Section
        $className = $request->input('class_name') ?? $request->input('class');
        $classId = $request->input('class_id');
        if ($classId && AcademicClass::where('id', $classId)->exists()) {
            $plan->class_id = $classId;
        } elseif ($className) {
            $cls = AcademicClass::where('name', $className)->orWhere('name', 'like', "%{$className}%")->first();
            if ($cls) $plan->class_id = $cls->id;
        }
        $plan->class_name = $className ?: $plan->class_name;

        $sectionName = $request->input('section_name') ?? $request->input('section');
        $sectionId = $request->input('section_id');
        if ($sectionId && Section::where('id', $sectionId)->exists()) {
            $plan->section_id = $sectionId;
        } elseif ($sectionName) {
            $sec = Section::where('name', $sectionName)->first();
            if ($sec) $plan->section_id = $sec->id;
        }
        $plan->section_name = $sectionName ?: $plan->section_name;

        // Room & Allocation
        if ($request->has('room_no')) $plan->room_no = (string)$request->input('room_no');
        if ($request->has('building_name')) $plan->building_name = (string)$request->input('building_name');
        if ($request->has('roll_from')) $plan->roll_from = (string)$request->input('roll_from');
        if ($request->has('roll_to')) $plan->roll_to = (string)$request->input('roll_to');

        if ($request->has('allocated_rolls')) {
            $ar = $request->input('allocated_rolls');
            $plan->allocated_rolls = is_array($ar) ? implode(', ', $ar) : (string)$ar;
        }

        if ($request->has('total_seats')) $plan->total_seats = (int)$request->input('total_seats');
        if ($request->has('exam_date')) $plan->exam_date = $request->input('exam_date');
        if ($request->has('start_time')) $plan->start_time = $request->input('start_time');
        if ($request->has('end_time')) $plan->end_time = $request->input('end_time');
        if ($request->has('instructions')) $plan->instructions = (string)$request->input('instructions');
        if ($request->has('is_published')) $plan->is_published = (bool)$request->input('is_published');

        // File / PDF Attachment
        $fileContent = $request->input('file_content') ?? $request->input('file_base64') ?? $request->input('pdf_seat_plan');
        if ($fileContent && is_string($fileContent) && strlen($fileContent) > 300) {
            $this->saveBase64SeatPlanFile($fileContent, $plan, $request->input('file_name'));
        }
    }

    private function saveBase64SeatPlanFile(string $base64String, ExamSeatPlan $plan, ?string $customFileName = null): void
    {
        try {
            $extension = 'pdf';
            if (str_contains($base64String, ';base64,')) {
                [$meta, $content] = explode(';base64,', $base64String, 2);
                $fileData = base64_decode($content);
            } else {
                $fileData = base64_decode($base64String);
            }

            if ($customFileName && pathinfo($customFileName, PATHINFO_EXTENSION)) {
                $extension = strtolower(pathinfo($customFileName, PATHINFO_EXTENSION));
            }

            if ($fileData !== false) {
                $this->deleteOldSeatPlanFile($plan);
                $fileName = 'seat_plans/' . Str::random(16) . '.' . $extension;
                Storage::disk('public')->put($fileName, $fileData);
                $plan->file_path = $fileName;
            }
        } catch (\Exception $e) {
            Log::error("Seat Plan Base64 File Upload Failed: " . $e->getMessage());
        }
    }

    private function deleteOldSeatPlanFile(ExamSeatPlan $plan): void
    {
        if ($plan->file_path && Storage::disk('public')->exists($plan->file_path)) {
            Storage::disk('public')->delete($plan->file_path);
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                   DAILY ATTENDANCE SUMMARY HANDLERS                        */
    /* -------------------------------------------------------------------------- */

    private function insertAttendanceSummary(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['status' => 'error', 'message' => "Request payload is empty."], 422);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'total_students' => 'nullable|integer',
            'present_count' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $summary = null;
        if ($request->filled('external_id')) {
            $summary = DailyAttendanceSummary::firstOrNew(['external_id' => (string)$request->input('external_id')]);
        } else {
            $summary = DailyAttendanceSummary::firstOrNew([
                'date' => $request->input('date'),
                'class_name' => $request->input('class_name') ?? $request->input('class'),
                'section_name' => $request->input('section_name') ?? $request->input('section'),
            ]);
        }

        $this->fillAttendanceSummaryData($summary, $request);
        $summary->save();

        return response()->json([
            'status' => 'success',
            'message' => $summary->wasRecentlyCreated ? 'Attendance summary created successfully' : 'Attendance summary updated successfully',
            'data' => $summary
        ], $summary->wasRecentlyCreated ? 201 : 200);
    }

    private function bulkInsertAttendanceSummaries(Request $request)
    {
        $items = $request->input('summaries') ?? $request->input('attendance') ?? $request->input('data') ?? [];
        if (!is_array($items) || empty($items)) {
            $raw = $request->all();
            if (isset($raw[0]) && is_array($raw[0])) {
                $items = $raw;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload format. Expected an array of attendance items under key "summaries" or "data".'
                ], 422);
            }
        }

        $total = count($items);
        $inserted = 0;
        $updated = 0;
        $errors = [];

        foreach ($items as $idx => $item) {
            if (!is_array($item)) continue;
            $subReq = new Request($item);
            $this->normalizeIncomingRequest($subReq, 'attendance-summaries');

            try {
                $extId = $subReq->input('external_id');
                $summary = null;
                if ($extId) {
                    $summary = DailyAttendanceSummary::firstOrNew(['external_id' => (string)$extId]);
                } else {
                    $summary = DailyAttendanceSummary::firstOrNew([
                        'date' => $subReq->input('date', date('Y-m-d')),
                        'class_name' => $subReq->input('class_name') ?? $subReq->input('class'),
                        'section_name' => $subReq->input('section_name') ?? $subReq->input('section'),
                    ]);
                }
                $isNew = !$summary->exists;
                $this->fillAttendanceSummaryData($summary, $subReq);
                $summary->save();
                if ($isNew) $inserted++; else $updated++;
            } catch (\Exception $e) {
                $errors[] = ['index' => $idx, 'error' => $e->getMessage()];
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Bulk attendance summary sync completed: {$inserted} inserted, {$updated} updated.",
            'total_received' => $total,
            'inserted' => $inserted,
            'updated' => $updated,
            'errors' => $errors
        ], 200);
    }

    private function updateAttendanceSummary(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = DailyAttendanceSummary::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to update.'], 422);
        }

        $summary = $query->first();
        if (!$summary) {
            return response()->json(['status' => 'error', 'message' => 'Attendance summary record not found.'], 404);
        }

        $this->fillAttendanceSummaryData($summary, $request);
        $summary->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance summary updated successfully',
            'data' => $summary
        ]);
    }

    private function deleteAttendanceSummary(Request $request)
    {
        $extId = $request->input('external_id');
        $id = $request->input('id');

        $query = DailyAttendanceSummary::query();
        if ($extId) {
            $query->where('external_id', $extId);
        } elseif ($id) {
            $query->where('id', $id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Field external_id or id is required to delete.'], 422);
        }

        $summary = $query->first();
        if (!$summary) {
            return response()->json(['status' => 'error', 'message' => 'Attendance summary record not found.'], 404);
        }

        $summary->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance summary deleted successfully',
            'data' => ['external_id' => $summary->external_id, 'id' => $summary->id]
        ]);
    }

    private function getAttendanceSummary(Request $request)
    {
        $extId = $request->input('external_id') ?? $request->query('external_id');
        $id = $request->input('id') ?? $request->query('id');

        if ($extId) {
            $summary = DailyAttendanceSummary::where('external_id', $extId)->first();
            if (!$summary) {
                return response()->json(['status' => 'error', 'message' => "Attendance summary with external_id '{$extId}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $summary]);
        }

        if ($id) {
            $summary = DailyAttendanceSummary::find($id);
            if (!$summary) {
                return response()->json(['status' => 'error', 'message' => "Attendance summary with id '{$id}' not found."], 404);
            }
            return response()->json(['status' => 'success', 'data' => $summary]);
        }

        $date = $request->input('date') ?? $request->query('date') ?? date('Y-m-d');
        $className = $request->input('class_name') ?? $request->query('class_name');
        $sectionName = $request->input('section_name') ?? $request->query('section_name');

        $query = DailyAttendanceSummary::where('date', $date);
        if ($className) $query->where('class_name', $className);
        if ($sectionName) $query->where('section_name', $sectionName);

        $summary = $query->first();
        if (!$summary) {
            return response()->json(['status' => 'error', 'message' => 'Attendance summary not found with provided criteria.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $summary]);
    }

    private function listAttendanceSummaries(Request $request)
    {
        $query = DailyAttendanceSummary::query();

        if ($request->filled('date')) {
            $query->where('date', $request->input('date'));
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->input('start_date'), $request->input('end_date')]);
        }
        if ($request->filled('class_name')) {
            $query->where('class_name', $request->input('class_name'));
        }
        if ($request->filled('section_name')) {
            $query->where('section_name', $request->input('section_name'));
        }

        $perPage = min((int)($request->input('per_page', 50)), 200);
        $summaries = $query->orderByDesc('date')->orderBy('class_name')->paginate($perPage);

        return response()->json(['status' => 'success', 'data' => $summaries]);
    }

    private function fillAttendanceSummaryData(DailyAttendanceSummary $summary, Request $request): void
    {
        if ($request->filled('external_id')) {
            $summary->external_id = (string)$request->input('external_id');
        }

        if ($request->filled('date')) {
            $summary->date = $request->input('date');
        } elseif (!$summary->date) {
            $summary->date = date('Y-m-d');
        }

        // Class & Section
        $className = $request->input('class_name') ?? $request->input('class');
        $classId = $request->input('class_id');
        if ($classId && AcademicClass::where('id', $classId)->exists()) {
            $summary->class_id = $classId;
        } elseif ($className) {
            $cls = AcademicClass::where('name', $className)->orWhere('name', 'like', "%{$className}%")->first();
            if ($cls) $summary->class_id = $cls->id;
        }
        $summary->class_name = $className ?: $summary->class_name;

        $sectionName = $request->input('section_name') ?? $request->input('section');
        $sectionId = $request->input('section_id');
        if ($sectionId && Section::where('id', $sectionId)->exists()) {
            $summary->section_id = $sectionId;
        } elseif ($sectionName) {
            $sec = Section::where('name', $sectionName)->first();
            if ($sec) $summary->section_id = $sec->id;
        }
        $summary->section_name = $sectionName ?: $summary->section_name;

        // Metric counts
        $total = $request->input('total_students', $summary->total_students ?? 0);
        $present = $request->input('present_count', $summary->present_count ?? 0);
        $leave = $request->input('leave_count', $summary->leave_count ?? 0);
        $late = $request->input('late_count', $summary->late_count ?? 0);

        $absent = $request->has('absent_count') ? $request->input('absent_count') : max(0, $total - $present - $leave);

        $summary->total_students = (int)$total;
        $summary->present_count = (int)$present;
        $summary->absent_count = (int)$absent;
        $summary->leave_count = (int)$leave;
        $summary->late_count = (int)$late;

        // Attendance rate
        if ($request->has('attendance_rate')) {
            $summary->attendance_rate = (float)$request->input('attendance_rate');
        } else {
            $summary->attendance_rate = $total > 0 ? round(($present / $total) * 100, 2) : 0;
        }

        if ($request->has('remarks')) {
            $summary->remarks = $request->input('remarks');
        }
    }
}

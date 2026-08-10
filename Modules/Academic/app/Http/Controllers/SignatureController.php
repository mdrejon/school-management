<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\Signature;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Signatures/Index', [
            'signatures' => Signature::latest()->get()->map(function ($signature) {
                return [
                    'id' => $signature->id,
                    'place_at' => $signature->place_at,
                    'title' => $signature->title,
                    'signature_path' => $signature->signature_path ? Storage::url($signature->signature_path) : null,
                ];
            }),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'place_at' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'signature_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('signature_file')) {
            $data['signature_path'] = $request->file('signature_file')->store('signatures', 'public');
        }

        Signature::create([
            'place_at' => $data['place_at'],
            'title' => $data['title'],
            'signature_path' => $data['signature_path'] ?? null,
        ]);

        return back()->with('success', 'Signature created successfully.');
    }

    public function update(Request $request, Signature $signature)
    {
        $data = $request->validate([
            'place_at' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'signature_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('signature_file')) {
            if ($signature->signature_path) {
                Storage::disk('public')->delete($signature->signature_path);
            }
            $data['signature_path'] = $request->file('signature_file')->store('signatures', 'public');
        }

        $signature->update([
            'place_at' => $data['place_at'],
            'title' => $data['title'],
            'signature_path' => $data['signature_path'] ?? $signature->signature_path,
        ]);

        return back()->with('success', 'Signature updated successfully.');
    }

    public function destroy(Signature $signature)
    {
        if ($signature->signature_path) {
            Storage::disk('public')->delete($signature->signature_path);
        }
        $signature->delete();
        return back()->with('success', 'Signature deleted successfully.');
    }
}

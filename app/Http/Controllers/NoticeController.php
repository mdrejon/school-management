<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\NoticePageSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoticeController extends Controller
{
    public function index(Request $request): View
    {
        return view('frontend.notices.index', [
            'notices' => Notice::forList(10, $request->string('q')->trim()->value() ?: null),
            'search' => $request->string('q')->trim()->value(),
            'pageSettings' => NoticePageSetting::current(),
        ]);
    }

    public function show(Notice $notice): View
    {
        abort_unless($notice->is_active, 404);

        return view('frontend.notices.show', [
            'notice' => $notice,
            'pageSettings' => NoticePageSetting::current(),
        ]);
    }
}

<?php
$controllers = [
    'ResourceController' => 'Resource',
    'ClassLessonController' => 'ClassLesson',
    'PrayerController' => 'Prayer',
    'BehaviorController' => 'Behavior'
];

$teacherPath = 'd:\laragon-new\laragon\www\school-management\Modules\Teacher\app\Http\Controllers';
$adminPath = 'd:\laragon-new\laragon\www\school-management\Modules\Academic\app\Http\Controllers\Admin';

foreach ($controllers as $file => $modelName) {
    $content = file_get_contents("$teacherPath\\$file.php");
    
    // Replace Namespace
    $content = str_replace('namespace Modules\Teacher\Http\Controllers;', "namespace Modules\Academic\Http\Controllers\Admin;\n\nuse App\Models\User;", $content);
    
    // Replace Inertia Render Paths
    $content = str_replace("Inertia::render('Teacher/", "Inertia::render('Admin/Academic/", $content);
    
    // Replace Route names
    $content = str_replace("route('teacher.", "route('admin.academic.", $content);
    
    // Replace teacher_id auth()->id() with $request->teacher_id ?? auth()->id()
    // and add teachers to create/edit
    $content = str_replace("'teacher_id' => auth()->id()", "'teacher_id' => \$request->teacher_id ?? auth()->id()", $content);
    
    // Find index method and add 'teacher' to with()
    if (preg_match("/with\(\[?(.*?)\]?\)/", $content, $matches)) {
        $withArgs = $matches[1];
        if (!str_contains($withArgs, 'teacher')) {
            if ($withArgs === '') {
                $content = preg_replace("/with\(\)/", "with('teacher')", $content);
            } else if ($withArgs[0] === "'") {
                // it's a string like 'academicClass'
                $content = preg_replace("/with\('([^']+)'\)/", "with(['$1', 'teacher'])", $content);
            } else {
                $content = preg_replace("/with\(\[([^\]]+)\]\)/", "with([$1, 'teacher'])", $content);
            }
        }
    }
    
    // Modify create method to pass teachers
    $createStr = "public function create()\n    {\n";
    if (str_contains($content, $createStr)) {
        $content = str_replace($createStr, $createStr . "        \$teachers = User::role('staff')->get();\n", $content);
        $content = str_replace("]);", "    'teachers' => \$teachers,\n        ]);", $content);
    }
    
    file_put_contents("$adminPath\\$file.php", $content);
    echo "Generated $file\n";
}

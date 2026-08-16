<?php
$controllers = [
    'StudentAttendanceController',
    'ExamAttendanceController',
    'AttendanceReportController'
];

$teacherPath = 'd:\laragon-new\laragon\www\school-management\Modules\Teacher\app\Http\Controllers';
$adminPath = 'd:\laragon-new\laragon\www\school-management\Modules\Student\app\Http\Controllers\Admin';

foreach ($controllers as $file) {
    $content = file_get_contents("$teacherPath\\$file.php");
    
    // Replace Namespace
    $content = str_replace('namespace Modules\Teacher\Http\Controllers;', "namespace Modules\Student\Http\Controllers\Admin;\n\nuse App\Models\User;", $content);
    
    // Replace Inertia Render Paths
    $content = str_replace("Inertia::render('Teacher/", "Inertia::render('Admin/Student/", $content);
    
    // Replace Route names
    $content = str_replace("route('teacher.", "route('admin.students.", $content);
    
    file_put_contents("$adminPath\\$file.php", $content);
    echo "Generated $file\n";
}

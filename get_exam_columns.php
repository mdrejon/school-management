<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = ['exam_student_marks', 'class_exams'];
foreach($tables as $t) {
    if (\Illuminate\Support\Facades\Schema::hasTable($t)) {
        echo $t . ': ' . implode(', ', \Illuminate\Support\Facades\Schema::getColumnListing($t)) . "\n";
    } else {
        echo $t . ": NOT FOUND\n";
    }
}

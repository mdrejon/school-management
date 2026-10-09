<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$student = Modules\Student\Models\Student::where('roll_no', '40')->first();
echo "Direct attributes: " . $student->first_name . " " . $student->last_name . "\n";
echo "Translations: " . $student->getTranslation('first_name', 'en') . "\n";
$arr = $student->toArray();
echo "Array representation for Vue: " . (is_array($arr['first_name']) ? "ARRAY" : "STRING") . "\n";

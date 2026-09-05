<?php

$models = [
    'BlogPost' => 'blog_posts',
    'Department' => 'departments',
    'Event' => 'events',
    'GalleryImage' => 'gallery_images',
    'Slider' => 'sliders',
    'Teacher' => 'teachers',
    'Testimonial' => 'testimonials',
    'Notice' => 'notices',
];

foreach ($models as $model => $table) {
    $file = __DIR__ . "/app/Models/{$model}.php";
    $content = file_get_contents($file);

    // Remove Cache import if not used elsewhere
    $content = preg_replace('/use Illuminate\\\\Support\\\\Facades\\\\Cache;\n/', '', $content);

    // Remove booted method if we added it (Notice and BlogPost had existing booted methods)
    if ($model !== 'Notice' && $model !== 'BlogPost' && $model !== 'Course') {
        $content = preg_replace('/    protected static function booted\(\): void\n    \{\n        static::saved\(fn \(\) => Cache::forget\(\'.*?\'\)\);\n        static::deleted\(fn \(\) => Cache::forget\(\'.*?\'\)\);\n    \}\n\n/', '', $content);
    } else {
        // Remove just the Cache::forget lines
        $content = preg_replace('/        static::saved\(fn \(\) => Cache::forget\(\'.*?\'\)\);\n/', '', $content);
        $content = preg_replace('/        static::deleted\(fn \(\) => Cache::forget\(\'.*?\'\)\);\n/', '', $content);
    }

    // Revert the Cache::rememberForever wrapping
    if ($model === 'Notice') {
        $content = preg_replace('/return Cache::rememberForever\(\'.*?\', function \(\) use \(\$limit\) \{\n            return (static::where\(\'is_active\', true\)->latest\(\)->limit\(\$limit\)->get\(\));\n        \}\);/', 'return $1;', $content);
    } elseif ($model === 'Slider') {
        $content = preg_replace('/return Cache::rememberForever\(\'.*?\', function \(\) \{\n            return (static::where\(\'is_active\', true\)->orderBy\(\'sort_order\'\)->get\(\));\n        \}\);/', 'return $1;', $content);
    } else {
        $content = preg_replace('/return Cache::rememberForever\(\'.*?\', function \(\) use \(\$limit\) \{\n            return (static::where\(\'is_active\', true\)->orderBy\(\'sort_order\'\)->limit\(\$limit\)->get\(\));\n        \}\);/', 'return $1;', $content);
    }

    file_put_contents($file, $content);
    echo "Reverted {$model}\n";
}

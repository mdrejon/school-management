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

    // 1. Add Cache import
    if (strpos($content, 'use Illuminate\Support\Facades\Cache;') === false) {
        $content = str_replace(
            "use Illuminate\Database\Eloquent\Model;",
            "use Illuminate\Database\Eloquent\Model;\nuse Illuminate\Support\Facades\Cache;",
            $content
        );
    }

    $cacheKey = $model === 'Notice' ? 'notices.marquee' : "{$table}.homepage";

    // 2. Add booted method / invalidate cache
    $bootedLogic = "\n        static::saved(fn () => Cache::forget('{$cacheKey}'));\n        static::deleted(fn () => Cache::forget('{$cacheKey}'));\n";

    if (preg_match('/protected static function booted\(\): void\s*\{/', $content)) {
        $content = preg_replace('/(protected static function booted\(\): void\s*\{)/', "$1" . $bootedLogic, $content);
    } else {
        $bootedMethod = "    protected static function booted(): void\n    {" . $bootedLogic . "    }\n\n";
        $content = preg_replace('/(public static function for)/', $bootedMethod . "$1", $content);
    }

    // 3. Cache the query
    if ($model === 'Notice') {
        $content = preg_replace(
            '/return static::where\(\'is_active\', true\)\s*->latest\(\)\s*->limit\(\$limit\)\s*->get\(\);/',
            "return Cache::rememberForever('{$cacheKey}', function () use (\$limit) {\n            return static::where('is_active', true)->latest()->limit(\$limit)->get();\n        });",
            $content
        );
    } elseif ($model === 'Slider') {
        $content = preg_replace(
            '/return static::where\(\'is_active\', true\)\s*->orderBy\(\'sort_order\'\)\s*->get\(\);/',
            "return Cache::rememberForever('{$cacheKey}', function () {\n            return static::where('is_active', true)->orderBy('sort_order')->get();\n        });",
            $content
        );
    } else {
        $content = preg_replace(
            '/return static::where\(\'is_active\', true\)\s*->orderBy\(\'sort_order\'\)\s*->limit\(\$limit\)\s*->get\(\);/',
            "return Cache::rememberForever('{$cacheKey}', function () use (\$limit) {\n            return static::where('is_active', true)->orderBy('sort_order')->limit(\$limit)->get();\n        });",
            $content
        );
    }

    file_put_contents($file, $content);
    echo "Updated {$model}\n";
}

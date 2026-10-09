<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

echo "========================================================\n";
echo "EduEx School & College - Database Page Content Updater\n";
echo "========================================================\n\n";

$files = glob(__DIR__ . '/page_contents/*.php');
$updatedCount = 0;

foreach ($files as $file) {
    $data = require $file;
    $slug = $data['slug'];

    $page = Page::where('slug', $slug)->first();

    if (! $page) {
        $page = new Page();
        $page->slug = $slug;
        echo "Creating new page: {$slug}\n";
    } else {
        echo "Updating existing page [ID {$page->id}]: {$slug}\n";
    }

    // Set title
    if (! empty($data['title'])) {
        foreach ($data['title'] as $lang => $text) {
            if ($text !== null) {
                $page->setTranslation('title', $lang, $text);
            }
        }
    }

    // Set content
    if (! empty($data['content'])) {
        foreach ($data['content'] as $lang => $html) {
            if ($html !== null) {
                $page->setTranslation('content', $lang, $html);
            }
        }
    }

    // Set SEO title
    if (! empty($data['seo_title'])) {
        foreach ($data['seo_title'] as $lang => $text) {
            if ($text !== null) {
                $page->setTranslation('seo_title', $lang, $text);
            }
        }
    }

    // Set SEO description
    if (! empty($data['seo_description'])) {
        foreach ($data['seo_description'] as $lang => $text) {
            if ($text !== null) {
                $page->setTranslation('seo_description', $lang, $text);
            }
        }
    }

    $page->is_active = true;
    $page->save();

    $updatedCount++;
    echo "  -> Saved successfully! (Title: {$page->getTranslation('title', 'en', false)} | {$page->getTranslation('title', 'bn', false)})\n";
}

echo "\n--------------------------------------------------------\n";
echo "Total pages processed: {$updatedCount}\n";
echo "Running optimize:clear...\n";
\Illuminate\Support\Facades\Artisan::call('optimize:clear');
echo "Cache cleared!\n";
echo "========================================================\n";

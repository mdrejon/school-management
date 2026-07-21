<?php

namespace Tests\Feature;

use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class LanguageCacheTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_languages_survive_a_cache_round_trip(): void
    {
        // Tests default to the array cache driver, which never actually
        // serializes anything — that would let this test pass even with the
        // bug it's guarding against. Force the database driver (production's
        // default here, over SQLite) so the value really goes through
        // serialize()/unserialize(), which is what corrupted the cached
        // Eloquent Collection into a __PHP_Incomplete_Class before the fix.
        Config::set('cache.default', 'database');

        Language::create(['code' => 'en', 'name' => 'English', 'native_name' => 'English', 'direction' => 'ltr', 'is_default' => true, 'is_active' => true, 'sort_order' => 1]);
        Language::create(['code' => 'bn', 'name' => 'Bangla', 'native_name' => 'বাংলা', 'direction' => 'ltr', 'is_default' => false, 'is_active' => true, 'sort_order' => 2]);

        Cache::forget('languages.active');
        Language::active(); // cache miss — computes fresh and writes to the database cache table
        $languages = Language::active(); // cache hit — reads the serialized value back

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $languages);
        $this->assertCount(2, $languages);
        $this->assertIsArray($languages->toArray());
        $this->assertSame('en', $languages->first()->code);
    }
}

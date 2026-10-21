<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->json('site_title')->nullable()->after('site_name');
            $table->json('site_tagline')->nullable()->after('site_title');
            $table->json('meta_title')->nullable()->after('site_tagline');
        });

        // Initialize default translations for existing settings row if present
        $setting = \App\Models\SiteSetting::first();
        if ($setting) {
            $siteNameTranslations = $setting->getTranslations('site_name') ?: [];

            $setting->setTranslations('site_title', !empty($siteNameTranslations) ? $siteNameTranslations : [
                'en' => 'Sitakund Kamil M.A Madrasah',
                'bn' => 'সীতাকুণ্ড কামিল এম.এ মাদ্রাসা',
                'ar' => 'مدرسة الكامل الماجستير بسيتاكُند',
            ]);

            $setting->setTranslations('site_tagline', [
                'en' => 'Committed to Academic Excellence & Innovation',
                'bn' => 'শিক্ষা এবং উদ্ভাবনে অঙ্গীকারবদ্ধ',
                'ar' => 'ملتزمون بالتميز الأكاديمي والابتكار',
            ]);

            $setting->setTranslations('meta_title', [
                'en' => 'EduEx School and College - Home',
                'bn' => 'সীতাকুণ্ড কামিল এম.এ মাদ্রাসা - হোম',
                'ar' => 'مدرسة الكامل الماجستير بسيتاكُند - الرئيسية',
            ]);

            $setting->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['site_title', 'site_tagline', 'meta_title']);
        });
    }
};

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
            // The 4 info cards on /contact are dedicated to that page now,
            // not shared with the global address/phone/email under Header —
            // both the card's label ("Office Address") and its value are
            // per-language, since a school may want a different label
            // wording per language, not just a translated value.
            $table->json('contact_address_label')->nullable();
            $table->json('contact_address_value')->nullable();
            $table->json('contact_phone_label')->nullable();
            $table->json('contact_phone_value')->nullable();
            $table->json('contact_email_label')->nullable();
            $table->json('contact_email_value')->nullable();
            $table->json('contact_open_time_label')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_address_label',
                'contact_address_value',
                'contact_phone_label',
                'contact_phone_value',
                'contact_email_label',
                'contact_email_value',
                'contact_open_time_label',
            ]);
        });
    }
};

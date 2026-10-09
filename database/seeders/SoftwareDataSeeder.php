<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\SoftwareDataImporter;

class SoftwareDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $importer = app(SoftwareDataImporter::class);
        $stats = $importer->import();

        $this->command->info("SoftwareDataSeeder: Ingested {$stats['notices_imported']} notices, {$stats['students_imported']} students, {$stats['results_imported']} results, {$stats['routines_imported']} routines.");
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\StudentExcelImporter;

class StudentExcelDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path('docs/Untitled spreadsheet.xlsx');
        if (file_exists($file)) {
            $importer = new StudentExcelImporter();
            $importer->import($file);
            $this->command->info("✓ Student data from 'docs/Untitled spreadsheet.xlsx' seeded successfully.");
        } else {
            $this->command->warn("Spreadsheet 'docs/Untitled spreadsheet.xlsx' not found. Skipping.");
        }
    }
}

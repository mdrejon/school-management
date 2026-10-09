<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StudentExcelImporter;

class ImportStudentExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:import-excel {file=docs/Untitled spreadsheet.xlsx : Path to the student Excel file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import student profiles, exam results, subjects, and routines from an Excel spreadsheet';

    /**
     * Execute the console command.
     */
    public function handle(StudentExcelImporter $importer): int
    {
        $file = $this->argument('file');
        $this->info("Starting student import from: {$file}");

        try {
            $stats = $importer->import($file);

            $this->info("✓ Excel processing completed successfully!");
            $this->table(['Metric', 'Count'], [
                ['Total Rows in Sheet', $stats['total_rows']],
                ['Students Processed', $stats['students_processed']],
                ['Exam Results Processed', $stats['results_processed']],
                ['Subjects Ensured', $stats['subjects_ensured']],
                ['Routine Slots Created', $stats['routines_created']],
            ]);

            if (!empty($stats['details'])) {
                $this->info("Student Details:");
                $headers = ['Name', 'Roll', 'Class', 'Section', 'GPA', 'Grade', 'Total Marks', 'Subjects'];
                $this->table($headers, array_map(function ($d) {
                    return [
                        $d['student_name'],
                        $d['roll_no'],
                        $d['class'],
                        $d['section'],
                        number_format($d['gpa'], 2),
                        $d['grade'],
                        $d['total_marks'],
                        $d['subjects_count'],
                    ];
                }, $stats['details']));
            }

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error("Import failed: " . $e->getMessage());
            $this->line($e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}

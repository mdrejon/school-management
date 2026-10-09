<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SoftwareDataImporter;

class ImportSoftwareDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'software:import-data {file? : Optional path to software_data.json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import exported software data (Notices, Students, Results, and Routine) into the school management database';

    /**
     * Execute the console command.
     */
    public function handle(SoftwareDataImporter $importer): int
    {
        $filePath = $this->argument('file');

        $this->info('Starting software data import...');
        if ($filePath) {
            $this->line("Using file: {$filePath}");
        } else {
            $this->line('Using default file: docs/software_data.json');
        }

        try {
            $startTime = microtime(true);
            $stats = $importer->import($filePath);
            $duration = round(microtime(true) - $startTime, 2);

            $this->newLine();
            $this->info("Import completed successfully in {$duration}s!");
            $this->table(['Metric', 'Count'], [
                ['Notices Ingested', $stats['notices_imported']],
                ['Students Ingested', $stats['students_imported']],
                ['Exam Results Processed', $stats['results_imported']],
                ['Routine Slots Configured', $stats['routines_imported']],
            ]);

            if (!empty($stats['details'])) {
                $this->newLine();
                $this->info('Student Results Summary (3rd Term 2026 - Class 10 Science):');
                $rows = array_map(function ($d) {
                    return [
                        $d['roll'],
                        $d['name'],
                        $d['total'] . ' / 500',
                        number_format($d['gpa'], 2),
                        $d['grade'],
                    ];
                }, $stats['details']);

                $this->table(['Roll', 'Student Name', 'Total Marks', 'GPA', 'Grade'], $rows);
            }

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Failed to import software data: ' . $e->getMessage());
            $this->line($e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}

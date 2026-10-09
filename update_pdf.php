<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteSetting;

$settings = SiteSetting::current();
$schoolName = $settings->site_name ?? 'School Name';

$pdf_dir = "public/Notice";
$storage_pdf_dir = "storage/app/public/Notice";

if (!is_dir($pdf_dir)) mkdir($pdf_dir, 0777, true);
if (!is_dir($storage_pdf_dir)) mkdir($storage_pdf_dir, 0777, true);

$pdf_filename = "Notice of Durga Puja Holiday_20261009112952.pdf";

$lines = [
    $schoolName,
    "Notice Board / Office of the Principal",
    "Date: October 09, 2026",
    "",
    "REF NO: EX-ADM/NOT/2026-039",
    "",
    "NOTICE: DURGA PUJA HOLIDAY 2026",
    "",
    "This is for the information of all respected teachers, staff members,",
    "students, and guardians of " . $schoolName . " that the institution",
    "will remain closed on account of the holy festival of Durga Puja.",
    "",
    "Key Details:",
    "- Holiday Duration: October 10, 2026 to October 14, 2026",
    "- Class Resumption: October 15, 2026 (Thursday) as per regular routine",
    "- Emergency Contact: Academic Section (info@school.edu.bd)",
    "",
    "All students are advised to utilize this festive break productively",
    "and prepare for their upcoming 3rd Term terminal assessments.",
    "",
    "Warm wishes for a joyful and blessed festive season to everyone.",
    "",
    "By order of the Authority,",
    "Principal & Head of Institute",
    $schoolName . ", Chittagong, Bangladesh"
];

$stream_content = "BT\n/F1 18 Tf\n50 760 Td\n(" . str_replace(['(', ')'], ['\\(', '\\)'], $schoolName) . ") Tj\nET\n";
$stream_content .= "BT\n/F1 12 Tf\n50 740 Td\n(Office of the Principal | Notice Ref: EX-ADM/NOT/2026-039) Tj\nET\n";
$stream_content .= "BT\n/F1 10 Tf\n50 725 Td\n(Published: October 09, 2026) Tj\nET\n";
$stream_content .= "0 0 0 RG\n2 w\n50 715 m 550 715 l S\n";
$stream_content .= "BT\n/F1 15 Tf\n50 680 Td\n(NOTICE: DURGA PUJA HOLIDAY 2026) Tj\nET\n";

$y = 640;
foreach (array_slice($lines, 8) as $line) {
    if (empty($line)) {
        $y -= 12;
        continue;
    }
    $escaped = str_replace(['(', ')'], ['\\(', '\\)'], $line);
    $stream_content .= "BT\n/F1 11 Tf\n50 {$y} Td\n({$escaped}) Tj\nET\n";
    $y -= 18;
}

$stream_bytes = $stream_content;
$stream_len = strlen($stream_bytes);

$objects = [];
$objects[] = "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
$objects[] = "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n";
$objects[] = "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n";
$objects[] = "4 0 obj\n<< /Length {$stream_len} >>\nstream\n" . $stream_bytes . "\nendstream\nendobj\n";
$objects[] = "5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";

$header = "%PDF-1.4\n";
$offsets = [];
$current_offset = strlen($header);
$body = "";

foreach ($objects as $obj) {
    $offsets[] = $current_offset;
    $body .= $obj;
    $current_offset += strlen($obj);
}

$xref_offset = strlen($header) + strlen($body);
$xref = "xref\n0 " . (count($objects) + 1) . "\n0000000000 65535 f \n";
foreach ($offsets as $off) {
    $xref .= sprintf("%010d 00000 n \n", $off);
}

$trailer = "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n{$xref_offset}\n%%EOF\n";

$pdf_data = $header . $body . $xref . $trailer;

$paths = [
    $pdf_dir . '/' . $pdf_filename,
    $storage_pdf_dir . '/' . $pdf_filename,
    'public/storage/Notice/' . $pdf_filename
];

foreach ($paths as $path) {
    if (!is_dir(dirname($path))) mkdir(dirname($path), 0777, true);
    file_put_contents($path, $pdf_data);
    echo "Saved: $path\n";
}

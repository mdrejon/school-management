<?php

return [
    'slug' => 'exam-results',
    'title' => [
        'en' => 'Exam Results',
        'bn' => 'পরীক্ষার ফলাফল',
        'ar' => 'نتائج الامتحان',
    ],
    'seo_title' => [
        'en' => 'Examination Results Portal - EduEx School and College',
        'bn' => 'পরীক্ষার ফলাফল ও গ্রেডশিট - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Check online term examination results, transcript downloads, and Board exam stats at EduEx School and College.',
        'bn' => 'অনলাইনে পরীক্ষার ফলাফল অনুসন্ধান, একাডেমিক ট্রান্সক্রিপ্ট ও বোর্ড পরীক্ষার সার্বিক ফলাফল।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-success px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-award me-1"></i> Academic Results</span>
        <h2 class="fw-bold">Examination Results &amp; Academic Transcripts</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">Access your official term results, subject-wise marks breakdown, GPA grade sheets, and board examination summaries.</p>
    </div>

    <!-- How to Check Results Online -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-magnifying-glass me-2"></i> How to Check Your Result Online</h4>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">1</span>
                    <h6 class="fw-bold mb-1">Select Session</h6>
                    <small class="text-muted">Choose current academic year &amp; exam term.</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">2</span>
                    <h6 class="fw-bold mb-1">Enter Student ID</h6>
                    <small class="text-muted">Type your 6-digit unique Student ID number.</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">3</span>
                    <h6 class="fw-bold mb-1">Select Class / Stream</h6>
                    <small class="text-muted">Specify Class &amp; Section (Science / Commerce / Arts).</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">4</span>
                    <h6 class="fw-bold mb-1">Download Transcript</h6>
                    <small class="text-muted">View and download your verified PDF Grade Sheet.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Board Examination Summary -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-ranking-star me-2"></i> Board Examination Public Results Overview</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none text-center">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th>Examination</th>
                        <th>Total Candidates</th>
                        <th>Passed</th>
                        <th>Pass Rate</th>
                        <th>GPA-5.00 Count</th>
                        <th>Board Position</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>SSC Examination</strong></td>
                        <td>245 Students</td>
                        <td>245</td>
                        <td><span class="badge bg-success">100%</span></td>
                        <td><strong class="text-primary">208 (85%)</strong></td>
                        <td><span class="badge bg-warning text-dark">Top 10 in Board</span></td>
                    </tr>
                    <tr>
                        <td><strong>HSC Examination</strong></td>
                        <td>190 Students</td>
                        <td>189</td>
                        <td><span class="badge bg-success">99.5%</span></td>
                        <td><strong class="text-primary">152 (80%)</strong></td>
                        <td><span class="badge bg-warning text-dark">District Distinction</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Re-scrutiny (Khata Review) Policy -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-rotate-left me-2 text-primary"></i> Answer Script Re-Scrutiny (Review) Policy</h5>
        <p class="text-muted small mb-2">Students wishing to apply for answer script review or re-scrutiny must submit a formal application through the student portal within <strong>7 days</strong> of result publication. The academic review committee inspects addition of marks, unexamined questions, and transcript transcription.</p>
        <span class="badge bg-secondary">Application Fee: 200 BDT per subject</span>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-success px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-award me-1"></i> ফলাফল বিবরণী</span>
        <h2 class="fw-bold">পরীক্ষার ফলাফল ও গ্রেডশিট</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">টার্মভিত্তিক পরীক্ষার ফলাফল, বিষয়ভিত্তিক প্রাপ্ত নম্বর, জিপিএ গ্রেডশিট এবং পাবলিক বোর্ড পরীক্ষার সার্বিক ফলাফল।</p>
    </div>

    <!-- How to Check Results Online -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-magnifying-glass me-2"></i> অনলাইনে যেভাবে ফলাফল দেখবেন</h4>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">১</span>
                    <h6 class="fw-bold mb-1">শিক্ষাবর্ষ নির্বাচন</h6>
                    <small class="text-muted">চলতি শিক্ষাবর্ষ ও পরীক্ষার নাম নির্বাচন করুন।</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">২</span>
                    <h6 class="fw-bold mb-1">স্টুডেন্ট আইডি দিন</h6>
                    <small class="text-muted">আপনার ৬ ডিজিটের নির্দিষ্ট স্টুডেন্ট আইডি প্রদান করুন।</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">৩</span>
                    <h6 class="fw-bold mb-1">শ্রেণি ও শাখা</h6>
                    <small class="text-muted">সঠিক শ্রেণি ও বিভাগ (বিজ্ঞান / ব্যবসায় / মানবিক) বাছাই করুন।</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white rounded-3 border text-center h-100">
                    <span class="badge bg-primary p-2 rounded-circle mb-2">৪</span>
                    <h6 class="fw-bold mb-1">গ্রেডশিট সংগ্রহ</h6>
                    <small class="text-muted">অনলাইনে ফলাফল দেখুন ও ডিজিটাল ট্রান্সক্রিপ্ট প্রিন্ট নিন।</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Board Examination Summary -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-ranking-star me-2"></i> পাবলিক পরীক্ষার সাফল্য চিত্র</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none text-center">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th>পরীক্ষার নাম</th>
                        <th>মোট পরীক্ষার্থী</th>
                        <th>উত্তীর্ণ</th>
                        <th>পাসের হার</th>
                        <th>জিপিএ-৫ প্রাপ্তি</th>
                        <th>বোর্ড অবস্থান</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>এসএসসি পরীক্ষা</strong></td>
                        <td>২৪৫ জন</td>
                        <td>২৪৫ জন</td>
                        <td><span class="badge bg-success">১০০%</span></td>
                        <td><strong class="text-primary">২০৮ জন (৮৫%)</strong></td>
                        <td><span class="badge bg-warning text-dark">বোর্ডের শীর্ষ তালিকায়</span></td>
                    </tr>
                    <tr>
                        <td><strong>এইচএসসি পরীক্ষা</strong></td>
                        <td>১৯০ জন</td>
                        <td>১৮৯ জন</td>
                        <td><span class="badge bg-success">৯৯.৫%</span></td>
                        <td><strong class="text-primary">১৫২ জন (৮০%)</strong></td>
                        <td><span class="badge bg-warning text-dark">জেলা পর্যায়ে শ্রেষ্ঠত্ব</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Re-scrutiny (Khata Review) Policy -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-rotate-left me-2 text-primary"></i> উত্তরপত্র পুনঃনিরীক্ষণ (খাতা রিভিউ) নীতিমালা</h5>
        <p class="text-muted small mb-2">ফলাফল প্রকাশের <strong>০৭ দিনের মধ্যে</strong> সন্তুষ্ট না হওয়া পরীক্ষার্থীরা নির্ধারিত ফি জমাদান সাপেক্ষে স্টুডেন্ট পোর্টালের মাধ্যমে পুনঃনিরীক্ষণের আবেদন করতে পারবে। পরীক্ষা কমিটি উত্তরপত্রের নম্বর যোগ ও মূল্যায়নের যথার্থতা পুনঃনিরীক্ষা করবে।</p>
        <span class="badge bg-secondary">আবেদন ফি: বিষয় প্রতি ২০০ টাকা</span>
    </div>
</div>
HTML,
    ],
];

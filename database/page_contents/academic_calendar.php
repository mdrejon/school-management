<?php

return [
    'slug' => 'academic-calendar',
    'title' => [
        'en' => 'Academic Calendar',
        'bn' => 'একাডেমিক ক্যালেন্ডার',
        'ar' => 'التقويم الأكاديمي',
    ],
    'seo_title' => [
        'en' => 'Academic Calendar - EduEx School and College',
        'bn' => 'একাডেমিক ক্যালেন্ডার - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Annual academic calendar of EduEx School and College outlining terms, exams, sports, and vacations.',
        'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের বার্ষিক একাডেমিক ক্যালেন্ডার: টার্ম, পরীক্ষা, খেলাধুলা ও ছুটির পূর্ণাঙ্গ সময়সূচি।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-calendar-days me-1"></i> Academic Year</span>
        <h2 class="fw-bold">Annual Academic Calendar</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">A structured roadmap of academic terms, monthly evaluations, board pre-tests, co-curricular festivals, and scheduled institutional vacations.</p>
    </div>

    <!-- Term Overview -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light border-start border-4 border-primary">
                <span class="badge bg-primary mb-2 align-self-start">Term 01</span>
                <h5 class="fw-bold mb-1">First Term (Spring)</h5>
                <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> January – April</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Academic Session Opening</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> 1st Monthly Assessment</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Annual Sports Meet</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> First Term Final Exams</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light border-start border-4 border-info">
                <span class="badge bg-info text-dark mb-2 align-self-start">Term 02</span>
                <h5 class="fw-bold mb-1">Second Term (Mid-Year)</h5>
                <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> May – August</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> 2nd Monthly Assessment</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Science Fair &amp; Innovation Fest</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Half-Yearly / Mid-Term Exams</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Parent-Teacher Meeting (PTM)</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light border-start border-4 border-success">
                <span class="badge bg-success mb-2 align-self-start">Term 03</span>
                <h5 class="fw-bold mb-1">Final Term (Annual)</h5>
                <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> September – December</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Pre-Test &amp; Model Tests</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Cultural Week &amp; Study Tour</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Annual Final Examination</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> Result Day &amp; Prize Giving</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Detailed Schedule Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-list-check me-2"></i> Month-by-Month Academic Schedule</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 130px;">Month</th>
                        <th>Major Academic Events &amp; Exams</th>
                        <th>Co-Curricular / Special Events</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>January</strong></td>
                        <td>Orientation Day &amp; Textbook distribution; Class inception</td>
                        <td>House formation &amp; Annual Sports Practice begins</td>
                    </tr>
                    <tr>
                        <td><strong>February</strong></td>
                        <td>1st Monthly Diagnostic Test; Syllabus checkpoints</td>
                        <td>International Mother Language Day Celebration (21 Feb)</td>
                    </tr>
                    <tr>
                        <td><strong>March</strong></td>
                        <td>Preparation for First Term Examinations</td>
                        <td>Independence Day (26 Mar) &amp; Annual Sports Finale</td>
                    </tr>
                    <tr>
                        <td><strong>April</strong></td>
                        <td>First Term Examinations &amp; Answer Script Review</td>
                        <td>Bengali New Year (Pohela Boishakh) Cultural Fest</td>
                    </tr>
                    <tr>
                        <td><strong>May</strong></td>
                        <td>Resumption of classes for Term 2; 1st Term Result &amp; PTM</td>
                        <td>Inter-House Debate &amp; English Spelling Bee</td>
                    </tr>
                    <tr>
                        <td><strong>June</strong></td>
                        <td>2nd Monthly Evaluation Test; Practical classes intensive</td>
                        <td>World Environment Day Tree Plantation Campaign</td>
                    </tr>
                    <tr>
                        <td><strong>July</strong></td>
                        <td>Half-Yearly / Mid-Term Comprehensive Examinations</td>
                        <td>Inter-Class Science &amp; Robotics Exhibition</td>
                    </tr>
                    <tr>
                        <td><strong>August</strong></td>
                        <td>Mid-Term Results, Grade Sheet distribution &amp; Guardians' Meet</td>
                        <td>National Mourning Day Observance (15 Aug)</td>
                    </tr>
                    <tr>
                        <td><strong>September</strong></td>
                        <td>Class 10 &amp; Class 12 Pre-Test Examinations</td>
                        <td>Annual Study Tour / Field Excursion</td>
                    </tr>
                    <tr>
                        <td><strong>October</strong></td>
                        <td>3rd Monthly Assessment &amp; Revision modules</td>
                        <td>Inter-School Friendly Football/Cricket Tournament</td>
                    </tr>
                    <tr>
                        <td><strong>November</strong></td>
                        <td>SSC &amp; HSC Board Test Examinations</td>
                        <td>Annual Cultural Week &amp; Drama Fest</td>
                    </tr>
                    <tr>
                        <td><strong>December</strong></td>
                        <td>Annual Examination (Play to Class 9 &amp; 11); Result Publication</td>
                        <td>Victory Day (16 Dec) &amp; Annual Prize Giving Ceremony</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-calendar-days me-1"></i> শিক্ষাবর্ষের পরিকল্পনা</span>
        <h2 class="fw-bold">বার্ষিক একাডেমিক ক্যালেন্ডার</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">ক্লাস শুরু, মাসিক মূল্যায়ন, টার্ম পরীক্ষা, সহশিক্ষা প্রতিযোগিতা এবং ছুটির পূর্ণাঙ্গ বার্ষিক রূপরেখা।</p>
    </div>

    <!-- Term Overview -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light border-start border-4 border-primary">
                <span class="badge bg-primary mb-2 align-self-start">১ম টার্ম</span>
                <h5 class="fw-bold mb-1">প্রথম সাময়িক সেশন</h5>
                <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> জানুয়ারি – এপ্রিল</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> নতুন শিক্ষাবর্ষ ও বই বিতরণ</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> ১ম মাসিক মূল্যায়ন পরীক্ষা</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> বার্ষিক ক্রীড়া প্রতিযোগিতা</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> ১ম সাময়িক পরীক্ষা গ্রহণ</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light border-start border-4 border-info">
                <span class="badge bg-info text-dark mb-2 align-self-start">২য় টার্ম</span>
                <h5 class="fw-bold mb-1">অর্ধবার্ষিক সেশন</h5>
                <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> মে – আগস্ট</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> ২য় মাসিক মূল্যায়ন পরীক্ষা</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> বিজ্ঞান মেলা ও উদ্ভাবন উৎসব</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> অর্ধবার্ষিক পরীক্ষা গ্রহণ</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> অভিভাবক সমাবেশ ও ফলাফল প্রকাশ</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light border-start border-4 border-success">
                <span class="badge bg-success mb-2 align-self-start">৩য় টার্ম</span>
                <h5 class="fw-bold mb-1">বার্ষিক ও টেস্ট সেশন</h5>
                <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> সেপ্টেম্বর – ডিসেম্বর</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> নির্বাচনী ও মডেল টেস্ট পরীক্ষা</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> সাংস্কৃতিক সপ্তাহ ও শিক্ষা সফর</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> বার্ষিক চূড়ান্ত পরীক্ষা</li>
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-1"></i> ফলাফল প্রকাশ ও পুরস্কার বিতরণ</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Detailed Schedule Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-list-check me-2"></i> মাসভিত্তিক বিস্তারিত শিক্ষা কার্যক্রম</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 130px;">মাস</th>
                        <th>একাডেমিক কার্যক্রম ও পরীক্ষা</th>
                        <th>সহ-পাঠ্যক্রম ও বিশেষ আয়োজন</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>জানুয়ারি</strong></td>
                        <td>নতুন ক্লাসের ওরিয়েন্টেশন ও পাঠ্যপুস্তক বিতরণ; ক্লাস শুরু</td>
                        <td>হাউস গঠন ও বার্ষিক ক্রীড়া প্রস্তুতি</td>
                    </tr>
                    <tr>
                        <td><strong>ফেব্রুয়ারি</strong></td>
                        <td>১ম মাসিক মূল্যায়ন পরীক্ষা ও সিলেবাস অগ্রগতি পর্যালোচনা</td>
                        <td>আন্তর্জাতিক মাতৃভাষা দিবস (২১ ফেব্রুয়ারি) উদযাপন</td>
                    </tr>
                    <tr>
                        <td><strong>মার্চ</strong></td>
                        <td>প্রথম সাময়িক পরীক্ষার প্রস্তুতি ও রিভিশন ক্লাস</td>
                        <td>মহান স্বাধীনতা দিবস (২৬ মার্চ) ও বার্ষিক ক্রীড়া চূড়ান্ত পর্ব</td>
                    </tr>
                    <tr>
                        <td><strong>এপ্রিল</strong></td>
                        <td>প্রথম সাময়িক পরীক্ষা গ্রহণ ও খাতা মূল্যায়ন</td>
                        <td>পহেলা বৈশাখ বাংলা নববর্ষের সাংস্কৃতিক অনুষ্ঠান</td>
                    </tr>
                    <tr>
                        <td><strong>মে</strong></td>
                        <td>২য় টার্মের ক্লাস শুরু; ১ম টার্মের ফলাফল প্রকাশ ও অভিভাবক সমাবেশ</td>
                        <td>আন্তঃহাউস বিতর্ক ও বানান প্রতিযোগিতা</td>
                    </tr>
                    <tr>
                        <td><strong>জুন</strong></td>
                        <td>২য় মাসিক মূল্যায়ন পরীক্ষা; ল্যাবরেটরি প্র্যাকটিক্যাল ক্লাস</td>
                        <td>বিশ্ব পরিবেশ দিবস উপলক্ষে বৃক্ষরোপণ কর্মসূচি</td>
                    </tr>
                    <tr>
                        <td><strong>জুলাই</strong></td>
                        <td>অর্ধবার্ষিক পরীক্ষা ও ব্যবহারিক মূল্যায়ন গ্রহণ</td>
                        <td>আন্তঃক্লাস বিজ্ঞান ও রোবোটিক্স প্রদর্শনী</td>
                    </tr>
                    <tr>
                        <td><strong>আগস্ট</strong></td>
                        <td>অর্ধবার্ষিক পরীক্ষার ফলাফল প্রকাশ ও গ্রেডশিট বিতরণ</td>
                        <td>জাতীয় শোক দিবস (১৫ আগস্ট) পালন</td>
                    </tr>
                    <tr>
                        <td><strong>সেপ্টেম্বর</strong></td>
                        <td>এসএসসি ও এইচএসসি পরীক্ষার্থীদের প্রাক-নির্বাচনী পরীক্ষা</td>
                        <td>বার্ষিক শিক্ষা সফর ও বনভোজন</td>
                    </tr>
                    <tr>
                        <td><strong>অক্টোবর</strong></td>
                        <td>৩য় মাসিক মূল্যায়ন ও বার্ষিক পরীক্ষার প্রস্তুতিমূলক ক্লাস</td>
                        <td>আন্তঃস্কুল ফুটবল ও ক্রিকেট টুর্নামেন্ট</td>
                    </tr>
                    <tr>
                        <td><strong>নভেম্বর</strong></td>
                        <td>এসএসসি ও এইচএসসি নির্বাচনী (টেস্ট) পরীক্ষা গ্রহণ</td>
                        <td>বার্ষিক সাংস্কৃতিক সপ্তাহ ও নাট্যোৎসব</td>
                    </tr>
                    <tr>
                        <td><strong>ডিসেম্বর</strong></td>
                        <td>বার্ষিক পরীক্ষা (প্লে থেকে ৯ম ও ১১শ শ্রেণি); ফলাফল প্রকাশ</td>
                        <td>মহান বিজয় দিবস (১৬ ডিসেম্বর) ও পুরস্কার বিতরণী অনুষ্ঠান</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
HTML,
    ],
];

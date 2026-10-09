<?php

return [
    'slug' => 'exam-routine',
    'title' => [
        'en' => 'Exam Routine',
        'bn' => 'পরীক্ষার রুটিন',
        'ar' => 'روتين الامتحان',
    ],
    'seo_title' => [
        'en' => 'Examination Routine - EduEx School and College',
        'bn' => 'পরীক্ষার রুটিন ও সময়সূচি - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Master examination timetable and subject schedule for students at EduEx School and College.',
        'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের সকল শ্রেণির লিখিত ও ব্যবহারিক পরীক্ষার রুটিন ও সময়সূচি।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-clipboard-list me-1"></i> Timetable</span>
        <h2 class="fw-bold">Examination Schedule &amp; Routine</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">Detailed examination schedule for upcoming comprehensive terminal evaluations across all classes and academic streams.</p>
    </div>

    <!-- Timing Shifts -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-4 border text-center">
                <span class="badge bg-primary mb-1">Morning Shift</span>
                <h5 class="fw-bold mb-0">09:00 AM – 12:00 PM</h5>
                <small class="text-muted">Primary (Play – 5) &amp; High School (Class 6 – 10)</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-4 border text-center">
                <span class="badge bg-info text-dark mb-1">Afternoon Shift</span>
                <h5 class="fw-bold mb-0">01:30 PM – 04:30 PM</h5>
                <small class="text-muted">College Section (Class 11 – 12) &amp; Special Electives</small>
            </div>
        </div>
    </div>

    <!-- Master Exam Routine Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-calendar-days me-2"></i> Comprehensive Theory Examination Routine</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 140px;">Date &amp; Day</th>
                        <th>High School Subjects (6 – 10)</th>
                        <th>College Subjects (11 – 12)</th>
                        <th>Exam Session</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Day 01 (Sunday)</strong></td>
                        <td>Bangla 1st Paper</td>
                        <td>Bangla 1st Paper</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 02 (Tuesday)</strong></td>
                        <td>Bangla 2nd Paper</td>
                        <td>Bangla 2nd Paper</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 03 (Thursday)</strong></td>
                        <td>English 1st Paper</td>
                        <td>English 1st Paper</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 04 (Sunday)</strong></td>
                        <td>English 2nd Paper</td>
                        <td>English 2nd Paper</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 05 (Tuesday)</strong></td>
                        <td>General Mathematics</td>
                        <td>Physics / Accounting / Logic (1st Paper)</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 06 (Thursday)</strong></td>
                        <td>Physics / Business Ent. / History</td>
                        <td>Physics / Accounting / Logic (2nd Paper)</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 07 (Sunday)</strong></td>
                        <td>Chemistry / Accounting / Civics</td>
                        <td>Chemistry / Business Org. / Civics (1st Paper)</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 08 (Tuesday)</strong></td>
                        <td>Biology / Finance / Economics</td>
                        <td>Chemistry / Business Org. / Civics (2nd Paper)</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 09 (Thursday)</strong></td>
                        <td>Higher Math / Agriculture / Home Eco.</td>
                        <td>Biology / Higher Math / Finance (1st &amp; 2nd)</td>
                        <td><span class="badge bg-primary">09:00 AM – 12:00 PM</span></td>
                    </tr>
                    <tr>
                        <td><strong>Day 10 (Sunday)</strong></td>
                        <td>Information &amp; Communication Technology (ICT)</td>
                        <td>ICT (Theory &amp; MCQ)</td>
                        <td><span class="badge bg-primary">09:00 AM – 11:30 AM</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Candidate Rules -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-pen-nib me-2 text-primary"></i> Essential Instructions for Examinees</h5>
        <ul class="list-unstyled small text-muted mb-0">
            <li class="mb-1"><i class="fa-solid fa-circle-check text-success me-2"></i> Examinees must strictly fill out their Roll Number, Registration Number, and Subject Code on the OMR sheet accurately.</li>
            <li class="mb-1"><i class="fa-solid fa-circle-check text-success me-2"></i> Leaving the examination room is strictly barred during the first hour and last 15 minutes of the test.</li>
            <li class="mb-0"><i class="fa-solid fa-circle-check text-success me-2"></i> In case of unforeseen government general holidays, rescheduled exam dates will be officially notified through SMS and portal notice.</li>
        </ul>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-clipboard-list me-1"></i> সময়সূচি</span>
        <h2 class="fw-bold">পরীক্ষার রুটিন ও সময় বণ্টন</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">আসন্ন সাময়িক ও প্রাক-নির্বাচনী পরীক্ষার পূর্ণাঙ্গ বিষয়ভিত্তিক তারিখ ও সময়সূচি।</p>
    </div>

    <!-- Timing Shifts -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-4 border text-center">
                <span class="badge bg-primary mb-1">সকাল শিফট</span>
                <h5 class="fw-bold mb-0">সকাল ০৯:০০ – দুপুর ১২:০০</h5>
                <small class="text-muted">প্রাথমিক (প্লে – ৫ম) ও মাধ্যমিক শাখা (৬ষ্ঠ – ১০ম শ্রেণি)</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-4 border text-center">
                <span class="badge bg-info text-dark mb-1">বেলা শিফট</span>
                <h5 class="fw-bold mb-0">দুপুর ০১:৩০ – বিকাল ০৪:৩০</h5>
                <small class="text-muted">কলেজ শাখা (১১শ – ১২শ শ্রেণি) ও ঐচ্ছিক বিষয়সমূহ</small>
            </div>
        </div>
    </div>

    <!-- Master Exam Routine Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-calendar-days me-2"></i> বিষয়ভিত্তিক তত্ত্বীয় পরীক্ষার সময়সূচি</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 140px;">তারিখ ও বার</th>
                        <th>মাধ্যমিক স্তর (৬ষ্ঠ – ১০ম)</th>
                        <th>উচ্চমাধ্যমিক স্তর (১১শ – ১২শ)</th>
                        <th>সময়কাল</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>১ম দিন (রবিবার)</strong></td>
                        <td>বাংলা ১ম পত্র</td>
                        <td>বাংলা ১ম পত্র</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>২য় দিন (মঙ্গলবার)</strong></td>
                        <td>বাংলা ২য় পত্র</td>
                        <td>বাংলা ২য় পত্র</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৩য় দিন (বৃহস্পতিবার)</strong></td>
                        <td>ইংরেজি ১ম পত্র</td>
                        <td>ইংরেজি ১ম পত্র</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৪র্থ দিন (রবিবার)</strong></td>
                        <td>ইংরেজি ২য় পত্র</td>
                        <td>ইংরেজি ২য় পত্র</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৫ম দিন (মঙ্গলবার)</strong></td>
                        <td>সাধারণ গণিত</td>
                        <td>পদার্থবিজ্ঞান / হিসাববিজ্ঞান / যুক্তিবিদ্যা (১ম)</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৬ষ্ঠ দিন (বৃহস্পতিবার)</strong></td>
                        <td>পদার্থ / ব্যবসায় উদ্যোগ / ইতিহাস</td>
                        <td>পদার্থবিজ্ঞান / হিসাববিজ্ঞান / যুক্তিবিদ্যা (২য়)</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৭ম দিন (রবিবার)</strong></td>
                        <td>রসায়ন / ফিন্যান্স / পৌরনীতি</td>
                        <td>রসায়ন / ব্যবসায় সংগঠন / পৌরনীতি (১ম)</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৮ম দিন (মঙ্গলবার)</strong></td>
                        <td>জীববিজ্ঞান / সাধারণ বিজ্ঞান</td>
                        <td>রসায়ন / ব্যবসায় সংগঠন / পৌরনীতি (২য়)</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>৯ম দিন (বৃহস্পতিবার)</strong></td>
                        <td>উচ্চতর গণিত / কৃষি শিক্ষা</td>
                        <td>জীববিজ্ঞান / উচ্চতর গণিত / অর্থনীতি</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১২:০০</span></td>
                    </tr>
                    <tr>
                        <td><strong>১০ম দিন (রবিবার)</strong></td>
                        <td>তথ্য ও যোগাযোগ প্রযুক্তি (আইসিটি)</td>
                        <td>তথ্য ও যোগাযোগ প্রযুক্তি (আইসিটি)</td>
                        <td><span class="badge bg-primary">সকাল ০৯:০০ – ১১:৩০</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Candidate Rules -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-pen-nib me-2 text-primary"></i> পরীক্ষার্থীদের জন্য জরুরি নির্দেশনা</h5>
        <ul class="list-unstyled small text-muted mb-0">
            <li class="mb-1"><i class="fa-solid fa-circle-check text-success me-2"></i> উত্তরপত্রের ওএমআর অংশে রোল নম্বর, রেজিস্ট্রেশন ও বিষয় কোড সঠিকভাবে বৃত্ত ভরাট করতে হবে।</li>
            <li class="mb-1"><i class="fa-solid fa-circle-check text-success me-2"></i> পরীক্ষা শুরুর প্রথম এক ঘণ্টা এবং শেষ ১৫ মিনিটে কোনো পরীক্ষার্থীকে হল ত্যাগের অনুমতি দেওয়া হবে না।</li>
            <li class="mb-0"><i class="fa-solid fa-circle-check text-success me-2"></i> অনিবার্য কারণে কোনো পরীক্ষা স্থগিত হলে পরিবর্তিত সময়সূচি এসএমএস ও ওয়েবসাইটে প্রকাশ করা হবে।</li>
        </ul>
    </div>
</div>
HTML,
    ],
];

<?php

return [
    'slug' => 'class-routine',
    'title' => [
        'en' => 'Class Routine',
        'bn' => 'ক্লাস রুটিন',
        'ar' => 'روتين الفصل',
    ],
    'seo_title' => [
        'en' => 'Daily Class Routine & Timings - EduEx School and College',
        'bn' => 'দৈনিক ক্লাস রুটিন ও সময়সূচি - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Daily class schedule, periods, assembly hours, and breaks at EduEx School and College.',
        'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের দৈনিক ক্লাস রুটিন, পিরিয়ডের সময়, অ্যাসেম্বলি ও বিরতির পূর্ণ বিবরণ।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-clock me-1"></i> Daily Bell Schedule</span>
        <h2 class="fw-bold">Class Routine &amp; Timings</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">A disciplined, punctual daily timetable balancing rigorous academic lessons with refreshing breaks and assembly.</p>
    </div>

    <!-- Quick Time Summary -->
    <div class="row g-3 mb-4 text-center">
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Gate Closing</span>
                <strong class="text-danger fs-5">08:15 AM</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Morning Assembly</span>
                <strong class="text-primary fs-5">08:15 – 08:30 AM</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Tiffin / Break</span>
                <strong class="text-warning fs-5">10:45 – 11:15 AM</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">School Closing</span>
                <strong class="text-success fs-5">02:15 / 03:00 PM</strong>
            </div>
        </div>
    </div>

    <!-- Period Schedule Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-bell me-2"></i> Master Period Distribution Schedule</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 140px;">Period</th>
                        <th>Standard Time</th>
                        <th>Duration</th>
                        <th>Academic Focus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Assembly</strong></td>
                        <td>08:15 AM – 08:30 AM</td>
                        <td>15 Mins</td>
                        <td>National Anthem, Oath, Morning Physical Drill &amp; Moral Thought</td>
                    </tr>
                    <tr>
                        <td><strong>1st Period</strong></td>
                        <td>08:30 AM – 09:15 AM</td>
                        <td>45 Mins</td>
                        <td>Language &amp; Literature (Bangla / English)</td>
                    </tr>
                    <tr>
                        <td><strong>2nd Period</strong></td>
                        <td>09:15 AM – 10:00 AM</td>
                        <td>45 Mins</td>
                        <td>Mathematics / Higher Mathematics</td>
                    </tr>
                    <tr>
                        <td><strong>3rd Period</strong></td>
                        <td>10:00 AM – 10:45 AM</td>
                        <td>45 Mins</td>
                        <td>Core Science (Physics / Chemistry / Biology / Gen. Science)</td>
                    </tr>
                    <tr class="table-warning">
                        <td><strong><i class="fa-solid fa-mug-hot me-1"></i> Tiffin Break</strong></td>
                        <td>10:45 AM – 11:15 AM</td>
                        <td>30 Mins</td>
                        <td>Nutritious Tiffin, Refreshment &amp; Social Recreation</td>
                    </tr>
                    <tr>
                        <td><strong>4th Period</strong></td>
                        <td>11:15 AM – 12:00 PM</td>
                        <td>45 Mins</td>
                        <td>Social Science / Business Studies / History</td>
                    </tr>
                    <tr>
                        <td><strong>5th Period</strong></td>
                        <td>12:00 PM – 12:45 PM</td>
                        <td>45 Mins</td>
                        <td>ICT Lab / Religious &amp; Moral Studies</td>
                    </tr>
                    <tr>
                        <td><strong>6th Period</strong></td>
                        <td>12:45 PM – 01:30 PM</td>
                        <td>45 Mins</td>
                        <td>Practical Lab Work / Art &amp; Craft / Physical Education</td>
                    </tr>
                    <tr>
                        <td><strong>7th Period</strong></td>
                        <td>01:30 PM – 02:15 PM</td>
                        <td>45 Mins</td>
                        <td>Remedial Support, Problem-Solving &amp; Club Hours</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Shifts & Notes -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light">
                <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-sun text-warning me-2"></i> Primary Section Timings</h5>
                <p class="text-muted small mb-0">For Playgroup to Class 5, classes conclude daily at <strong>01:15 PM</strong> to accommodate children's resting schedules. Friday and Saturday are weekly holidays.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light">
                <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-school text-primary me-2"></i> High School &amp; College Timings</h5>
                <p class="text-muted small mb-0">For Class 6 to Class 12, classes run until <strong>02:15 PM / 03:00 PM</strong> (on days with laboratory sessions and sports clubs).</p>
            </div>
        </div>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-clock me-1"></i> দৈনিক সময়সূচি</span>
        <h2 class="fw-bold">দৈনিক ক্লাস রুটিন ও সময় বণ্টন</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">সময়নিষ্ঠতা ও শৃঙ্খলার সাথে সুষম পাঠদান, ল্যাব অনুশীলন এবং টিফিন বিরতির সমন্বয়ে সাজানো দৈনিক রুটিন।</p>
    </div>

    <!-- Quick Time Summary -->
    <div class="row g-3 mb-4 text-center">
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">গেট বন্ধের সময়</span>
                <strong class="text-danger fs-5">সকাল ০৮:১৫</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">প্রাত্যহিক সমাবেশ (Assembly)</span>
                <strong class="text-primary fs-5">০৮:১৫ – ০৮:৩০</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">টিফিন বিরতি</span>
                <strong class="text-warning fs-5">১০:৪৫ – ১১:১৫</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">ছুটি</span>
                <strong class="text-success fs-5">০১:১৫ / ০২:১৫</strong>
            </div>
        </div>
    </div>

    <!-- Period Schedule Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-bell me-2"></i> পিরিয়ডভিত্তিক পূর্ণাঙ্গ সময়সূচি</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 140px;">পিরিয়ড</th>
                        <th>সময়</th>
                        <th>ব্যাপ্তি</th>
                        <th>বিষয়ভিত্তিক পাঠদান</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>প্রাত্যহিক সমাবেশ</strong></td>
                        <td>০৮:১৫ – ০৮:৩০</td>
                        <td>১৫ মিনিট</td>
                        <td>জাতীয় সংগীত, শপথ পাঠ, শারীরিক কসরত ও নৈতিক অনুশাসন</td>
                    </tr>
                    <tr>
                        <td><strong>১ম পিরিয়ড</strong></td>
                        <td>০৮:৩০ – ০৯:১৫</td>
                        <td>৪৫ মিনিট</td>
                        <td>ভাষা ও সাহিত্য (বাংলা / ইংরেজি)</td>
                    </tr>
                    <tr>
                        <td><strong>২য় পিরিয়ড</strong></td>
                        <td>০৯:১৫ – ১০:০০</td>
                        <td>৪৫ মিনিট</td>
                        <td>গণিত / উচ্চতর গণিত</td>
                    </tr>
                    <tr>
                        <td><strong>৩য় পিরিয়ড</strong></td>
                        <td>১০:০০ – ১০:৪৫</td>
                        <td>৪৫ মিনিট</td>
                        <td>মৌলিক বিজ্ঞান (পদার্থ / রসায়ন / জীববিজ্ঞান / সাধারণ বিজ্ঞান)</td>
                    </tr>
                    <tr class="table-warning">
                        <td><strong><i class="fa-solid fa-mug-hot me-1"></i> টিফিন বিরতি</strong></td>
                        <td>১০:৪৫ – ১১:১৫</td>
                        <td>৩০ মিনিট</td>
                        <td>স্বাস্থ্যকর টিফিন গ্রহণ ও বিনোদন বিরতি</td>
                    </tr>
                    <tr>
                        <td><strong>৪র্থ পিরিয়ড</strong></td>
                        <td>১১:১৫ – ১২:০০</td>
                        <td>৪৫ মিনিট</td>
                        <td>সমাজবিজ্ঞান / ব্যবসায় উদ্যোগ / ইতিহাস / পৌরনীতি</td>
                    </tr>
                    <tr>
                        <td><strong>৫ম পিরিয়ড</strong></td>
                        <td>১২:০০ – ১২:৪৫</td>
                        <td>৪৫ মিনিট</td>
                        <td>তথ্য ও যোগাযোগ প্রযুক্তি (ল্যাব) / ধর্ম ও নৈতিক শিক্ষা</td>
                    </tr>
                    <tr>
                        <td><strong>৬ষ্ঠ পিরিয়ড</strong></td>
                        <td>১২:৪৫ – ০১:৩০</td>
                        <td>৪৫ মিনিট</td>
                        <td>ব্যবহারিক বিজ্ঞান পরীক্ষণ / চারু ও কারুকলা / শরীরচর্চা</td>
                    </tr>
                    <tr>
                        <td><strong>৭ম পিরিয়ড</strong></td>
                        <td>০১:৩০ – ০২:১৫</td>
                        <td>৪৫ মিনিট</td>
                        <td>বিশেষ নিবিড় পাঠদান, সমস্যা সমাধান ও ক্লাব কার্যক্রম</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Shifts & Notes -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light">
                <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-sun text-warning me-2"></i> প্রাথমিক শাখার সময়</h5>
                <p class="text-muted small mb-0">প্লে থেকে ৫ম শ্রেণি পর্যন্ত শিক্ষার্থীদের পাঠদান দুপুর <strong>০১:১৫ টায়</strong> সমাপ্ত হয়। শুক্র ও শনিবার সাপ্তাহিক ছুটি।</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light">
                <h5 class="fw-bold text-dark mb-2"><i class="fa-solid fa-school text-primary me-2"></i> মাধ্যমিক ও কলেজ শাখার সময়</h5>
                <p class="text-muted small mb-0">৬ষ্ঠ থেকে ১২শ শ্রেণি পর্যন্ত দুপুর <strong>০২:১৫ টা</strong> পর্যন্ত এবং ল্যাব/ক্লাব সেশন থাকলে <strong>০৩:০০ টা</strong> পর্যন্ত চলবে।</p>
            </div>
        </div>
    </div>
</div>
HTML,
    ],
];

<?php

return [
    'slug' => 'holiday-list',
    'title' => [
        'en' => 'Holiday List',
        'bn' => 'ছুটির তালিকা',
        'ar' => 'قائمة العطلات',
    ],
    'seo_title' => [
        'en' => 'Annual Holiday List - EduEx School and College',
        'bn' => 'বার্ষিক ছুটির তালিকা - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Official calendar of public, national, and seasonal holidays at EduEx School and College.',
        'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের বার্ষিক সরকারি, জাতীয় ও ধর্মীয় ছুটির পূর্ণাঙ্গ তালিকা।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-umbrella-beach me-1"></i> Vacation Schedule</span>
        <h2 class="fw-bold">Annual List of Holidays</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">Official gazetted schedule of national holidays, religious festivals, and seasonal vacation periods observed by EduEx School and College.</p>
    </div>

    <!-- Holiday Summary Badges -->
    <div class="row g-3 mb-4 text-center">
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Weekly Holidays</span>
                <strong class="text-primary fs-6">Friday &amp; Saturday</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Ramadan &amp; Eid Vacation</span>
                <strong class="text-success fs-6">15 Working Days</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Summer Vacation</span>
                <strong class="text-warning fs-6">10 Working Days</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">Winter Vacation</span>
                <strong class="text-info fs-6">07 Working Days</strong>
            </div>
        </div>
    </div>

    <!-- Holiday Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-calendar-check me-2"></i> Gazetted Holiday Calendar</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Occasion / Festival</th>
                        <th>Estimated Date &amp; Day</th>
                        <th>Duration</th>
                        <th>Holiday Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold">01</td>
                        <td><strong class="text-dark">Shab-e-Barat *</strong></td>
                        <td>February 15, Sunday</td>
                        <td>01 Day</td>
                        <td><span class="badge bg-secondary">Religious</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">02</td>
                        <td><strong class="text-dark">International Mother Language Day</strong></td>
                        <td>February 21, Saturday</td>
                        <td>01 Day</td>
                        <td><span class="badge bg-danger">National</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">03</td>
                        <td><strong class="text-dark">Independence &amp; National Day</strong></td>
                        <td>March 26, Thursday</td>
                        <td>01 Day</td>
                        <td><span class="badge bg-danger">National</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">04</td>
                        <td><strong class="text-dark">Holy Ramadan, Shab-e-Qadr &amp; Eid-ul-Fitr</strong></td>
                        <td>March 20 – April 04</td>
                        <td>15 Days</td>
                        <td><span class="badge bg-success">Major Vacation</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">05</td>
                        <td><strong class="text-dark">Bengali New Year (Pohela Boishakh)</strong></td>
                        <td>April 14, Tuesday</td>
                        <td>01 Day</td>
                        <td><span class="badge bg-warning text-dark">Cultural</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">06</td>
                        <td><strong class="text-dark">May Day &amp; Buddha Purnima</strong></td>
                        <td>May 01 &amp; May 12</td>
                        <td>02 Days</td>
                        <td><span class="badge bg-secondary">Gazetted</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">07</td>
                        <td><strong class="text-dark">Eid-ul-Adha &amp; Summer Vacation</strong></td>
                        <td>June 05 – June 16</td>
                        <td>10 Days</td>
                        <td><span class="badge bg-success">Major Vacation</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">08</td>
                        <td><strong class="text-dark">Holy Ashura &amp; Janmashtami</strong></td>
                        <td>July 06 &amp; August 16</td>
                        <td>02 Days</td>
                        <td><span class="badge bg-secondary">Religious</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">09</td>
                        <td><strong class="text-dark">Eid-e-Miladunnabi (PBUH)</strong></td>
                        <td>September 05, Friday</td>
                        <td>01 Day</td>
                        <td><span class="badge bg-secondary">Religious</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">10</td>
                        <td><strong class="text-dark">Durga Puja &amp; Autumn Vacation</strong></td>
                        <td>October 01 – October 05</td>
                        <td>05 Days</td>
                        <td><span class="badge bg-warning text-dark">Religious &amp; Autumn</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">11</td>
                        <td><strong class="text-dark">Great Victory Day</strong></td>
                        <td>December 16, Wednesday</td>
                        <td>01 Day</td>
                        <td><span class="badge bg-danger">National</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">12</td>
                        <td><strong class="text-dark">Christmas Day &amp; Winter Vacation</strong></td>
                        <td>December 25 – December 31</td>
                        <td>07 Days</td>
                        <td><span class="badge bg-info text-dark">Winter Vacation</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <small class="text-muted d-block mt-2"><em>* Note: Islamic religious holidays are subject to the sighting of the moon. National Days are observed with flag hoisting and assemblies at school premises.</em></small>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-umbrella-beach me-1"></i> অবকাশ যাপন</span>
        <h2 class="fw-bold">বার্ষিক ছুটির তালিকা</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">এডুএক্স স্কুল অ্যান্ড কলেজের অনুমোদিত সরকারি, জাতীয় দিবস ও ধর্মীয় উৎসবের বাৎসরিক ছুটির তালিকা।</p>
    </div>

    <!-- Holiday Summary Badges -->
    <div class="row g-3 mb-4 text-center">
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">সাপ্তাহিক ছুটি</span>
                <strong class="text-primary fs-6">শুক্রবার ও শনিবার</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">রমজান ও ঈদুল ফিতর</span>
                <strong class="text-success fs-6">১৫ কর্মদিবস</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">গ্রীষ্মকালীন ও ঈদুল আজহা</span>
                <strong class="text-warning fs-6">১০ কর্মদিবস</strong>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 bg-light rounded-4 border">
                <span class="text-muted small d-block">শীতকালীন ছুটি</span>
                <strong class="text-info fs-6">০৭ কর্মদিবস</strong>
            </div>
        </div>
    </div>

    <!-- Holiday Table -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-calendar-check me-2"></i> বাৎসরিক ছুটির বিবরণ</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 60px;">ক্রমিক</th>
                        <th>ছুটির বিবরণ ও উপলক্ষ</th>
                        <th>সম্ভাব্য তারিখ ও বার</th>
                        <th>ছুটির ব্যাপ্তি</th>
                        <th>ছুটির ধরন</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold">০১</td>
                        <td><strong class="text-dark">পবিত্র শবে বরাত *</strong></td>
                        <td>১৫ ফেব্রুয়ারি, রবিবার</td>
                        <td>০১ দিন</td>
                        <td><span class="badge bg-secondary">ধর্মীয়</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০২</td>
                        <td><strong class="text-dark">আন্তর্জাতিক মাতৃভাষা দিবস</strong></td>
                        <td>২১ ফেব্রুয়ারি, শনিবার</td>
                        <td>০১ দিন</td>
                        <td><span class="badge bg-danger">জাতীয়</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৩</td>
                        <td><strong class="text-dark">মহান স্বাধীনতা ও জাতীয় দিবস</strong></td>
                        <td>২৬ মার্চ, বৃহস্পতিবার</td>
                        <td>০১ দিন</td>
                        <td><span class="badge bg-danger">জাতীয়</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৪</td>
                        <td><strong class="text-dark">পবিত্র রমজান, শবে কদর ও ঈদুল ফিতর</strong></td>
                        <td>২০ মার্চ – ০৪ এপ্রিল</td>
                        <td>১৫ দিন</td>
                        <td><span class="badge bg-success">দীর্ঘ অবকাশ</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৫</td>
                        <td><strong class="text-dark">বাংলা নববর্ষ (পহেলা বৈশাখ)</strong></td>
                        <td>১৪ এপ্রিল, মঙ্গলবার</td>
                        <td>০১ দিন</td>
                        <td><span class="badge bg-warning text-dark">সাংস্কৃতিক</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৬</td>
                        <td><strong class="text-dark">মে দিবস ও বুদ্ধ পূর্ণিমা</strong></td>
                        <td>০১ মে ও ১২ মে</td>
                        <td>০২ দিন</td>
                        <td><span class="badge bg-secondary">সরকারি</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৭</td>
                        <td><strong class="text-dark">পবিত্র ঈদুল আজহা ও গ্রীষ্মকালীন ছুটি</strong></td>
                        <td>০৫ জুন – ১৬ জুন</td>
                        <td>১০ দিন</td>
                        <td><span class="badge bg-success">দীর্ঘ অবকাশ</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৮</td>
                        <td><strong class="text-dark">পবিত্র আশুরা ও জন্মাষ্টমী</strong></td>
                        <td>০৬ জুলাই ও ১৬ আগস্ট</td>
                        <td>০২ দিন</td>
                        <td><span class="badge bg-secondary">ধর্মীয়</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৯</td>
                        <td><strong class="text-dark">পবিত্র ঈদে মিলাদুন্নবী (সা.) *</strong></td>
                        <td>০৫ সেপ্টেম্বর, শুক্রবার</td>
                        <td>০১ দিন</td>
                        <td><span class="badge bg-secondary">ধর্মীয়</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">১০</td>
                        <td><strong class="text-dark">শারদীয় দুর্গাপূজা ও শরৎকালীন ছুটি</strong></td>
                        <td>০১ অক্টোবর – ০৫ অক্টোবর</td>
                        <td>০৫ দিন</td>
                        <td><span class="badge bg-warning text-dark">ধর্মীয় উৎসব</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">১১</td>
                        <td><strong class="text-dark">মহান বিজয় দিবস</strong></td>
                        <td>১৬ ডিসেম্বর, বুধবার</td>
                        <td>০১ দিন</td>
                        <td><span class="badge bg-danger">জাতীয়</span></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">১২</td>
                        <td><strong class="text-dark">যিশু খ্রিস্টের জন্মদিন ও শীতকালীন ছুটি</strong></td>
                        <td>২৫ ডিসেম্বর – ৩১ ডিসেম্বর</td>
                        <td>০৭ দিন</td>
                        <td><span class="badge bg-info text-dark">শীতকালীন ছুটি</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <small class="text-muted d-block mt-2"><em>* বিশেষ দ্রষ্টব্য: মুসলিম ধর্মীয় ছুটির তারিখ চাঁদ দেখার ওপর নির্ভরশীল। জাতীয় দিবসগুলোতে ক্যাম্পাসে জাতীয় পতাকা উত্তোলন ও আলোচনা সভার আয়োজন করা হবে।</em></small>
    </div>
</div>
HTML,
    ],
];

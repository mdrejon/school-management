<?php

return [
    'slug' => 'staff-information',
    'title' => [
        'en' => 'Staff Information',
        'bn' => 'কর্মকর্তা ও কর্মচারী বৃন্দ',
        'ar' => 'معلومات الموظفين',
    ],
    'seo_title' => [
        'en' => 'Staff Information - EduEx School and College',
        'bn' => 'কর্মকর্তা ও কর্মচারী বৃন্দ - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Explore the administrative, technical, and operational staff directory of EduEx School and College.',
        'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের দক্ষ প্রশাসনিক কর্মকর্তা, ল্যাব টেকনিশিয়ান এবং সাপোর্ট স্টাফদের বিস্তারিত তালিকা।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-address-card me-1"></i> Staff Directory</span>
        <h2 class="fw-bold">Administrative &amp; Support Staff</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">The dedicated backbone of EduEx School and College ensuring smooth daily operations, student services, and campus maintenance.</p>
    </div>

    <!-- Administrative Section -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-building-user me-2"></i> Administrative &amp; Accounts Division</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Contact / Email</th>
                        <th>Office Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold">01</td>
                        <td><strong class="text-dark">Md. Jahangir Alam</strong></td>
                        <td>Head Assistant &amp; Office Superintendent</td>
                        <td>General Administration</td>
                        <td>admin@eduex.edu.bd</td>
                        <td>Admin Block, Room 101</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">02</td>
                        <td><strong class="text-dark">Md. Kamal Hossain</strong></td>
                        <td>Senior Accounts Officer</td>
                        <td>Finance &amp; Accounts</td>
                        <td>accounts@eduex.edu.bd</td>
                        <td>Accounts Office, Room 103</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">03</td>
                        <td><strong class="text-dark">Md. Tariqul Islam</strong></td>
                        <td>IT &amp; Database Administrator</td>
                        <td>Information Technology</td>
                        <td>it@eduex.edu.bd</td>
                        <td>Server &amp; IT Lab, Room 204</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">04</td>
                        <td><strong class="text-dark">S. M. Faruq Ahmed</strong></td>
                        <td>Section Officer (Examination)</td>
                        <td>Controller of Exams</td>
                        <td>exam@eduex.edu.bd</td>
                        <td>Exam Control Wing, Room 105</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">05</td>
                        <td><strong class="text-dark">Begum Nasrin Akhter</strong></td>
                        <td>Librarian</td>
                        <td>Central Library</td>
                        <td>library@eduex.edu.bd</td>
                        <td>Central Library, 2nd Floor</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">06</td>
                        <td><strong class="text-dark">Md. Tanvir Hasan</strong></td>
                        <td>Assistant Librarian</td>
                        <td>Central Library</td>
                        <td>tanvir.lib@eduex.edu.bd</td>
                        <td>Central Library, 2nd Floor</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laboratory & Technical Staff -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-flask-vial me-2"></i> Laboratory &amp; Technical Support</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Laboratory Assigned</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold">01</td>
                        <td><strong class="text-dark">Md. Abu Sayeed</strong></td>
                        <td>Senior Lab Demonstrator</td>
                        <td>Physics Laboratory</td>
                        <td>sayeed.phys@eduex.edu.bd</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">02</td>
                        <td><strong class="text-dark">Md. Monirul Islam</strong></td>
                        <td>Lab Demonstrator</td>
                        <td>Chemistry Laboratory</td>
                        <td>monirul.chem@eduex.edu.bd</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">03</td>
                        <td><strong class="text-dark">Rasheda Begum</strong></td>
                        <td>Lab Assistant</td>
                        <td>Biology Laboratory</td>
                        <td>rasheda.bio@eduex.edu.bd</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">04</td>
                        <td><strong class="text-dark">Md. Shakil Ahmed</strong></td>
                        <td>Hardware &amp; Network Assistant</td>
                        <td>Computer &amp; Robotics Lab</td>
                        <td>shakil.it@eduex.edu.bd</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Campus Care & Security -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-shield-cat me-2"></i> Campus Security &amp; Caretakers</h4>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-user-shield fs-2 text-primary mb-2"></i>
                    <h6 class="fw-bold mb-1">Md. Abul Kashem</h6>
                    <small class="text-muted d-block">Security Supervisor</small>
                    <span class="badge bg-success mt-2">24/7 Security Desk</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-id-badge fs-2 text-secondary mb-2"></i>
                    <h6 class="fw-bold mb-1">Md. Nurul Islam</h6>
                    <small class="text-muted d-block">Senior Office Attendant</small>
                    <span class="badge bg-secondary mt-2">Principal's Office</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-id-badge fs-2 text-secondary mb-2"></i>
                    <h6 class="fw-bold mb-1">Md. Sohel Rana</h6>
                    <small class="text-muted d-block">Campus Caretaker</small>
                    <span class="badge bg-secondary mt-2">Academic Building</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-id-badge fs-2 text-secondary mb-2"></i>
                    <h6 class="fw-bold mb-1">Salma Begum</h6>
                    <small class="text-muted d-block">Female Caretaker</small>
                    <span class="badge bg-secondary mt-2">Primary Section</span>
                </div>
            </div>
        </div>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-address-card me-1"></i> কর্মকর্তা ও কর্মচারী তালিকা</span>
        <h2 class="fw-bold">প্রশাসনিক কর্মকর্তা ও কর্মচারী বৃন্দ</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">এডুএক্স স্কুল অ্যান্ড কলেজের প্রাতিষ্ঠানিক কার্যক্রম, নিরাপত্তা ও শিক্ষার্থী সেবায় নিরলস নিয়োজিত দক্ষ কর্মীবাহিনী।</p>
    </div>

    <!-- Administrative Section -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-building-user me-2"></i> প্রশাসনিক ও হিসাব বিভাগ</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 60px;">ক্রমিক</th>
                        <th>নাম</th>
                        <th>পদবি</th>
                        <th>বিভাগ / শাখা</th>
                        <th>ইমেইল / যোগাযোগ</th>
                        <th>দাপ্তরিক অবস্থান</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold">০১</td>
                        <td><strong class="text-dark">মোঃ জাহাঙ্গীর আলম</strong></td>
                        <td>প্রধান সহকারী ও অফিস সুপার</td>
                        <td>সাধারণ প্রশাসন</td>
                        <td>admin@eduex.edu.bd</td>
                        <td>প্রশাসনিক ভবন, কক্ষ ১০১</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০২</td>
                        <td><strong class="text-dark">মোঃ কামাল হোসেন</strong></td>
                        <td>সিনিয়র হিসাবরক্ষণ কর্মকর্তা</td>
                        <td>অর্থ ও হিসাব বিভাগ</td>
                        <td>accounts@eduex.edu.bd</td>
                        <td>হিসাব শাখা, কক্ষ ১০৩</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৩</td>
                        <td><strong class="text-dark">মোঃ তরিকুল ইসলাম</strong></td>
                        <td>আইটি ও ডেটাবেজ প্রশাসক</td>
                        <td>তথ্য ও যোগাযোগ প্রযুক্তি</td>
                        <td>it@eduex.edu.bd</td>
                        <td>সার্ভার ও আইটি কক্ষ ২০৪</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৪</td>
                        <td><strong class="text-dark">এস. এম. ফারুক আহমেদ</strong></td>
                        <td>শাখা কর্মকর্তা (পরীক্ষা নিয়ন্ত্রণ)</td>
                        <td>পরীক্ষা নিয়ন্ত্রণ শাখা</td>
                        <td>exam@eduex.edu.bd</td>
                        <td>পরীক্ষা কক্ষ ১০৫</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৫</td>
                        <td><strong class="text-dark">বেগম নাসরিন আক্তার</strong></td>
                        <td>গ্রন্থাগারিক (Librarian)</td>
                        <td>কেন্দ্রীয় লাইব্রেরি</td>
                        <td>library@eduex.edu.bd</td>
                        <td>লাইব্রেরি ভবন, ২য় তলা</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৬</td>
                        <td><strong class="text-dark">মোঃ তানভীর হাসান</strong></td>
                        <td>সহকারী গ্রন্থাগারিক</td>
                        <td>কেন্দ্রীয় লাইব্রেরি</td>
                        <td>tanvir.lib@eduex.edu.bd</td>
                        <td>লাইব্রেরি ভবন, ২য় তলা</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laboratory & Technical Staff -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-flask-vial me-2"></i> ল্যাবরেটরি ও টেকনিক্যাল সাপোর্ট স্টাফ</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th style="width: 60px;">ক্রমিক</th>
                        <th>নাম</th>
                        <th>পদবি</th>
                        <th>দায়িত্বপ্রাপ্ত ল্যাবরেটরি</th>
                        <th>ইমেইল / যোগাযোগ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fw-bold">০১</td>
                        <td><strong class="text-dark">মোঃ আবু সাঈদ</strong></td>
                        <td>সিনিয়র ল্যাব প্রদর্শক</td>
                        <td>পদার্থবিজ্ঞান ল্যাব</td>
                        <td>sayeed.phys@eduex.edu.bd</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০২</td>
                        <td><strong class="text-dark">মোঃ মনিরুল ইসলাম</strong></td>
                        <td>ল্যাব প্রদর্শক</td>
                        <td>রসায়ন ল্যাব</td>
                        <td>monirul.chem@eduex.edu.bd</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৩</td>
                        <td><strong class="text-dark">রাশেদা বেগম</strong></td>
                        <td>ল্যাব সহকারী</td>
                        <td>জীববিজ্ঞান ল্যাব</td>
                        <td>rasheda.bio@eduex.edu.bd</td>
                    </tr>
                    <tr>
                        <td class="text-center fw-bold">০৪</td>
                        <td><strong class="text-dark">মোঃ শাকিল আহমেদ</strong></td>
                        <td>হার্ডওয়্যার ও নেটওয়ার্ক সহকারী</td>
                        <td>কম্পিউটার ও রোবোটিক্স ল্যাব</td>
                        <td>shakil.it@eduex.edu.bd</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Campus Care & Security -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-shield-cat me-2"></i> ক্যাম্পাস নিরাপত্তা ও সহকারী কর্মচারী</h4>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-user-shield fs-2 text-primary mb-2"></i>
                    <h6 class="fw-bold mb-1">মোঃ আবুল কাশেম</h6>
                    <small class="text-muted d-block">প্রধান নিরাপত্তা তত্ত্বাবধায়ক</small>
                    <span class="badge bg-success mt-2">সার্বক্ষণিক নিরাপত্তা ডেস্ক</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-id-badge fs-2 text-secondary mb-2"></i>
                    <h6 class="fw-bold mb-1">মোঃ নুরুল ইসলাম</h6>
                    <small class="text-muted d-block">সিনিয়র এমএলএসএস</small>
                    <span class="badge bg-secondary mt-2">অধ্যক্ষের কার্যালয়</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-id-badge fs-2 text-secondary mb-2"></i>
                    <h6 class="fw-bold mb-1">মোঃ সোহেল রানা</h6>
                    <small class="text-muted d-block">ভবন সহকারী</small>
                    <span class="badge bg-secondary mt-2">একাডেমিক ভবন</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-3 border rounded-3 bg-light text-center">
                    <i class="fa-solid fa-id-badge fs-2 text-secondary mb-2"></i>
                    <h6 class="fw-bold mb-1">সালমা বেগম</h6>
                    <small class="text-muted d-block">মহিলা আয়া</small>
                    <span class="badge bg-secondary mt-2">প্রাথমিক শাখা</span>
                </div>
            </div>
        </div>
    </div>
</div>
HTML,
    ],
];

<?php

return [
    'slug' => 'exam-system',
    'title' => [
        'en' => 'Exam System',
        'bn' => 'পরীক্ষা পদ্ধতি',
        'ar' => 'نظام الامتحان',
    ],
    'seo_title' => [
        'en' => 'Examination & Grading System - EduEx School and College',
        'bn' => 'পরীক্ষা ও মূল্যায়ন পদ্ধতি - এডুএক্স স্কুল অ্যান্ড কলেজ',
    ],
    'seo_description' => [
        'en' => 'Comprehensive evaluation, grading scale, continuous assessment, and exam rules at EduEx School and College.',
        'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের পরীক্ষা কাঠামো, জিপিএ গ্রেডিং স্কেল ও ধারাবাহিক মূল্যায়ন নির্দেশিকা।',
    ],
    'content' => [
        'en' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-square-poll-vertical me-1"></i> Assessment Guidelines</span>
        <h2 class="fw-bold">Examination &amp; Evaluation System</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">A fair, transparent, and comprehensive assessment system combining continuous classroom engagement with rigorous periodic examinations.</p>
    </div>

    <!-- Evaluation Framework -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light text-center">
                <div class="fs-1 fw-bold text-primary mb-1">20%</div>
                <h6 class="fw-bold mb-2">Continuous Assessment (SBA)</h6>
                <p class="small text-muted mb-0">Class participation, homework assignments, unannounced pop quizzes, lab performance, and attendance regularity.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light text-center">
                <div class="fs-1 fw-bold text-info mb-1">40%</div>
                <h6 class="fw-bold mb-2">Half-Yearly / Mid-Term</h6>
                <p class="small text-muted mb-0">Covers 50% of the annual syllabus with rigorous Creative Questions (CQ) and Multiple Choice Questions (MCQ).</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light text-center">
                <div class="fs-1 fw-bold text-success mb-1">40%</div>
                <h6 class="fw-bold mb-2">Annual Final Examination</h6>
                <p class="small text-muted mb-0">Comprehensive cumulative evaluation determining academic promotion, scholarship honors, and merit positions.</p>
            </div>
        </div>
    </div>

    <!-- Official GPA Grading Scale -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-chart-column me-2"></i> Official National GPA Grading Scale</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none text-center">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th>Marks Range</th>
                        <th>Letter Grade</th>
                        <th>Grade Point (GP)</th>
                        <th>Performance Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>80% – 100%</td>
                        <td><span class="badge bg-success fs-6">A+</span></td>
                        <td><strong>5.00</strong></td>
                        <td class="text-success fw-bold">Outstanding</td>
                    </tr>
                    <tr>
                        <td>70% – 79%</td>
                        <td><span class="badge bg-primary fs-6">A</span></td>
                        <td><strong>4.00</strong></td>
                        <td class="text-primary fw-bold">Excellent</td>
                    </tr>
                    <tr>
                        <td>60% – 69%</td>
                        <td><span class="badge bg-info text-dark fs-6">A-</span></td>
                        <td><strong>3.50</strong></td>
                        <td class="text-info text-dark fw-bold">Very Good</td>
                    </tr>
                    <tr>
                        <td>50% – 59%</td>
                        <td><span class="badge bg-warning text-dark fs-6">B</span></td>
                        <td><strong>3.00</strong></td>
                        <td class="text-warning text-dark fw-bold">Good</td>
                    </tr>
                    <tr>
                        <td>40% – 49%</td>
                        <td><span class="badge bg-secondary fs-6">C</span></td>
                        <td><strong>2.00</strong></td>
                        <td class="text-secondary fw-bold">Pass</td>
                    </tr>
                    <tr>
                        <td>33% – 39%</td>
                        <td><span class="badge bg-dark fs-6">D</span></td>
                        <td><strong>1.00</strong></td>
                        <td class="text-dark fw-bold">Conditional Pass</td>
                    </tr>
                    <tr>
                        <td>00% – 32%</td>
                        <td><span class="badge bg-danger fs-6">F</span></td>
                        <td><strong>0.00</strong></td>
                        <td class="text-danger fw-bold">Fail</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Exam Hall Rules -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-triangle-exclamation me-2"></i> Examination Hall Regulations</h4>
        <ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i> Candidates must report to the exam hall at least <strong>15 minutes prior</strong> to the scheduled commencement.</li>
            <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i> Official Admit Card and Student Identification Card must be placed visibly on the exam desk.</li>
            <li class="mb-2"><i class="fa-solid fa-circle-xmark text-danger me-2"></i> <strong>Strict Zero-Tolerance:</strong> Mobile phones, programmable smart watches, study notes, or unfair means lead to instant paper cancellation.</li>
            <li class="mb-0"><i class="fa-solid fa-circle-check text-success me-2"></i> Transparent pencil cases and standard approved non-programmable scientific calculators are permitted for relevant subjects.</li>
        </ul>
    </div>
</div>
HTML,
        'bn' => <<<HTML
<div class="wexnix_terms-content">
    <div class="mb-5 text-center">
        <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa-solid fa-square-poll-vertical me-1"></i> মূল্যায়ন পদ্ধতি</span>
        <h2 class="fw-bold">পরীক্ষা ও মূল্যায়ন পদ্ধতি</h2>
        <p class="text-muted mx-auto" style="max-width: 750px;">স্বচ্ছ, নিরপেক্ষ ও পূর্ণাঙ্গ মূল্যায়ন ব্যবস্থা যা শিক্ষার্থীদের ধারাবাহিক পাঠাভ্যাস ও সৃজনশীল মেধা বিকাশে সহায়ক।</p>
    </div>

    <!-- Evaluation Framework -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light text-center">
                <div class="fs-1 fw-bold text-primary mb-1">২০%</div>
                <h6 class="fw-bold mb-2">ধারাবাহিক মূল্যায়ন (SBA)</h6>
                <p class="small text-muted mb-0">শ্রেণিকক্ষে সক্রিয় অংশগ্রহণ, বাড়ির কাজ, কুইজ পরীক্ষা, ল্যাব পারফরম্যান্স ও উপস্থিতি।</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light text-center">
                <div class="fs-1 fw-bold text-info mb-1">৪০%</div>
                <h6 class="fw-bold mb-2">অর্ধবার্ষিক পরীক্ষা</h6>
                <p class="small text-muted mb-0">বার্ষিক সিলেবাসের ৫০% অংশের ওপর সৃজনশীল (CQ) ও বহুনির্বাচনি (MCQ) পদ্ধতিতে পরীক্ষা।</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-light text-center">
                <div class="fs-1 fw-bold text-success mb-1">৪০%</div>
                <h6 class="fw-bold mb-2">বার্ষিক চূড়ান্ত পরীক্ষা</h6>
                <p class="small text-muted mb-0">চূড়ান্ত ফলাফল নির্ধারণ, পরবর্তী শ্রেণিতে প্রমোশন ও মেধা স্থান নির্ধারণী পরীক্ষা।</p>
            </div>
        </div>
    </div>

    <!-- Official GPA Grading Scale -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-white">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-chart-column me-2"></i> জাতীয় শিক্ষাবোর্ড অনুমোদিত জিপিএ গ্রেডিং স্কেল</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white rounded-3 shadow-none text-center">
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th>নম্বরের ব্যাপ্তি</th>
                        <th>লেটার গ্রেড</th>
                        <th>গ্রেড পয়েন্ট (GP)</th>
                        <th>মন্তব্য</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>৮০% – ১০০%</td>
                        <td><span class="badge bg-success fs-6">A+</span></td>
                        <td><strong>৫.০০</strong></td>
                        <td class="text-success fw-bold">অসাধারণ (Outstanding)</td>
                    </tr>
                    <tr>
                        <td>৭০% – ৭৯%</td>
                        <td><span class="badge bg-primary fs-6">A</span></td>
                        <td><strong>৪.০০</strong></td>
                        <td class="text-primary fw-bold">চমৎকার (Excellent)</td>
                    </tr>
                    <tr>
                        <td>৬০% – ৬৯%</td>
                        <td><span class="badge bg-info text-dark fs-6">A-</span></td>
                        <td><strong>৩.৫০</strong></td>
                        <td class="text-info text-dark fw-bold">খুব ভালো (Very Good)</td>
                    </tr>
                    <tr>
                        <td>৫০% – ৫৯%</td>
                        <td><span class="badge bg-warning text-dark fs-6">B</span></td>
                        <td><strong>৩.০০</strong></td>
                        <td class="text-warning text-dark fw-bold">ভালো (Good)</td>
                    </tr>
                    <tr>
                        <td>৪০% – ৪৯%</td>
                        <td><span class="badge bg-secondary fs-6">C</span></td>
                        <td><strong>২.০০</strong></td>
                        <td class="text-secondary fw-bold">উত্তীর্ণ (Pass)</td>
                    </tr>
                    <tr>
                        <td>৩৩% – ৩৯%</td>
                        <td><span class="badge bg-dark fs-6">D</span></td>
                        <td><strong>১.০০</strong></td>
                        <td class="text-dark fw-bold">শর্তসাপেক্ষে উত্তীর্ণ</td>
                    </tr>
                    <tr>
                        <td>০০% – ৩২%</td>
                        <td><span class="badge bg-danger fs-6">F</span></td>
                        <td><strong>০.০০</strong></td>
                        <td class="text-danger fw-bold">অনুত্তীর্ণ (Fail)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Exam Hall Rules -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4 bg-light">
        <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-triangle-exclamation me-2"></i> পরীক্ষা হলের অবশ্য পালনীয় নিয়মাবলী</h4>
        <ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i> পরীক্ষা শুরুর অন্তত <strong>১৫ মিনিট পূর্বে</strong> নিজ নিজ আসনে উপস্থিত হতে হবে।</li>
            <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i> মূল প্রবেশপত্র (Admit Card) এবং প্রতিষ্ঠানের পরিচয়পত্র ডেস্কে প্রদর্শন করতে হবে।</li>
            <li class="mb-2"><i class="fa-solid fa-circle-xmark text-danger me-2"></i> <strong>কঠোর অনুশাসন:</strong> স্মার্টওয়াচ, মোবাইল ফোন বা কোনো ধরনের অসদুপায় অবলম্বন করলে পরীক্ষা বাতিল হবে।</li>
            <li class="mb-0"><i class="fa-solid fa-circle-check text-success me-2"></i> স্বচ্ছ জ্যামিতি বক্স ও অনুমোদিত সাধারণ সায়েন্টিফিক ক্যালকুলেটর ব্যবহার করা যাবে।</li>
        </ul>
    </div>
</div>
HTML,
    ],
];

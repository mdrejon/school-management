<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedDepartments();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/departments-breadcrumb.jpg');
        $settings = DepartmentPageSetting::query()->first() ?? new DepartmentPageSetting();

        $settings->fill([
            'section_tagline' => [
                'en' => 'Academic Departments',
                'bn' => 'একাডেমিক বিভাগসমূহ',
                'ar' => 'الأقسام الأكاديمية',
            ],
            'section_title' => [
                'en' => 'Explore Our Academic Departments',
                'bn' => 'আমাদের একাডেমিক বিভাগসমূহ দেখুন',
                'ar' => 'استكشف أقسامنا الأكاديمية',
            ],
            'section_highlight' => [
                'en' => 'Departments',
                'bn' => 'বিভাগসমূহ',
                'ar' => 'الأكاديمية',
            ],
            'section_description' => [
                'en' => 'EduEx School and College offers dynamic academic faculties dedicated to fostering critical thinking, moral character, and scholastic excellence across all levels.',
                'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজ শিক্ষার্থীদের সমালোচনামূলক চিন্তা, নৈতিক চরিত্র এবং শিক্ষাগত শ্রেষ্ঠত্ব বিকাশে নিবেদিত আধুনিক একাডেমিক বিভাগ পরিচালনা করে।',
                'ar' => 'تقدم مدرسة وكلية إيدوإكس أقساماً أكاديمية متميزة مكرسة لتعزيز التفكير النقدي والقيم الأخلاقية والتميز العلمي.',
            ],
            'breadcrumb_title' => [
                'en' => 'Academic Departments',
                'bn' => 'একাডেমিক বিভাগ',
                'ar' => 'الأقسام الأكاديمية',
            ],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => [
                'en' => 'Academic Departments - EduEx School and College',
                'bn' => 'একাডেমিক বিভাগ - এডুএক্স স্কুল অ্যান্ড কলেজ',
                'ar' => 'الأقسام الأكاديمية - مدرسة وكلية إيدوإكس',
            ],
            'seo_description' => [
                'en' => 'Discover the academic departments at EduEx School and College, including Science, Business Studies, Humanities, ICT, and Arts.',
                'bn' => 'এডুএক্স স্কুল অ্যান্ড কলেজের বিজ্ঞান, ব্যবসায় শিক্ষা, মানবিক, আইসিটি এবং শিল্পকলাসহ বিভিন্ন একাডেমিক বিভাগসমূহ জানুন।',
                'ar' => 'اكتشف الأقسام الأكاديمية في مدرسة وكلية إيدوإكس بما في ذلك العلوم والدراسات التجارية والإنسانيات وتكنولوجيا المعلومات.',
            ],
            'seo_keywords' => [
                'en' => 'departments, school departments, college faculties, science, business studies, humanities, ict',
                'bn' => 'বিভাগ, স্কুল বিভাগ, কলেজ অনুষদ, বিজ্ঞান, ব্যবসায় শিক্ষা, মানবিক, আইসিটি',
                'ar' => 'أقسام, أقسام المدرسة, كليات الكلية, علوم, دراسات تجارية, إنسانيات, تكنولوجيا المعلومات',
            ],
        ])->save();
    }

    protected function seedDepartments(): void
    {
        $syllabusPdf = $this->copyPdfIntoStorage('site/notices/admission-test-result-publication.pdf', 'site/departments/syllabus.pdf');
        $prospectusPdf = $this->copyPdfIntoStorage('site/notices/summer-vacation-notice.pdf', 'site/departments/prospectus.pdf');

        $commonDownloads = array_values(array_filter([
            $syllabusPdf ? [
                'label' => [
                    'en' => 'Department Syllabus & Curriculum',
                    'bn' => 'বিভাগীয় পাঠ্যক্রম ও সিলেবাস',
                    'ar' => 'المنهج الدراسي وخطة القسم',
                ],
                'file' => $syllabusPdf,
            ] : null,
            $prospectusPdf ? [
                'label' => [
                    'en' => 'Academic Prospectus & Guidelines',
                    'bn' => 'একাডেমিক প্রসপেক্টাস ও নির্দেশিকা',
                    'ar' => 'دليل الأقسام الإرشادي',
                ],
                'file' => $prospectusPdf,
            ] : null,
        ]));

        $departments = [
            // 1. Department of Science
            [
                'slug' => 'science',
                'icon' => 'atom',
                'title' => [
                    'en' => 'Department of Science',
                    'bn' => 'বিজ্ঞান বিভাগ',
                    'ar' => 'قسم العلوم',
                ],
                'short_description' => [
                    'en' => 'Fostering analytical curiosity and scientific innovation through modern physics, chemistry, biology, and laboratory research.',
                    'bn' => 'উন্নত পদার্থবিজ্ঞান, রসায়ন, জীববিজ্ঞান এবং আধুনিক ল্যাব গবেষণার মাধ্যমে শিক্ষার্থীদের বৈজ্ঞানিক উদ্ভাবন ও অনুসন্ধিৎসু মেধা বিকাশ।',
                    'ar' => 'تعزيز الفضول التحليلي والابتكار العلمي من خلال الفيزياء والكيمياء والأحياء والتجارب المعملية الحديثة.',
                ],
                'image' => $this->copyIntoStorage('course/06.jpg', 'site/departments/science.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('facility/03.jpg', 'site/departments/science-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('department/01.jpg', 'site/departments/science-gal-2.jpg'),
                'description' => [
                    'en' => '<p>The Department of Science at EduEx School and College is dedicated to cultivating inquiring minds, rigorous analytical skills, and scientific excellence. Our curriculum covers general science in secondary classes as well as specialized Physics, Chemistry, Biology, and Higher Mathematics at the Secondary (SSC) and Higher Secondary (HSC) college levels.</p><p>We take pride in our well-equipped, state-of-the-art laboratories where students translate theoretical principles into practical experiments under the close supervision of qualified science lecturers. Students regularly participate in National Science Olympiads, robotics showcases, and inter-school science fairs, achieving top distinctions.</p>',
                    'bn' => '<p>এডুএক্স স্কুল অ্যান্ড কলেজের বিজ্ঞান বিভাগ শিক্ষার্থীদের অনুসন্ধিৎসু মনন, সুগভীর বিশ্লেষণাত্মক দক্ষতা এবং বৈজ্ঞানিক শ্রেষ্ঠত্ব গড়ে তুলতে নিবেদিত। মাধ্যমিক ও উচ্চমাধ্যমিক (এইচএসসি) স্তরে পদার্থবিজ্ঞান, রসায়ন, জীববিজ্ঞান এবং উচ্চতর গণিতের মতো মৌলিক বিজ্ঞান বিষয়সমূহে গভীর জ্ঞান প্রদান করা হয়।</p><p>আমাদের আধুনিক ও সমৃদ্ধ বিজ্ঞান গবেষণাগারগুলোতে শিক্ষার্থীরা অভিজ্ঞ শিক্ষকদের সার্বক্ষণিক তত্ত্বাবধানে হাতে-কলমে পরীক্ষার মাধ্যমে তাত্ত্বিক জ্ঞান বাস্তবায়ন করে। শিক্ষার্থীরা জাতীয় বিজ্ঞান অলিম্পিয়াড, রোবোটিক্স উৎসব ও বিজ্ঞান মেলায় নিয়মিত অংশগ্রহণ করে গৌরবময় সাফল্য অর্জন করে আসছে।</p>',
                    'ar' => '<p>يكرس قسم العلوم في مدرسة وكلية إيدوإكس جهوده لتنمية العقول المبتكرة والتفكير التحليلي والتميز العلمي من خلال أحدث المختبرات للفيزياء والكيمياء والأحياء والتجارب المعملية المتطورة.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Admission & Group Criteria',
                    'bn' => 'ভর্তি ও বিভাগ নির্বাচনের শর্তাবলী',
                    'ar' => 'شروط القبول واختيار القسم',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Minimum GPA 4.50 in previous annual / SSC examination for Science stream.',
                        'bn' => 'বিজ্ঞান বিভাগে ভর্তির জন্য পূর্ববর্তী বার্ষিক বা এসএসসি পরীক্ষায় ন্যূনতম জিপিএ ৪.৫০।',
                        'ar' => 'الحد الأدنى للمعدل التراكمي 4.50 في الاختبارات السابقة للمسار العلمي.',
                    ]],
                    ['text' => [
                        'en' => 'Satisfactory scores in General Science and Mathematics in entrance assessment.',
                        'bn' => 'ভর্তি মূল্যায়ন পরীক্ষায় সাধারণ বিজ্ঞান ও গণিতে সন্তোষজনক নম্বর অর্জন।',
                        'ar' => 'الحصول على درجات مرضية في العلوم العامة والرياضيات في اختبار القبول.',
                    ]],
                    ['text' => [
                        'en' => 'Mandatory participation in laboratory safety orientation and practical workshops.',
                        'bn' => 'বিজ্ঞান গবেষণাগারের নিরাপত্তা ও ব্যবহারিক কর্মশালায় বাধ্যতামূলক অংশগ্রহণ।',
                        'ar' => 'المشاركة الإلزامية في ورش عمل السلامة المعملية والتجارب التطبيقية.',
                    ]],
                    ['text' => [
                        'en' => 'Submission of academic transcripts, transfer certificate, and passport-size photos.',
                        'bn' => 'একাডেমিক ট্রান্সক্রিপ্ট, প্রশংসাপত্র এবং পাসপোর্ট সাইজের ছবি জমা দেওয়া।',
                        'ar' => 'تقديم السجلات الأكاديمية وشهادة النقل والصور الشخصية المطلوبة.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 2. Department of Business Studies
            [
                'slug' => 'business-studies',
                'icon' => 'briefcase',
                'title' => [
                    'en' => 'Department of Business Studies',
                    'bn' => 'ব্যবসায় শিক্ষা বিভাগ',
                    'ar' => 'قسم دراسات إدارة الأعمال',
                ],
                'short_description' => [
                    'en' => 'Equipping future leaders and entrepreneurs with strong foundations in accounting, finance, business organization, and economics.',
                    'bn' => 'হিসাববিজ্ঞান, ফিন্যান্স, ব্যবসায় উদ্যোগ এবং অর্থনীতির সুদৃঢ় ভিত্তি দিয়ে ভবিষ্যৎ উদ্যোক্তা ও দক্ষ ব্যবসায়িক নেতৃত্ব গড়ে তোলা।',
                    'ar' => 'إعداد قادة ورواد أعمال الغد بأسس قوية في المحاسبة والمالية وإدارة الأعمال والاقتصاد.',
                ],
                'image' => $this->copyIntoStorage('course/01.jpg', 'site/departments/business-studies.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('department/02.jpg', 'site/departments/business-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('course/02.jpg', 'site/departments/business-gal-2.jpg'),
                'description' => [
                    'en' => '<p>The Department of Business Studies at EduEx School and College develops commercial literacy, entrepreneurial vision, and managerial leadership. Our comprehensive academic tracks encompass Financial Accounting, Business Organization and Management, Finance, Banking & Insurance, and Economics.</p><p>Through innovative classroom projects, annual business case challenges, and interactive accounting software training, our students build strategic thinking, ethical commercial conduct, and readiness for premier business schools and universities.</p>',
                    'bn' => '<p>এডুএক্স স্কুল অ্যান্ড কলেজের ব্যবসায় শিক্ষা বিভাগ ভবিষ্যৎ উদ্যোক্তা, আর্থিক পরিকল্পনাকারী ও বাণিজ্যিক নেতৃত্ব বিকাশে কাজ করে। আমাদের পাঠ্যক্রমে হিসাববিজ্ঞান, ব্যবসায় সংগঠন ও ব্যবস্থাপনা, ফিন্যান্স ও ব্যাংকিং এবং অর্থনীতির প্রায়োগিক দিকগুলো গুরুত্ব পায়।</p><p>বাস্তবধর্মী ব্যবসায়িক পরিকল্পনা, বার্ষিক বিজনেস ফেয়ার এবং আধুনিক হিসাবরক্ষণ সফটওয়্যার পরিচিতির মাধ্যমে শিক্ষার্থীরা ভবিষ্যৎ উচ্চশিক্ষা ও কর্পোরেট জগতের জন্য পূর্ণ আত্মবিশ্বাস অর্জন করে।</p>',
                    'ar' => '<p>يركز قسم دراسات إدارة الأعمال في مدرسة وكلية إيدوإكس على تعزيز الثقافة التجارية والفكر الريادي والمهارات القيادية لدى الطلاب من خلال المحاسبة والمالية والاقتصاد.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Admission & Group Criteria',
                    'bn' => 'ভর্তি ও বিভাগ নির্বাচনের শর্তাবলী',
                    'ar' => 'شروط القبول واختيار القسم',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Minimum GPA 3.50 in previous annual / SSC examination for Business Studies.',
                        'bn' => 'ব্যবসায় শিক্ষা বিভাগে ভর্তির জন্য পূর্ববর্তী বার্ষিক বা এসএসসি পরীক্ষায় ন্যূনতম জিপিএ ৩.৫০।',
                        'ar' => 'الحد الأدنى للمعدل التراكمي 3.50 في الاختبارات السابقة للمسار التجاري.',
                    ]],
                    ['text' => [
                        'en' => 'Strong interest in commercial arithmetic, accounting, and business communication.',
                        'bn' => 'বাণিজ্যিক গণিত, হিসাবরক্ষণ এবং ব্যবসায়িক যোগাযোগের প্রতি গভীর আগ্রহ।',
                        'ar' => 'الاهتمام بالرياضيات التجارية والمحاسبة والتواصل التجاري.',
                    ]],
                    ['text' => [
                        'en' => 'Commitment to participate in departmental business fairs and entrepreneurship clubs.',
                        'bn' => 'বিভাগীয় ব্যবসায় মেলা এবং তরুণ উদ্যোক্তা ক্লাবের কার্যক্রমে সক্রিয় অংশগ্রহণ।',
                        'ar' => 'الالتزام بالمشاركة في معارض الأعمال وفعاليات ريادة الأعمال بالمدرسة.',
                    ]],
                    ['text' => [
                        'en' => 'Submission of academic testimonials, birth certificate copy, and parent consent form.',
                        'bn' => 'প্রশংসাপত্র, জন্মনিবন্ধন সনদের কপি এবং অভিভাবকের সম্মতিপত্র জমা দেওয়া।',
                        'ar' => 'تقديم الشهادات الأكاديمية وشهادة الميلاد وموافقة ولي الأمر.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 3. Department of Humanities & Social Sciences
            [
                'slug' => 'humanities',
                'icon' => 'landmark',
                'title' => [
                    'en' => 'Department of Humanities & Social Sciences',
                    'bn' => 'মানবিক ও সামাজিক বিজ্ঞান বিভাগ',
                    'ar' => 'قسم العلوم الإنسانية والاجتماعية',
                ],
                'short_description' => [
                    'en' => 'Developing deep cultural understanding, civic awareness, history, logic, and social ethics through engaged academic learning.',
                    'bn' => 'গভীর সাংস্কৃতিক বোধ, নাগরিক সচেতনতা, ইতিহাস, যুক্তিবিদ্যা এবং সামাজিক মূল্যবোধ বিকাশে নিবেদিত একাডেমিক শিক্ষা।',
                    'ar' => 'تطوير الوعي الثقافي والمدني والتاريخ والمنطق والمسؤولية المجتمعية من خلال التعليم التفاعلي.',
                ],
                'image' => $this->copyIntoStorage('course/03.jpg', 'site/departments/humanities.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('facility/04.jpg', 'site/departments/humanities-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('department/single.jpg', 'site/departments/humanities-gal-2.jpg'),
                'description' => [
                    'en' => '<p>The Department of Humanities & Social Sciences provides learners with a profound understanding of society, culture, history, and human behavior. Offering core disciplines including History of Bangladesh, World Civilizations, Civics & Good Governance, Sociology, Economics, and Logic, the department encourages open-minded inquiry and critical analysis.</p><p>Students participate in mock parliaments, historical study tours, debate championships, and community outreach initiatives, preparing for illustrious paths in law, public policy, civil service, journalism, and social research.</p>',
                    'bn' => '<p>এডুএক্স স্কুল অ্যান্ড কলেজের মানবিক ও সামাজিক বিজ্ঞান বিভাগ সমাজ, সংস্কৃতি, ইতিহাস এবং মানব আচরণের গভীর উপলব্ধি প্রদানে কাজ করে। বাংলাদেশের ইতিহাস ও বিশ্বসভ্যতা, পৌরনীতি ও সুশাসন, সমাজবিজ্ঞান, অর্থনীতি এবং যুক্তিবিদ্যার সমন্বয়ে শিক্ষার্থীরা সামাজিক ব্যবস্থা ও নাগরিক দায়িত্ববোধ সম্পর্কে সম্যক জ্ঞান লাভ করে।</p><p>মক পার্লামেন্ট, ঐতিহাসিক শিক্ষা সফর, বিতর্ক প্রতিযোগিতা এবং সামাজিক সচেতনতামূলক কার্যক্রমের মাধ্যমে শিক্ষার্থীরা আইন, লোকপ্রশাসন, সাংবাদিকতা ও আন্তর্জাতিক সম্পর্কের জন্য প্রস্তুত হয়।</p>',
                    'ar' => '<p>يقدم قسم العلوم الإنسانية والاجتماعية للطلاب فهماً عميقاً للمجتمع والتاريخ والحضارة الإنسانية والقوانين والمنطق، مما يفتح آفاقاً واسعة في دراسة القانون والإعلام والخدمة العامة.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Admission & Group Criteria',
                    'bn' => 'ভর্তি ও বিভাগ নির্বাচনের শর্তাবলী',
                    'ar' => 'شروط القبول واختيار القسم',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Minimum qualifying GPA 3.00 in previous board / school annual examination.',
                        'bn' => 'মানবিক বিভাগে ভর্তির জন্য পূর্ববর্তী বার্ষিক বা বোর্ড পরীক্ষায় ন্যূনতম জিপিএ ৩.০০।',
                        'ar' => 'الحد الأدنى للمعدل التراكمي 3.00 في الاختبارات المدرسية أو العامة السابقة.',
                    ]],
                    ['text' => [
                        'en' => 'Enthusiasm for reading history, social issues, and contemporary national affairs.',
                        'bn' => 'ইতিহাস, সামাজিক সমস্যা এবং সমসাময়িক জাতীয় বিষয়াবলীর প্রতি গভীর আগ্রহ।',
                        'ar' => 'الاهتمام بقراءة التاريخ والقضايا الاجتماعية والشؤون العامة.',
                    ]],
                    ['text' => [
                        'en' => 'Active participation in language debate competitions and social welfare events.',
                        'bn' => 'বিতর্ক প্রতিযোগিতা এবং সমাজসেবামূলক কার্যক্রমে সক্রিয় অংশগ্রহণ।',
                        'ar' => 'المشاركة الفعالة في المناظرات اللغوية وأنشطة الخدمة المجتمعية.',
                    ]],
                    ['text' => [
                        'en' => 'Completed application form with previous report cards and verified certificates.',
                        'bn' => 'পূর্ববর্তী পরীক্ষার নম্বরপত্র ও সনদসহ পূরণকৃত আবেদনপত্র দাখিল।',
                        'ar' => 'تقديم استمارة التقديم مكتملة مع السجلات الأكاديمية والشهادات المعتمدة.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 4. Department of Information & Communication Technology
            [
                'slug' => 'information-technology',
                'icon' => 'laptop',
                'title' => [
                    'en' => 'Department of ICT & Computer Science',
                    'bn' => 'তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ',
                    'ar' => 'قسم تكنولوجيا المعلومات والحاسوب',
                ],
                'short_description' => [
                    'en' => 'Empowering students with coding, digital literacy, web development, and robotics in high-tech computer laboratories.',
                    'bn' => 'অত্যাধুনিক কম্পিউটার ল্যাবে কোডিং, ডিজিটাল সাক্ষরতা, ওয়েব ডেভেলপমেন্ট এবং রোবোটিক্স দক্ষতায় শিক্ষার্থীদের দক্ষ করে তোলা।',
                    'ar' => 'تمكين الطلاب من مهارات البرمجة والتحول الرقمي وتطوير الويب والروبوتات في مختبرات حاسوبية متطورة.',
                ],
                'image' => $this->copyIntoStorage('course/04.jpg', 'site/departments/ict.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('facility/03.jpg', 'site/departments/ict-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('gallery/01.jpg', 'site/departments/ict-gal-2.jpg'),
                'description' => [
                    'en' => '<p>In today\'s interconnected digital world, the Department of ICT & Computer Science at EduEx School and College trains students to become technologically adept creators and problem solvers. Our curriculum spans fundamental computer applications, structured programming (C/Python), database architecture, web technologies, and cybersecurity awareness.</p><p>With high-speed internet and dedicated workstations for every student, our air-conditioned computer labs support hands-on learning. Through our active Coding & Robotics Club, students engage in hackathons and STEM competitions with outstanding accolades.</p>',
                    'bn' => '<p>বর্তমান তথ্যপ্রযুক্তির যুগে এডুএক্স স্কুল অ্যান্ড কলেজের তথ্য ও যোগাযোগ প্রযুক্তি (আইসিটি) বিভাগ শিক্ষার্থীদের ভবিষ্যৎমুখী ডিজিটাল দক্ষতায় পারদর্শী করে গড়ে তোলে। আমাদের পাঠ্যক্রমে কম্পিউটার অ্যাপ্লিকেশন, প্রোগ্রামিং ভাষা (C/পাইথন), ডাটাবেজ সিস্টেম, ওয়েব ডিজাইন এবং সাইবার সচেতনতা অন্তর্ভুক্ত রয়েছে।</p><p>উচ্চগতির ইন্টারনেট এবং প্রতিটি শিক্ষার্থীর জন্য একক কম্পিউটার সমৃদ্ধ আধুনিক ল্যাবে ব্যবহারিক ক্লাসের ব্যবস্থা রয়েছে। আমাদের কোডিং ও রোবোটিক্স ক্লাবের মাধ্যমে শিক্ষার্থীরা জাতীয় পর্যায়ের বিজ্ঞান ও প্রযুক্তি মেলায় অংশ নিয়ে অভূতপূর্ব সাফল্য প্রদর্শন করে।</p>',
                    'ar' => '<p>يوفر قسم تكنولوجيا المعلومات والحاسوب بيئة تعليمية ذكية تهدف إلى إكساب الطلاب مهارات البرمجة والذكاء الاصطناعي والأمن السيبراني وتصميم الويب وتطبيقات الحاسوب الحديثة.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Lab Enrollment & Rules',
                    'bn' => 'ল্যাব ভর্তি ও নিয়মানুবর্তিতা',
                    'ar' => 'شروط التسجيل في المختبر وقواعده',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Basic understanding of computer fundamentals and logical reasoning.',
                        'bn' => 'কম্পিউটারের প্রাথমিক ধারণা এবং যৌক্তিক চিন্তার প্রাথমিক দক্ষতা।',
                        'ar' => 'فهم أساسيات الحاسوب والتفكير المنطقي السليم.',
                    ]],
                    ['text' => [
                        'en' => 'Strict adherence to lab safety, cyber hygiene, and hardware usage rules.',
                        'bn' => 'কম্পিউটার ল্যাবের নিরাপত্তা, সাইবার পরিচ্ছন্নতা ও হার্ডওয়্যার ব্যবহারের নিয়মাবলী মেনে চলা।',
                        'ar' => 'الالتزام الصارم بقواعد السلامة في المختبر وأمان الأجهزة الرقمية.',
                    ]],
                    ['text' => [
                        'en' => 'Regular submission of programming assignments and laboratory practical tasks.',
                        'bn' => 'ব্যবহারিক ক্লাসের অ্যাসাইনমেন্ট ও প্রোগ্রামিং প্রজেক্ট নিয়মিত জমা দেওয়া।',
                        'ar' => 'تقديم المهام البرمجية والتطبيقات العملية بانتظام.',
                    ]],
                    ['text' => [
                        'en' => 'Signed ICT laboratory policy consent form by parent/guardian.',
                        'bn' => 'অভিভাবক কর্তৃক স্বাক্ষরিত আইসিটি ল্যাব ব্যবহার নির্দেশিকা সম্মতিপত্র।',
                        'ar' => 'توقيع ولي الأمر على وثيقة الالتزام بسياسات مختبر الحاسوب.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 5. Department of Mathematics
            [
                'slug' => 'mathematics',
                'icon' => 'calculator',
                'title' => [
                    'en' => 'Department of Mathematics',
                    'bn' => 'গণিত বিভাগ',
                    'ar' => 'قسم الرياضيات',
                ],
                'short_description' => [
                    'en' => 'Building numerical precision, algebra mastery, and geometry problem-solving from primary foundations to college calculus.',
                    'bn' => 'প্রাথমিক ভিত্তি থেকে উচ্চতর ক্যালকুলাস পর্যন্ত গাণিতিক যুক্তি, নিখুঁত বীজগণিতীয় সমাধান এবং জ্যামিতিক দক্ষতায় দক্ষতা অর্জন।',
                    'ar' => 'بناء التفكير المنطقي وحل المسائل الجبرية وإتقان الهندسة وحساب التفاضل والتكامل المتقدم.',
                ],
                'image' => $this->copyIntoStorage('course/05.jpg', 'site/departments/mathematics.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('department/01.jpg', 'site/departments/math-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('course/01.jpg', 'site/departments/math-gal-2.jpg'),
                'description' => [
                    'en' => '<p>The Department of Mathematics at EduEx School and College empowers students with the language of science and logical analysis. From foundational arithmetic in primary sections to Euclidean geometry, trigonometry, vectors, probability, and advanced calculus in college levels, we provide systematic instruction that demystifies mathematics.</p><p>We host weekly Math Circles and specialized Olympiad workshops where enthusiastic mathletes sharpen their speed, conceptual clarity, and puzzle-solving acumen under experienced mentors.</p>',
                    'bn' => '<p>এডুএক্স স্কুল অ্যান্ড কলেজের গণিত বিভাগ শিক্ষার্থীদের গাণিতিক যুক্তি, নিখুঁত হিসাব এবং গভীর বিশ্লেষণাত্মক ক্ষমতা বিকাশে কাজ করে। প্রাথমিক শ্রেণীর পাটিগণিত ও জ্যামিতি থেকে শুরু করে কলেজ পর্যায়ের উচ্চতর ক্যালকুলাস, ত্রিকোণমিতি, ভেক্টর ও সম্ভাবনা তত্ত্ব পর্যন্ত প্রতিটি শাখা শিক্ষার্থীদের উপযোগী করে শিক্ষাদান করা হয়।</p><p>আমাদের সাপ্তাহিক গণিত ফোরাম এবং অলিম্পিয়াড প্রশিক্ষণ ক্লাসের মাধ্যমে শিক্ষার্থীরা আন্তর্জাতিক গণিত অলিম্পিয়াডের প্রস্তুতি গ্রহণ করে এবং জটিল গাণিতিক সমস্যা সমাধানে বিশেষ দক্ষতা অর্জন করে।</p>',
                    'ar' => '<p>يعمل قسم الرياضيات على تنمية التفكير المنطقي والقدرات التحليلية وحل المشكلات المعقدة من الحساب الأساسي وحتى التفاضل والتكامل المتقدم والهندسة الرياضية.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Prerequisites & Evaluation',
                    'bn' => 'পূর্বশর্ত ও মূল্যায়ন পদ্ধতি',
                    'ar' => 'المتطلبات الأساسية ومعايير التقييم',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Satisfactory score in General Mathematics in previous academic session.',
                        'bn' => 'পূর্ববর্তী শিক্ষাবর্ষে সাধারণ গণিতে সন্তোষজনক গ্রেড বা নম্বর প্রাপ্তি।',
                        'ar' => 'الحصول على درجة جيدة في مادة الرياضيات في العام الدراسي السابق.',
                    ]],
                    ['text' => [
                        'en' => 'Demonstrated interest in analytical reasoning and problem-solving exercises.',
                        'bn' => 'বিশ্লেষণাত্মক চিন্তা ও সমস্যা সমাধান অনুশীলনে আন্তরিক আগ্রহ।',
                        'ar' => 'إظهار الرغبة في التفكير التحليلي وحل المسائل الرياضية.',
                    ]],
                    ['text' => [
                        'en' => 'Regular attendance in tutorial circles and periodic mathematical tests.',
                        'bn' => 'নিয়মিত টিউটোরিয়াল ক্লাস ও সাপ্তাহিক গাণিতিক মূল্যায়নে উপস্থিতি।',
                        'ar' => 'المواظبة على حضور جلسات التقوية والاختبارات الدورية.',
                    ]],
                    ['text' => [
                        'en' => 'Standard enrollment documents and previous examination transcripts.',
                        'bn' => 'ভর্তির প্রয়োজনীয় কাগজপত্র ও পূর্ববর্তী পরীক্ষার ট্রান্সক্রিপ্ট।',
                        'ar' => 'الوثائق الرسمية للقبول وشهادات الدرجات السابقة.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 6. Department of Languages & Literature
            [
                'slug' => 'languages',
                'icon' => 'book-open',
                'title' => [
                    'en' => 'Department of Languages & Literature',
                    'bn' => 'ভাষা ও সাহিত্য বিভাগ',
                    'ar' => 'قسم اللغات والآداب',
                ],
                'short_description' => [
                    'en' => 'Cultivating eloquent communication, creative writing, and literary appreciation in Bangla and English.',
                    'bn' => 'বাংলা ও ইংরেজি উভয় ভাষায় ভাষার শুদ্ধতা, বাকপটুতা, সৃজনশীল লেখালেখি এবং গভীর সাহিত্যবোধের বিকাশ।',
                    'ar' => 'تنمية الطلاقة اللغوية والتعبير الإبداعي وفنون الخطابة والتذوق الأدبي في اللغتين البنغالية والإنجليزية.',
                ],
                'image' => $this->copyIntoStorage('course/02.jpg', 'site/departments/languages.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('facility/04.jpg', 'site/departments/languages-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('department/02.jpg', 'site/departments/languages-gal-2.jpg'),
                'description' => [
                    'en' => '<p>The Department of Languages & Literature at EduEx School and College fosters fluent linguistic expression, creative writing, and deep literary sensitivity in both Bangla (Mother Language) and English (Global Medium). Through comprehensive study of poetry, prose, grammar, phonetics, and drama, students build commanding communication skills.</p><p>Our department runs an acclaimed Debating Society, an annual Wall Magazine competition, and Language Club activities where students hone persuasive rhetoric, journalistic reporting, and public presentation.</p>',
                    'bn' => '<p>এডুএক্স স্কুল অ্যান্ড কলেজের ভাষা ও সাহিত্য বিভাগ বাংলা ও ইংরেজি উভয় ভাষায় শিক্ষার্থীদের ভাষাগত দক্ষতা, প্রাঞ্জল প্রকাশভঙ্গি এবং সাহিত্যরস আস্বাদনের ক্ষমতা বৃদ্ধি করে। কবিতা, গল্প, উপন্যাস, ব্যাকরণ এবং নাটকের নিয়মিত পাঠের মধ্য দিয়ে শিক্ষার্থীদের ভাষা প্রয়োগের শুদ্ধতা নিশ্চিত হয়।</p><p>বিভাগ পরিচালিত বিতর্ক ক্লাব, সাহিত্য সাময়িকী ও দেয়াল পত্রিকা প্রকাশনার মাধ্যমে শিক্ষার্থীরা বক্তব্য উপস্থাপনা, প্রবন্ধ রচনা ও সৃজনশীল লেখালেখিতে নিজেদের শ্রেষ্ঠত্ব প্রমাণ করে।</p>',
                    'ar' => '<p>يعنى قسم اللغات والآداب بتعزيز مهارات التحدث والكتابة الإبداعية والتذوق الأدبي وفنون الإلقاء باللغتين البنغالية والإنجليزية، وإعداد الطلاب للمناظرات الثقافية والخطابة.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Language Enrollment Criteria',
                    'bn' => 'ভাষা বিভাগ নির্বাচনের শর্তাবলী',
                    'ar' => 'معايير الالتحاق بقسم اللغات',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Qualifying pass grades in Bangla and English language subjects.',
                        'bn' => 'বাংলা ও ইংরেজি বিষয়ে পূর্ববর্তী পরীক্ষায় উত্তীর্ণ হওয়া।',
                        'ar' => 'اجتياز مواد اللغتين البنغالية والإنجليزية في المستويات السابقة.',
                    ]],
                    ['text' => [
                        'en' => 'Enthusiasm for reading library literature, essay writing, and public speaking.',
                        'bn' => 'সাহিত্য পাঠ, প্রবন্ধ রচনা এবং উপস্থিত বক্তৃতার প্রতি গভীর অনুরাগ।',
                        'ar' => 'الشغف بالقراءة الأدبية وكتابة المقالات وفنون الإلقاء.',
                    ]],
                    ['text' => [
                        'en' => 'Active involvement in Language Club, English Spoken circles, and debating sessions.',
                        'bn' => 'ল্যাঙ্গুয়েজ ক্লাব, স্পোকেন ইংলিশ এবং বিতর্ক দলের কার্যক্রমে অংশগ্রহণ।',
                        'ar' => 'المشاركة الفعالة في نادي اللغات والمناظرات والأنشطة الأدبية.',
                    ]],
                    ['text' => [
                        'en' => 'Submission of verified student registration and previous academic marks.',
                        'bn' => 'যাচাইকৃত শিক্ষার্থী নিবন্ধন ও পূর্ববর্তী পরীক্ষার নম্বরপত্র দাখিল।',
                        'ar' => 'تقديم وثائق التسجيل المعتمدة وسجل الدرجات الأكاديمية.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 7. Department of Arts, Music & Culture
            [
                'slug' => 'arts-and-culture',
                'icon' => 'palette',
                'title' => [
                    'en' => 'Department of Arts & Culture',
                    'bn' => 'চারুকলা ও সাংস্কৃতিক বিভাগ',
                    'ar' => 'قسم الفنون والثقافة',
                ],
                'short_description' => [
                    'en' => 'Inspiring aesthetic creativity and self-expression through sketching, fine arts, vocal music, theater, and cultural heritage.',
                    'bn' => 'চিত্রাঙ্কন, চারুকলা, সঙ্গীত, অভিনয় এবং জাতীয় ঐতিহ্যের মাধ্যমে শিক্ষার্থীদের নান্দনিক মনন ও সৃজনশীল প্রতিভার বিকাশ।',
                    'ar' => 'إلهام الإبداع الجمالي والتعبير عن الذات من خلال الرسم والفنون الجميلة والموسيقى والمسرح والتراث الثقافي.',
                ],
                'image' => $this->copyIntoStorage('department/single.jpg', 'site/departments/arts.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('gallery/03.jpg', 'site/departments/arts-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('gallery/04.jpg', 'site/departments/arts-gal-2.jpg'),
                'description' => [
                    'en' => '<p>The Department of Arts & Culture enriches the educational journey at EduEx School and College by nurturing creativity, emotional intelligence, and artistic expression. Students receive structured guidance in drawing, water color, oil painting, classical and patriotic vocal music, instrumental performance, and theatrical stagecraft.</p><p>Our students lead vibrant cultural celebrations for Independence Day, Victory Day, Pahela Baishakh, and the Annual Cultural Gala, developing stage confidence, team harmony, and proud connection with national roots.</p>',
                    'bn' => '<p>এডুএক্স স্কুল অ্যান্ড কলেজের চারুকলা ও সাংস্কৃতিক বিভাগ শিক্ষার্থীদের সৃজনশীল কল্পনা, মানসিক প্রফুল্লতা ও নান্দনিক রুচিবোধ বিকাশে অগ্রণী ভূমিকা পালন করে। অভিজ্ঞ শিল্পীদের দিকনির্দেশনায় শিক্ষার্থীরা জলরং, স্কেচ, তৈলচিত্র, কণ্ঠসঙ্গীত, বাদ্যযন্ত্র এবং নাট্যকলায় প্রশিক্ষণ গ্রহণ করে।</p><p>জাতীয় দিবসসমূহ যথা মহান স্বাধীনতা দিবস, বিজয় দিবস, পহেলা বৈশাখ এবং বার্ষিক সাংস্কৃতিক উৎসবে শিক্ষার্থীরা বর্ণাঢ্য পরিবেশনার মাধ্যমে নিজেদের অনন্য প্রতিভার স্বাক্ষর রাখে।</p>',
                    'ar' => '<p>يهدف قسم الفنون والثقافة إلى صقل الحس الجمالي وتنمية المهارات الإبداعية في الرسم والموسيقى والفنون التشكيلية والمسرحية مع الاعتزاز بالهوية والتراث الثقافي.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Creative Enrollment Guidelines',
                    'bn' => 'সাংস্কৃতিক কার্যক্রমে অংশগ্রহণের নীতিমালা',
                    'ar' => 'إرشادات التسجيل في الأنشطة الفنية',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Genuine passion and talent in fine arts, vocal music, or theatrical arts.',
                        'bn' => 'চারুকলা, সঙ্গীত বা নাট্যকলায় আন্তরিক আগ্রহ ও সৃজনশীল মেধার উপস্থিতি।',
                        'ar' => 'الشغف الحقيقي والموهبة في الفنون التشكيلية أو الموسيقى أو المسرح.',
                    ]],
                    ['text' => [
                        'en' => 'Commitment to regular studio rehearsals and annual cultural festival performances.',
                        'bn' => 'নিয়মিত মহড়া এবং বার্ষিক সাংস্কৃতিক উৎসবে সক্রিয় অংশগ্রহণের প্রতিশ্রুতি।',
                        'ar' => 'الالتزام بالتدريبات المنتظمة والمشاركة في المهرجانات الثقافية السنوية.',
                    ]],
                    ['text' => [
                        'en' => 'Careful handling of institutional art equipment and musical instruments.',
                        'bn' => 'প্রতিষ্ঠানের শিল্পসামগ্রী ও বাদ্যযন্ত্রের সঠিক যত্ন ও সুরক্ষার নিশ্চয়তা।',
                        'ar' => 'المحافظة على أدوات الرسم والآلات الموسيقية الخاصة بالمؤسسة.',
                    ]],
                    ['text' => [
                        'en' => 'Submission of enrollment consent from parent or legal guardian.',
                        'bn' => 'অভিভাবকের লিখিত সম্মতিপত্র জমা প্রদান।',
                        'ar' => 'تقديم موافقة خطية من ولي الأمر للمشاركة.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],

            // 8. Department of Physical Education & Sports
            [
                'slug' => 'physical-education',
                'icon' => 'trophy',
                'title' => [
                    'en' => 'Department of Physical Education & Sports',
                    'bn' => 'শারীরিক শিক্ষা ও ক্রীড়া বিভাগ',
                    'ar' => 'قسم التربية البدنية والرياضة',
                ],
                'short_description' => [
                    'en' => 'Promoting physical fitness, sportsmanship, discipline, and athletic excellence across football, cricket, and indoor sports.',
                    'bn' => 'নিয়মানুবর্তিতা, শারীরিক সক্ষমতা, দলগত চেতনা এবং ফুটবল, ক্রিকেটসহ বিভিন্ন ইনডোর-আউটডোর খেলার মাধ্যমে সুস্থ জীবনধারা গঠন।',
                    'ar' => 'تعزيز اللياقة البدنية والروح الرياضية والانضباط والتميز الرياضي في كرة القدم والكركيت والأنشطة الحركية.',
                ],
                'image' => $this->copyIntoStorage('facility/05.jpg', 'site/departments/sports.jpg'),
                'gallery_image_1' => $this->copyIntoStorage('gallery/05.jpg', 'site/departments/sports-gal-1.jpg'),
                'gallery_image_2' => $this->copyIntoStorage('department/01.jpg', 'site/departments/sports-gal-2.jpg'),
                'description' => [
                    'en' => '<p>A healthy mind resides in a healthy body. The Department of Physical Education & Sports at EduEx School and College fosters robust health, endurance, agility, and sportsmanship. Supervised by qualified athletic directors and coaches, training covers football, cricket, basketball, volleyball, badminton, table tennis, and athletics.</p><p>Our sprawling campus sports ground hosts the Annual Sports Meet and Inter-House tournaments. EduEx sports teams consistently earn trophies in inter-school and college athletic championships across the country.</p>',
                    'bn' => '<p>সুস্থ দেহে সুস্থ মন—এই প্রত্যয়কে ধারণ করে এডুএক্স স্কুল অ্যান্ড কলেজের শারীরিক শিক্ষা ও ক্রীড়া বিভাগ শিক্ষার্থীদের শারীরিক সক্ষমতা, মানসিক একাগ্রতা ও ক্রীড়াসুলভ মনোভাব তৈরি করে। অভিজ্ঞ ক্রীড়া প্রশিক্ষকদের অধীনে ফুটবল, ক্রিকেট, বাস্কেটবল, ভলিবল, ব্যাডমিন্টন ও অ্যাথলেটিক্সে উন্নত প্রশিক্ষণ দেওয়া হয়।</p><p>আমাদের সুবিশাল খেলার মাঠে আয়োজিত হয় বার্ষিক ক্রীড়া প্রতিযোগিতা এবং আন্তঃহাউস টুর্নামেন্ট। জাতীয় ও আঞ্চলিক পর্যায়ের আন্তঃস্কুল-কলেজ প্রতিযোগিতায় আমাদের শিক্ষার্থীরা অসাধারণ নৈপুণ্য প্রদর্শন করে।</p>',
                    'ar' => '<p>يركز قسم التربية البدنية والرياضة على بناء الصحة السليمة والروح الرياضية والانضباط والمنافسة الشريفة في كرة القدم والكركيت وألعاب القوى ومختلف الأنشطة الحركية.</p>',
                ],
                'requirement_title' => [
                    'en' => 'Athletic Enrollment & Fitness',
                    'bn' => 'ক্রীড়া ভর্তি ও শারীরিক সুস্থতার শর্তাবলী',
                    'ar' => 'شروط اللياقة البدنية والتسجيل الرياضي',
                ],
                'requirement_items' => [
                    ['text' => [
                        'en' => 'Medical fitness clearance certifying capability for athletic activities.',
                        'bn' => 'খেলাধুলা ও শরীরচর্চার জন্য চিকিৎসকের শারীরিক সুস্থতার প্রত্যয়নপত্র।',
                        'ar' => 'شهادة لياقة طبية تؤكد القدرة على ممارسة الأنشطة الرياضية.',
                    ]],
                    ['text' => [
                        'en' => 'Commitment to team discipline, official sports kit/uniform, and practice drills.',
                        'bn' => 'দলগত শৃঙ্খলা, নির্দিষ্ট ক্রীড়া পোশাক পরিধান এবং অনুশীলন ক্লাসে উপস্থিতি।',
                        'ar' => 'الالتزام بالزي الرياضي الرسمي والانضباط ومواعيد التدريبات.',
                    ]],
                    ['text' => [
                        'en' => 'Maintaining satisfactory academic grades alongside sports participation.',
                        'bn' => 'খেলাধুলার পাশাপাশি পাঠ্যবইয়ের পড়াশোনায় সন্তোষজনক ফলাফল বজায় রাখা।',
                        'ar' => 'الحفاظ على المستوى الأكاديمي المطلوب بالتوازي مع النشاط الرياضي.',
                    ]],
                    ['text' => [
                        'en' => 'Parental consent and emergency contact information on record.',
                        'bn' => 'অভিভাবকের সম্মতিপত্র এবং জরুরি যোগাযোগের তথ্য প্রদান।',
                        'ar' => 'تقديم موافقة ولي الأمر ومعلومات الاتصال في حالات الطوارئ.',
                    ]],
                ],
                'downloads' => $commonDownloads,
            ],
        ];

        Department::query()->delete();

        foreach ($departments as $index => $department) {
            Department::updateOrCreate(
                ['slug' => $department['slug']],
                [
                    'icon' => ['source' => 'lucide', 'value' => $department['icon']],
                    'title' => $department['title'],
                    'short_description' => $department['short_description'],
                    'image' => $department['image'],
                    'description' => $department['description'],
                    'gallery_image_1' => $department['gallery_image_1'],
                    'gallery_image_2' => $department['gallery_image_2'],
                    'requirement_title' => $department['requirement_title'],
                    'requirement_items' => $department['requirement_items'],
                    'downloads' => $department['downloads'] ?? [],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }

        Cache::forget('departments_homepage_8');
        Cache::forget('departments_homepage_12');
    }

    protected function copyIntoStorage(string $source, string $destination): ?string
    {
        $sourcePath = public_path("frontend/assets/img/{$source}");

        if (! is_file($sourcePath)) {
            $storageSource = storage_path("app/public/{$source}");
            if (is_file($storageSource)) {
                $sourcePath = $storageSource;
            } else {
                return null;
            }
        }

        if (! Storage::disk('public')->exists($destination)) {
            Storage::disk('public')->put($destination, file_get_contents($sourcePath));
        }

        return $destination;
    }

    protected function copyPdfIntoStorage(string $sourcePathInStorage, string $destination): ?string
    {
        if (Storage::disk('public')->exists($sourcePathInStorage)) {
            if (! Storage::disk('public')->exists($destination)) {
                Storage::disk('public')->put($destination, Storage::disk('public')->get($sourcePathInStorage));
            }
            return $destination;
        }

        return null;
    }
}

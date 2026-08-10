@extends('frontend.layouts.app')

@section('content')
    <main class="wexnix_main">

        <!-- hero slider -->
        @if (\App\Models\ModuleSetting::showOnHomepage('slider'))
            @include('frontend.sections.slider.' . config('frontend.sections.slider'), ['sliders' => $sliders])
        @endif
        <!-- hero slider end -->

        <!-- institute info strip -->
        @if (\App\Models\ModuleSetting::showOnHomepage('institute_info'))
            @include('frontend.sections.institute-info.' . config('frontend.sections.institute_info'), ['siteSettings' => $siteSettings])
        @endif
        <!-- institute info strip end -->

        @if (($siteSettings->homepage_template ?? 'default') === 'index-1')
            <!-- home content + sidebar layout (index-1) -->
            <div class="wexnix_home-content-area">
                <div class="container-fluid">
                    <div class="row g-4">
                        <div class="col-lg-9 wexnix_home-main-col">
        @endif

        <!-- about area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('about'))
            @include('frontend.sections.about.' . config('frontend.sections.about'), ['siteSettings' => $siteSettings])
        @endif
        <!-- about area end -->


        <!-- counter area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('counter'))
            @include('frontend.sections.counter.' . config('frontend.sections.counter'), ['siteSettings' => $siteSettings])
        @endif
        <!-- counter area end -->


        <!-- course-area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('courses'))
            @include('frontend.sections.course.' . config('frontend.sections.course'), ['courses' => $courses, 'pageSettings' => $coursePageSettings])
        @endif
        <!-- course-area end -->


        <!-- video-area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('video'))
            @include('frontend.sections.video.' . config('frontend.sections.video'), ['siteSettings' => $siteSettings])
        @endif
        <!-- video-area end -->

        @if (($siteSettings->homepage_template ?? 'default') === 'index-1')
                        </div>
                        <!-- home main col end -->

                        <div class="col-lg-3 py-5">
                            @include('frontend.partials.home-sidebar')
                        </div>
                    </div>
                </div>
            </div>
            <!-- home content area end -->
        @endif


        <!-- team-area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('teachers'))
            @include('frontend.sections.teacher.' . config('frontend.sections.teacher'), ['teachers' => $teachers, 'pageSettings' => $teacherPageSettings])
        @endif
        <!-- team-area end -->


        <!-- choose-area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('choose'))
            @include('frontend.sections.choose.' . config('frontend.sections.choose'), ['siteSettings' => $siteSettings])
        @endif
        <!-- choose-area end -->


        <!-- gallery-area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('gallery'))
            @include('frontend.sections.gallery.' . config('frontend.sections.gallery'), ['images' => $galleryImages, 'pageSettings' => $galleryPageSettings])
        @endif
        <!-- gallery-area end -->


        <!-- cta-area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('offer'))
            @include('frontend.sections.offer.' . config('frontend.sections.offer'), ['siteSettings' => $siteSettings])
        @endif
        <!-- cta-area end -->


        <!-- event area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('events'))
            @include('frontend.sections.event.' . config('frontend.sections.event'), ['events' => $events, 'pageSettings' => $eventPageSettings])
        @endif
        <!-- event area end -->


        <!-- enroll area-->
        @if (\App\Models\ModuleSetting::showOnHomepage('skill'))
            @include('frontend.sections.skill.' . config('frontend.sections.skill'), ['siteSettings' => $siteSettings])
        @endif
        <!-- enroll area end -->


        <!-- department area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('departments'))
            @include('frontend.sections.department.' . config('frontend.sections.department'), ['departments' => $departments, 'pageSettings' => $departmentPageSettings])
        @endif
        <!-- department area end -->


        <!-- testimonial area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('testimonials'))
            @include('frontend.sections.testimonial.' . config('frontend.sections.testimonial'), ['testimonials' => $testimonials, 'pageSettings' => $testimonialPageSettings])
        @endif
        <!-- testimonial area end -->


        <!-- blog area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('blog'))
            @include('frontend.sections.blog.' . config('frontend.sections.blog'), ['posts' => $blogPosts, 'pageSettings' => $blogPageSettings])
        @endif
        <!-- blog area end -->


        <!-- partner area -->
        @if (\App\Models\ModuleSetting::showOnHomepage('partner'))
            @include('frontend.sections.partner.' . config('frontend.sections.partner'), ['siteSettings' => $siteSettings])
        @endif
        <!-- partner area end -->

    </main>
@endsection

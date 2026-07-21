@extends('frontend.layouts.app')

@section('content')
    <main class="wexnix_main">

        <!-- hero slider -->
        @include('frontend.sections.slider.' . config('frontend.sections.slider'), ['sliders' => $sliders])
        <!-- hero slider end -->

        <!-- institute info strip -->
        @include('frontend.sections.institute-info.' . config('frontend.sections.institute_info'), ['siteSettings' => $siteSettings])
        <!-- institute info strip end -->


        <!-- about area -->
        @include('frontend.sections.about.' . config('frontend.sections.about'), ['siteSettings' => $siteSettings])
        <!-- about area end -->


        <!-- counter area -->
        @include('frontend.sections.counter.' . config('frontend.sections.counter'), ['siteSettings' => $siteSettings])
        <!-- counter area end -->


        <!-- course-area -->
        @include('frontend.sections.course.' . config('frontend.sections.course'), ['courses' => $courses, 'pageSettings' => $coursePageSettings])
        <!-- course-area end -->


        <!-- video-area -->
        @include('frontend.sections.video.' . config('frontend.sections.video'), ['siteSettings' => $siteSettings])
        <!-- video-area end -->
        

        <!-- team-area -->
        @include('frontend.sections.teacher.' . config('frontend.sections.teacher'), ['teachers' => $teachers, 'pageSettings' => $teacherPageSettings])
        <!-- team-area end -->


        <!-- choose-area -->
        @include('frontend.sections.choose.' . config('frontend.sections.choose'), ['siteSettings' => $siteSettings])
        <!-- choose-area end -->


        <!-- gallery-area -->
        @include('frontend.sections.gallery.' . config('frontend.sections.gallery'), ['images' => $galleryImages, 'pageSettings' => $galleryPageSettings])
        <!-- gallery-area end -->


        <!-- cta-area -->
        @include('frontend.sections.offer.' . config('frontend.sections.offer'), ['siteSettings' => $siteSettings])
        <!-- cta-area end -->


        <!-- event area -->
        @include('frontend.sections.event.' . config('frontend.sections.event'), ['events' => $events, 'pageSettings' => $eventPageSettings])
        <!-- event area end -->


        <!-- enroll area-->
        @include('frontend.sections.skill.' . config('frontend.sections.skill'), ['siteSettings' => $siteSettings])
        <!-- enroll area end -->


        <!-- department area -->
        @include('frontend.sections.department.' . config('frontend.sections.department'), ['departments' => $departments, 'pageSettings' => $departmentPageSettings])
        <!-- department area end -->


        <!-- testimonial area -->
        <div class="wexnix_testimonial-area wexnix_ts-bg pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="wexnix_site-heading text-center">
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> Testimonials</span>
                            <h2 class="wexnix_site-title text-white">What Our Students <span>Say's</span></h2>
                            <p class="text-white">It is a long established fact that a reader will be distracted by the
                                readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="wexnix_testimonial-slider owl-carousel wexnix_owl-theme">
                    <div class="wexnix_testimonial-item">
                        <div class="wexnix_testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="wexnix_testimonial-quote">
                            <p>
                                There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words.
                            </p>
                        </div>
                        <div class="wexnix_testimonial-content">
                            <div class="wexnix_testimonial-author-img">
                                <img src="/frontend/assets/img/testimonial/01.jpg" alt="">
                            </div>
                            <div class="wexnix_testimonial-author-info">
                                <h4>Anthony Nicoll</h4>
                                <p>Student</p>
                            </div>
                        </div>
                        <span class="wexnix_testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                    </div>
                    <div class="wexnix_testimonial-item">
                        <div class="wexnix_testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="wexnix_testimonial-quote">
                            <p>
                                There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words.
                            </p>
                        </div>
                        <div class="wexnix_testimonial-content">
                            <div class="wexnix_testimonial-author-img">
                                <img src="/frontend/assets/img/testimonial/02.jpg" alt="">
                            </div>
                            <div class="wexnix_testimonial-author-info">
                                <h4>Richard Lock</h4>
                                <p>Student</p>
                            </div>
                        </div>
                        <span class="wexnix_testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                    </div>
                    <div class="wexnix_testimonial-item">
                        <div class="wexnix_testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="wexnix_testimonial-quote">
                            <p>
                                There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words.
                            </p>
                        </div>
                        <div class="wexnix_testimonial-content">
                            <div class="wexnix_testimonial-author-img">
                                <img src="/frontend/assets/img/testimonial/03.jpg" alt="">
                            </div>
                            <div class="wexnix_testimonial-author-info">
                                <h4>Randal Grand</h4>
                                <p>Student</p>
                            </div>
                        </div>
                        <span class="wexnix_testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                    </div>
                    <div class="wexnix_testimonial-item">
                        <div class="wexnix_testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="wexnix_testimonial-quote">
                            <p>
                                There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words.
                            </p>
                        </div>
                        <div class="wexnix_testimonial-content">
                            <div class="wexnix_testimonial-author-img">
                                <img src="/frontend/assets/img/testimonial/04.jpg" alt="">
                            </div>
                            <div class="wexnix_testimonial-author-info">
                                <h4>Edward Miles</h4>
                                <p>Student</p>
                            </div>
                        </div>
                        <span class="wexnix_testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                    </div>
                    <div class="wexnix_testimonial-item">
                        <div class="wexnix_testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="wexnix_testimonial-quote">
                            <p>
                                There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words.
                            </p>
                        </div>
                        <div class="wexnix_testimonial-content">
                            <div class="wexnix_testimonial-author-img">
                                <img src="/frontend/assets/img/testimonial/05.jpg" alt="">
                            </div>
                            <div class="wexnix_testimonial-author-info">
                                <h4>Ninal Gordon</h4>
                                <p>Student</p>
                            </div>
                        </div>
                        <span class="wexnix_testimonial-quote-icon"><i class="fas fa-quote-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial area end -->


        <!-- blog area -->
        <div class="wexnix_blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="wexnix_site-heading text-center">
                            <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> Our Blog</span>
                            <h2 class="wexnix_site-title">Latest News & <span>Blog</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="wexnix_blog-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="wexnix_blog-date"><i class="fas fa-calendar-alt"></i> June 18, 2024</div>
                            <div class="wexnix_blog-item-img">
                                <img src="/frontend/assets/img/blog/01.jpg" alt="Thumb">
                            </div>
                            <div class="wexnix_blog-item-info">
                                <div class="wexnix_blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-user-circle"></i> By Alicia Davis</a></li>
                                        <li><a href="#"><i class="fas fa-comments"></i> 03 Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="wexnix_blog-title">
                                    <a href="blog-single.html">There are many variations passage have suffered
                                        available.</a>
                                </h4>
                                <a class="wexnix_theme-btn" href="blog-single.html">Read More<i
                                        class="fas fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="wexnix_blog-item wow fadeInUp" data-wow-delay=".50s">
                            <div class="wexnix_blog-date"><i class="fas fa-calendar-alt"></i> June 18, 2024</div>
                            <div class="wexnix_blog-item-img">
                                <img src="/frontend/assets/img/blog/02.jpg" alt="Thumb">
                            </div>
                            <div class="wexnix_blog-item-info">
                                <div class="wexnix_blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-user-circle"></i> By Alicia Davis</a></li>
                                        <li><a href="#"><i class="fas fa-comments"></i> 03 Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="wexnix_blog-title">
                                    <a href="blog-single.html">There are many variations passage have suffered
                                        available.</a>
                                </h4>
                                <a class="wexnix_theme-btn" href="blog-single.html">Read More<i
                                        class="fas fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="wexnix_blog-item wow fadeInUp" data-wow-delay=".75s">
                            <div class="wexnix_blog-date"><i class="fas fa-calendar-alt"></i> June 18, 2024</div>
                            <div class="wexnix_blog-item-img">
                                <img src="/frontend/assets/img/blog/03.jpg" alt="Thumb">
                            </div>
                            <div class="wexnix_blog-item-info">
                                <div class="wexnix_blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-user-circle"></i> By Alicia Davis</a></li>
                                        <li><a href="#"><i class="fas fa-comments"></i> 03 Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="wexnix_blog-title">
                                    <a href="blog-single.html">There are many variations passage have suffered
                                        available.</a>
                                </h4>
                                <a class="wexnix_theme-btn" href="blog-single.html">Read More<i
                                        class="fas fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog area end -->


        <!-- partner area -->
        @include('frontend.sections.partner.' . config('frontend.sections.partner'), ['siteSettings' => $siteSettings])
        <!-- partner area end -->

    </main>
@endsection

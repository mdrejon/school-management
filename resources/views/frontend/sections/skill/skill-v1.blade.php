{{-- Enrollment card + "Our Skills" progress bars, design v1. --}}
{{-- Expects: $siteSettings (App\Models\SiteSetting, shared globally via the AppServiceProvider view composer). --}}
{{-- The enrollment form fields (name/email/course/message) are static theme UI, not admin content — only the card heading and skill bars are dynamic. --}}
@php
    $titleHtml = e($siteSettings->skill_title);
    if (! empty($siteSettings->skill_highlight)) {
        $titleHtml = str_ireplace(e($siteSettings->{{ __('skill_highlight), \'') }}<span>' . e($siteSettings->{{ __('skill_highlight) . \'') }}</span>', $titleHtml);
    }
    $skills = $siteSettings->skillItems();
@endphp
<div class="wexnix_enroll-area pt-80 pb-80">
    <div class="container">
        <div class="col-lg-12">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="wexnix_enroll-left wow fadeInLeft" data-wow-delay=".25s">
                        <div class="wexnix_enroll-form">
                            <div class="wexnix_enroll-form-header">
                                <h3>{{ $siteSettings->{{ __('skill_enroll_title ?: \'Start Your Enrollment\' }}') }}</h3>
                                @if ($siteSettings->{{ __('skill_enroll_subtitle)') }}
                                    <p>{{ $siteSettings->{{ __('skill_enroll_subtitle }}') }}</p>
                                @endif
                            </div>
                            <form action="#">
                                <div class="wexnix_form-group">
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('Your Name') }}">
                                </div>
                                <div class="wexnix_form-group">
                                    <input type="email" name="email" class="form-control" placeholder="{{ __('Email Address') }}">
                                </div>
                                <div class="wexnix_form-group">
                                    <select class="form-select" name="service">
                                        <option value="">{{ __('Choose Course') }}</option>
                                        <option value="1">{{ __('Art And Design') }}</option>
                                        <option value="2">{{ __('Acting And Drama') }}</option>
                                        <option value="3">{{ __('Accounting And Finance') }}</option>
                                        <option value="4">{{ __('Biology And Conservation') }}</option>
                                        <option value="5">{{ __('Science And Engineering') }}</option>
                                        <option value="6">{{ __('Health Administration') }}</option>
                                    </select>
                                </div>
                                <div class="wexnix_form-group">
                                    <textarea name="message" class="form-control" placeholder="{{ __('Type Message') }}" rows="4"></textarea>
                                </div>
                                <button class="wexnix_theme-btn">{{ __('Enroll Now') }}<i class="fas fa-arrow-right-long"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="wexnix_enroll-right wow fadeInUp" data-wow-delay=".25s">
                        <div class="wexnix_skill-content">
                            <div class="wexnix_site-heading mb-3">
                                @if ($siteSettings->{{ __('skill_tagline)') }}
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $siteSettings->{{ __('skill_tagline }}') }}</span>
                                @endif
                                <h2 class="wexnix_site-title text-white">{!! $titleHtml !!}</h2>
                            </div>
                            @if ($siteSettings->{{ __('skill_description)') }}
                                <p class="text-white">{{ $siteSettings->{{ __('skill_description }}') }}</p>
                            @endif
                            @if (count($skills))
                                <div class="wexnix_skills-section">
                                    @foreach ($skills as $skill)
                                        <div class="wexnix_progress-box">
                                            <h5>{{ $skill['label'] }} <span class="wexnix_pull-right">{{ $skill['percentage'] }}%</span></h5>
                                            <div class="progress" data-value="{{ $skill['percentage'] }}">
                                                <div class="progress-bar" role="progressbar"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($siteSettings->{{ __('skill_button_text)') }}
                                <a href="{{ $siteSettings->skill_button_url ?: '#' }}" class="wexnix_theme-btn mt-5">{{ $siteSettings->{{ __('skill_button_text }}') }}<i class="fas fa-arrow-right-long"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

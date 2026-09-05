    <!-- Hon'ble Minister Widget -->
    @if (!empty($siteSettings->sidebar_minister_show))
        <div class="col-lg-3 col-md-6">
    <div class="wexnix_sidebar-widget h-100">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-user-tie"></i> {{ __('Hon\'ble Minister') }}</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img loading="lazy" src="{{ $siteSettings->sidebar_minister_photo_url ?: asset('assets/img/Minister.jpeg') }}" alt="Hon'ble Minister">
                </div>
                <h5 class="wexnix_sidebar-person-name">{{ $siteSettings->sidebar_minister_name ?: 'Dr. A N M Ehsanul Hoque Milon' }}</h5>
                <span class="wexnix_sidebar-person-role">{{ $siteSettings->sidebar_minister_role ?: 'Hon\'ble Minister, Ministry of Education' }}</span>
                <div>
                    <a href="{{ $siteSettings->sidebar_minister_button_url ?: '#' }}" class="wexnix_sidebar-more">
                        {{ $siteSettings->sidebar_minister_button_text ?: 'See More' }} <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            </div>
</div>
    @endif
    <!-- Hon'ble Minister Widget End -->

    <!-- Secretary Widget -->
    @if (!empty($siteSettings->sidebar_secretary_show))
        <div class="col-lg-3 col-md-6">
    <div class="wexnix_sidebar-widget h-100">
            <h4 class="wexnix_sidebar-widget-title wexnix_sidebar-title-alt"><i class="fas fa-user-tie"></i> {{ __('Secretary') }}</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img loading="lazy" src="{{ $siteSettings->sidebar_secretary_photo_url ?: asset('assets/img/Secretary.jpeg') }}" alt="Secretary">
                </div>
                <h5 class="wexnix_sidebar-person-name">{{ $siteSettings->sidebar_secretary_name ?: 'Abdul Khaleque' }}</h5>
                <span class="wexnix_sidebar-person-role">{{ $siteSettings->sidebar_secretary_role ?: 'Secretary, Secondary and Higher Education Division' }}</span>
                <div>
                    <a href="{{ $siteSettings->sidebar_secretary_button_url ?: '#' }}" class="wexnix_sidebar-more">
                        {{ $siteSettings->sidebar_secretary_button_text ?: 'See More' }} <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            </div>
</div>
    @endif
    <!-- Secretary Widget End -->

    <!-- Our Principal Widget -->
    @if (!empty($siteSettings->sidebar_principal_show) && \App\Models\ModuleSetting::isEnabled('principal'))
        <div class="col-lg-3 col-md-6">
    <div class="wexnix_sidebar-widget h-100">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-user-tie"></i> {{ __('Our Principal') }}</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img loading="lazy" src="{{ $siteSettings->principal_photo_url ?: asset('assets/img/team/03.jpg') }}" alt="{{ $siteSettings->principal_name ?: 'Principal' }}">
                </div>
                <h5 class="wexnix_sidebar-person-name">{{ $siteSettings->principal_name ?: 'Mohammad Rafiqul Islam' }}</h5>
                <span class="wexnix_sidebar-person-role">{{ $siteSettings->principal_designation ?: 'Principal' }}</span>
                <div>
                    <a href="{{ route('principal') }}" class="wexnix_sidebar-more">
                        {{ $siteSettings->sidebar_principal_button_text ?: 'Read More' }} <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            </div>
</div>
    @endif
    <!-- Our Principal Widget End -->

    <!-- Our Vice Principal Widget -->
    @if (!empty($siteSettings->sidebar_vice_principal_show))
        <div class="col-lg-3 col-md-6">
    <div class="wexnix_sidebar-widget h-100">
            <h4 class="wexnix_sidebar-widget-title wexnix_sidebar-title-alt"><i class="fas fa-user-tie"></i> {{ __('Our Vice Principal') }}</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img loading="lazy" src="{{ $siteSettings->sidebar_vice_principal_photo_url ?: asset('assets/img/team/04.jpg') }}" alt="Our Vice Principal">
                </div>
                <h5 class="wexnix_sidebar-person-name">{{ $siteSettings->sidebar_vice_principal_name ?: 'Dennis A. Pruitt' }}</h5>
                <span class="wexnix_sidebar-person-role">{{ $siteSettings->sidebar_vice_principal_role ?: 'Vice Principal' }}</span>
                <div>
                    <a href="{{ $siteSettings->sidebar_vice_principal_button_url ?: '#' }}" class="wexnix_sidebar-more">
                        {{ $siteSettings->sidebar_vice_principal_button_text ?: 'Read More' }} <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            </div>
</div>
    @endif
    <!-- Our Vice Principal Widget End -->

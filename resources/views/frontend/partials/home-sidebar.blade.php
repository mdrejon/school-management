<aside class="wexnix_home-sidebar">

    <!-- Notice Board Widget -->
    @if (!empty($siteSettings->sidebar_notice_show) && \App\Models\ModuleSetting::isEnabled('notices'))
        <div class="wexnix_sidebar-widget">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-rss"></i> {{ $siteSettings->sidebar_notice_title ?: 'Notice Board' }}</h4>
            <ul class="wexnix_sidebar-notice-list">
                @php
                    $limit = $siteSettings->sidebar_notice_limit ?: 4;
                    $noticesList = $sidebarNotices ?? \App\Models\Notice::forMarquee($limit);
                @endphp
                @forelse ($noticesList->take($limit) as $notice)
                    <li>
                        <span class="wexnix_sidebar-notice-icon"><i class="fas fa-file-alt"></i></span>
                        <div class="wexnix_sidebar-notice-content">
                            <a href="{{ route('notices.show', $notice->slug) }}">{{ $notice->title }}</a>
                            <span>{{ $notice->published_at ? $notice->published_at->format('l, F j, Y') : '' }}</span>
                        </div>
                    </li>
                @empty
                    <li>
                        <div class="wexnix_sidebar-notice-content">
                            <span>No notices available at this time.</span>
                        </div>
                    </li>
                @endforelse
            </ul>
            <div class="wexnix_sidebar-widget-footer">
                <a href="{{ route('notices.index') }}">Read more <i class="fas fa-arrow-right-long"></i></a>
            </div>
        </div>
    @endif
    <!-- Notice Board Widget End -->

    <!-- Hon'ble Minister Widget -->
    @if (!empty($siteSettings->sidebar_minister_show))
        <div class="wexnix_sidebar-widget">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-user-tie"></i> Hon'ble Minister</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img src="{{ $siteSettings->sidebar_minister_photo_url ?: asset('assets/img/Minister.jpeg') }}" alt="Hon'ble Minister">
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
    @endif
    <!-- Hon'ble Minister Widget End -->

    <!-- Secretary Widget -->
    @if (!empty($siteSettings->sidebar_secretary_show))
        <div class="wexnix_sidebar-widget">
            <h4 class="wexnix_sidebar-widget-title wexnix_sidebar-title-alt"><i class="fas fa-user-tie"></i> Secretary</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img src="{{ $siteSettings->sidebar_secretary_photo_url ?: asset('assets/img/Secretary.jpeg') }}" alt="Secretary">
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
    @endif
    <!-- Secretary Widget End -->

    <!-- Our Principal Widget -->
    @if (!empty($siteSettings->sidebar_principal_show) && \App\Models\ModuleSetting::isEnabled('principal'))
        <div class="wexnix_sidebar-widget">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-user-tie"></i> Our Principal</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img src="{{ $siteSettings->principal_photo_url ?: asset('assets/img/team/03.jpg') }}" alt="{{ $siteSettings->principal_name ?: 'Principal' }}">
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
    @endif
    <!-- Our Principal Widget End -->

    <!-- Our Vice Principal Widget -->
    @if (!empty($siteSettings->sidebar_vice_principal_show))
        <div class="wexnix_sidebar-widget">
            <h4 class="wexnix_sidebar-widget-title wexnix_sidebar-title-alt"><i class="fas fa-user-tie"></i> Our Vice Principal</h4>
            <div class="wexnix_sidebar-person">
                <div class="wexnix_sidebar-person-img">
                    <img src="{{ $siteSettings->sidebar_vice_principal_photo_url ?: asset('assets/img/team/04.jpg') }}" alt="Our Vice Principal">
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
    @endif
    <!-- Our Vice Principal Widget End -->

    <!-- Academic Calendar Widget -->
    @if (!empty($siteSettings->sidebar_calendar_show))
        <div class="wexnix_sidebar-widget">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-calendar-alt"></i> {{ $siteSettings->sidebar_calendar_title ?: 'Academic Calendar' }}</h4>
            <div class="wexnix_sidebar-calendar">
                <div class="wexnix_sidebar-calendar-head">{{ now()->format('F Y') }}</div>
                <div class="wexnix_sidebar-calendar-grid">
                    <span class="wexnix_cal-dow">Mo</span>
                    <span class="wexnix_cal-dow">Tu</span>
                    <span class="wexnix_cal-dow">We</span>
                    <span class="wexnix_cal-dow">Th</span>
                    <span class="wexnix_cal-dow">Fr</span>
                    <span class="wexnix_cal-dow">Sa</span>
                    <span class="wexnix_cal-dow">Su</span>

                    @php
                        $startOfMonth = now()->startOfMonth();
                        $daysInMonth = now()->daysInMonth;
                        $dayOfWeek = $startOfMonth->dayOfWeekIso; // 1 (Mon) to 7 (Sun)
                        $today = now()->day;
                    @endphp

                    @for ($i = 1; $i < $dayOfWeek; $i++)
                        <span class="wexnix_cal-day wexnix_cal-empty"></span>
                    @endfor

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        <span class="wexnix_cal-day {{ $day == $today ? 'wexnix_cal-today' : '' }} {{ in_array($day, [4, 15, 22]) ? 'wexnix_cal-event' : '' }}">{{ $day }}</span>
                    @endfor
                </div>
                <div class="wexnix_sidebar-calendar-legend">
                    <span><span class="wexnix_dot wexnix_dot-today"></span> Today</span>
                    <span><span class="wexnix_dot wexnix_dot-event"></span> Event</span>
                </div>
            </div>
        </div>
    @endif
    <!-- Academic Calendar Widget End -->

</aside>

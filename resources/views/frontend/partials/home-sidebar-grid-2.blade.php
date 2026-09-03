    <!-- Notice Board Widget -->
    @if (!empty($siteSettings->{{ __('sidebar_notice_show) && \App\Models\ModuleSetting::isEnabled(\'notices\'))') }}
        <div class="col-lg-4 col-md-6">
    <div class="wexnix_sidebar-widget h-100">
            <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-rss"></i> {{ $siteSettings->{{ __('sidebar_notice_title ?: \'Notice Board\' }}') }}</h4>
            <ul class="wexnix_sidebar-notice-list">
                @php
                    $limit = $siteSettings->sidebar_notice_limit ?: 4;
                    $noticesList = $sidebarNotices ?? \App\Models\Notice::forMarquee($limit);
                @endphp
                @forelse ($noticesList->take($limit) as $notice)
                    <li>
                        <span class="wexnix_sidebar-notice-icon"><i class="fas fa-file-alt"></i></span>
                        <div class="wexnix_sidebar-notice-content">
                            <a href="{{ route('notices.show', $notice->slug) }}">{{ $notice->{{ __('title }}') }}</a>
                            <span>{{ $notice->published_at ? $notice->published_at->{{ __('format(\'l, F j, Y\') : \'\' }}') }}</span>
                        </div>
                    </li>
                @empty
                    <li>
                        <div class="wexnix_sidebar-notice-content">
                            <span>{{ __('No notices available at this time.') }}</span>
                        </div>
                    </li>
                @endforelse
            </ul>
            <div class="wexnix_sidebar-widget-footer">
                <a href="{{ route('notices.index') }}">{{ __('Read more') }} <i class="fas fa-arrow-right-long"></i></a>
            </div>
            </div>
</div>
    @endif
    <!-- Notice Board Widget End -->

    <!-- Academic Calendar Widget -->
    @if (!empty($siteSettings->{{ __('sidebar_calendar_show))') }}
        <div class="col-lg-4 col-md-6">
            @include('frontend.partials.academic-calendar-widget')
        </div>
    @endif
    <!-- Academic Calendar Widget End -->

    <!-- Upcoming Events Widget -->
    @if (\App\Models\ModuleSetting::isEnabled('events') && isset($events) && $events->count() > 0)
        <div class="col-lg-4 col-md-6">
            <div class="wexnix_sidebar-widget h-100">
                <h4 class="wexnix_sidebar-widget-title wexnix_sidebar-title-alt">
                    <i class="fas fa-calendar-check"></i> {{ __('Upcoming Events') }}
                </h4>
                <ul class="wexnix_sidebar-event-list">
                    @foreach ($events->take(3) as $event)
                        <li>
                            <div class="wexnix_sidebar-event-date">
                                <span>{{ $event->event_date ? $event->event_date->{{ __('format(\'d\') : \'\' }}') }}</span>{{ $event->event_date ? $event->event_date->{{ __('format(\'M\') : \'\' }}') }}
                            </div>
                            <div class="wexnix_sidebar-event-content">
                                <a href="{{ route('events.show', $event) }}">{{ $event->{{ __('title }}') }}</a>
                                <span><i class="fas fa-map-marker-alt"></i> {{ $event->{{ __('location }}') }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="wexnix_sidebar-widget-footer">
                    <a href="{{ route('events.index') }}">{{ __('Read more') }} <i class="fas fa-arrow-right-long"></i></a>
                </div>
            </div>
        </div>
    @endif
    <!-- Upcoming Events Widget End -->



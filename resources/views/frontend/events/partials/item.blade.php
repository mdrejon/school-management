{{-- Bare event item (no grid column wrapper) — shared by the events list page (wrapped in a column) --}}
{{-- and the homepage "Events" teaser carousel (wrapped by owl-carousel directly). --}}
{{-- Expects: $event (App\Models\Event). --}}
<div class="wexnix_event-item">
    @if ($event->location)
        <div class="wexnix_event-location">
            <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
        </div>
    @endif
    <div class="wexnix_event-img">
        <img src="{{ $event->image_url ?? '/frontend/assets/img/event/01.jpg' }}" alt="">
    </div>
    <div class="wexnix_event-info">
        @if ($event->event_date || $event->event_time)
            <div class="wexnix_event-meta">
                @if ($event->event_date)
                    <span class="wexnix_event-date"><i class="fas fa-calendar-alt"></i>{{ $event->event_date->format('d F, Y') }}</span>
                @endif
                @if ($event->event_time)
                    <span class="wexnix_event-time"><i class="fas fa-clock"></i>{{ $event->event_time }}</span>
                @endif
            </div>
        @endif
        <h4 class="wexnix_event-title"><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></h4>
        @if ($event->short_description)
            <p>{{ $event->short_description }}</p>
        @endif
        <div class="wexnix_event-btn">
            <a href="{{ route('events.show', $event) }}" class="wexnix_theme-btn">Join Event<i class="fas fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>

{{-- Shared staff card --}}
{{-- Expects: $staff (Modules\Staff\Models\Staff). --}}
<div class="col-md-6 col-lg-3">
    <div class="wexnix_team-item wow fadeInUp" data-wow-delay=".25s">
        <div class="wexnix_team-img">
            <img loading="lazy" src="{{ $staff->photo_url ?? '/frontend/assets/img/team/01.jpg' }}" alt="thumb">
        </div>
        <div class="wexnix_team-content">
            <div class="wexnix_team-bio">
                <h5><a href="{{ route('staff.show', $staff) }}">{{ $staff->name }}</a></h5>
                @if ($staff->designation)
                    <span>{{ $staff->designation }}</span>
                @endif
            </div>
        </div>
        <a href="{{ route('staff.show', $staff) }}" class="wexnix_team-social-btn"><i class="fas fa-share-nodes"></i></a>
    </div>
</div>

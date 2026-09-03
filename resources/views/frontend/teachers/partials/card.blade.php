{{-- Shared teacher card — used by the teachers list page and the homepage "Teachers" teaser section. --}}
{{-- Expects: $teacher (App\Models\Teacher). --}}
<div class="col-md-6 col-lg-3">
    <div class="wexnix_team-item wow fadeInUp" data-wow-delay=".25s">
        <div class="wexnix_team-img">
            <img src="{{ $teacher->photo_url ?? '/frontend/assets/img/team/01.jpg' }}" alt="thumb">
        </div>
        <div class="wexnix_team-social">
            @if ($teacher->facebook_url)
                <a href="{{ $teacher->facebook_url }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if ($teacher->whatsapp_url)
                <a href="{{ $teacher->whatsapp_url }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
            @endif
            @if ($teacher->linkedin_url)
                <a href="{{ $teacher->linkedin_url }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
            @endif
            @if ($teacher->pinterest_url)
                <a href="{{ $teacher->pinterest_url }}" target="_blank" rel="noopener"><i class="fab fa-pinterest"></i></a>
            @endif
        </div>
        <div class="wexnix_team-content">
            <div class="wexnix_team-bio">
                <h5><a href="{{ route('teachers.show', $teacher) }}">{{ $teacher->name }}</a></h5>
                @if ($teacher->designation)
                    <span>{{ $teacher->designation }}</span>
                @endif
            </div>
        </div>
        <a href="{{ route('teachers.show', $teacher) }}" class="wexnix_team-social-btn"><i class="fas fa-share-nodes"></i></a>
    </div>
</div>

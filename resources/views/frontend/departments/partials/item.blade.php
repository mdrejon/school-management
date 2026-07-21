{{-- Bare department item (no grid column wrapper) — shared by the departments list page (wrapped in a --}}
{{-- column) and the homepage "Department" teaser carousel (wrapped by owl-carousel directly). --}}
{{-- Expects: $department (App\Models\Department). --}}
<div class="wexnix_department-item">
    <div class="wexnix_department-icon">
        <x-dynamic-icon :icon="$department->icon" />
    </div>
    <div class="wexnix_department-info">
        <h4 class="wexnix_department-title"><a href="{{ route('departments.show', $department) }}">{{ $department->title }}</a></h4>
        @if ($department->short_description)
            <p>{{ $department->short_description }}</p>
        @endif
        <div class="wexnix_department-btn">
            <a href="{{ route('departments.show', $department) }}">Read More<i class="fas fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>

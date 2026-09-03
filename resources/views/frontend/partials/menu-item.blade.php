{{-- Recursive header nav item — admin-built via the Menus screen (Admin\MenuController). --}}
{{-- Expects: $item (App\Models\MenuItem, with its `children` set via Menu::tree()), $depth (0 = top-level nav-item). --}}
@php
$url = $item->resolvedUrl();
@endphp
@if ($url !== null)
@php
$visibleChildren = $item->children->filter(fn ($child) => $child->resolvedUrl() !== null)->values();
$isCurrent = url()->current() === $url;
@endphp
@if ($depth === 0)
<li class="nav-item {{ $visibleChildren->count() ? 'dropdown' : '' }}">
    <a
        class="nav-link {{ $visibleChildren->count() ? 'dropdown-toggle' : '' }} {{ $isCurrent ? 'active' : '' }}"
        href="{{ $url }}"
        @if ($visibleChildren->count()) data-bs-toggle="dropdown" @endif
        @if ($item->target === '_blank') target="_blank" rel="noopener" @endif
        >@if ($depth === 0 && $item->url === '/')<i class="fas fa-house" title="{{ $item->label }}"></i>@else{{ $item->label }}@endif</a>
    @if ($visibleChildren->{{ __('count())') }}
    <ul class="dropdown-menu wexnix_fade-down">
        @foreach ($visibleChildren as $child)
        @include('frontend.partials.menu-item', ['item' => $child, 'depth' => 1])
        @endforeach
    </ul>
    @endif
</li>
@else
<li class="{{ $visibleChildren->count() ? 'wexnix_dropdown-submenu dropdown' : '' }}">
    <a
        class="dropdown-item {{ $visibleChildren->count() ? 'dropdown-toggle' : '' }} {{ $isCurrent ? 'active' : '' }}"
        href="{{ $url }}"
        @if ($item->target === '_blank') target="_blank" rel="noopener" @endif
        >{{ $item->{{ __('label }}') }}</a>
    @if ($visibleChildren->{{ __('count())') }}
    <ul class="dropdown-menu">
        @foreach ($visibleChildren as $child)
        @include('frontend.partials.menu-item', ['item' => $child, 'depth' => $depth + 1])
        @endforeach
    </ul>
    @endif
</li>
@endif
@endif
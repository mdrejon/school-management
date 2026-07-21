@props(['icon', 'class' => ''])
{{-- Renders a repeater icon field ({source: 'lucide'|'upload', value: ...}) —
     'lucide' renders true inline SVG via mallardduck/blade-lucide-icons,
     'upload' renders the admin-uploaded image/SVG file as a plain <img>. --}}
@if (($icon['source'] ?? null) === 'lucide' && ($icon['value'] ?? ''))
    {{ svg('lucide-' . $icon['value'], $class) }}
@elseif ($icon['value'] ?? null)
    <img src="/storage/{{ $icon['value'] }}" alt="" class="{{ $class }}">
@endif

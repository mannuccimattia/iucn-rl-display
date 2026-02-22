@php
    $classes =
        'bg-main-light rounded-2xl border border-main-emphasis/20 hover:border-main-emphasis/40 p-6 shadow duration-150 transition-all';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

@php
    $classes =
        'bg-main-light p-6 rounded-2xl border border-main-emphasis/20 hover:border-main-emphasis/40 duration-150 transition-all';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

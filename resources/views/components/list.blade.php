@php
    $classes =
        'bg-main-light rounded-2xl border border-main-emphasis/20 hover:border-main-emphasis/40 p-6 group grid gap-6 lg:grid-cols-[1fr_auto] items-start lg:items-center duration-150 transition-all';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

@php
    $classes =
        'cursor-pointer hover:text-main-emphasis/80 focus:text-main-emphasis transition-all duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

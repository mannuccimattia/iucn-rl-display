@php
    $classes = 'cursor-pointer hover:text-main-emphasis focus:text-red-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

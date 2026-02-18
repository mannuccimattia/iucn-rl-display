@php
    $classes = 'cursor-pointer hover:text-main-emphasis focus:text-red-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

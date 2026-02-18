@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-main-emphasis text-start text-base font-medium text-main bg-red-100 focus:outline-none focus:text-main-emphasis focus:bg-red-100 focus:border-main-emphasis transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-main-contrast hover:bg-main hover:border-gray-300 focus:outline-none focus:text-main focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

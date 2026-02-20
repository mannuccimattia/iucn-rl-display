<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-main-emphasis border border-transparent rounded-md font-semibold text-xs text-main-contrast uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

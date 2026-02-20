<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-main-light border border-gray-300 rounded-md font-semibold text-xs text-main-contrast uppercase tracking-widest shadow-sm hover:bg-main-dark focus:border-main-emphasis/20 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

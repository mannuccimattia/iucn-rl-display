@props([
    'mode' => 'list',
])

<div class="w-fit inline-flex rounded-lg border border-main-emphasis/40 p-1 bg-main">
    <a href="{{ $mode === 'list' ? '#' : request()->fullUrlWithQuery(['view' => 'list']) }}"
        aria-disabled="{{ $mode === 'list' ? 'true' : 'false' }}" aria-current="{{ $mode === 'list' ? 'page' : 'false' }}"
        tabindex="{{ $mode === 'list' ? '-1' : '0' }}" @class([
            'px-3 py-1.5 text-xs font-bold uppercase rounded-md transition-all duration-150',
            'bg-main-emphasis text-main pointer-events-none' => $mode === 'list',
            'text-main-contrast hover:text-main-emphasis' => $mode !== 'list',
        ])>
        <i class="fa-solid fa-list"></i>
    </a>

    <a href="{{ $mode === 'card' ? '#' : request()->fullUrlWithQuery(['view' => 'card']) }}"
        aria-disabled="{{ $mode === 'card' ? 'true' : 'false' }}" aria-current="{{ $mode === 'card' ? 'page' : 'false' }}"
        tabindex="{{ $mode === 'card' ? '-1' : '0' }}" @class([
            'px-3 py-1.5 text-xs font-bold uppercase rounded-md transition-all duration-150',
            'bg-main-emphasis text-main pointer-events-none' => $mode === 'card',
            'text-main-contrast hover:text-main-emphasis' => $mode !== 'card',
        ])>
        <i class="fa-solid fa-grip"></i>
    </a>
</div>

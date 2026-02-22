@props([
    'mode' => 'list',
])

<div class="w-fit inline-flex rounded-lg border border-main-emphasis/40 p-1 bg-main">
    <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" @class([
        'px-3 py-1.5 text-xs font-bold uppercase rounded-md transition-all duration-150',
        'bg-main-emphasis text-main' => $mode === 'list',
        'text-main-contrast hover:text-main-emphasis' => $mode !== 'list',
    ])>
        <i class="fa-solid fa-list"></i>
    </a>

    <a href="{{ request()->fullUrlWithQuery(['view' => 'card']) }}" @class([
        'px-3 py-1.5 text-xs font-bold uppercase rounded-md transition-all duration-150',
        'bg-main-emphasis text-main' => $mode === 'card',
        'text-main-contrast hover:text-main-emphasis' => $mode !== 'card',
    ])>
        <i class="fa-solid fa-grip"></i>
    </a>
</div>

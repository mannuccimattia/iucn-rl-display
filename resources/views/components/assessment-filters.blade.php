@props([
    'viewMode' => 'list',
    'filters' => [],
])

<x-card class="mb-8 border-none bg-transparent">
    <form method="GET" action="{{ request()->url() }}" class="grid gap-4 lg:grid-cols-3 xl:grid-cols-5 xl:items-end">
        <input type="hidden" name="view" value="{{ $viewMode }}">

        <div class="flex flex-col gap-1">
            <label for="year_published" class="text-[10px] uppercase opacity-60 font-bold">Anno pubblicazione</label>
            <input id="year_published" name="year_published" type="text" inputmode="numeric" pattern="[0-9]{0,4}"
                maxlength="4" max="{{ date('Y') }}" autocomplete="off"
                value="{{ $filters['year_published'] ?? '' }}" placeholder="{{ $filters['year_published'] ?? 'Tutti' }}"
                class="rounded-md border-main-emphasis/40 bg-main text-main-contrast text-sm focus:border-main-emphasis focus:ring-main-emphasis" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="possibly_extinct" class="text-[10px] uppercase opacity-60 font-bold">Possibile estinto</label>
            <select id="possibly_extinct" name="possibly_extinct"
                class="rounded-md border-main-emphasis/40 bg-main text-main-contrast text-sm focus:border-main-emphasis focus:ring-main-emphasis">
                <option value="">Tutti</option>
                <option value="true" @selected(($filters['possibly_extinct'] ?? '') === 'true')>Sì</option>
                <option value="false" @selected(($filters['possibly_extinct'] ?? '') === 'false')>No</option>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="possibly_extinct_in_the_wild" class="text-[10px] uppercase opacity-60 font-bold">Possibile
                estinto in natura</label>
            <select id="possibly_extinct_in_the_wild" name="possibly_extinct_in_the_wild"
                class="rounded-md border-main-emphasis/40 bg-main text-main-contrast text-sm focus:border-main-emphasis focus:ring-main-emphasis">
                <option value="">Tutti</option>
                <option value="true" @selected(($filters['possibly_extinct_in_the_wild'] ?? '') === 'true')>Sì</option>
                <option value="false" @selected(($filters['possibly_extinct_in_the_wild'] ?? '') === 'false')>No</option>
            </select>
        </div>

        <div class="flex gap-2 xl:col-span-2 xl:justify-end">
            <x-primary-button class="justify-center">
                Applica filtri
            </x-primary-button>

            <x-link :href="request()->url() . '?view=' . $viewMode" class="inline-flex items-center px-4 py-2">
                Reset
            </x-link>
        </div>
    </form>
</x-card>

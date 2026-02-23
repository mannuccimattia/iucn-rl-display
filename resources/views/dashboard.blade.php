<x-app-layout>
    <x-slot name="header">
        <div class="flex items-baseline text-main-contrast leading-tight">
            <h2 class="font-semibold text-xl">
                {{ __('Benvenuto!') }}
            </h2>
            <span class="ms-2 opacity-60 text-md">Clicca su un sistema o una nazione per iniziare la navigazione</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col gap-y-4">
                    <div class="flex flex-col items-center">
                        <h3 class="text-xs font-bold uppercase mb-4 opacity-60">Sistemi</h3>
                        <div class="flex w-full flex-col md:flex-row gap-0 overflow-hidden">
                            @foreach ($systems as $system)
                                <a class="flex-1 flex justify-center items-center h-28 py-4 md:py-0 bg-main-emphasis/60 hover:bg-main-emphasis text-center text-xl font-bold uppercase text-main-contrast/70 hover:text-main-contrast transition-all duration-150 ease-in-out"
                                    href="{{ route('assessments.index', [
                                        'type' => 'systems',
                                        'code' => $system['code'],
                                    ]) }}">
                                    {{ __($system['description']['en']) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-y-2">
                        <h3 class="text-xs font-bold uppercase mb-4 opacity-60">Nazioni</h3>
                        <div class="flex flex-row flex-wrap gap-5 justify-center">
                            @foreach ($countries as $country)
                                <x-link :href="route('assessments.index', [
                                    'type' => 'countries',
                                    'code' => $country['code'],
                                ])">
                                    <x-card
                                        class="px-3 py-3 uppercase text-xs flex flex-col items-center justify-center gap-2 w-[140px] text-center">
                                        <img src="https://flagcdn.com/w80/{{ strtolower($country['code']) }}.png"
                                            class="w-10 h-6 object-cover rounded shadow-sm mb-1"
                                            onerror="this.onerror=null; this.src='/images/placeholder-flag.svg';">
                                        <span class="block w-full truncate text-[10px] leading-tight opacity-80"
                                            title="{{ $country['name'] ?? ($country['description']['en'] ?? $country['code']) }}">
                                            {{ $country['name'] ?? ($country['description']['en'] ?? $country['code']) }}
                                        </span>
                                    </x-card>
                                </x-link>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

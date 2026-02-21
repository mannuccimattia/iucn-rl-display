@php
    $type = request()->route('type');
    $code = request()->route('code');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-main-contrast leading-tight">
                Visualizzazione dettaglio: <p class="inline font-bold italic text-main-emphasis">
                    {{ $taxon['scientific_name'] }}
                </p>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-8 pb-4 flex justify-between items-top border-b border-main-emphasis">
                    <div class="flex items-top">
                        <x-link :href="route('assessments.index', ['type' => $type, 'code' => $code])">
                            <i class="me-4 mt-2.5 fa-solid fa-chevron-left"></i>
                        </x-link>
                        <div>
                            <h3 class="text-2xl font-black italic">{{ $taxon['scientific_name'] }}</h3>
                            <p class="opacity-60 text-sm">SIS Taxon ID: #{{ $taxon['sis_id'] }}</p>
                        </div>
                    </div>

                    @guest
                        <form action="{{ route('favorites.toggle') }}" method="POST">
                            @csrf
                            <x-primary-button>
                                <i class="fa-solid fa-heart me-2"></i> Aggiungi ai Preferiti
                            </x-primary-button>
                        </form>
                    @endguest

                    @auth
                        @php
                            $isFavorite = auth()->user()->favorites()->where('sis_id', $taxon['sis_id'])->exists();
                        @endphp

                        <form action="{{ route('favorites.toggle') }}" method="POST" class="flex-none">
                            @csrf
                            <input type="hidden" name="sis_id" value="{{ $taxon['sis_id'] }}">
                            <input type="hidden" name="scientific_name" value="{{ $taxon['scientific_name'] }}">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="code" value="{{ $code }}">

                            <x-primary-button>
                                @if ($isFavorite)
                                    <i class="fa-solid fa-heart-crack me-2"></i> Rimuovi dai Preferiti
                                @else
                                    <i class="fa-solid fa-heart me-2"></i> Aggiungi ai Preferiti
                                @endif
                            </x-primary-button>
                        </form>
                    @endauth
                </div>


                <h3 class="text-xs font-bold uppercase mb-4 opacity-60">
                    Nomi Comuni</h3>
                <x-card class="p-6 flex flex-wrap gap-2">
                    @forelse ($taxon['common_names'] as $name)
                        <span @class([
                            'px-4 py-1 rounded-full text-sm border transition',
                            'bg-main-emphasis text-main border-main-emphasis font-bold shadow-lg' =>
                                $name['main'],
                            'border-main-emphasis/20 text-main-emphasis/90' => !$name['main'],
                        ])>
                            {{ $name['name'] }}
                        </span>
                    @empty
                        <span class="opacity-50">Nessun nome comune associato a {{ $taxon['scientific_name'] }}</span>
                    @endforelse
                </x-card>

                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-6 opacity-60">Cronologia Valutazioni</h3>
                    <div class="grid gap-4">
                        @foreach ($assessments as $assessment)
                            <x-card class="p-6 group grid gap-6 lg:grid-cols-[1fr_auto] items-start lg:items-center">
                                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Anno</span>
                                        <span class="text-xl font-black">{{ $assessment['year_published'] }}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Categoria</span>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-xl font-black text-main-emphasis">{{ $assessment['red_list_category_code'] }}</span>
                                            <span
                                                class="text-xs truncate">({{ __($assessment['red_list_category_code']) }})</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Possibile
                                            Estinto</span>
                                        <span
                                            class="text-xl font-black">{{ $assessment['possibly_extinct'] ? 'SI' : 'NO' }}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span
                                            class="text-[10px] uppercase opacity-50 font-bold whitespace-nowrap">Possibile
                                            Estinto In Natura
                                        </span>
                                        <span
                                            class="text-xl font-black">{{ $assessment['possibly_extinct_in_the_wild'] ? 'SI' : 'NO' }}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">ID Valutazione</span>
                                        <span class="font-mono text-xl">#{{ $assessment['assessment_id'] }}</span>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col gap-5 min-[400px]:flex-row min-[400px]:justify-between min-[400px]:items-center border-t lg:border-t-0 pt-4 lg:pt-0 border-main-emphasis">

                                    <x-link :href="route('assessments.show-assessment', [
                                        'assessment_id' => $assessment['assessment_id'],
                                        'type' => $type,
                                        'code' => $code,
                                        'sis_id' => $taxon['sis_id'],
                                    ])" class="hover:underline">
                                        <div>Valutazione<i class="ms-1 fa-solid fa-chevron-right text-xs"></i></div>
                                    </x-link>

                                    <x-link :href="$assessment['url']" target="_blank" class="hover:underline">
                                        <div>Scheda Ufficiale<i
                                                class="ms-1 text-xs fa-solid fa-up-right-from-square"></i></div>
                                    </x-link>
                                </div>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

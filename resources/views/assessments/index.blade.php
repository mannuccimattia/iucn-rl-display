@php
    $type = request()->route('type');
    $code = request()->route('code');
    $viewMode = request()->query('view', 'list');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            Visualizzazione per <span class="font-bold text-main-emphasis">
                {{ $type === 'systems' ? 'Sistema: ' : 'Nazione: ' }}
                {{ __($metadata['description']['en']) }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center">
                        <x-link :href="route('dashboard')">
                            <i class="me-4 fa-solid fa-chevron-left"></i>
                        </x-link>
                        <h3 class="text-lg font-bold">Risultati della ricerca</h3>
                    </div>
                    <x-view-toggle :mode="$viewMode" />
                </div>

                @if ($viewMode === 'card')
                    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
                        @foreach ($assessments as $assessment)
                            <x-card>
                                <h3 class="text-lg font-bold italic">{{ $assessment['taxon_scientific_name'] }}</h3>
                                <div class="flex flex-col justify-between md:flex-row md:items-center gap-y-2 mb-4">
                                    <span class="text-sm text-gray-300">
                                        ID Valutazione: {{ $assessment['assessment_id'] }}
                                    </span>
                                    <span
                                        class=" w-fit px-3 py-1 rounded text-xs font-bold bg-main">{{ __($assessment['red_list_category_code']) }}
                                    </span>
                                </div>
                                <div class="space-y-1 text-sm text-gray-400">
                                    <p><strong>Anno:</strong>
                                        {{ $assessment['year_published'] }}
                                    </p>
                                    <p><strong>Possibile Estinto:</strong>
                                        {{ $assessment['possibly_extinct'] ? 'Sì' : 'No' }}
                                    </p>
                                    <p><strong>Possibile Estinto in Natura:</strong>
                                        {{ $assessment['possibly_extinct_in_the_wild'] ? 'Sì' : 'No' }}</p>
                                </div>
                                <div class="mt-4 pt-4 border-t border-main-emphasis flex justify-between">
                                    @if ($assessment['sis_taxon_id'])
                                        <x-link :href="route('assessments.show', [
                                            'type' => $type,
                                            'code' => $code,
                                            'sis_id' => $assessment['sis_taxon_id'],
                                        ])" class="hover:underline text-sm font-bold">
                                            Vedi Dettagli<i class="fa-solid fa-chevron-right text-xs"></i>
                                        </x-link>
                                    @endif
                                    <x-link :href="$assessment['url']" target="_blank"
                                        class="hover:underline text-sm font-bold ms-auto">
                                        Scheda Ufficiale<i class="ms-1 text-xs fa-solid fa-up-right-from-square"></i>
                                    </x-link>
                                </div>
                            </x-card>
                        @endforeach
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach ($assessments as $assessment)
                            <x-list>
                                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 items-center">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Nome scientifico</span>
                                        <span
                                            class="text-xl font-black">{{ $assessment['taxon_scientific_name'] }}</span>
                                    </div>
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
                                        <span class="text-[10px] uppercase opacity-50 font-bold">ID Valutazione</span>
                                        <span class="font-mono text-xl">#{{ $assessment['assessment_id'] }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col gap-5 min-[400px]:flex-row min-[400px]:justify-between min-[400px]:items-center border-t lg:border-t-0 pt-4 lg:pt-0 border-main-emphasis">
                                    @if ($assessment['sis_taxon_id'])
                                        <x-link :href="route('assessments.show', [
                                            'type' => $type,
                                            'code' => $code,
                                            'sis_id' => $assessment['sis_taxon_id'],
                                        ])" class="hover:underline">
                                            <div>Vedi Dettagli<i class="ms-1 fa-solid fa-chevron-right text-xs"></i>
                                            </div>
                                        </x-link>
                                    @endif
                                    <x-link :href="$assessment['url']" target="_blank" class="hover:underline">
                                        <div>Scheda Ufficiale<i
                                                class="ms-1 text-xs fa-solid fa-up-right-from-square"></i></div>
                                    </x-link>
                                </div>
                            </x-list>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

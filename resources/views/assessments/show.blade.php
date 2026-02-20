@php
    $type = request()->route('type');
    $code = request()->route('code');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            Visualizzazione dettaglio: <p class="inline font-bold italic text-main-emphasis">
                {{ $taxon->scientific_name }}
            </p>
            </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-8 pb-4 flex items-top border-b border-main-emphasis">
                    <x-link :href="route('assessments.index', ['type' => $type, 'code' => $code])">
                        <i class="me-4 mt-2.5 fa-solid fa-chevron-left"></i>
                    </x-link>
                    <div>
                        <h3 class="text-2xl font-black italic">{{ $taxon->scientific_name }}</h3>
                        <p class="opacity-60 text-sm">SIS Taxon ID: #{{ $taxon->sis_taxon_id }}</p>
                    </div>
                </div>

                <h3 class="text-xs font-bold uppercase mb-4 opacity-60">
                    Nomi Comuni</h3>
                <x-card class="flex flex-wrap gap-2">
                    @foreach ($taxon->common_names as $name)
                        <span @class([
                            'px-4 py-1 rounded-full text-sm border transition',
                            'bg-main-emphasis text-main border-main-emphasis font-bold shadow-lg' =>
                                $name['main'],
                            'border-main-emphasis/20 text-main-emphasis/90' => !$name['main'],
                        ])>
                            {{ $name['name'] }}
                        </span>
                    @endforeach
                </x-card>

                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-6 opacity-60">Cronologia Valutazioni</h3>
                    <div class="grid gap-4">
                        @foreach ($taxon->assessments as $assessment)
                            <x-card class="group flex flex-col md:flex-row md:items-center justify-between gap-6">

                                <div class="flex flex-wrap items-center gap-8">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Anno</span>
                                        <span class="text-xl font-black">{{ $assessment['published_year'] }}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Categoria</span>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-xl font-black text-main-emphasis">{{ $assessment['category_code'] }}</span>
                                            <span class="text-xs">({{ __($assessment['category_code']) }})</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">ID Valutazione</span>
                                        <span class="font-mono text-xl">#{{ $assessment['assessment_id'] }}</span>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center border-t md:border-t-0 pt-4 md:pt-0 border-main-emphasis/10">
                                    <x-link href="#" class="hover:underline">
                                        <span>Valutazione</span>
                                        <i class="fa-solid fa-chevron-right text-xs"></i>
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

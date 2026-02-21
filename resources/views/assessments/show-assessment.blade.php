@php
    $trend = data_get($assessment, 'population_trend.description.en', 'N/D');

    $type = request('type');
    $code = request('code');
    $sisId = request('sis_id') ?? ($assessment['sis_taxon_id'] ?? null);

    $backHref =
        $type && $code && $sisId
            ? route('assessments.show', [
                'type' => $type,
                'code' => $code,
                'sis_id' => $sisId,
            ])
            : url()->previous();
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-main-contrast leading-tight">
                Visualizzazione valutazione: <p class="inline font-bold text-main-emphasis">
                    #{{ $assessment['assessment_id'] }}
                </p>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div
                    class="mb-8 pb-4 flex flex-col gap-y-5 sm:flex-row sm:justify-between items-center border-b border-main-emphasis">
                    <div class="flex items-top">
                        <x-link :href="$backHref">
                            <i class="me-4 mt-2.5 fa-solid fa-chevron-left"></i>
                        </x-link>
                        <div>
                            <h3 class="text-2xl font-black">SIS Taxon ID: #{{ $assessment['sis_taxon_id'] }}</h3>
                            <p class="opacity-60 text-sm">Trend popolazione:
                                {{ $trend }}</p>
                        </div>
                    </div>

                    <x-link :href="$assessment['url']" target="_blank" class="ms-9 sm:ms-0 hover:underline">
                        <div>Scheda Ufficiale<i class="ms-1 text-xs fa-solid fa-up-right-from-square"></i></div>
                    </x-link>
                </div>

                <div class="mb-8 pb-4">
                    <h3 class="ms-1 text-xs font-bold uppercase mb-4 opacity-60">
                        Azioni di conservazione svolte sul posto</h3>
                    <div class="flex flex-col gap-y-3">
                        @forelse ($assessment['supplementary_info']['conservation_actions_in_place'] as $actions)
                            <x-card class="p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                                <h4 class="text-sm uppercase font-bold">{{ $actions['name'] }}</h4>
                                @foreach ($actions['actions'] as $action)
                                    <div class="flex flex-col opacity-50 text-sm">
                                        <span>
                                            <i
                                                class="me-1 fa-solid {{ strncasecmp(trim((string) ($action['value'] ?? '')), 'Yes', 3) === 0
                                                    ? 'fa-check text-green-500'
                                                    : 'fa-xmark text-red-500' }}"></i>
                                            {{ $action['name'] }}
                                        </span>
                                    </div>
                                @endforeach
                            </x-card>
                        @empty
                            <span class="opacity-50">Nessuna azione di conservazione sul posto verificata.</span>
                        @endforelse
                    </div>
                </div>

                <div class="pb-4">
                    <h3 class="ms-1 text-xs font-bold uppercase mb-4 opacity-60">
                        Documentazione</h3>
                    <div class="flex flex-col gap-y-3">
                        @foreach ($assessment['documentation'] as $key => $value)
                            <x-card class="p-6 flex flex-col md:flex-row md:justify-between md:items-top gap-2">
                                <h4 class="w-[200px] lg:w-[300px] text-sm uppercase font-bold">{{ __($key) }}</h4>
                                <span class="w-full text-sm opacity-70">{!! $value ?? 'N/D' !!}</span>
                            </x-card>
                        @endforeach
                    </div>
                </div>

                @if (!empty($assessment['systems']))
                    <div class="mt-8 pb-4 flex flex-col gap-y-2">
                        <h3 class="text-xs font-bold uppercase mb-4 opacity-60">Sistemi</h3>
                        <div class="flex flex-col md:flex-row w-full md:w-auto gap-5">
                            @foreach ($assessment['systems'] as $system)
                                <x-link :href="route('assessments.index', [
                                    'type' => 'systems',
                                    'code' => $system['code'],
                                ])">
                                    <x-card
                                        class="p-6 uppercase text-sm">{{ __($system['description']['en']) }}</x-card>
                                </x-link>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

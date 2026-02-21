<x-app-layout>
    @php
        $viewMode = request()->query('view', 'list');
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            Preferiti
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
                        <h3 class="text-lg font-bold">I tuoi preferiti</h3>
                    </div>

                    <x-view-toggle :mode="$viewMode" />
                </div>

                @if ($viewMode === 'card')
                    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
                        @foreach ($favorites as $favorite)
                            <x-card>
                                <h3 class="text-lg font-bold italic">{{ $favorite->scientific_name }}</h3>

                                <div class="flex flex-col justify-between md:flex-row md:items-center gap-y-2 mb-4">
                                    <span class="text-sm text-gray-300">
                                        SIS Taxon ID: {{ $favorite->sis_id }}
                                    </span>
                                </div>

                                <div class="space-y-1 text-sm text-gray-400">
                                    <p><strong>Aggiunto il:</strong> {{ $favorite->created_at->format('d M Y') }}</p>
                                </div>

                                <div class="mt-4 pt-4 border-t border-main-emphasis flex justify-between">
                                    <x-link :href="route('assessments.show', [
                                        'type' => $favorite->type,
                                        'code' => $favorite->code,
                                        'sis_id' => $favorite->sis_id,
                                    ])" class="hover:underline text-sm font-bold">
                                        Dettaglio<i class="ms-1 fa-solid fa-chevron-right text-xs"></i>
                                    </x-link>
                                </div>
                            </x-card>
                        @endforeach
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach ($favorites as $favorite)
                            <x-list>
                                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">Nome scientifico</span>
                                        <span class="text-xl font-black">{{ $favorite->scientific_name }}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase opacity-50 font-bold">SIS Taxon ID</span>
                                        <span class="text-xl font-black">{{ $favorite->sis_id }}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span
                                            class="text-[10px] uppercase opacity-50 font-bold whitespace-nowrap">Aggiunto
                                            il</span>
                                        <span
                                            class="text-xl font-black">{{ $favorite->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col gap-5 min-[400px]:flex-row min-[400px]:justify-between min-[400px]:items-center border-t lg:border-t-0 pt-4 lg:pt-0 border-main-emphasis">

                                    <x-link :href="route('assessments.show', [
                                        'type' => $favorite->type,
                                        'code' => $favorite->code,
                                        'sis_id' => $favorite->sis_id,
                                    ])" class="hover:underline">
                                        <div>Dettaglio<i class="ms-1 fa-solid fa-chevron-right text-xs"></i></div>
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

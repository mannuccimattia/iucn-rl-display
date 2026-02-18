<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            Visualizzazione per <p class="inline font-bold text-main-emphasis">{{ $title }}
            </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4 flex items-center">
                    <x-link :href="route('dashboard')">
                        <i class="me-4 fa-solid fa-chevron-left"></i>
                    </x-link>
                    <h3 class="text-lg font-bold">Risultati della ricerca</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($items as $item)
                        <div class="bg-main-light p-6 rounded-lg shadow">
                            <h3 class="text-xl font-bold italic">{{ $item['scientific_name'] }}</h3>
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="text-sm text-gray-300">ID Valutazione: {{ $item['assessment_id'] }}</p>
                                </div>
                                <span class="px-3 py-1 rounded text-xs font-bold bg-main">
                                    {{ __($item['category_code']) }}
                                </span>
                            </div>

                            <div class="space-y-1 text-sm text-gray-400">
                                <p><strong>Anno:</strong> {{ $item['published_year'] }}</p>
                                <p><strong>Possibile Estinto:</strong> {{ $item['is_possibly_extinct'] ? 'Sì' : 'No' }}
                                </p>
                                <p><strong>Possibile Estinto in Natura:</strong>
                                    {{ $item['is_possibly_extinct_in_wild'] ? 'Sì' : 'No' }}</p>
                            </div>

                            <div class="mt-4 pt-4 border-t border-main-emphasis">
                                <x-link :href="$item['iucn_url']" target="_blank" class="hover:underline text-sm font-bold">
                                    Vedi Scheda Ufficiale →
                                </x-link>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

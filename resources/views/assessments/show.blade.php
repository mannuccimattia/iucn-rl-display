<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            Visualizzazione dettaglio: <p class="inline font-bold italic text-main-emphasis">
                {{ $item['scientific_name'] }}
            </p>
            </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4 flex items-center">
                    <x-link :href="route('assessments.index', ['type' => $type, 'id' => $id])">
                        <i class="me-4 fa-solid fa-chevron-left"></i>
                    </x-link>
                    <h3 class="text-lg font-bold">Dettaglio</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

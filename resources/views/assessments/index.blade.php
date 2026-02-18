<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            Visualizzazione per <p class="inline font-bold text-main-emphasis">{{ $title }}
            </p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="mb-4 text-lg font-bold">Risultati della ricerca</h3>

                <ul class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <li class="py-4 flex justify-between">
                            <span>{{ $item['scientific_name'] }}</span>
                            <span class="font-mono font-bold text-main-emphasis">{{ $item['category'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>

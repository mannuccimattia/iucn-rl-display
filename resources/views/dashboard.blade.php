<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-main text-main-contrast overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col gap-y-4">
                    <div class="flex flex-col justify-center items-center gap-y-2">
                        <h3 class="text-xl font-bold pb-3">Sistemi</h3>
                        <div class="flex flex-row gap-x-5">
                            @foreach ($systems as $system)
                                <x-link class="bg-main-light hover:bg-red-200 px-4 py-2 rounded" :href="route('assessments.index', ['type' => 'system', 'id' => $system])">
                                    {{ __($system) }}
                                </x-link>
                            @endforeach
                        </div>
                    </div>
                    <hr class="border-main-emphasis my-3">
                    <div class="flex flex-col justify-center items-center gap-y-2">
                        <h3 class="text-xl font-bold pb-3">Nazioni</h3>
                        <div class="flex flex-row gap-x-5">
                            @foreach ($countries as $country)
                                <x-link class="bg-main-light hover:bg-red-200 px-4 py-2 rounded" :href="route('assessments.index', ['type' => 'country', 'id' => $country])">
                                    {{ __($country) }}
                                </x-link>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

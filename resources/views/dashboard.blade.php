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
                                <x-link :href="route('assessments.index', ['type' => 'system', 'id' => $system['code']])">
                                    <x-card class="uppercase text-xs">{{ __($system['description']['en']) }}</x-card>
                                </x-link>
                            @endforeach
                        </div>
                    </div>
                    <hr class="border-main-emphasis my-3">
                    <div class="flex flex-col items-center gap-y-2">
                        <h3 class="text-xl font-bold pb-3">Nazioni</h3>
                        <div class="flex flex-row flex-wrap gap-5 justify-center">
                            @foreach ($countries as $country)
                                <x-link :href="route('assessments.index', ['type' => 'country', 'id' => $country['code']])">
                                    <x-card class="uppercase text-xs flex items-center w-[129px]">
                                        <img src="https://flagcdn.com/w40/{{ strtolower($country['code']) }}.png"
                                            class="w-10 h-6 object-cover rounded shadow-sm">
                                        <span class="ms-2 text-xl font-black">{{ $country['code'] }}</span>
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

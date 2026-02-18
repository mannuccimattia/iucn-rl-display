<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-main-contrast leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-main-dark flex flex-col gap-y-4">
                    <div class="flex flex-col justify-center items-center gap-y-2">
                        <h3 class="px-40 py-2 rounded-lg bg-main text-main-contrast">Sistemi</h3>
                        <div class="flex flex-row gap-x-5">
                            <x-link :href="route('assessments.index', ['type' => 'system', 'id' => 'terrestrial'])">Terrestre</x-link>
                            <x-link :href="route('assessments.index', ['type' => 'system', 'id' => 'marine'])">Marino</x-link>
                            <x-link :href="route('assessments.index', ['type' => 'system', 'id' => 'freshwater'])">Acque Dolci</x-link>
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-col justify-center items-center gap-y-2">
                        <h3 class="px-40 py-2 rounded-lg bg-main text-main-contrast">Nazioni</h3>
                        <div class="flex flex-row gap-x-5">
                            <x-link :href="route('assessments.index', ['type' => 'country', 'id' => 'IT'])">Italia</x-link>
                            <x-link :href="route('assessments.index', ['type' => 'country', 'id' => 'FR'])">Francia</x-link>
                            <x-link :href="route('assessments.index', ['type' => 'country', 'id' => 'ES'])">Spagna</x-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <p class="text-sm opacity-60">
            Pagina {{ $paginator->currentPage() }} di {{ $paginator->lastPage() }}
            @if ($paginator->total() > 0)
                - Totale risultati: {{ $paginator->total() }}
            @endif
        </p>

        <div class="flex max-[400px]:justify-between justify-center sm:justify-normal items-center gap-5">
            @if (!$paginator->onFirstPage())
                <x-link :href="$paginator->url(1)">
                    <i class="me-1 fa-solid fa-angles-left text-xs"></i>
                    <span class="max-[400px]:hidden">Inizio</span>
                </x-link>

                <x-link :href="$paginator->previousPageUrl()" rel="prev" aria-label="{{ __('pagination.previous') }}">
                    <i class="me-1 fa-solid fa-chevron-left text-xs"></i>
                    <span class="max-[400px]:hidden">Precedente</span>
                </x-link>
            @endif

            @if ($paginator->hasMorePages())
                <x-link :href="$paginator->nextPageUrl()" rel="next" aria-label="{{ __('pagination.next') }}">
                    <span class="max-[400px]:hidden">Successivo</span>
                    <i class="ms-1 fa-solid fa-chevron-right text-xs"></i>
                </x-link>

                <x-link :href="$paginator->url($paginator->lastPage())">
                    <span class="max-[400px]:hidden">Fine</span>
                    <i class="ms-1 fa-solid fa-angles-right text-xs"></i>
                </x-link>
            @endif
        </div>
    </nav>
@endif

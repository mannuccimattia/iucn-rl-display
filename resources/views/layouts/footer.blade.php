<footer class="bg-main-light shadow border-t border-main-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center p-6">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-currentw" />
                </a>
            </div>
            <div class="text-xs text-main-contrast/70 flex flex-col sm:flex-row sm:justify-between gap-x-3 gap-y-1">
                <span>API version:
                    <span class="text-main-emphasis">
                        {{ $footerData['api_version'] }}</span>
                </span>
                <span>Red List:
                    <span class="text-main-emphasis">
                        {{ $footerData['red_list_version'] }}</span>
                </span>
                <span>Species:
                    <span class="text-main-emphasis">
                        {{ $footerData['count'] }}</span>
                </span>
            </div>
        </div>
    </div>
</footer>

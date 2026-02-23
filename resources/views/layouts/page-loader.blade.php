<div data-page-loader role="status" aria-live="polite" aria-label="Caricamento in corso"
    class="page-loader fixed inset-0 z-[9999] flex items-center justify-center bg-main-dark/95">
    <div class="flex flex-col items-center gap-4 text-main-contrast">
        <div class="h-12 w-12 animate-spin rounded-full border-4 border-main-light border-t-main-emphasis"></div>
        <span class="text-sm font-medium">Caricamento</span>
    </div>
</div>

<script>
    (() => {
        const loader = document.querySelector('[data-page-loader]');
        if (!loader) {
            return;
        }

        const showLoader = () => loader.classList.remove('is-hidden');
        const hideLoader = () => loader.classList.add('is-hidden');

        const isLinkNavigation = (anchor) => {
            if (!anchor || (anchor.target && anchor.target !== '_self') || anchor.hasAttribute('download')) {
                return false;
            }

            const href = anchor.getAttribute('href');
            return !!href && !href.startsWith('#') && !href.startsWith('mailto:') && !href.startsWith('tel:');
        };

        showLoader();

        window.addEventListener('load', hideLoader);
        window.addEventListener('pageshow', hideLoader);
        window.addEventListener('beforeunload', showLoader);

        document.addEventListener('click', (event) => {
            if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event
                .shiftKey || event.altKey) {
                return;
            }

            const anchor = event.target.closest('a[href]');
            if (isLinkNavigation(anchor)) {
                showLoader();
            }
        });

        document.addEventListener('submit', (event) => {
            const form = event.target;
            if (form instanceof HTMLFormElement && form.target !== '_blank') {
                showLoader();
            }
        });
    })();
</script>

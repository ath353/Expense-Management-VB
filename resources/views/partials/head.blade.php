<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Prevent caching for authenticated pages -->
@auth
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<style>
    /* Loading overlay to prevent flash of cached content */
    #bfcache-check-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #09090b;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    #bfcache-check-overlay.active {
        display: flex;
    }
</style>
<script>
    // Prevent bfcache - force reload when navigating back after logout
    (function() {
        let overlay = null;
        
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                // Show overlay immediately to hide cached content
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.id = 'bfcache-check-overlay';
                    overlay.className = 'active';
                    overlay.innerHTML = '<div style="color: white; font-size: 14px;">Đang kiểm tra...</div>';
                    document.body.appendChild(overlay);
                }
                
                // Page was loaded from bfcache, check if still authenticated
                fetch('/dashboard', { method: 'HEAD' })
                    .then(response => {
                        if (response.redirected || response.status === 401) {
                            // Not authenticated, redirect to login
                            window.location.href = '/login';
                        } else {
                            // Still authenticated, hide overlay
                            if (overlay) overlay.remove();
                        }
                    })
                    .catch(() => {
                        // Error checking auth, reload page
                        window.location.reload();
                    });
            }
        });
    })();
</script>
@endauth

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/favicon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

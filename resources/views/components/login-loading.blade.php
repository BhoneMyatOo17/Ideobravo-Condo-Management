<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}" />
<link rel="icon" type="image/png" sizes="194x194" href="{{ asset('favicon/favicon-194x194.png') }}" />
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}" />
<link rel="manifest" href="{{ asset('favicon/site.webmanifest.json') }}" />
<link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#3d63dd" />
@if(session('show_loading'))
  <div id="loginLoadingScreen"
    class="fixed top-0 bottom-0 left-0 right-0 z-[99999] flex items-center justify-center bg-primary-light-1 dark:bg-primary-dark-1 opacity-100 visible pointer-events-auto"
    role="status" aria-live="polite" aria-atomic="true" aria-label="Loading...">
    <div class="grid-loader">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  <script>
    // Auto-hide after animation completes (2 seconds)
    setTimeout(function () {
      const loadingScreen = document.getElementById('loginLoadingScreen');
      if (loadingScreen) {
        loadingScreen.style.opacity = '0';
        setTimeout(function () {
          loadingScreen.remove();
        }, 300);
      }
    }, 2000);
  </script>
@endif
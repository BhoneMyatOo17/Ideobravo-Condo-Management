<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Ideo" />
  <meta name="description" content="Ideo Condominiums - Modern Urban Living" />

  <meta name="msapplication-TileColor" content="#3d63dd" />
  <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-144x144.png') }}" />
  <meta name="theme-color" content="#3d63dd" />

  <!-- Page title -->
  <title>{{ config('app.name') }}</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}" />
  <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('favicon/favicon-194x194.png') }}" />
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}" />
  <link rel="manifest" href="{{ asset('favicon/site.webmanifest.json') }}" />
  <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#3d63dd" />

  <!-- CSS Plugins -->
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <!-- Page loading -->
  <div
    class="page-loading fixed top-0 bottom-0 left-0 right-0 z-[99999] flex items-center justify-center bg-primary-light-1 dark:bg-primary-dark-1 opacity-100 visible pointer-events-auto"
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

  @yield('content')

  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

  <script>
    // Scroll Reveal
    const sr = ScrollReveal({
      origin: "bottom",
      distance: "16px",
      duration: 1000,
      reset: false,
    });

    sr.reveal(`.scroll-revealed`, {
      cleanup: true,
    });
  </script>
</body>

</html>
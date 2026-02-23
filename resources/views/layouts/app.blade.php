<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="rating" content="general" />
    <meta name="language" content="English" />
    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="description"
        content="Smart Urban Residences Crafted for Life. Thailand's leading high-rise condominium developer." />
    <meta name="keywords" content="condominium, Bangkok, Thailand, real estate, urban living" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ config('app.name') }}" />
    <meta name="twitter:description" content="Smart Urban Residences Crafted for Life." />
    <meta name="twitter:image" content="{{ asset('images/og-cover.jpg') }}" />
    <meta content="{{ config('app.name') }}" property="og:title" />
    <meta content="{{ config('app.name') }}" property="og:site_name" />
    <meta content="Smart Urban Residences Crafted for Life." property="og:description" />
    <meta content="{{ asset('images/og-cover.jpg') }}" property="og:image" />
    <meta content="{{ url('/') }}" property="og:url" />
    <meta content="website" property="og:type" />

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.landing-navigation')

    @yield('content')

    @include('layouts.footer')

    <button type="button"
        class="inline-flex w-12 h-12 rounded-md items-center justify-center text-lg/none bg-primary text-primary-color hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:bg-primary-light-10 dark:focus:bg-primary-dark-10 fixed bottom-[117px] right-[20px] hover:-translate-y-1 opacity-100 visible z-50 is-hided"
        data-web-trigger="scroll-top" aria-label="Scroll to top">
        <i class="lni lni-chevron-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

    <script>
        // Scroll Reveal - Maximum early visibility
        const sr = ScrollReveal({
            origin: "bottom",
            distance: "15px",
            duration: 500,
            reset: false,
            viewFactor: 0.05,
            viewOffset: {
                top: 200,
                bottom: 0
            },
            interval: 50,
            delay: 0,
            mobile: true,
            opacity: 0,
            scale: 1,
            easing: 'ease-out'
        });

        sr.reveal(`.scroll-revealed`, {
            cleanup: true,
        });

        // GLightBox
        GLightbox({
            selector: ".video-popup",
            href: "https://youtu.be/lhmxe7ZZYEE?si=ISrA5Jq0Q5qHIE5j",
            type: "video",
            source: "youtube",
            width: 900,
            autoplayVideos: true,
        });

        const myGallery3 = GLightbox({
            selector: ".portfolio-box",
            type: "image",
            width: 900,
        });

        // Testimonial
        const testimonialSwiper = new Swiper(".testimonial-carousel", {
            slidesPerView: 1,
            spaceBetween: 30,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });

    </script>
    @include('components.cookie-consent')
</body>

</html>
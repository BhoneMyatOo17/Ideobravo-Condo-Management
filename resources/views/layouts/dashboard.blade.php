<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'Dashboard') - {{ config('app.name', 'IdeoBravo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('favicon/favicon-194x194.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest.json') }}" />
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#3d63dd" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.3);
            border-radius: 3px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.5);
        }

        /* Background pattern for primary cards */
        .bg-rings {
            background-image: radial-gradient(circle at top right,
                    rgba(255, 255, 255, 0.1) 0%,
                    rgba(255, 255, 255, 0.1) 28%,
                    rgba(255, 255, 255, 0.075) 28%,
                    rgba(255, 255, 255, 0.075) 45%,
                    rgba(255, 255, 255, 0.05) 45%,
                    rgba(255, 255, 255, 0.05) 63%,
                    rgba(255, 255, 255, 0.025) 63%,
                    rgba(255, 255, 255, 0.025) 100%);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Dashboard Navigation (Sidebar + Top Bar) -->
        @include('layouts.dashboard-navigation')

        <!-- Page Content -->
        <main id="main-content" class="transition-all duration-300 lg:ml-64">
            <div class="py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- FAQ Floating Action Button -->
    @include('components.faq-floating-button')

    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const topNav = document.getElementById('top-nav');
            const hideToggle = document.getElementById('sidebar-hide-toggle');
            const hideIcon = document.getElementById('hide-icon');
            const logoFull = document.querySelector('.sidebar-logo-full');
            const logoSmall = document.querySelector('.sidebar-logo-small');
            let isCollapsed = false;

            // Toggle sidebar collapse/expand
            if (hideToggle) {
                hideToggle.addEventListener('click', function () {
                    isCollapsed = !isCollapsed;

                    if (isCollapsed) {
                        // Collapse sidebar to icon-only mode
                        sidebar.classList.remove('w-64');
                        sidebar.classList.add('w-20');
                        mainContent.classList.remove('lg:ml-64');
                        mainContent.classList.add('lg:ml-20');
                        topNav.classList.remove('lg:left-64');
                        topNav.classList.add('lg:left-20');

                        // Switch logos
                        if (logoFull) logoFull.classList.add('hidden');
                        if (logoSmall) logoSmall.classList.remove('hidden');

                        // Hide all text elements
                        document.querySelectorAll('.sidebar-text').forEach(el => {
                            el.classList.add('hidden');
                        });

                        // Center icons and remove gaps
                        document.querySelectorAll('#sidebar a, #sidebar button').forEach(el => {
                            el.classList.add('justify-center');
                            el.classList.remove('gap-3');
                        });

                        // Rotate icon
                        hideIcon.classList.add('rotate-180');

                    } else {
                        // Expand sidebar to full mode
                        sidebar.classList.remove('w-20');
                        sidebar.classList.add('w-64');
                        mainContent.classList.remove('lg:ml-20');
                        mainContent.classList.add('lg:ml-64');
                        topNav.classList.remove('lg:left-20');
                        topNav.classList.add('lg:left-64');

                        // Switch logos back
                        if (logoFull) logoFull.classList.remove('hidden');
                        if (logoSmall) logoSmall.classList.add('hidden');

                        // Show all text elements
                        document.querySelectorAll('.sidebar-text').forEach(el => {
                            el.classList.remove('hidden');
                        });

                        // Reset link styling
                        document.querySelectorAll('#sidebar a, #sidebar button').forEach(el => {
                            el.classList.remove('justify-center');
                            el.classList.add('gap-3');
                        });

                        // Rotate icon back
                        hideIcon.classList.remove('rotate-180');
                    }
                });
            }
        });
    </script>
</body>

</html>
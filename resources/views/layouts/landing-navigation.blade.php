<!-- Navbar -->
@php
  $transparentPages = ['welcome', 'services', 'about', 'contact', 'team'];
  $isTransparent = in_array(Route::currentRouteName(), $transparentPages);
@endphp

<header
  class="ic-navbar absolute left-0 top-0 z-40 flex w-full items-center {{ $isTransparent ? 'bg-transparent' : 'sticky' }}"
  role="banner" aria-label="Navigation bar">
  <div class="container">
    <div class="ic-navbar-container relative -mx-5 flex items-center justify-between">
      <!-- Mobile Logo + Hamburger -->
      <div class="flex items-center gap-3 px-5 lg:hidden">
        <a href="{{ route('welcome') }}" class="ic-navbar-logo block py-3">
          <img src="{{ asset('images/ideobravo-logo-white.png') }}" alt="Ideobravo"
            class="h-9 max-w-none w-auto object-contain transition-opacity duration-300" id="logo-white-mobile" />
          <img src="{{ asset('images/ideobravo-logo.png') }}" alt="Ideobravo"
            class="h-9 max-w-none w-auto object-contain transition-opacity duration-300 hidden" id="logo-blue-mobile" />

        </a>
        <button type="button"
          class="ic-navbar-toggler rounded-md px-3 py-[6px] text-[22px]/none text-primary-color ring-primary focus:ring-2"
          data-web-toggle="navbar-collapse" data-web-target="navbarMenu" aria-expanded="false"
          aria-label="Toggle navigation menu">
          <i class="lni lni-menu"></i>
        </button>
      </div>

      <!-- Desktop Logo -->
      <div class="w-60 lg:w-56 max-w-full px-5 hidden lg:block">
        <a href="{{ route('welcome') }}" class="ic-navbar-logo block w-full py-5 mb-2 ml-3">
          <img src="{{ asset('images/logo-white.png') }}" alt="Ideobravo"
            class="w-full h-auto max-h-10 transition-opacity duration-300" id="logo-white" />
          <img src="{{ asset('images/logo-blue.png') }}" alt="Ideobravo"
            class="w-full h-auto max-h-10 transition-opacity duration-300 hidden" id="logo-blue" />
        </a>
      </div>

      <div class="flex w-full items-center justify-between px-5">
        <div>
          <nav id="navbarMenu"
            class="ic-navbar-collapse absolute left-4 top-[80px] w-full max-w-[250px] rounded-lg hidden bg-primary-light-1 py-5 shadow-lg dark:bg-primary-dark-1 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6">
            <ul class="block lg:flex" role="menu" aria-label="Navigation menu">

              <li class="group relative">
                <a href="{{ route('services') }}"
                  class="mx-8 flex py-2 text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70 {{ request()->is('services*') ? 'active' : '' }}"
                  role="menuitem">Services</a>
              </li>

              <li class="group relative">
                <a href="{{ route('about') }}"
                  class="mx-8 flex py-2 text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70 {{ request()->is('about*') ? 'active' : '' }}"
                  role="menuitem">About Us</a>
              </li>

              <li class="group relative">
                <a href="{{ route('contact') }}"
                  class="mx-8 flex py-2 text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70 {{ request()->is('contact*') ? 'active' : '' }}"
                  role="menuitem">Contact</a>
              </li>

              <li class="group relative">
                <a href="{{ route('team') }}"
                  class="mx-8 flex py-2 text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70 {{ request()->is('team*') ? 'active' : '' }}"
                  role="menuitem">Team</a>
              </li>

            </ul>
          </nav>
        </div>
        <div class="flex items-center justify-end gap-2 sm:gap-3">
          <!-- Language Toggle -->
          <div class="lang-toggle flex items-center text-sm font-medium notranslate" translate="no">
            <button type="button" onclick="changeLanguage('en')" id="lang-en"
              class="lang-btn px-2 py-1 text-primary-color opacity-100 hover:opacity-70 transition-opacity">EN</button>
            <span class="text-primary-color opacity-50">|</span>
            <button type="button" onclick="changeLanguage('th')" id="lang-th"
              class="lang-btn px-2 py-1 text-primary-color opacity-50 hover:opacity-70 transition-opacity">TH</button>
          </div>

          <!-- Theme Toggle -->
          <button type="button" class="inline-flex items-center text-primary-color text-[24px]/none"
            aria-label="Switch theme" data-web-trigger="web-theme"></button>

          <!-- Get Started / Dashboard Button (visible on all screens) -->
          @auth
            @if(Auth::user()->hasRole())
              <a href="{{ route('dashboard') }}"
                class="btn-navbar px-4 sm:px-6 py-2 sm:py-3 rounded-md bg-primary-color bg-opacity-20 text-sm sm:text-base font-medium text-primary-color hover:bg-opacity-100 hover:text-primary"
                role="button">Dashboard</a>
            @else
              <a href="{{ route('condo-code') }}"
                class="btn-navbar px-4 sm:px-6 py-2 sm:py-3 rounded-md bg-primary-color bg-opacity-20 text-sm sm:text-base font-medium text-primary-color hover:bg-opacity-100 hover:text-primary"
                role="button">Complete Setup</a>
            @endif
          @else
            @if(request()->routeIs('register'))
              <a href="{{ route('login') }}"
                class="btn-navbar px-4 sm:px-6 py-2 sm:py-3 rounded-md bg-primary-color bg-opacity-20 text-sm sm:text-base font-medium text-primary-color hover:bg-opacity-100 hover:text-primary"
                role="button">Login</a>
            @elseif(request()->routeIs('login'))
              <a href="{{ route('register') }}"
                class="btn-navbar px-4 sm:px-6 py-2 sm:py-3 rounded-md bg-primary-color bg-opacity-20 text-sm sm:text-base font-medium text-primary-color hover:bg-opacity-100 hover:text-primary"
                role="button">Register</a>
            @else
              <a href="{{ route('register') }}"
                class="btn-navbar px-4 sm:px-6 py-2 sm:py-3 rounded-md bg-primary-color bg-opacity-20 text-sm sm:text-base font-medium text-primary-color hover:bg-opacity-100 hover:text-primary"
                role="button">Get Started</a>
            @endif
          @endauth
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Hidden Google Translate Element -->
<div id="google_translate_element" style="display: none;"></div>

<!-- Google Translate Scripts -->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,th',
      autoDisplay: false
    }, 'google_translate_element');
  }

  function changeLanguage(lang) {
    if (lang === 'en') {
      document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=." + window.location.hostname;
      location.reload();
    } else {
      var selectElement = document.querySelector('.goog-te-combo');
      if (selectElement) {
        selectElement.value = lang;
        selectElement.dispatchEvent(new Event('change'));
      }
    }

    updateLangButtons(lang);
  }

  function updateLangButtons(lang) {
    document.getElementById('lang-en').classList.toggle('opacity-100', lang === 'en');
    document.getElementById('lang-en').classList.toggle('opacity-50', lang !== 'en');
    document.getElementById('lang-th').classList.toggle('opacity-100', lang === 'th');
    document.getElementById('lang-th').classList.toggle('opacity-50', lang !== 'th');
  }

  document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
      var isThaiActive = document.cookie.includes('googtrans=/en/th');
      updateLangButtons(isThaiActive ? 'th' : 'en');
    }, 500);
  });
</script>
<script type="text/javascript"
  src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- Hide Google Translate banner -->
<style>
  .goog-te-banner-frame,
  .skiptranslate {
    display: none !important;
  }

  body {
    top: 0 !important;
  }
</style>
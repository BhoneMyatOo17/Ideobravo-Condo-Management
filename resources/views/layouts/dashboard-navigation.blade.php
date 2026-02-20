<!-- Mobile Overlay (backdrop when sidebar is open on mobile) -->
<div id="sidebar-overlay" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-20 lg:hidden hidden"></div>

<!-- Sidebar -->
<aside id="sidebar"
  class="fixed top-0 left-0 z-30 h-screen w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 -translate-x-full lg:translate-x-0">
  <div class="flex flex-col h-full">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 px-6 border-b border-gray-200 dark:border-gray-700">
      <a href="{{ route('dashboard') }}" class="flex items-center">
        <img src="{{ asset('images/logo-blue.png') }}" alt="IdeoBravo" class="h-8 sidebar-logo-full">
        <img src="{{ asset('images/ideobravo-logo.png') }}" alt="IdeoBravo" class="h-10 sidebar-logo-small hidden">
      </a>
    </div>

    <!-- Hide/Show Button (Desktop only) -->
    <div class="hidden lg:block px-4 py-3 border-b border-gray-200 dark:border-gray-700">
      <button id="sidebar-hide-toggle"
        class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
        <i class="lni lni-chevron-left text-xl transition-transform duration-300 flex-shrink-0" id="hide-icon"></i>
        <span class="font-medium sidebar-text">Hide Sidebar</span>
      </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto sidebar-scroll">
      <!-- Dashboard -->
      <a href="{{ route('dashboard') }}"
        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
        <i class="lni lni-home text-xl flex-shrink-0"></i>
        <span class="font-medium sidebar-text">Dashboard</span>
      </a>

      <!-- Announcements -->
      <a href="{{ route('announcements.index') }}"
        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('announcements*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
        <i class="lni lni-bullhorn text-xl flex-shrink-0"></i>
        <span class="font-medium sidebar-text">Announcements</span>
      </a>

      @if(Auth::user()->isResident())
        <!-- Resident Menu Items -->
        <a href="{{ route('parcels.my-parcels') }}"
          class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('parcels.my-parcels', 'parcels.my-parcel-show') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
          <i class="lni lni-package text-xl flex-shrink-0"></i>
          <span class="font-medium sidebar-text">My Parcels</span>
        </a>

        <a href="{{ route('my-bills.index') }}"
          class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('my-bills.*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
          <i class="lni lni-credit-cards text-xl flex-shrink-0"></i>
          <span class="font-medium sidebar-text">My Bills</span>
        </a>
      @endif

      @if(Auth::user()->isStaff() || Auth::user()->isAdmin())
        <!-- Staff & Admin Menu Items -->
        <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
          <p class="px-4 mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase sidebar-text">Management
          </p>

          <a href="{{ route('parcels.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('parcels*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-package text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Parcels</span>
          </a>

          <a href="{{ route('bills.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('bills.index') || request()->routeIs('bills.create') || request()->routeIs('bills.edit') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-credit-cards text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Bills</span>
          </a>

          <a href="{{ route('profile.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('profile.index', 'profile.create', 'profile.store', 'profile.showUser', 'profile.editUser', 'profile.updateUser') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-users text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Residents</span>
          </a>

          <a href="{{ route('newsletter.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('newsletter*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-envelope text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Newsletter</span>
          </a>

          <a href="{{ route('contacts.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('contacts*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-bubble text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Contact Requests</span>
          </a>
        </div>
      @endif

      @if(Auth::user()->isAdmin())
        <!-- Admin-Only Menu Items -->
        <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
          <p class="px-4 mb-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase sidebar-text">
            Administration</p>

          <a href="{{ route('staff.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('staff*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-briefcase text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Staff</span>
          </a>

          <a href="{{ route('condominiums.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('condominiums*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-apartment text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Properties</span>
          </a>

          <a href="{{ route('reports.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors {{ request()->routeIs('reports*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
            <i class="lni lni-bar-chart text-xl flex-shrink-0"></i>
            <span class="font-medium sidebar-text">Reports</span>
          </a>
        </div>
      @endif
    </nav>
  </div>
</aside>

<!-- Top Navigation Bar -->
<nav
  class="fixed top-0 right-0 left-0 lg:left-64 z-10 h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-all duration-300"
  id="top-nav">
  <div class="flex items-center justify-between h-full px-4 sm:px-6">
    <!-- Left: Hamburger + Page Title -->
    <div class="flex items-center gap-4">
      <!-- Mobile Hamburger Button -->
      <button id="mobile-menu-toggle" type="button"
        class="lg:hidden p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <i class="lni lni-menu text-2xl"></i>
      </button>

      <h1 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white">
        @yield('page-title', 'Dashboard')
      </h1>
    </div>

    <div class="flex items-center gap-3">
      <!-- Language Toggle -->
      <div class="lang-toggle flex items-center text-sm font-medium notranslate" translate="no">
        <button type="button" onclick="changeLanguage('en')" id="lang-en"
          class="lang-btn px-2 py-1 text-gray-700 dark:text-gray-300 opacity-100 hover:opacity-70 transition-opacity">EN</button>
        <span class="text-gray-400">|</span>
        <button type="button" onclick="changeLanguage('th')" id="lang-th"
          class="lang-btn px-2 py-1 text-gray-700 dark:text-gray-300 opacity-50 hover:opacity-70 transition-opacity">TH</button>
      </div>

      <!-- User Profile Dropdown -->
      <div class="relative" x-data="{ open: false, showLogout: false }">
        <button @click="open = !open"
          class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          <div
            class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-sm font-semibold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </div>
          <span
            class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
          <i class="lni lni-chevron-down text-gray-500 dark:text-gray-400 text-sm"></i>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2"
          style="display: none;">

          <!-- User Info -->
          <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
            <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold bg-primary/10 text-primary rounded">
              {{ Auth::user()->getRoleName() }}
            </span>
          </div>

          <!-- Menu Items -->
          <a href="{{ route('profile.show') }}"
            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="lni lni-user"></i>
            <span>My Profile</span>
          </a>

          <a href="{{ route('welcome') }}"
            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="lni lni-home"></i>
            <span>Back to Website</span>
          </a>

          <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

          <!-- Logout -->
          <button type="button" @click="open = false; showLogout = true"
            class="flex items-center gap-3 w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
          </button>
        </div>

        <!-- Logout Confirmation Modal -->
        <div x-show="showLogout" @click.self="showLogout = false"
          class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm"
          style="display: none;">
          <div x-show="showLogout" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" @click.stop
            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full overflow-hidden">
            <div class="px-6 pt-6 pb-4">
              <div class="flex items-start gap-4">
                <div
                  class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                  <i class="lni lni-warning text-red-600 dark:text-red-400 text-2xl"></i>
                </div>
                <div class="flex-1">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Confirm Logout
                  </h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    Are you sure you want to logout? You'll need to sign in again to access your account.
                  </p>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex gap-3 justify-end">
              <button type="button" @click="showLogout = false"
                class="min-w-[10px] max-h-10 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Cancel
              </button>

              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                  class="min-w-[120px] min-h-10 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                  Yes, Logout
                </button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Add spacing for fixed top bar -->
<div class="h-16"></div>

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

<!-- Mobile & Desktop Sidebar Toggle Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const topNav = document.getElementById('top-nav');
    const overlay = document.getElementById('sidebar-overlay');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const hideToggle = document.getElementById('sidebar-hide-toggle');
    const hideIcon = document.getElementById('hide-icon');
    const logoFull = document.querySelector('.sidebar-logo-full');
    const logoSmall = document.querySelector('.sidebar-logo-small');
    let isCollapsed = false;

    // Mobile menu toggle
    if (mobileMenuToggle) {
      mobileMenuToggle.addEventListener('click', function () {
        const isOpen = !sidebar.classList.contains('-translate-x-full');

        if (isOpen) {
          // Close mobile menu
          sidebar.classList.add('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
        } else {
          // Open mobile menu
          sidebar.classList.remove('-translate-x-full');
          overlay.classList.remove('hidden');
          document.body.classList.add('overflow-hidden');
        }
      });
    }

    // Close mobile menu when clicking overlay
    if (overlay) {
      overlay.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      });
    }

    // Close mobile menu when clicking a link (better UX)
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
      link.addEventListener('click', function () {
        if (window.innerWidth < 1024) { // Only on mobile
          sidebar.classList.add('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
        }
      });
    });

    // Desktop sidebar collapse/expand toggle
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

    // Handle window resize to reset mobile menu state
    let resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (window.innerWidth >= 1024) {
          // Desktop: ensure mobile overlay is hidden and body scroll is enabled
          overlay.classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
          sidebar.classList.remove('-translate-x-full');
        } else {
          // Mobile: ensure sidebar is hidden
          if (!overlay.classList.contains('hidden')) {
            // If overlay is visible, keep sidebar open
          } else {
            sidebar.classList.add('-translate-x-full');
          }
        }
      }, 250);
    });
  });
</script>
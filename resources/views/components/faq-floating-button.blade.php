<!-- FAQ Floating Action Button -->
<div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50">
  <!-- Floating Action Button -->
  <button @click="open = !open"
    class="group relative flex items-center justify-center w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 text-white rounded-full shadow-lg hover:shadow-xl hover:from-blue-600 hover:via-blue-700 hover:to-indigo-700 transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800"
    aria-label="FAQ and Help">

    <!-- Question Mark Icon (shows when closed) -->
    <svg x-show="!open" x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 scale-50 rotate-90" x-transition:enter-end="opacity-100 scale-100 rotate-0"
      x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 rotate-0"
      x-transition:leave-end="opacity-0 scale-50 -rotate-90" class="w-7 h-7 absolute" fill="currentColor"
      viewBox="0 0 24 24">
      <path fill-rule="evenodd"
        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm0-4h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"
        clip-rule="evenodd" />
    </svg>

    <!-- X Close Icon (shows when open) -->
    <svg x-show="open" x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 scale-50 rotate-90" x-transition:enter-end="opacity-100 scale-100 rotate-0"
      x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 rotate-0"
      x-transition:leave-end="opacity-0 scale-50 -rotate-90" class="w-6 h-6 absolute" fill="none" stroke="currentColor"
      viewBox="0 0 24 24" style="display: none;">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
    </svg>

    <!-- Tooltip - hidden on mobile -->
    <span
      class="hidden md:block absolute right-full mr-3 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
      <span x-show="!open">Help & FAQ</span>
      <span x-show="open" style="display: none;">Close</span>
    </span>
  </button>

  <!-- Popup Modal - Responsive -->
  <div x-show="open" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false" class="md:absolute md:bottom-20 md:right-0 md:w-[480px] 
           fixed left-0 right-0 bottom-0 w-full md:rounded-2xl rounded-t-2xl
           bg-white dark:bg-gray-800 shadow-2xl overflow-hidden max-h-[85vh] md:max-h-[28rem] flex flex-col"
    style="display: none;">

    <!-- Header -->
    <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 px-4 md:px-6 py-4 flex-shrink-0">
      <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-white">Help & Support</h3>
        <button @click="open = false" class="text-white hover:text-gray-200 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <p class="text-blue-100 text-sm mt-1">Quick answers to common questions</p>
    </div>

    <!-- Content - Scrollable -->
    <div class="px-4 md:px-6 py-4 overflow-y-auto flex-1">
      <!-- FAQ Links -->
      <div class="space-y-3">
        <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">
          Frequently Asked Questions
        </h4>

        @php
          $faqs = [
            [
              'title' => 'How do I check my bills?',
              'anchor' => 'bills'
            ],
            [
              'title' => 'How do I track my parcels?',
              'anchor' => 'parcels'
            ],
            [
              'title' => 'How do I update my profile?',
              'anchor' => 'profile'
            ],
            [
              'title' => 'How do I make payments?',
              'anchor' => 'payments'
            ],
            [
              'title' => 'Where can I see announcements?',
              'anchor' => 'announcements'
            ],
            [
              'title' => 'How do I contact support?',
              'anchor' => 'support'
            ]
          ];
        @endphp

        @foreach($faqs as $faq)
          <a href="{{ route('faq') }}#{{ $faq['anchor'] }}"
            class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group">
            <div
              class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center group-hover:bg-blue-200 dark:group-hover:bg-blue-800 transition-colors">
              <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
            <span
              class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
              {{ $faq['title'] }}
            </span>
          </a>
          <hr class="border-gray-200 dark:border-gray-700">
        @endforeach

        <a href="{{ route('faq') }}"
          class="flex items-center justify-center p-3 mt-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
          <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
            View All FAQs
          </span>
          <svg class="w-4 h-4 ml-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </a>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-200 dark:border-gray-700 my-4"></div>

      <!-- Contact Info -->
      <div class="space-y-3 pb-4 md:pb-0">
        <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">
          Need More Help?
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
            <div class="flex flex-col items-center text-center space-y-2">
              <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Email</p>
                <a href="mailto:support@ideobravo.com"
                  class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:underline break-all">
                  support@ideobravo.com
                </a>
              </div>
            </div>
          </div>

          <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
            <div class="flex flex-col items-center text-center space-y-2">
              <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Phone</p>
                <a href="tel:+6621234567"
                  class="text-xs font-medium text-green-600 dark:text-green-400 hover:underline">
                  +66 2 123 4567
                </a>
              </div>
            </div>
          </div>
        </div>

        <a href="{{ route('contact') }}"
          class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r hover:text-white from-blue-500 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg mt-3">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
          </svg>
          Contact Us
        </a>
      </div>
    </div>
  </div>
</div>
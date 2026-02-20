<x-guest-layout>
  <div class="max-w-md mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
      <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-primary/10 flex items-center justify-center">
        <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
          </path>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-body-light-12 dark:text-body-dark-12 mb-2">
        Join Your Condominium
      </h2>
      <p class="text-sm text-body-light-11 dark:text-body-dark-11">
        Enter your condominium invitation code to continue
      </p>
    </div>

    <!-- Code Entry Form -->
    <form method="POST" action="{{ route('condo-code.verify') }}" class="space-y-6">
      @csrf

      <!-- Condo Code Input -->
      <div>
        <label for="condominium_code" class="block text-sm font-medium text-body-light-12 dark:text-body-dark-12 mb-2">
          Condominium Code
        </label>
        <input id="condominium_code" type="text" name="condominium_code" value="{{ old('condominium_code') }}" required
          autofocus placeholder="ENTER 6-DIGIT CODE" maxlength="6"
          class="w-full px-4 py-4 rounded-lg border-2 border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-center tracking-[0.5em] uppercase font-bold" />
        <x-input-error :messages="$errors->get('condominium_code')" class="mt-2" />
      </div>

      <!-- Info Box -->
      <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex gap-3">
          <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
              clip-rule="evenodd"></path>
          </svg>
          <div class="text-sm text-blue-800 space-y-0">
            <p class="font-semibold text-xl">Where to find your code?</p>
            <p class="leading-relaxed">Your condominium invitation code was provided by your juristic office.
              Contact them if you don't have it yet.
            </p>
          </div>

        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit"
        class="w-full px-4 py-3 text-base rounded-lg bg-primary text-primary-color font-semibold hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:ring-4 focus:ring-primary/20 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
        Verify Code
      </button>
    </form>
  </div>
</x-guest-layout>
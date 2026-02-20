<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-body-light-12 dark:text-body-dark-12 mb-1">
            Forgot Password?
        </h2>
        <p class="text-sm text-body-light-11 dark:text-body-dark-11">
            No worries! Enter your email and we'll send you a reset link
        </p>
    </div>

    <!-- Forgot Password Form -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-3.5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Email Address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="email" placeholder="you@example.com"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full px-4 py-2.5 text-sm rounded-lg bg-primary text-primary-color font-semibold hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:ring-4 focus:ring-primary/20 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 mt-4">
            Send Reset Link
        </button>
    </form>

    <!-- Back to Login Link -->
    <div class="text-center mt-6">
        <p class="text-xs text-body-light-11 dark:text-body-dark-11">
            Remember your password?
            <a href="{{ route('login') }}"
                class="font-semibold text-primary hover:text-primary-light-10 dark:hover:text-primary-dark-10 transition-colors duration-200">
                Back to sign in
            </a>
        </p>
    </div>
</x-guest-layout>
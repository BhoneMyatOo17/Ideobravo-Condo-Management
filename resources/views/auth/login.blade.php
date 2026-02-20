<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-body-light-12 dark:text-body-dark-12 mb-1">
            Welcome Back
        </h2>
        <p class="text-sm text-body-light-11 dark:text-body-dark-11">
            Sign in to your account
        </p>
    </div>

    <!-- Lockout Timer Alert (Hidden by default) -->
    <div id="lockoutAlert"
        class="hidden mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5 flex-shrink-0" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
            <div class="flex-1">
                <h3 class="text-base font-semibold text-red-800 dark:text-red-300 mb-1">
                    Account Temporarily Locked
                </h3>
                <p class="text-sm text-red-700 dark:text-red-400">
                    Too many failed login attempts. Please try again in
                </p>
                <div class="mt-2 flex items-center gap-2">
                    <div class="text-2xl font-bold text-red-600 dark:text-red-400" id="lockoutTimer">
                        <span id="minutes">0</span>:<span id="seconds">00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-3.5" id="loginForm">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Email Address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" placeholder="you@example.com" tabindex="1"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-xs font-medium text-primary hover:text-primary-light-10 dark:hover:text-primary-dark-10 transition-colors duration-200">
                        Forgot Password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Enter your password" tabindex="2"
                    class="w-full px-3.5 py-2.5 pr-10 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-body-light-10 dark:text-body-dark-10 hover:text-body-light-12 dark:hover:text-body-dark-12 transition-colors duration-200 focus:outline-none">
                    <!-- Eye Icon (Show) -->
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <!-- Eye Slash Icon (Hide) - Hidden by default -->
                    <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-1">
            <input id="remember_me" type="checkbox" name="remember" tabindex="3"
                class="h-3.5 w-3.5 rounded border-alpha-light dark:border-alpha-dark text-primary focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200">
            <label for="remember_me" class="ml-2 block text-xs text-body-light-11 dark:text-body-dark-11">
                Remember me
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn" tabindex="4"
            class="w-full px-4 py-2.5 text-sm rounded-lg bg-primary text-primary-color font-semibold hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:ring-4 focus:ring-primary/20 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 mt-4">
            Sign In
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-5">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-alpha-light dark:border-alpha-dark"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="px-3 bg-white dark:bg-gray-800 text-body-light-11 dark:text-body-dark-11">
                Or continue with
            </span>
        </div>
    </div>

    <!-- Social Login Button -->
    <a href="{{ route('google.redirect') }}" id="googleBtn"
        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
        <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                fill="#4285F4" />
            <path
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                fill="#34A853" />
            <path
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                fill="#FBBC05" />
            <path
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                fill="#EA4335" />
        </svg>
        <span>Continue with Google</span>
    </a>

    <!-- Register Link -->
    <div class="text-center mt-4">
        <p class="text-xs text-body-light-11 dark:text-body-dark-11">
            Don't have an account?
            <a href="{{ route('register') }}"
                class="font-semibold text-primary hover:text-primary-light-10 dark:hover:text-primary-dark-10 transition-colors duration-200">
                Create account
            </a>
        </p>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        // Lockout Timer Logic with localStorage persistence
        document.addEventListener('DOMContentLoaded', function () {
            const lockoutAlert = document.getElementById('lockoutAlert');
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const googleBtn = document.getElementById('googleBtn');
            const minutesSpan = document.getElementById('minutes');
            const secondsSpan = document.getElementById('seconds');

            // Get email from input for unique lockout key
            const emailInput = document.getElementById('email');

            // Check localStorage for existing lockout
            checkExistingLockout();

            // Check if there's a throttle error from Laravel
            const errorMessage = "{{ $errors->first('email') }}";

            // Extract seconds from Laravel's error message
            const secondsMatch = errorMessage.match(/(\d+)\s+seconds/);

            if (secondsMatch) {
                const lockoutSeconds = parseInt(secondsMatch[1]);
                saveLockoutToStorage(lockoutSeconds);
                startLockoutTimer(lockoutSeconds);
            }

            function checkExistingLockout() {
                const lockoutData = localStorage.getItem('loginLockout');

                if (lockoutData) {
                    try {
                        const data = JSON.parse(lockoutData);
                        const now = new Date().getTime();
                        const unlockTime = data.unlockTime;

                        if (now < unlockTime) {
                            // Still locked out
                            const remainingSeconds = Math.ceil((unlockTime - now) / 1000);
                            startLockoutTimer(remainingSeconds);
                        } else {
                            // Lockout expired, clear storage
                            localStorage.removeItem('loginLockout');
                        }
                    } catch (e) {
                        // Invalid data, remove it
                        localStorage.removeItem('loginLockout');
                    }
                }
            }

            function saveLockoutToStorage(seconds) {
                const now = new Date().getTime();
                const unlockTime = now + (seconds * 1000);

                const lockoutData = {
                    unlockTime: unlockTime,
                    email: emailInput.value
                };

                localStorage.setItem('loginLockout', JSON.stringify(lockoutData));
            }

            function startLockoutTimer(totalSeconds) {
                // Show lockout alert
                lockoutAlert.classList.remove('hidden');

                // Disable form and buttons
                disableLoginControls();

                let remainingSeconds = totalSeconds;

                const timerInterval = setInterval(function () {
                    if (remainingSeconds <= 0) {
                        clearInterval(timerInterval);
                        enableLoginControls();
                        lockoutAlert.classList.add('hidden');
                        localStorage.removeItem('loginLockout');
                        return;
                    }

                    // Calculate minutes and seconds
                    const mins = Math.floor(remainingSeconds / 60);
                    const secs = remainingSeconds % 60;

                    // Update display
                    minutesSpan.textContent = mins;
                    secondsSpan.textContent = secs.toString().padStart(2, '0');

                    remainingSeconds--;
                }, 1000);
            }

            function disableLoginControls() {
                // Disable form inputs
                const inputs = loginForm.querySelectorAll('input, button[type="submit"]');
                inputs.forEach(input => {
                    input.disabled = true;
                    input.classList.add('opacity-50', 'cursor-not-allowed');
                });

                // Disable Google login button
                googleBtn.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            }

            function enableLoginControls() {
                // Enable form inputs
                const inputs = loginForm.querySelectorAll('input, button[type="submit"]');
                inputs.forEach(input => {
                    input.disabled = false;
                    input.classList.remove('opacity-50', 'cursor-not-allowed');
                });

                // Enable Google login button
                googleBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            }
        });
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const submitBtn = document.getElementById('submitBtn');

            // Disable button and show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
        });
    </script>
</x-guest-layout>
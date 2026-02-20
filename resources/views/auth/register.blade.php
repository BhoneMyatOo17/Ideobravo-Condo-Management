<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-body-light-12 dark:text-body-dark-12 mb-1">
            Create Account
        </h2>
        <p class="text-sm text-body-light-11 dark:text-body-dark-11">
            Join IdeoBravo today
        </p>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register.store') }}" class="space-y-3.5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Full Name
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                placeholder="John Smith" tabindex="1"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Email Address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                placeholder="you@example.com" tabindex="2"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Phone Number with Country Code -->
        <div>
            <label for="phone_number"
                class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Phone Number (Optional)
            </label>
            <div class="flex gap-2">
                <select id="country_code" name="country_code"
                    class="w-28 px-3 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200">
                    <option value="+66" selected>🇹🇭 +66</option>
                    <option value="+1">🇺🇸 +1</option>
                    <option value="+44">🇬🇧 +44</option>
                    <option value="+81">🇯🇵 +81</option>
                    <option value="+82">🇰🇷 +82</option>
                    <option value="+86">🇨🇳 +86</option>
                    <option value="+91">🇮🇳 +91</option>
                    <option value="+65">🇸🇬 +65</option>
                    <option value="+60">🇲🇾 +60</option>
                    <option value="+62">🇮🇩 +62</option>
                    <option value="+63">🇵🇭 +63</option>
                    <option value="+84">🇻🇳 +84</option>
                </select>
                <input id="phone_number" type="tel" name="phone_number" value="{{ old('phone_number') }}"
                    autocomplete="tel" placeholder="812345678" tabindex="3"
                    class="flex-1 px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
            </div>
            <x-input-error :messages="$errors->get('phone_number')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Password
            </label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    placeholder="Min. 8 characters" tabindex="4"
                    class="w-full px-3.5 py-2.5 pr-10 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
                <button type="button" onclick="togglePasswords()"
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

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation"
                class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
                Confirm Password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="Retype password" tabindex="5"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <button type="submit" tabindex="6"
            class="w-full px-4 py-2.5 text-sm rounded-lg bg-primary text-primary-color font-semibold hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:ring-4 focus:ring-primary/20 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 mt-4">
            Create Account
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
    <a href="{{ route('google.redirect') }}"
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

    <!-- Sign In Link -->
    <div class="text-center mt-4">
        <p class="text-xs text-body-light-11 dark:text-body-dark-11">
            Already have an account?
            <a href="{{ route('login') }}"
                class="font-semibold text-primary hover:text-primary-light-10 dark:hover:text-primary-dark-10 transition-colors duration-200">
                Sign in
            </a>
        </p>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePasswords() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            // Toggle both password fields
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                confirmPasswordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                confirmPasswordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</x-guest-layout>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register for Songkran 2026 - IdeoBravo</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Line Icons CDN -->
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
  <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('favicon/favicon-194x194.png') }}" />

  <!-- Custom Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: '#3d63dd',
            }
          }
        }
      },
      darkMode: 'class'
    }
  </script>

  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      animation: fadeIn 0.6s ease-out forwards;
    }

    /* Input focus styles */
    input:focus,
    select:focus {
      outline: none;
      border-color: #3d63dd;
      box-shadow: 0 0 0 3px rgba(61, 99, 221, 0.1);
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8 px-4">

  <div class="max-w-2xl mx-auto fade-in">

    <!-- Event Poster Section -->
    <div class="bg-white dark:bg-gray-800 rounded-t-2xl shadow-xl overflow-hidden">
      <div
        class="w-full h-64 bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 flex items-center justify-center">
        <img src="{{ asset('images/songkran.png') }}" alt="Songkran 2026 Event Poster"
          class="w-full h-full object-cover"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="hidden w-full h-full items-center justify-center">
          <div class="text-center text-white">
            <i class="lni lni-image text-6xl mb-4 opacity-50"></i>
            <p class="text-xl font-semibold">Songkran 2026 Event</p>
            <p class="text-sm opacity-75 mt-2">Event Poster</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Registration Form -->
    <div class="bg-white dark:bg-gray-800 rounded-b-2xl shadow-xl p-8">

      <!-- Form Header -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
          Register for Songkran 2026
        </h1>
        <p class="text-gray-600 dark:text-gray-400">
          Join us for the traditional Thai New Year celebration
        </p>
      </div>

      <!-- Form -->
      <form id="registration-form" class="space-y-6">

        <!-- Name Field -->
        <div>
          <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Full Name <span class="text-red-500">*</span>
          </label>
          <input type="text" id="name" name="name" required
            class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
            placeholder="Enter your full name">
        </div>

        <!-- Number of Attendees -->
        <div>
          <label for="attendees" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Number of Attendees <span class="text-red-500">*</span>
          </label>
          <select id="attendees" name="attendees" required
            class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200">
            <option value="">Select number of attendees</option>
            <option value="1">1 Person</option>
            <option value="2">2 People</option>
            <option value="3">3 People</option>
            <option value="4">4 People</option>
            <option value="5">5 People</option>
            <option value="6">6+ People</option>
          </select>
        </div>

        <!-- Room Number -->
        <div>
          <label for="room" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Room Number <span class="text-red-500">*</span>
          </label>
          <input type="text" id="room" name="room" required
            class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
            placeholder="e.g., 1205">
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
          <button type="submit"
            class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
            <i class="lni lni-checkmark-circle mr-2"></i>
            Register for Event
          </button>
        </div>

      </form>

      <!-- Event Info -->
      <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-start text-sm text-gray-600 dark:text-gray-400">
          <i class="lni lni-calendar text-primary mr-2 mt-0.5"></i>
          <div>
            <p class="font-semibold text-gray-800 dark:text-white">Event Date</p>
            <p>April 13-15, 2026</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Branding -->
    <div class="text-center mt-6">
      <p class="text-sm text-gray-500 dark:text-gray-400">
        Powered by <span class="font-semibold text-primary">IdeoBravo</span>
      </p>
    </div>

  </div>

  <script>
    // Form submission handler - just redirect to confirmation page
    document.getElementById('registration-form').addEventListener('submit', function (e) {
      e.preventDefault();
      window.location.href = '/confirmed';
    });

    // Dark mode detection
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      document.documentElement.classList.add('dark');
    }
  </script>

</body>

</html>
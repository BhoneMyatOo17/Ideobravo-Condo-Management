<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registration Successful - IdeoBravo</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Line Icons CDN -->
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
  <link rel="icon" type="logo" href="./logo.png">

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
      }

      to {
        opacity: 1;
      }
    }

    @keyframes checkmark {
      0% {
        stroke-dashoffset: 100;
      }

      100% {
        stroke-dashoffset: 0;
      }
    }

    @keyframes scaleIn {
      0% {
        transform: scale(0.8);
        opacity: 0;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .fade-in {
      animation: fadeIn 0.5s ease-out forwards;
    }

    .scale-in {
      animation: scaleIn 0.5s ease-out forwards;
    }

    .checkmark-circle {
      stroke-dasharray: 166;
      stroke-dashoffset: 166;
      animation: checkmark 0.6s ease-in-out 0.3s forwards;
    }

    .checkmark-check {
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: checkmark 0.3s ease-in-out 0.9s forwards;
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-md fade-in">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 text-center">

      <!-- Success Icon -->
      <div class="flex justify-center mb-6">
        <svg class="w-24 h-24" viewBox="0 0 52 52">
          <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#3d63dd" stroke-width="2" />
          <path class="checkmark-check" fill="none" stroke="#3d63dd" stroke-width="3" d="M14 27 l7 7 16-16" />
        </svg>
      </div>

      <!-- Title -->
      <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-3">
        Registration Successful!
      </h1>

      <!-- Message -->
      <p class="text-gray-600 dark:text-gray-400 mb-8">
        You have successfully registered for Songkran 2026
      </p>

      <!-- Confirmation Number -->
      <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-4 mb-6">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Confirmation Number</p>
        <p class="text-sm font-semibold text-gray-900 dark:text-white font-mono">
          SONG-2026-123456
        </p>
      </div>

      <!-- Event Info Box -->
      <div class="bg-primary/10 border-2 border-primary/20 rounded-xl p-4 mb-8">
        <div class="flex items-start text-sm">
          <i class="lni lni-calendar text-primary text-xl mr-3 mt-0.5"></i>
          <div class="text-left">
            <p class="font-semibold text-gray-800 dark:text-white mb-1">Event Details</p>
            <p class="text-gray-700 dark:text-gray-300">Songkran 2026 Celebration</p>
            <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">April 13-15, 2026</p>
          </div>
        </div>
      </div>

      <!-- Additional Info -->
      <div class="text-sm text-gray-600 dark:text-gray-400 mb-6">
        <p class="mb-2">
          <i class="lni lni-envelope text-primary mr-2"></i>
          A confirmation email will be sent to your registered email
        </p>
      </div>

      <!-- Footer -->
      <div class="text-sm text-gray-600 dark:text-gray-400 pt-6 border-t border-gray-200 dark:border-gray-700">
        <i class="lni lni-checkmark-circle text-primary mr-1"></i>
        Secured by IdeoBravo
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
    // Dark mode detection
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      document.documentElement.classList.add('dark');
    }
  </script>

</body>

</html>
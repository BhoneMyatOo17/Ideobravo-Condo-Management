<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Payment Successful - IdeoBravo</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Line Icons CDN -->
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}" />

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

    .fade-in {
      animation: fadeIn 0.5s ease-out forwards;
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

    /* Loading spinner */
    .spinner {
      border: 3px solid #f3f3f3;
      border-top: 3px solid #3d63dd;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <!-- Loading Screen -->
  <div id="loading-screen" class="text-center">
    <div class="spinner mx-auto mb-4"></div>
    <p class="text-gray-600 dark:text-gray-400 text-lg">Processing payment...</p>
  </div>

  <!-- Success Screen (Hidden Initially) -->
  <div id="success-screen" class="w-full max-w-md hidden fade-in">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 text-center">

      <!-- Success Icon -->
      <div class="flex justify-center mb-6">
        <svg class="w-24 h-24" viewBox="0 0 52 52">
          <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#22c55e" stroke-width="2" />
          <path class="checkmark-check" fill="none" stroke="#22c55e" stroke-width="3" d="M14 27 l7 7 16-16" />
        </svg>
      </div>

      <!-- Title -->
      <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-3">
        Payment Successful
      </h1>

      <!-- Message -->
      <p class="text-gray-600 dark:text-gray-400 mb-8">
        Your payment has been processed successfully
      </p>

      <!-- Amount -->
      <div class="bg-green-50 dark:bg-green-900/20 rounded-xl py-6 mb-6">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Amount Paid</p>
        <p class="text-3xl font-bold text-green-600 dark:text-green-400" id="payment-amount">฿0.00</p>
      </div>

      <!-- Transaction ID -->
      <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-4 mb-6">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Transaction ID</p>
        <p class="text-sm font-semibold text-gray-900 dark:text-white font-mono">
          TXN-2024-001234567
        </p>
      </div>

      <!-- Date & Time -->
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-8" id="current-datetime">
        Dec 15, 2024 at 2:30 PM
      </p>

      <!-- Footer -->
      <div class="text-sm text-gray-600 dark:text-gray-400 pt-6 border-t border-gray-200 dark:border-gray-700">
        <i class="lni lni-lock text-green-600 dark:text-green-400 mr-1"></i>
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
    function updateDateTime() {
      const now = new Date();
      const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      };
      document.getElementById('current-datetime').textContent = now.toLocaleDateString('en-US', options);
    }

    function getQueryParam(name) {
      const url = new URLSearchParams(window.location.search);
      return url.get(name);
    }

    window.addEventListener('DOMContentLoaded', function () {
      updateDateTime();

      const amount = getQueryParam('amount');
      if (amount) {
        document.getElementById('payment-amount').textContent = '฿' + parseFloat(amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      }

      setTimeout(function () {
        document.getElementById('loading-screen').style.display = 'none';
        document.getElementById('success-screen').classList.remove('hidden');
      }, 2000);
    });

    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      document.documentElement.classList.add('dark');
    }

    // Simulate loading then show success
    window.addEventListener('DOMContentLoaded', function () {
      updateDateTime();

      // Show success screen after 2 seconds
      setTimeout(function () {
        document.getElementById('loading-screen').style.display = 'none';
        document.getElementById('success-screen').classList.remove('hidden');
      }, 2000);
    });

    // Dark mode detection
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      document.documentElement.classList.add('dark');
    }
  </script>

</body>

</html>
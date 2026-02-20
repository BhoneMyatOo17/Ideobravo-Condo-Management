<div id="cookieConsent"
  class="hidden fixed bottom-0 left-0 right-0 z-[9999] p-4 md:p-6 bg-white dark:bg-gray-800 shadow-2xl border-t-4 border-primary animate-slide-up">
  <div class="container mx-auto max-w-6xl">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
      <!-- Cookie Message -->
      <div class="flex-1">
        <div class="flex items-start gap-3">
          <i class="lni lni-cookie text-3xl text-primary mt-1"></i>
          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
              We Value Your Privacy
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">
              We use cookies to enhance your browsing experience, provide personalized content, and analyze our traffic.
              By clicking "Accept All", you consent to our use of cookies.
              <a href="{{ route('privacy.policy') }}" class="text-primary hover:underline font-medium">Learn more</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Cookie Buttons -->
      <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
        <button type="button" id="rejectCookies"
          class="px-6 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors duration-200">
          Reject All
        </button>
        <button type="button" id="acceptCookies"
          class="px-6 py-2.5 text-sm font-medium text-white bg-primary hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 rounded-md transition-colors duration-200">
          Accept All
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  @keyframes slide-up {
    from {
      transform: translateY(100%);
      opacity: 0;
    }

    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .animate-slide-up {
    animation: slide-up 0.4s ease-out;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const cookieConsent = document.getElementById('cookieConsent');
    const acceptBtn = document.getElementById('acceptCookies');
    const rejectBtn = document.getElementById('rejectCookies');

    // Check if user has already made a choice and if it's still valid
    const cookieData = localStorage.getItem('cookieConsent');
    let shouldShowConsent = true;

    if (cookieData) {
      try {
        const parsed = JSON.parse(cookieData);
        const expiryDate = new Date(parsed.expiry);
        const now = new Date();

        // Check if consent has expired (1 day = 86400000 milliseconds)
        if (now < expiryDate) {
          shouldShowConsent = false;
        } else {
          // Expired, remove old data
          localStorage.removeItem('cookieConsent');
        }
      } catch (e) {
        // Invalid data, remove it
        localStorage.removeItem('cookieConsent');
      }
    }

    if (shouldShowConsent) {
      // Show cookie consent if no valid choice exists
      setTimeout(() => {
        cookieConsent.classList.remove('hidden');
      }, 1000); // Show after 1 second
    }

    // Handle Accept button
    acceptBtn.addEventListener('click', function () {
      saveCookieChoice('accepted');
      hideCookieConsent();
    });

    // Handle Reject button
    rejectBtn.addEventListener('click', function () {
      saveCookieChoice('rejected');
      hideCookieConsent();
    });

    // Save choice with expiry date (1 day from now)
    function saveCookieChoice(choice) {
      const now = new Date();
      const expiryDate = new Date(now.getTime() + (24 * 60 * 60 * 1000)); // 1 day in milliseconds

      const cookieData = {
        choice: choice,
        expiry: expiryDate.toISOString()
      };

      localStorage.setItem('cookieConsent', JSON.stringify(cookieData));
    }

    // Hide cookie consent with animation
    function hideCookieConsent() {
      cookieConsent.style.animation = 'slide-up 0.4s ease-out reverse';
      setTimeout(() => {
        cookieConsent.classList.add('hidden');
      }, 400);
    }
  });
</script>
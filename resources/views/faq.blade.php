@extends('layouts.dashboard')

@section('page-title', 'FAQ - Help Center')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
      <div class="flex items-center space-x-3 mb-2">
        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div>
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Help Center</h1>
          <p class="text-gray-600 dark:text-gray-400">Frequently Asked Questions</p>
        </div>
      </div>
    </div>

    <!-- Search Box (Optional - can be implemented later) -->
    <div class="mb-8">
      <div class="relative">
        <input type="text" placeholder="Search for answers..."
          class="w-full px-4 py-3 pl-12 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
        <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>

    <!-- FAQ Sections -->
    <div class="space-y-6">

      <!-- Bills Section -->
      <div id="bills" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden scroll-mt-20">
        <div
          class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-750 px-6 py-4 border-l-4 border-blue-500">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-6 h-6 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Bills & Payments
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I check my bills?</h3>
            <p class="text-gray-600 dark:text-gray-400">Navigate to <a href="{{ route('my-bills.index') }}"
                class="text-blue-600 dark:text-blue-400 hover:underline font-medium">My Bills</a> from the dashboard menu.
              You'll see all your current and past bills with their status.</p>
          </div>

          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I make payments?</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-2">You have two payment options:</p>
            <ul class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-400 ml-4">
              <li><strong>Credit/Debit Card:</strong> Pay directly through the system</li>
              <li><strong>Bank Transfer:</strong> Upload your payment receipt after making the transfer</li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">When are bills issued?</h3>
            <p class="text-gray-600 dark:text-gray-400">Bills are typically issued at the beginning of each month. You'll
              receive a notification once a new bill is available.</p>
          </div>
        </div>
      </div>

      <!-- Parcels Section -->
      <div id="parcels" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden scroll-mt-20">
        <div
          class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-750 px-6 py-4 border-l-4 border-green-500">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Parcel Management
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I track my parcels?</h3>
            <p class="text-gray-600 dark:text-gray-400">Go to <a href="{{ route('parcels.my-parcels') }}"
                class="text-blue-600 dark:text-blue-400 hover:underline font-medium">My Parcels</a> to see all parcels
              received for you. You'll get a notification when a new parcel arrives.</p>
          </div>

          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I collect my parcel?</h3>
            <p class="text-gray-600 dark:text-gray-400">Visit the juristic office with a valid ID. The staff will verify
              your identity and hand over your parcel. The system will automatically mark it as collected.</p>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">What if I can't collect my parcel
              immediately?</h3>
            <p class="text-gray-600 dark:text-gray-400">Your parcel will be safely stored at the juristic office. We
              recommend collecting it within 7 days to avoid storage limitations.</p>
          </div>
        </div>
      </div>

      <!-- Profile Section -->
      <div id="profile" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden scroll-mt-20">
        <div
          class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-700 dark:to-gray-750 px-6 py-4 border-l-4 border-purple-500">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-6 h-6 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profile & Account
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I update my profile?</h3>
            <p class="text-gray-600 dark:text-gray-400">Click on your profile picture in the top navigation bar, then
              select <a href="{{ route('profile.edit') }}"
                class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Edit Profile</a>. You can update your
              contact information, profile picture, and preferences.</p>
          </div>

          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I change my password?</h3>
            <p class="text-gray-600 dark:text-gray-400">Go to your profile page and look for the "Update Password"
              section. Enter your current password and choose a new secure password.</p>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Can I update my room number?</h3>
            <p class="text-gray-600 dark:text-gray-400">Room numbers can only be updated by staff or admin. Please contact
              the juristic office if you need to change your room information.</p>
          </div>
        </div>
      </div>

      <!-- Announcements Section -->
      <div id="announcements" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden scroll-mt-20">
        <div
          class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-gray-700 dark:to-gray-750 px-6 py-4 border-l-4 border-orange-500">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-6 h-6 mr-3 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
            Announcements
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Where can I see announcements?</h3>
            <p class="text-gray-600 dark:text-gray-400">All condominium announcements are available in the <a
                href="{{ route('announcements.index') }}"
                class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Announcements</a> section. You can
              also see the latest announcements on your dashboard.</p>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Will I be notified of new announcements?
            </h3>
            <p class="text-gray-600 dark:text-gray-400">Yes, you'll receive notifications for important announcements.
              Make sure your notification settings are enabled in your profile.</p>
          </div>
        </div>
      </div>

      <!-- Support Section -->
      <div id="support" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden scroll-mt-20">
        <div
          class="bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-gray-700 dark:to-gray-750 px-6 py-4 border-l-4 border-cyan-500">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-6 h-6 mr-3 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Contact & Support
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">How do I contact support?</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-3">You can reach us through multiple channels:</p>
            <div class="space-y-3">
              <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">Email</p>
                  <a href="mailto:support@ideobravo.com"
                    class="text-sm text-blue-600 dark:text-blue-400 hover:underline">support@ideobravo.com</a>
                </div>
              </div>
              <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mt-0.5" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">Phone</p>
                  <a href="tel:+6621234567" class="text-sm text-green-600 dark:text-green-400 hover:underline">+66 2 123
                    4567</a>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mon-Fri: 8:00 AM - 6:00 PM</p>
                </div>
              </div>
              <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400 mt-0.5" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">Juristic Office</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Ground Floor, Building A</p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">What are the office hours?</h3>
            <p class="text-gray-600 dark:text-gray-400">The juristic office is open Monday to Friday from 8:00 AM to 6:00
              PM, and Saturday from 9:00 AM to 1:00 PM. We're closed on Sundays and public holidays.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Still Need Help Card -->
    <div class="mt-8 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-xl shadow-lg overflow-hidden">
      <div class="p-8 text-center">
        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-white mb-2">Still need help?</h3>
        <p class="text-blue-100 mb-6">Can't find what you're looking for? Our support team is here to help.</p>
        <a href="{{ route('contact') }}"
          class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-lg">
          Contact Support
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </a>
      </div>
    </div>
  </div>
@endsection
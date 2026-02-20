@props(['user'])

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6">
    <!-- Profile Header -->
    <div class="flex items-center space-x-8 mb-6">
      <!-- Avatar -->
      <div class="flex-shrink-0">
        @if($user->avatar)
          <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
            class="h-24 w-24 rounded-full object-cover border-4 border-blue-500">
        @else
          <div
            class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center border-4 border-blue-500">
            <span class="text-3xl font-bold text-white">
              {{ strtoupper(substr($user->name, 0, 1)) }}
            </span>
          </div>
        @endif
      </div>

      <!-- User Info -->
      <div class="flex-1">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
          {{ $user->name }}
        </h2>
        <p class="text-gray-600 dark:text-gray-400 mb-3">
          {{ $user->email }}
        </p>

        <!-- Registration Status Badge -->
        @if($user->hasCompletedRegistration())
          <span
            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
            Registered Resident
          </span>
        @else
          <span
            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd" />
            </svg>
            Registration Incomplete
          </span>
        @endif
      </div>
    </div>

    <!-- Profile Details - Different Background Color -->
    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
      <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
        <!-- Email -->
        <div>
          <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email Address</dt>
          <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ $user->email }}</dd>
        </div>

        <!-- Account Created -->
        <div>
          <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Member Since</dt>
          <dd class="text-sm text-gray-900 dark:text-white font-medium">
            {{ $user->created_at->format('F d, Y') }}
          </dd>
        </div>

        <!-- User Type -->
        @if($user->user_type)
          <div>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Account Type</dt>
            <dd class="text-sm text-gray-900 dark:text-white font-medium capitalize">
              {{ $user->user_type }}
            </dd>
          </div>
        @endif

        <!-- Condo Status -->
        <div>
          <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Condo Registration</dt>
          <dd class="text-sm font-medium">
            @if($user->hasCompletedRegistration())
              <span class="inline-flex items-center text-green-600 dark:text-green-400">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
                </svg>
                Completed
              </span>
            @else
              <span class="inline-flex items-center text-yellow-600 dark:text-yellow-400">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd" />
                </svg>
                Pending
              </span>
            @endif
          </dd>
        </div>
      </dl>
    </div>
  </div>
</div>
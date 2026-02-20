@extends('layouts.dashboard')

@section('page-title', 'Staff Details')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Header with Back Button -->
    <div class="mb-6 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <a href="{{ route('staff.index') }}"
          class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
          <i class="lni lni-arrow-left text-xl text-gray-600 dark:text-gray-400"></i>
        </a>
        <div>
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Staff Details</h1>
          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">View and manage staff member information</p>
        </div>
      </div>
      <a href="{{ route('staff.edit', $staff) }}"
        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 hover:text-white text-white rounded-lg transition-colors">
        <i class="lni lni-pencil"></i>
        <span>Edit Profile</span>
      </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Left Column - Profile Card -->
      <div class="lg:col-span-1">
        <!-- Main Profile Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
          <!-- Profile Header with Background -->
          <div class="h-32 bg-gradient-to-r from-blue-500 to-blue-600"></div>

          <!-- Profile Content -->
          <div class="px-6 pb-6">

            <!-- Name & Position -->
            <div class="text-center mt-4">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                {{ $staff->user->name }}
              </h2>
              <p class="text-lg text-blue-600 dark:text-blue-400 font-medium mb-2">
                {{ $staff->position }}
              </p>
              @if($staff->department)
                <p class="text-sm text-gray-600 dark:text-gray-400">
                  {{ $staff->department }}
                </p>
              @endif
            </div>

            <!-- Status Badge -->
            <div class="flex justify-center mb-6">
              @if($staff->is_active)
                <span
                  class="px-4 py-2 text-sm rounded-full font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 inline-flex items-center gap-2">
                  <i class="lni lni-checkmark-circle"></i> Active Employee
                </span>
              @else
                <span
                  class="px-4 py-2 text-sm rounded-full font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 inline-flex items-center gap-2">
                  <i class="lni lni-close"></i> Inactive
                </span>
              @endif
            </div>

            <!-- Quick Info Cards -->
            <div class="space-y-3 mb-6">
              <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div
                  class="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                  <i class="lni lni-user text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-xs text-gray-500 dark:text-gray-400">Employee ID</p>
                  <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                    {{ $staff->employee_id }}
                  </p>
                </div>
              </div>

              @if($staff->department)
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                  <div
                    class="flex-shrink-0 w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <i class="lni lni-apartment text-purple-600 dark:text-purple-400"></i>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Department</p>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                      {{ $staff->department }}
                    </p>
                  </div>
                </div>
              @endif

              <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div
                  class="flex-shrink-0 w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                  <i class="lni lni-briefcase text-orange-600 dark:text-orange-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-xs text-gray-500 dark:text-gray-400">Employment Type</p>
                  <p class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ ucfirst($staff->employment_type) }}
                  </p>
                </div>
              </div>

              @if($staff->hire_date)
                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                  <div
                    class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                    <i class="lni lni-calendar text-green-600 dark:text-green-400"></i>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Hire Date</p>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                      {{ \Carbon\Carbon::parse($staff->hire_date)->format('M d, Y') }}
                    </p>
                  </div>
                </div>
              @endif
            </div>

            <!-- Activity Stats -->
            <div class="grid grid-cols-3 gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
              <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                  {{ $staff->parcels_received ?? 0 }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Parcels</p>
              </div>
              <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                  {{ $staff->bills_generated ?? 0 }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Bills</p>
              </div>
              <div class="text-center">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                  {{ $staff->announcements_created ?? 0 }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Posts</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column - Detailed Information -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Contact Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="lni lni-phone text-blue-600 dark:text-blue-400"></i>
              Contact Information
            </h3>
          </div>
          <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Email Address
                </label>
                <div class="flex items-center gap-2 text-gray-900 dark:text-white">
                  <i class="lni lni-envelope text-gray-400"></i>
                  <a href="mailto:{{ $staff->user->email }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                    {{ $staff->user->email }}
                  </a>
                </div>
              </div>

              @if($staff->user->phone_number)
                <div>
                  <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Personal Phone
                  </label>
                  <div class="flex items-center gap-2 text-gray-900 dark:text-white">
                    <i class="lni lni-mobile text-gray-400"></i>
                    <a href="tel:{{ $staff->user->phone_number }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                      {{ $staff->user->phone_number }}
                    </a>
                  </div>
                </div>
              @endif

              @if($staff->work_phone)
                <div>
                  <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Work Phone
                  </label>
                  <div class="flex items-center gap-2 text-gray-900 dark:text-white">
                    <i class="lni lni-phone text-gray-400"></i>
                    <a href="tel:{{ $staff->work_phone }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                      {{ $staff->work_phone }}
                    </a>
                  </div>
                </div>
              @endif

              @if($staff->work_email)
                <div>
                  <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Work Email
                  </label>
                  <div class="flex items-center gap-2 text-gray-900 dark:text-white">
                    <i class="lni lni-envelope text-gray-400"></i>
                    <a href="mailto:{{ $staff->work_email }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                      {{ $staff->work_email }}
                    </a>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

        <!-- Employment Details -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="lni lni-briefcase text-blue-600 dark:text-blue-400"></i>
              Employment Details
            </h3>
          </div>
          <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Position
                </label>
                <p class="text-gray-900 dark:text-white font-medium">{{ $staff->position }}</p>
              </div>

              @if($staff->department)
                <div>
                  <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Department
                  </label>
                  <p class="text-gray-900 dark:text-white font-medium">{{ $staff->department }}</p>
                </div>
              @endif

              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Employee ID
                </label>
                <p class="text-gray-900 dark:text-white font-medium">{{ $staff->employee_id }}</p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Employment Type
                </label>
                <span
                  class="inline-flex px-3 py-1 text-sm rounded-full font-medium
                                                {{ $staff->employment_type === 'full-time' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                                {{ $staff->employment_type === 'part-time' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : '' }}
                                                {{ $staff->employment_type === 'contract' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' : '' }}">
                  {{ ucfirst($staff->employment_type) }}
                </span>
              </div>

              @if($staff->hire_date)
                <div>
                  <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                    Hire Date
                  </label>
                  <p class="text-gray-900 dark:text-white font-medium">
                    {{ \Carbon\Carbon::parse($staff->hire_date)->format('F d, Y') }}
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ \Carbon\Carbon::parse($staff->hire_date)->diffForHumans() }}
                  </p>
                </div>
              @endif

              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Status
                </label>
                @if($staff->is_active)
                  <span
                    class="inline-flex px-3 py-1 text-sm rounded-full font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                    <i class="lni lni-checkmark-circle mr-1"></i> Active
                  </span>
                @else
                  <span
                    class="inline-flex px-3 py-1 text-sm rounded-full font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                    <i class="lni lni-close mr-1"></i> Inactive
                  </span>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Condominium Assignment -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="lni lni-apartment text-blue-600 dark:text-blue-400"></i>
              Condominium Assignment
            </h3>
          </div>
          <div class="p-6">
            @if($staff->condominium)
              <div
                class="flex items-start gap-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                  <i class="lni lni-home text-white text-xl"></i>
                </div>
                <div class="flex-1">
                  <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                    {{ $staff->condominium->name }}
                  </h4>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                    Code: <span class="font-mono font-semibold">{{ $staff->condominium->code }}</span>
                  </p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    <i class="lni lni-map-marker"></i> {{ $staff->condominium->address }}
                  </p>
                </div>
              </div>
            @else
              <div
                class="flex items-start gap-4 p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                  <i class="lni lni-apartment text-white text-xl"></i>
                </div>
                <div class="flex-1">
                  <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                    General Management
                  </h4>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    This staff member has access to all condominium properties and is not assigned to a specific location.
                  </p>
                </div>
              </div>
            @endif
          </div>
        </div>

        <!-- System Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="lni lni-cog text-blue-600 dark:text-blue-400"></i>
              System Information
            </h3>
          </div>
          <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Account Created
                </label>
                <p class="text-gray-900 dark:text-white">
                  {{ $staff->created_at->format('F d, Y') }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  {{ $staff->created_at->diffForHumans() }}
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                  Last Updated
                </label>
                <p class="text-gray-900 dark:text-white">
                  {{ $staff->updated_at->format('F d, Y') }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  {{ $staff->updated_at->diffForHumans() }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        alert('{{ session('success') }}');
      });
    </script>
  @endif
@endsection
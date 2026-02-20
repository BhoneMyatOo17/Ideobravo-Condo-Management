@extends('dashboard')

@section('page-title', 'User Management')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">User Management</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Manage residents and staff accounts</p>
      </div>
      <a href="{{ route('profile.create') }}"
        class="inline-flex items-center justify-center gap-2 hover:text-white px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
        <i class="lni lni-plus"></i>
        Add New User
      </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
        <div class="flex items-center gap-3">
          <i class="lni lni-checkmark-circle text-green-500 text-xl"></i>
          <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
        <div class="flex items-center gap-3">
          <i class="lni lni-warning text-red-500 text-xl"></i>
          <p class="text-red-700 dark:text-red-400">{{ session('error') }}</p>
        </div>
      </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-users text-xl text-blue-600 dark:text-blue-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-home text-xl text-green-600 dark:text-green-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['residents'] }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Residents</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-briefcase text-xl text-purple-600 dark:text-purple-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['staff'] }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Staff</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-checkmark-circle text-xl text-yellow-600 dark:text-yellow-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['active'] }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Active</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
      <form method="GET" action="{{ route('profile.index') }}" class="flex flex-col sm:flex-row gap-4">
        <!-- Search -->
        <div class="flex-1">
          <div class="relative">
            <i class="lni lni-search-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}"
              placeholder="Search by name, email, or unit..."
              class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
          </div>
        </div>

        <!-- User Type Filter -->
        <div class="w-full sm:w-48">
          <select name="user_type"
            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            <option value="">All Types</option>
            <option value="resident" {{ request('user_type') === 'resident' ? 'selected' : '' }}>Residents</option>
            @if(Auth::user()->isAdmin())
              <option value="staff" {{ request('user_type') === 'staff' ? 'selected' : '' }}>Staff</option>
              <option value="admin" {{ request('user_type') === 'admin' ? 'selected' : '' }}>Admins</option>
            @endif
          </select>
        </div>

        <!-- Status Filter -->
        <div class="w-full sm:w-40">
          <select name="status"
            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

        <!-- Filter Buttons -->
        <div class="flex gap-2">
          <button type="submit"
            class="px-4 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
            <i class="lni lni-funnel"></i>
            <span class="ml-1 hidden sm:inline">Filter</span>
          </button>
          <a href="{{ route('profile.index') }}"
            class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
            <i class="lni lni-reload"></i>
          </a>
        </div>
      </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                User
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Role
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Details
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Status
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Joined
              </th>
              <th
                class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($users as $user)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <!-- User Info -->
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div
                      class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-semibold">
                      @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                          class="w-full h-full rounded-full object-cover">
                      @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                      @endif
                    </div>
                    <div>
                      <p class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                      <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                  </div>
                </td>

                <!-- Role -->
                <td class="px-6 py-4">
                  <span
                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                                          @if($user->isAdmin()) bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                                          @elseif($user->isStaff()) bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                                                          @else bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 @endif">
                    {{ $user->getRoleName() }}
                  </span>
                </td>

                <!-- Details -->
                <td class="px-6 py-4">
                  @if($user->isResident() && $user->userable)
                    <div class="text-sm">
                      <p class="text-gray-900 dark:text-white font-medium">Unit {{ $user->userable->unit_number }}</p>
                      <p class="text-gray-500 dark:text-gray-400">{{ ucfirst($user->userable->residency_status) }}</p>
                    </div>
                  @elseif($user->isStaff() && $user->userable)
                    <div class="text-sm">
                      <p class="text-gray-900 dark:text-white font-medium">{{ $user->userable->position }}</p>
                      <p class="text-gray-500 dark:text-gray-400">{{ $user->userable->department ?? '—' }}</p>
                    </div>
                  @elseif($user->isAdmin())
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                      System Administrator
                    </div>
                  @else
                    <span class="text-gray-400">—</span>
                  @endif
                </td>

                <!-- Status -->
                <td class="px-6 py-4">
                  @php
                    $isActive = true;
                    if ($user->userable && isset($user->userable->is_active)) {
                      $isActive = $user->userable->is_active;
                    }
                  @endphp
                  <span
                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                                          {{ $isActive ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                    {{ $isActive ? 'Active' : 'Inactive' }}
                  </span>
                </td>

                <!-- Joined -->
                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                  {{ $user->created_at->format('M j, Y') }}
                </td>

                <!-- Actions -->
                <td class="px-6 py-4">
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('profile.showUser', $user) }}"
                      class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                      title="View">
                      <i class="lni lni-eye"></i>
                    </a>
                    <a href="{{ route('profile.editUser', $user) }}"
                      class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                      title="Edit">
                      <i class="lni lni-pencil"></i>
                    </a>
                  </div>
                </td>
            @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center">
                      <i class="lni lni-users text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                      <p class="text-gray-500 dark:text-gray-400 font-medium">No users found</p>
                      <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Try adjusting your search or filters</p>
                    </div>
                  </td>
                </tr>
              @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
          {{ $users->withQueryString()->links() }}
        </div>
      @endif
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filterForm = document.querySelector('form[action="{{ route('profile.index') }}"]');

      if (filterForm) {
        filterForm.addEventListener('submit', function (e) {
          // Get all form inputs
          const inputs = this.querySelectorAll('input[type="text"], select');

          // Remove empty values before submission
          inputs.forEach(input => {
            if (input.value === '' || input.value === null) {
              input.removeAttribute('name');
            }
          });
        });
      }
    });
  </script>
@endsection
@extends('layouts.dashboard')

@section('page-title', 'Staff Management')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Staff Management</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage staff members and their information</p>
      </div>
      <a href="{{ route('staff.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:text-white hover:bg-blue-700 text-white rounded-lg transition-colors">
        <i class="lni lni-plus"></i>
        <span>Add New Staff</span>
      </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center gap-3">
          <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
            <i class="lni lni-users text-2xl text-blue-600 dark:text-blue-400"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Total Staff</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center gap-3">
          <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
            <i class="lni lni-checkmark-circle text-2xl text-green-600 dark:text-green-400"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Active</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['active'] }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center gap-3">
          <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
            <i class="lni lni-briefcase text-2xl text-purple-600 dark:text-purple-400"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Full-Time</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['full_time'] }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center gap-3">
          <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
            <i class="lni lni-timer text-2xl text-orange-600 dark:text-orange-400"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Part-Time</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['part_time'] }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
      <form method="GET" action="{{ route('staff.index') }}" class="p-4" id="filterForm">
        <div class="flex flex-wrap items-center gap-3">
          <!-- Search -->
          <div class="flex-1 min-w-[200px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search staff..."
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
          </div>

          <!-- Condominium Filter -->
          @if(Auth::user()->isAdmin())
            <div class="w-[200px]">
              <select name="condominium_id"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                <option value="">All Condominiums</option>
                <option value="null" {{ request('condominium_id') === 'null' ? 'selected' : '' }}>General Management</option>
                @foreach($condominiums as $condo)
                  <option value="{{ $condo->id }}" {{ request('condominium_id') == $condo->id ? 'selected' : '' }}>
                    {{ $condo->name }}
                  </option>
                @endforeach
              </select>
            </div>
          @endif

          <!-- Status Filter -->
          <div class="w-[150px]">
            <select name="status"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
              <option value="">All Status</option>
              <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          <!-- Employment Type Filter -->
          <div class="w-[150px]">
            <select name="employment_type"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
              <option value="">All Types</option>
              <option value="full-time" {{ request('employment_type') === 'full-time' ? 'selected' : '' }}>Full-Time
              </option>
              <option value="part-time" {{ request('employment_type') === 'part-time' ? 'selected' : '' }}>Part-Time
              </option>
              <option value="contract" {{ request('employment_type') === 'contract' ? 'selected' : '' }}>Contract</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="flex gap-2">
            <button type="submit"
              class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2">
              <i class="lni lni-search-alt"></i>
              <span class="hidden sm:inline">Filter</span>
            </button>
            <a href="{{ route('staff.index') }}"
              class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white rounded-lg transition-colors flex items-center">
              <i class="lni lni-reload"></i>
            </a>
          </div>
        </div>
      </form>
    </div>

    <!-- Staff Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Staff
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Position
              </th>
              @if(Auth::user()->isAdmin())
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                  Condominium
                </th>
              @endif
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Department
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Employment
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Status
              </th>
              <th
                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($staff as $member)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 h-10 w-10">
                      @if($member->user->avatar)
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $member->user->avatar }}"
                          alt="{{ $member->user->name }}">
                      @else
                        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center">
                          <span class="text-white font-semibold text-sm">{{ substr($member->user->name, 0, 2) }}</span>
                        </div>
                      @endif
                    </div>
                    <div>
                      <div class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $member->user->name }}
                      </div>
                      <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $member->user->email }}
                      </div>
                      <div class="text-xs text-gray-400 dark:text-gray-500">
                        ID: {{ $member->employee_id }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 dark:text-white">{{ $member->position }}</div>
                </td>
                @if(Auth::user()->isAdmin())
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($member->condominium)
                      <div class="text-sm text-gray-900 dark:text-white">{{ $member->condominium->name }}</div>
                      <div class="text-xs text-gray-500 dark:text-gray-400">{{ $member->condominium->code }}</div>
                    @else
                      <span
                        class="px-2 py-1 text-xs rounded-full font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                        General Management
                      </span>
                    @endif
                  </td>
                @endif
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 dark:text-white">
                    {{ $member->department ?? '-' }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 py-1 text-xs rounded-full font-medium
                                                        {{ $member->employment_type === 'full-time' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                                        {{ $member->employment_type === 'part-time' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : '' }}
                                                        {{ $member->employment_type === 'contract' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' : '' }}">
                    {{ ucfirst($member->employment_type) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($member->is_active)
                    <span
                      class="px-2 py-1 text-xs rounded-full font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                      <i class="lni lni-checkmark-circle"></i> Active
                    </span>
                  @else
                    <span
                      class="px-2 py-1 text-xs rounded-full font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                      <i class="lni lni-close"></i> Inactive
                    </span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('staff.show', $member) }}"
                      class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                      title="View Details">
                      <i class="lni lni-eye text-lg"></i>
                    </a>
                    <a href="{{ route('staff.edit', $member) }}"
                      class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                      title="Edit">
                      <i class="lni lni-pencil text-lg"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="{{ Auth::user()->isAdmin() ? '7' : '6' }}" class="px-6 py-12 text-center">
                  <div class="flex flex-col items-center justify-center">
                    <i class="lni lni-users text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400 text-lg mb-2">No staff members found</p>
                    <p class="text-gray-400 dark:text-gray-500 text-sm mb-4">Get started by adding your first staff member
                    </p>
                    <a href="{{ route('staff.create') }}"
                      class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:text-white hover:bg-blue-700 text-white rounded-lg transition-colors">
                      <i class="lni lni-plus"></i>
                      <span>Add New Staff</span>
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($staff->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
          {{ $staff->links() }}
        </div>
      @endif
    </div>
  </div>

  @if(session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        alert('{{ session('success') }}');
      });
    </script>
  @endif

  @if(session('error'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        alert('{{ session('error') }}');
      });
    </script>
  @endif
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filterForm = document.getElementById('filterForm');

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
    });
  </script>
@endsection
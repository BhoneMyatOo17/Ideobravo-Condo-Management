@extends('layouts.dashboard')

@section('page-title', 'Parcel Management')

@section('content')
  <div class="container-fluid px-6 py-8">

    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
        <div class="flex items-center gap-3">
          <i class="lni lni-checkmark-circle text-green-600 dark:text-green-400 text-xl"></i>
          <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
        <div class="flex items-center gap-3">
          <i class="lni lni-cross-circle text-red-600 dark:text-red-400 text-xl"></i>
          <p class="text-red-800 dark:text-red-200">{{ session('error') }}</p>
        </div>
      </div>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Parcel Management</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Track and manage incoming parcels</p>
      </div>

      @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
        <a href="{{ route('parcels.create') }}"
          class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark hover:text-white transition-colors flex items-center gap-2">
          <i class="lni lni-plus"></i>
          Register New Parcel
        </a>
      @endif
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Total Parcels</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['total'] ?? 0 }}</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
            <i class="lni lni-package text-blue-600 dark:text-blue-400 text-xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Pending Pickup</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['pending'] ?? 0 }}</p>
          </div>
          <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
            <i class="lni lni-timer text-yellow-600 dark:text-yellow-400 text-xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Picked Up</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['picked_up'] ?? 0 }}</p>
          </div>
          <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
            <i class="lni lni-checkmark-circle text-green-600 dark:text-green-400 text-xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Today</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['today'] ?? 0 }}</p>
          </div>
          <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
            <i class="lni lni-calendar text-purple-600 dark:text-purple-400 text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
      <form action="{{ route('parcels.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Tracking or courier..."
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
        </div>

        <!-- Status Filter -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
          <select name="status"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="notified" {{ request('status') == 'notified' ? 'selected' : '' }}>Notified</option>
            <option value="picked_up" {{ request('status') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
          </select>
        </div>

        <!-- Condominium Filter (Admin Only) -->
        @if(Auth::user()->isAdmin())
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Condominium</label>
            <select name="condominium_id"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
              <option value="">All Condominiums</option>
              @foreach($condominiums ?? [] as $condo)
                <option value="{{ $condo->id }}" {{ request('condominium_id') == $condo->id ? 'selected' : '' }}>
                  {{ $condo->name }}
                </option>
              @endforeach
            </select>
          </div>
        @endif

        <!-- Actions -->
        <div class="flex items-end gap-2">
          <button type="submit"
            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <i class="lni lni-funnel mr-2"></i>Filter
          </button>
          <a href="{{ route('parcels.index') }}"
            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            Reset
          </a>
        </div>
      </form>
    </div>

    <!-- Parcels Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Recipient
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Room
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Tracking
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Courier
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Received
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Status
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($parcels as $parcel)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <!-- Recipient Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center mr-3">
                      <i class="lni lni-user text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                      <p class="font-medium text-gray-900 dark:text-white">{{ $parcel->recipient_name }}</p>
                      @if($parcel->resident)
                        <p class="text-xs text-green-600 dark:text-green-400">
                          <i class="lni lni-checkmark-circle"></i> Registered
                        </p>
                      @endif
                    </div>
                  </div>
                </td>

                <!-- Room Number -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg font-medium">
                    {{ $parcel->unit_number }}
                  </span>
                </td>

                <!-- Tracking Number -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <p class="text-sm text-gray-900 dark:text-white">{{ $parcel->tracking_number ?? 'N/A' }}</p>
                </td>

                <!-- Courier -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <p class="text-sm text-gray-900 dark:text-white">{{ $parcel->courier_service }}</p>
                </td>

                <!-- Received Date -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <p class="text-sm text-gray-900 dark:text-white">{{ $parcel->received_date->format('M d, Y') }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ $parcel->received_date->diffForHumans() }}</p>
                </td>

                <!-- Status -->
                <td class="px-6 py-4 whitespace-nowrap">
                  @php
                    $statusColors = [
                      'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400',
                      'notified' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400',
                      'picked_up' => 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
                    ];
                    $statusLabels = [
                      'pending' => 'Pending',
                      'notified' => 'Notified',
                      'picked_up' => 'Picked Up',
                    ];
                  @endphp
                  <span
                    class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusColors[$parcel->status] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ $statusLabels[$parcel->status] ?? $parcel->status }}
                  </span>
                </td>

                <!-- Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  <div class="flex items-center gap-2">
                    <a href="{{ route('parcels.show', $parcel) }}"
                      class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                      title="View Details">
                      <i class="lni lni-eye text-lg"></i>
                    </a>

                    @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                      <a href="{{ route('parcels.edit', $parcel) }}"
                        class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300" title="Edit">
                        <i class="lni lni-pencil text-lg"></i>
                      </a>

                      @if($parcel->status != 'picked_up')
                        <form action="{{ route('parcels.mark-picked-up', $parcel) }}" method="POST" class="inline">
                          @csrf
                          <button type="submit" onclick="return confirm('Mark as picked up?')"
                            class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                            title="Mark as Picked Up">
                            <i class="lni lni-checkmark-circle text-lg"></i>
                          </button>
                        </form>
                      @endif

                      <form action="{{ route('parcels.destroy', $parcel) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this parcel?')"
                          class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Delete">
                          <i class="lni lni-trash text-lg"></i>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="px-6 py-12 text-center">
                  <div class="flex flex-col items-center justify-center">
                    <i class="lni lni-package text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">No parcels found</p>
                    @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                      <a href="{{ route('parcels.create') }}" class="mt-4 text-primary hover:underline">
                        Register your first parcel
                      </a>
                    @endif
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($parcels->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
          {{ $parcels->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection
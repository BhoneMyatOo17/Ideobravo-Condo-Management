@extends('layouts.dashboard')

@section('page-title', 'My Parcels')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">My Parcels</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">View your parcel deliveries</p>
      </div>
    </div>

    <!-- Content wrapper with flex for mobile ordering -->
    <div class="flex flex-col">
      <!-- Stats - Order 3 on mobile (appears at bottom), but appears at top on desktop -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-6 order-3 md:order-1">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Total Parcels</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['total'] }}</p>
            </div>
            <div class="p-2 md:p-3 bg-blue-100 dark:bg-blue-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-package text-blue-600 dark:text-blue-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Awaiting Pickup</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['pending'] }}</p>
            </div>
            <div class="p-2 md:p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-alarm-clock text-yellow-600 dark:text-yellow-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Notified</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['notified'] }}</p>
            </div>
            <div class="p-2 md:p-3 bg-orange-100 dark:bg-orange-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-bubble text-orange-600 dark:text-orange-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Picked Up</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['picked_up'] }}</p>
            </div>
            <div class="p-2 md:p-3 bg-green-100 dark:bg-green-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-checkmark-circle text-green-600 dark:text-green-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters - Order 1 on mobile, Order 2 on desktop -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6 p-4 order-1 md:order-2">
        <form method="GET" action="{{ route('parcels.my-parcels') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <select name="status"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
              <option value="">All Status</option>
              <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Pickup</option>
              <option value="notified" {{ request('status') == 'notified' ? 'selected' : '' }}>Notified</option>
              <option value="picked_up" {{ request('status') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
            </select>
          </div>
          <div class="flex items-end gap-2">
            <button type="submit"
              class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
              <i class="lni lni-search-alt mr-2"></i>Filter
            </button>
            <a href="{{ route('parcels.my-parcels') }}"
              class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
              Reset
            </a>
          </div>
        </form>
      </div>

      <!-- Parcels Table - Order 2 on mobile, Order 3 on desktop -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden order-2 md:order-3">
        <!-- Mobile Card View -->
        <div class="block md:hidden divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($parcels as $parcel)
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tracking Number</p>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $parcel->tracking_number }}</p>
                </div>
                <span
                  class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $parcel->getStatusBadgeColor() }}">
                  {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                </span>
              </div>
              
              <div class="grid grid-cols-2 gap-3 mb-3">
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Courier</p>
                  <p class="text-sm text-gray-900 dark:text-white">{{ $parcel->courier_service }}</p>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Received Date</p>
                  <p class="text-sm text-gray-900 dark:text-white">{{ $parcel->received_date->format('M d, Y') }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ $parcel->received_date->format('h:i A') }}</p>
                </div>
              </div>

              <div class="flex justify-end">
                <a href="{{ route('parcels.my-parcel-show', $parcel) }}" 
                   class="text-primary hover:text-primary-dark text-sm font-medium">
                  <i class="lni lni-eye mr-1"></i>View Details
                </a>
              </div>
            </div>
          @empty
            <div class="px-6 py-12 text-center">
              <i class="lni lni-inbox text-4xl text-gray-400 mb-4"></i>
              <p class="text-gray-500 dark:text-gray-400">No parcels found</p>
            </div>
          @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Tracking Number</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Courier</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Received Date</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Status</th>
                <th
                  class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($parcels as $parcel)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $parcel->tracking_number }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-white">{{ $parcel->courier_service }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-white">{{ $parcel->received_date->format('M d, Y') }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $parcel->received_date->format('h:i A') }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $parcel->getStatusBadgeColor() }}">
                      {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('parcels.my-parcel-show', $parcel) }}" class="text-primary hover:text-primary-dark">
                      <i class="lni lni-eye mr-1"></i>View
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-12 text-center">
                    <i class="lni lni-inbox text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">No parcels found</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
          {{ $parcels->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
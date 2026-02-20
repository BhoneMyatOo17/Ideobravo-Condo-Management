@extends('layouts.dashboard')

@section('page-title', 'My Bills')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">My Bills</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">View and manage your bills</p>
      </div>
    </div>

    <!-- Content wrapper with flex for mobile ordering -->
    <div class="flex flex-col">
      <!-- Stats - Order 3 on mobile (appears at bottom), Order 1 on desktop -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-6 order-3 md:order-1">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Total Bills</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['total'] }}</p>
            </div>
            <div class="p-2 md:p-3 bg-blue-100 dark:bg-blue-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-files text-blue-600 dark:text-blue-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Pending</p>
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
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Paid</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['paid'] }}</p>
            </div>
            <div class="p-2 md:p-3 bg-green-100 dark:bg-green-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-checkmark-circle text-green-600 dark:text-green-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 md:p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-2 md:mb-0">
              <p class="text-gray-500 dark:text-gray-400 text-xs md:text-sm">Pending Amount</p>
              <p class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mt-1">
                ฿{{ number_format($stats['pending_amount'], 2) }}</p>
            </div>
            <div class="p-2 md:p-3 bg-red-100 dark:bg-red-900 rounded-lg self-start md:self-auto">
              <i class="lni lni-wallet text-red-600 dark:text-red-300 text-lg md:text-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters - Order 1 on mobile, Order 2 on desktop -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6 p-4 order-1 md:order-2">
        <form method="GET" action="{{ route('my-bills.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <select name="status"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
              <option value="">All Status</option>
              <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
              <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bill Type</label>
            <select name="bill_type"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
              <option value="">All Types</option>
              <option value="common_area" {{ request('bill_type') == 'common_area' ? 'selected' : '' }}>Common Area Fee
              </option>
              <option value="electricity" {{ request('bill_type') == 'electricity' ? 'selected' : '' }}>Electricity</option>
              <option value="water" {{ request('bill_type') == 'water' ? 'selected' : '' }}>Water</option>
              <option value="insurance" {{ request('bill_type') == 'insurance' ? 'selected' : '' }}>Insurance</option>
              <option value="parking" {{ request('bill_type') == 'parking' ? 'selected' : '' }}>Parking</option>
              <option value="other" {{ request('bill_type') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>
          <div class="flex items-end gap-2">
            <button type="submit"
              class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
              <i class="lni lni-search-alt mr-2"></i>Filter
            </button>
            <a href="{{ route('my-bills.index') }}"
              class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
              Reset
            </a>
          </div>
        </form>
      </div>

      <!-- Bills Table - Order 2 on mobile, Order 3 on desktop -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden order-2 md:order-3">
        <!-- Mobile Card View -->
        <div class="block md:hidden divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($bills as $bill)
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Bill Number</p>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $bill->bill_number }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $bill->issue_date->format('M d, Y') }}</p>
                </div>
                <span
                  class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bill->getStatusBadgeColor() }}">
                  {{ ucfirst($bill->status) }}
                </span>
              </div>

              <div class="grid grid-cols-2 gap-3 mb-3">
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Type</p>
                  <p class="text-sm text-gray-900 dark:text-white">{{ $bill->getBillTypeLabel() }}</p>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Amount</p>
                  <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $bill->formatted_amount }}</p>
                </div>
              </div>

              <div class="mb-3">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Due Date</p>
                <p class="text-sm text-gray-900 dark:text-white">{{ $bill->due_date->format('M d, Y') }}</p>
                @if($bill->isOverdue())
                  <p class="text-xs text-red-600 dark:text-red-400 mt-1">Overdue</p>
                @endif
              </div>

              <div class="flex justify-end">
                <a href="{{ route('my-bills.show', $bill) }}"
                  class="text-primary hover:text-primary-dark text-sm font-medium">
                  <i class="lni lni-eye mr-1"></i>View Details
                </a>
              </div>
            </div>
          @empty
            <div class="px-6 py-12 text-center">
              <i class="lni lni-inbox text-4xl text-gray-400 mb-4"></i>
              <p class="text-gray-500 dark:text-gray-400">No bills found</p>
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
                  Bill Number</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Type</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Amount</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Due Date</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Status</th>
                <th
                  class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($bills as $bill)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $bill->bill_number }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $bill->issue_date->format('M d, Y') }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-white">{{ $bill->getBillTypeLabel() }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $bill->formatted_amount }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-white">{{ $bill->due_date->format('M d, Y') }}</div>
                    @if($bill->isOverdue())
                      <div class="text-xs text-red-600 dark:text-red-400">Overdue</div>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bill->getStatusBadgeColor() }}">
                      {{ ucfirst($bill->status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('my-bills.show', $bill) }}" class="text-primary hover:text-primary-dark">
                      <i class="lni lni-eye mr-1"></i>View
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center">
                    <i class="lni lni-inbox text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">No bills found</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
          {{ $bills->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
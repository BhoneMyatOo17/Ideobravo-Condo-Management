@extends('layouts.dashboard')

@section('page-title', 'Bills Management')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Bills Management</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Manage billing and payments</p>
      </div>
      @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
        <div class="mt-4 md:mt-0">
          <a href="{{ route('bills.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary text-white hover:text-white rounded-lg hover:bg-primary-dark transition-colors">
            <i class="lni lni-plus mr-2"></i>
            Create Bill
          </a>
        </div>
      @endif
    </div>

    <!-- Success Message -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded">
        <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
      </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
      <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded">
        <p class="text-red-700 dark:text-red-400">{{ session('error') }}</p>
      </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Total Bills</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['total'] }}</p>
          </div>
          <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
            <i class="lni lni-files text-blue-600 dark:text-blue-300 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Pending</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['pending'] }}</p>
          </div>
          <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
            <i class="lni lni-alarm-clock text-yellow-600 dark:text-yellow-300 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Paid</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['paid'] }}</p>
          </div>
          <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
            <i class="lni lni-checkmark-circle text-green-600 dark:text-green-300 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Overdue</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['overdue'] }}</p>
          </div>
          <div class="p-3 bg-red-100 dark:bg-red-900 rounded-lg">
            <i class="lni lni-close text-red-600 dark:text-red-300 text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6 p-4">
      <form method="GET" action="{{ route('bills.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Bill number or resident name..."
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
          <select name="status"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
          <a href="{{ route('bills.index') }}"
            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            Reset
          </a>
        </div>
      </form>
    </div>

    <!-- Bills Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Bill Number</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Resident</th>
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
                  <div class="text-sm text-gray-900 dark:text-white">{{ $bill->resident->user->name }}</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Unit {{ $bill->unit_number }}</div>
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
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('bills.show', $bill) }}" class="text-primary hover:text-primary-dark" title="View">
                      <i class="lni lni-eye"></i>
                    </a>
                    @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                      @if($bill->status !== 'paid')
                        <a href="{{ route('bills.edit', $bill) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400"
                          title="Edit">
                          <i class="lni lni-pencil"></i>
                        </a>
                        <form action="{{ route('bills.destroy', $bill) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this bill?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400" title="Delete">
                            <i class="lni lni-trash"></i>
                          </button>
                        </form>
                      @endif
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="px-6 py-12 text-center">
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
@endsection
@extends('layouts.dashboard')

@section('title', 'Bills Report')

@section('content')
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Bills Report</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Comprehensive billing analytics and payment tracking</p>
      </div>
      <a href="{{ route('reports.index') }}"
        class="inline-flex hover:text-white items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Dashboard
      </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Bills</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ number_format($stats['total_bills']) }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Amount</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">
          ฿{{ number_format($stats['total_amount'], 0) }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Paid Amount</p>
        <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">
          ฿{{ number_format($stats['paid_amount'], 0) }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pending Amount</p>
        <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">
          ฿{{ number_format($stats['pending_amount'], 0) }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Overdue Bills</p>
        <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-1">{{ number_format($stats['overdue_count']) }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Overdue Amount</p>
        <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-1">
          ฿{{ number_format($stats['overdue_amount'], 0) }}</p>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Monthly Trend Chart -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Monthly Billing Trend</h3>
        <div class="h-72">
          <canvas id="monthlyTrendChart"></canvas>
        </div>
      </div>

      <!-- Bills by Type Chart -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Bills by Type</h3>
        <div class="h-72">
          <canvas id="billsByTypeChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Second Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Bills by Status -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Bills by Status</h3>
        <div class="h-72 flex items-center justify-center">
          <canvas id="billsByStatusChart"></canvas>
        </div>
      </div>

      <!-- Payment Methods -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Payment Methods</h3>
        <div class="h-72 flex items-center justify-center">
          <canvas id="paymentMethodsChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Bills by Condominium -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Bills by Condominium</h3>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Condominium</th>
              <th
                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Total Bills</th>
              <th
                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Total Amount</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($billsByCondominium as $item)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $item->condominium->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-right text-gray-900 dark:text-gray-100">{{ number_format($item->count) }}</td>
                <td class="px-6 py-4 text-right font-semibold text-gray-900 dark:text-gray-100">
                  ฿{{ number_format($item->total, 2) }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No data available</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Filters & Bills List -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Bills List</h3>

        <!-- Filters -->
        <form method="GET" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Left Column: Dropdowns -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Condominium</label>
              <select name="condominium_id"
                class="w-full rounded-lg border-gray-300 border p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <option value="">All Condominiums</option>
                @foreach($condominiums as $condo)
                  <option value="{{ $condo->id }}" {{ request('condominium_id') == $condo->id ? 'selected' : '' }}>
                    {{ $condo->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bill Type</label>
              <select name="bill_type"
                class="w-full rounded-lg border-gray-300 border p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <option value="">All Types</option>
                <option value="common_area" {{ request('bill_type') == 'common_area' ? 'selected' : '' }}>Common Area Fee
                </option>
                <option value="water" {{ request('bill_type') == 'water' ? 'selected' : '' }}>Water</option>
                <option value="electricity" {{ request('bill_type') == 'electricity' ? 'selected' : '' }}>Electricity
                </option>
                <option value="insurance" {{ request('bill_type') == 'insurance' ? 'selected' : '' }}>Insurance</option>
                <option value="parking" {{ request('bill_type') == 'parking' ? 'selected' : '' }}>Parking</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
              <select name="status"
                class="w-full rounded-lg border-gray-300 border p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>
          </div>

          <!-- Right Column: Date Range & Buttons -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 items-end">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date From</label>
              <input type="date" name="date_from" value="{{ request('date_from') }}"
                class="w-full rounded-lg border p-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date To</label>
              <input type="date" name="date_to" value="{{ request('date_to') }}"
                class="w-full rounded-lg border-gray-300 border p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
              Filter
            </button>
            <a href="{{ route('reports.bills') }}"
              class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-center">
              Reset
            </a>
          </div>
        </form>
      </div>

      <!-- Bills Table -->
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Bill #</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Condominium</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Type</th>
              <th
                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Amount</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Due Date</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($bills as $bill)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $bill->bill_number }}</td>
                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $bill->condominium->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $bill->getBillTypeLabel() }}</td>
                <td class="px-6 py-4 text-right font-semibold text-gray-900 dark:text-gray-100">
                  ฿{{ number_format($bill->amount, 2) }}</td>
                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $bill->due_date->format('M d, Y') }}</td>
                <td class="px-6 py-4">
                  <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $bill->getStatusBadgeColor() }}">
                    {{ ucfirst($bill->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No bills found</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        {{ $bills->withQueryString()->links() }}
      </div>
    </div>
  </div>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#6B7280';
    const gridColor = isDarkMode ? '#374151' : '#E5E7EB';

    // Monthly Trend Chart
    new Chart(document.getElementById('monthlyTrendChart'), {
      type: 'bar',
      data: {
        labels: {!! json_encode($trendLabels) !!},
        datasets: [{
          label: 'Amount (฿)',
          data: {!! json_encode($trendAmounts) !!},
          backgroundColor: 'rgba(59, 130, 246, 0.8)',
          borderRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { color: textColor, callback: v => '฿' + v.toLocaleString() },
            grid: { color: gridColor }
          },
          x: { ticks: { color: textColor }, grid: { display: false } }
        }
      }
    });

    // Bills by Type Chart
    const billTypes = {!! json_encode($billsByType->pluck('bill_type')->map(fn($t) => ucfirst(str_replace('_', ' ', $t)))) !!};
    const billTypeTotals = {!! json_encode($billsByType->pluck('total')) !!};

    new Chart(document.getElementById('billsByTypeChart'), {
      type: 'bar',
      data: {
        labels: billTypes,
        datasets: [{
          label: 'Total Amount',
          data: billTypeTotals,
          backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'],
          borderRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: {
          x: {
            beginAtZero: true,
            ticks: { color: textColor, callback: v => '฿' + v.toLocaleString() },
            grid: { color: gridColor }
          },
          y: { ticks: { color: textColor }, grid: { display: false } }
        }
      }
    });

    // Bills by Status Chart
    const statusData = {!! json_encode($billsByStatus->pluck('count', 'status')) !!};
    new Chart(document.getElementById('billsByStatusChart'), {
      type: 'doughnut',
      data: {
        labels: ['Paid', 'Pending', 'Overdue', 'Cancelled'],
        datasets: [{
          data: [statusData.paid || 0, statusData.pending || 0, statusData.overdue || 0, statusData.cancelled || 0],
          backgroundColor: ['#10B981', '#F59E0B', '#EF4444', '#6B7280'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { color: textColor, padding: 20, usePointStyle: true } } },
        cutout: '60%'
      }
    });

    // Payment Methods Chart
    const paymentLabels = {!! json_encode($paymentMethods->pluck('payment_method')->map(fn($m) => ucfirst(str_replace('_', ' ', $m ?? 'Unknown')))) !!};
    const paymentData = {!! json_encode($paymentMethods->pluck('count')) !!};

    new Chart(document.getElementById('paymentMethodsChart'), {
      type: 'pie',
      data: {
        labels: paymentLabels.length ? paymentLabels : ['No data'],
        datasets: [{
          data: paymentData.length ? paymentData : [1],
          backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { color: textColor, padding: 20, usePointStyle: true } } }
      }
    });
  </script>
@endsection
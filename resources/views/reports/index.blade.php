@extends('layouts.dashboard')

@section('title', 'Reports Dashboard')

@section('content')
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Reports Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Overview of system performance and statistics</p>
      </div>
      <div class="flex gap-3">
        <a href="{{ route('reports.bills') }}"
          class="inline-flex items-center px-4 py-2 bg-blue-600 hover:text-white text-white rounded-lg hover:bg-blue-700 transition">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
          </svg>
          Bills Report
        </a>
        <a href="{{ route('reports.parcels') }}"
          class="inline-flex items-center px-4 py-2 bg-green-600 hover:text-white text-white rounded-lg hover:bg-green-700 transition">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
          </svg>
          Parcels Report
        </a>
        <a href="{{ route('reports.residents') }}"
          class="inline-flex items-center px-4 py-2 bg-purple-600 hover:text-white text-white rounded-lg hover:bg-purple-700 transition">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Residents Report
        </a>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Total Residents -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Residents</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              {{ number_format($stats['total_residents']) }}
            </p>
            <p class="text-sm text-green-600 dark:text-green-400 mt-1">{{ $stats['active_residents'] }} active</p>
          </div>
          <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Revenue This Month -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Revenue This Month</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              ฿{{ number_format($stats['revenue_this_month'], 2) }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ now()->format('F Y') }}</p>
          </div>
          <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Pending Bills -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Bills</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              {{ number_format($stats['pending_bills']) }}
            </p>
            <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $stats['overdue_bills'] }} overdue</p>
          </div>
          <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Pending Parcels -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Parcels</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">
              {{ number_format($stats['pending_parcels']) }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $stats['total_parcels'] }} total</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Revenue Trend Chart -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Revenue Trend (Last 6 Months)</h3>
        <div class="h-72">
          <canvas id="revenueChart"></canvas>
        </div>
      </div>

      <!-- Bills Status Chart -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Bills by Status</h3>
        <div class="h-72 flex items-center justify-center">
          <canvas id="billsStatusChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Second Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Parcels Status Chart -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Parcels by Status</h3>
        <div class="h-72 flex items-center justify-center">
          <canvas id="parcelsStatusChart"></canvas>
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">System Overview</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
              <span class="text-gray-700 dark:text-gray-300">Total Condominiums</span>
            </div>
            <span class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_condominiums'] }}</span>
          </div>
          <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-red-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <span class="text-gray-700 dark:text-gray-300">Total Staff</span>
            </div>
            <span class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_staff'] }}</span>
          </div>
          <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <span class="text-gray-700 dark:text-gray-300">Total Bills Generated</span>
            </div>
            <span
              class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_bills']) }}</span>
          </div>
          <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
              </div>
              <span class="text-gray-700 dark:text-gray-300">Total Parcels Received</span>
            </div>
            <span
              class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_parcels']) }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Recent Bills -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Bills</h3>
            <a href="{{ route('reports.bills') }}"
              class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400">View All</a>
          </div>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($recentBills as $bill)
            <div class="p-4 flex items-center justify-between">
              <div>
                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $bill->bill_number }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $bill->condominium->name ?? 'N/A' }}</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-900 dark:text-gray-100">฿{{ number_format($bill->amount, 2) }}</p>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $bill->getStatusBadgeColor() }}">
                  {{ ucfirst($bill->status) }}
                </span>
              </div>
            </div>
          @empty
            <div class="p-4 text-center text-gray-500 dark:text-gray-400">No bills found</div>
          @endforelse
        </div>
      </div>

      <!-- Recent Parcels -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Parcels</h3>
            <a href="{{ route('reports.parcels') }}"
              class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400">View All</a>
          </div>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($recentParcels as $parcel)
            <div class="p-4 flex items-center justify-between">
              <div>
                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $parcel->tracking_number ?? 'No tracking' }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $parcel->recipient_name }} - Unit
                  {{ $parcel->unit_number }}
                </p>
              </div>
              <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $parcel->received_date->format('M d, Y') }}</p>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $parcel->getStatusBadgeColor() }}">
                  {{ $parcel->getStatusLabel() }}
                </span>
              </div>
            </div>
          @empty
            <div class="p-4 text-center text-gray-500 dark:text-gray-400">No parcels found</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    // Chart.js default settings for dark mode support
    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#6B7280';
    const gridColor = isDarkMode ? '#374151' : '#E5E7EB';

    // Revenue Trend Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
      type: 'line',
      data: {
        labels: {!! json_encode($revenueLabels) !!},
        datasets: [{
          label: 'Revenue (฿)',
          data: {!! json_encode($revenueData) !!},
          borderColor: '#3B82F6',
          backgroundColor: 'rgba(59, 130, 246, 0.1)',
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#3B82F6',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              color: textColor,
              callback: function (value) {
                return '฿' + value.toLocaleString();
              }
            },
            grid: {
              color: gridColor
            }
          },
          x: {
            ticks: {
              color: textColor
            },
            grid: {
              display: false
            }
          }
        }
      }
    });

    // Bills Status Chart
    const billsStatusCtx = document.getElementById('billsStatusChart').getContext('2d');
    new Chart(billsStatusCtx, {
      type: 'doughnut',
      data: {
        labels: ['Paid', 'Pending', 'Overdue', 'Cancelled'],
        datasets: [{
          data: [
                                            {{ $billsByStatus['paid'] ?? 0 }},
                                            {{ $billsByStatus['pending'] ?? 0 }},
                                            {{ $billsByStatus['overdue'] ?? 0 }},
            {{ $billsByStatus['cancelled'] ?? 0 }}
          ],
          backgroundColor: ['#10B981', '#F59E0B', '#EF4444', '#6B7280'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: textColor,
              padding: 20,
              usePointStyle: true
            }
          }
        },
        cutout: '60%'
      }
    });

    // Parcels Status Chart
    const parcelsStatusCtx = document.getElementById('parcelsStatusChart').getContext('2d');
    new Chart(parcelsStatusCtx, {
      type: 'doughnut',
      data: {
        labels: ['Pending', 'Notified', 'Picked Up'],
        datasets: [{
          data: [
                                            {{ $parcelsByStatus['pending'] ?? 0 }},
                                            {{ $parcelsByStatus['notified'] ?? 0 }},
            {{ $parcelsByStatus['picked_up'] ?? 0 }}
          ],
          backgroundColor: ['#F59E0B', '#3B82F6', '#10B981'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: textColor,
              padding: 20,
              usePointStyle: true
            }
          }
        },
        cutout: '60%'
      }
    });
  </script>
@endsection
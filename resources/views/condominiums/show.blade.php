@extends('dashboard')

@section('page-title', $condominium->name)

@section('content')
  <div class="max-w-6xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('condominiums.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors">
        <i class="lni lni-arrow-left"></i>
        Back to Condominiums
      </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/25 border border-green-200 dark:border-green-800 rounded-xl">
        <div class="flex items-center gap-3">
          <i class="lni lni-checkmark-circle text-green-500 text-xl"></i>
          <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    <!-- Header Card -->
    <div
      class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6 overflow-hidden">
      <div class="bg-primary bg-rings p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
              <i class="lni lni-apartment text-3xl text-white"></i>
            </div>
            <div>
              <h1 class="text-2xl font-bold text-white">{{ $condominium->name }}</h1>
              <p class="text-white/80 text-sm mt-1">{{ $condominium->address }}</p>
            </div>
          </div>
          <div class="flex gap-2">
            <a href="{{ route('condominiums.edit', $condominium) }}"
              class="inline-flex items-center gap-2 px-4 py-2 bg-white/25 text-white rounded-lg hover:bg-white/30 transition-colors">
              <i class="lni lni-pencil"></i>
              Edit
            </a>
          </div>
        </div>
      </div>

      <!-- Invitation Code -->
      <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Invitation Code for Residents</p>
            <code class="text-2xl font-mono font-bold text-primary">{{ $condominium->code }}</code>
          </div>
          <form action="{{ route('condominiums.regenerate-code', $condominium) }}" method="POST">
            @csrf
            <button type="submit"
              class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
              onclick="return confirm('Generate a new invitation code? The old code will no longer work.');">
              <i class="lni lni-reload"></i>
              Regenerate Code
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-3 gap-4 mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-users text-lg text-green-600 dark:text-green-400"></i>
          </div>
          <div>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $stats['total_residents'] }}</p>
            <p class=" -mt-1 text-xs text-gray-500 dark:text-gray-400">Total Residents</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-checkmark-circle text-lg text-blue-600 dark:text-blue-400"></i>
          </div>
          <div>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $stats['active_residents'] }}</p>
            <p class="-mt-1 text-xs text-gray-500 dark:text-gray-400">Active Residents</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-briefcase text-lg text-purple-600 dark:text-purple-400"></i>
          </div>
          <div>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $stats['total_staff'] }}</p>
            <p class="-mt-1 text-xs text-gray-500 dark:text-gray-400">Total Staff</p>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Contact Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-phone text-primary"></i>
            Contact Information
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
              <i class="lni lni-phone text-gray-500"></i>
            </div>
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Phone</p>
              <p class="-mt-1 font-medium text-gray-900 dark:text-white">{{ $condominium->phone_number ?? '—' }}</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
              <i class="lni lni-envelope text-gray-500"></i>
            </div>
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Email</p>
              <p class="-mt-1  font-medium text-gray-900 dark:text-white">{{ $condominium->email ?? '—' }}</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
              <i class="lni lni-line text-gray-500"></i>
            </div>
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400">LINE ID</p>
              <p class="-mt-1 font-medium text-gray-900 dark:text-white">{{ $condominium->line_id ?? '—' }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Building Details -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-home text-primary"></i>
            Building Details
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
              <i class="lni lni-layers text-gray-500"></i>
            </div>
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Total Floors</p>
              <p class="-mt-1 font-medium text-gray-900 dark:text-white">{{ $condominium->total_floors ?? '—' }} floors
              </p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
              <i class="lni lni-apartment text-gray-500"></i>
            </div>
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Total Units</p>
              <p class="-mt-1 font-medium text-gray-900 dark:text-white">{{ $condominium->total_units ?? '—' }} units</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
              <i class="lni lni-calendar text-gray-500"></i>
            </div>
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400">Built Year</p>
              <p class="-mt-1 font-medium text-gray-900 dark:text-white">{{ $condominium->built_year ?? '—' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
      <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
          <i class="lni lni-bolt text-primary"></i>
          Quick Actions
        </h2>
      </div>
      <div class="p-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
        <a href="{{ route('profile.index') }}?condominium_id={{ $condominium->id }}"
          class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-green-100 hover:border hover:border-green-500 border border-gray-50 dark:hover:bg-gray-600 transition-all">
          <i class="lni lni-users text-2xl text-green-500"></i>
          <span class="text-sm font-medium text-gray-700 dark:text-gray-300">View Residents</span>
        </a>

        <a href="{{ route('staff.index') }}?condominium_id={{ $condominium->id }}"
          class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-purple-100 hover:border hover:border-purple-500 border border-gray-50 dark:hover:bg-gray-600 transition-all">
          <i class="lni lni-briefcase text-2xl text-purple-500"></i>
          <span class="text-sm font-medium text-gray-700 dark:text-gray-300">View Staff</span>
        </a>

        <a href="{{ route('parcels.index') }}?condominium_id={{ $condominium->id }}"
          class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-yellow-50 hover:border hover:border-yellow-400 border border-gray-50 dark:hover:bg-gray-600 transition-all">
          <i class="lni lni-package text-2xl text-yellow-500"></i>
          <span class="text-sm font-medium text-gray-700 dark:text-gray-300">View Parcels</span>
        </a>

        <a href="{{ route('bills.index') }}?condominium_id={{ $condominium->id }}"
          class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-red-50 hover:border hover:border-red-400 border border-gray-50 dark:hover:bg-gray-600 transition-all">
          <i class="lni lni-wallet text-2xl text-red-500"></i>
          <span class="text-sm font-medium text-gray-700 dark:text-gray-300">View Bills</span>
        </a>
      </div>
    </div>

    <!-- Timestamps -->
    <div class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
      Created {{ $condominium->created_at->format('M j, Y') }} · Last updated
      {{ $condominium->updated_at->diffForHumans() }}
    </div>
  </div>
@endsection
@extends('dashboard')

@section('page-title', 'Condominium Management')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Condominium Management</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Manage all condominiums in the system</p>
      </div>
      <a href="{{ route('condominiums.create') }}"
        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary text-white hover:text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
        <i class="lni lni-plus"></i>
        Add Condominium
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
            <i class="lni lni-apartment text-xl text-blue-600 dark:text-blue-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $condominiums->total() }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Condos</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-users text-xl text-green-600 dark:text-green-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $condominiums->sum('residents_count') }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Residents</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-briefcase text-xl text-purple-600 dark:text-purple-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $condominiums->sum('staff_count') }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Staff</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
            <i class="lni lni-home text-xl text-yellow-600 dark:text-yellow-400"></i>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $condominiums->sum('total_units') ?? 0 }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Units</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Condominiums Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Condominium
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Invitation Code
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Residents
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Staff
              </th>
              <th
                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Units
              </th>
              <th
                class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($condominiums as $condo)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <!-- Condominium Info -->
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div
                      class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-semibold">
                      <i class="lni lni-apartment"></i>
                    </div>
                    <div>
                      <p class="mb-1 font-medium text-gray-900 dark:text-white">{{ $condo->name }}</p>
                      <p class="-mt-1 text-sm text-gray-500 dark:text-gray-400 truncate max-w-[200px]">{{ $condo->address }}</p>
                    </div>
                  </div>
                </td>

                <!-- Invitation Code -->
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <code
                      class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-sm font-mono text-gray-800 dark:text-gray-200">
                          {{ $condo->code }}
                        </code>
                    <form action="{{ route('condominiums.regenerate-code', $condo) }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="p-1 text-gray-400 hover:text-primary" title="Regenerate Code">
                        <i class="lni lni-reload text-sm"></i>
                      </button>
                    </form>
                  </div>
                </td>

                <!-- Residents Count -->
                <td class="px-6 py-4">
                  <span
                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                    {{ $condo->residents_count }} residents
                  </span>
                </td>

                <!-- Staff Count -->
                <td class="px-6 py-4">
                  <span
                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                    {{ $condo->staff_count }} staff
                  </span>
                </td>

                <!-- Units -->
                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                  {{ $condo->total_units ?? '—' }} units
                </td>

                <!-- Actions -->
                <td class="px-6 py-4">
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('condominiums.show', $condo) }}"
                      class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                      title="View">
                      <i class="lni lni-eye"></i>
                    </a>
                    <a href="{{ route('condominiums.edit', $condo) }}"
                      class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                      title="Edit">
                      <i class="lni lni-pencil"></i>
                    </a>
                    <form action="{{ route('condominiums.destroy', $condo) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this condominium?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="p-2 text-gray-500 hover:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                        title="Delete">
                        <i class="lni lni-trash-can"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-12 text-center">
                  <div class="flex flex-col items-center">
                    <i class="lni lni-apartment text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">No condominiums found</p>
                    <a href="{{ route('condominiums.create') }}" class="text-primary hover:underline mt-2">Add your first
                      condominium</a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($condominiums->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
          {{ $condominiums->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection
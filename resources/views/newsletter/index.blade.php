@extends('layouts.dashboard')

@section('page-title', 'Newsletter Subscribers')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Newsletter Subscribers</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Manage newsletter subscribers and send campaigns</p>
      </div>
      <div class="mt-4 md:mt-0">
        <a href="{{ route('newsletter.create') }}"
          class="inline-flex items-center px-4 py-2 bg-primary text-white hover:text-white rounded-lg hover:bg-primary-dark transition-colors">
          <i class="lni lni-envelope mr-2"></i>
          Send Newsletter
        </a>
      </div>
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
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Total Subscribers</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['total'] }}</p>
          </div>
          <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
            <i class="lni lni-users text-blue-600 dark:text-blue-300 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Latest Subscriber</p>
            <p class="text-lg font-bold text-gray-800 dark:text-white mt-1">
              {{ $subscribers->first()->name ?? 'N/A' }}
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">
              {{ $subscribers->first() ? $subscribers->first()->created_at->diffForHumans() : '' }}
            </p>
          </div>
          <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
            <i class="lni lni-user text-green-600 dark:text-green-300 text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Subscribers Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Name</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Email</th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Subscribed At</th>
              <th
                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($subscribers as $subscriber)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-semibold">
                      {{ strtoupper(substr($subscriber->name, 0, 1)) }}
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $subscriber->name }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 dark:text-white">{{ $subscriber->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 dark:text-white">{{ $subscriber->created_at->format('M d, Y') }}</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">{{ $subscriber->created_at->diffForHumans() }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <form action="{{ route('newsletter.destroy', $subscriber) }}" method="POST" class="inline"
                    onsubmit="return confirm('Are you sure you want to delete this subscriber?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400" title="Delete">
                      <i class="lni lni-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-6 py-12 text-center">
                  <i class="lni lni-inbox text-4xl text-gray-400 mb-4"></i>
                  <p class="text-gray-500 dark:text-gray-400">No subscribers yet</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        {{ $subscribers->links() }}
      </div>
    </div>
  </div>
@endsection
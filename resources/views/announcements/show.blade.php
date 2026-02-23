@extends('layouts.dashboard')

@section('page-title', $announcement->title)

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center">
        <a href="{{ route('announcements.index') }}"
          class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
          <i class="lni lni-arrow-left text-xl"></i>
        </a>
        <div>
          <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Announcement Details</h1>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Posted by {{ $announcement->creator->name }}</p>
        </div>
      </div>

      <!-- Staff Actions -->
      @if (Auth::user()->isStaff() || Auth::user()->isAdmin())
        <div class="flex gap-3">
          <a href="{{ route('announcements.edit', $announcement) }}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors flex items-center gap-2">
            <i class="lni lni-pencil"></i>
            Edit
          </a>
          <form action="{{ route('announcements.destroy', $announcement) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this announcement?')">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors flex items-center gap-2">
              <i class="lni lni-trash"></i>
              Delete
            </button>
          </form>
        </div>
      @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Content -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Featured Image -->
        @if ($announcement->image)
          <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md">
            <img src="{{ Storage::url($announcement->image) }}" alt="{{ $announcement->title }}"
              class="w-full h-96 object-cover">
          </div>
        @endif

        <!-- Title & Badges -->

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
          <div class="flex flex-wrap items-left gap-3 mb-4">
            <!-- Category Badge -->
            <span class="px-4 py-1.5 {{ $announcement->getCategoryBadgeColor() }} text-sm font-semibold rounded-full">
              {{ $announcement->getCategoryLabel() }}
            </span>

            <!-- Priority Badge -->
            <span class="px-4 py-1.5 {{ $announcement->getPriorityBadgeColor() }} text-sm font-semibold rounded-full">
              {{ $announcement->getPriorityLabel() }}
            </span>

            <!-- Status Badge -->
            @if ($announcement->isExpired())
              <span class="px-4 py-1.5 bg-red-500 text-white text-sm font-semibold rounded-full">
                Expired
              </span>
            @elseif (!$announcement->isPublished())
              <span class="px-4 py-1.5 bg-gray-500 text-white text-sm font-semibold rounded-full">
                Draft
              </span>
            @else
              <span class="px-4 py-1.5 bg-green-500 text-white text-sm font-semibold rounded-full">
                Active
              </span>
            @endif
          </div>

          <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
            {{ $announcement->title }}
          </h1>

          <!-- Meta Information -->
          <div
            class="flex flex-wrap items-center gap-6 text-sm text-gray-600 dark:text-gray-400 pb-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-2">
              <i class="lni lni-user text-primary"></i>
              <span>{{ $announcement->creator->name }}</span>
            </div>
            <div class="flex items-center gap-2">
              <i class="lni lni-calendar text-primary"></i>
              <span>{{ $announcement->start_date->format('M d, Y') }}</span>
            </div>
            @if ($announcement->condominium)
              <div class="flex items-center gap-2">
                <i class="lni lni-apartment text-primary"></i>
                <span>{{ $announcement->condominium->name }}</span>
              </div>
            @endif
            <div class="flex items-center gap-2">
              <i class="lni lni-users text-primary"></i>
              <span>{{ ucfirst($announcement->target_audience) }}</span>
            </div>
          </div>

          <!-- Description -->
          <div class="mt-6 prose prose-lg dark:prose-invert max-w-none">
            <div class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
              {{ $announcement->description }}
            </div>
          </div>
        </div>

        <!-- Additional Information (if needed) -->
        @if ($announcement->end_date)
          <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 rounded-lg p-4">
            <div class="flex items-center gap-3">
              <i class="lni lni-alarm text-blue-500 text-2xl"></i>
              <div>
                <p class="font-semibold text-blue-800 dark:text-blue-300">Valid Until</p>
                <p class="text-sm text-blue-700 dark:text-blue-400">
                  {{ $announcement->end_date->format('l, F j, Y') }}
                  @if ($announcement->end_date->isFuture())
                    ({{ $announcement->end_date->diffForHumans() }})
                  @endif
                </p>
              </div>
            </div>
          </div>
        @endif
      </div>

      <!-- Sidebar -->
      <div class="lg:col-span-1 space-y-6">
        <!-- Quick Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
          <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
            <i class="lni lni-information text-primary"></i>
            Quick Information
          </h3>

          <div class="space-y-4">
            <!-- Posted Date -->
            <div>
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Posted On</p>
              <p class="font-semibold text-gray-800 dark:text-white">
                {{ $announcement->created_at->format('F j, Y') }}
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                {{ $announcement->created_at->diffForHumans() }}
              </p>
            </div>

            <!-- Start Date -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Effective From</p>
              <p class="font-semibold text-gray-800 dark:text-white">
                {{ $announcement->start_date->format('F j, Y') }}
              </p>
            </div>

            <!-- End Date -->
            @if ($announcement->end_date)
              <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Valid Until</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                  {{ $announcement->end_date->format('F j, Y') }}
                </p>
              </div>
            @else
              <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Validity</p>
                <p class="font-semibold text-green-600 dark:text-green-400">
                  No Expiry Date
                </p>
              </div>
            @endif

            <!-- Category -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Category</p>
              <span
                class="inline-block px-3 py-1 {{ $announcement->getCategoryBadgeColor() }} text-sm font-semibold rounded-full">
                {{ $announcement->getCategoryLabel() }}
              </span>
            </div>

            <!-- Priority -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Priority Level</p>
              <span
                class="inline-block px-3 py-1 {{ $announcement->getPriorityBadgeColor() }} text-sm font-semibold rounded-full">
                {{ $announcement->getPriorityLabel() }}
              </span>
            </div>

            <!-- Condominium -->
            @if ($announcement->condominium)
              <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Condominium</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                  {{ $announcement->condominium->name }}
                </p>
              </div>
            @endif

            <!-- Target Audience -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Target Audience</p>
              <p class="font-semibold text-gray-800 dark:text-white">
                {{ ucfirst($announcement->target_audience) }}
              </p>
            </div>
          </div>
        </div>

        <!-- Notification Settings (Staff/Admin Only) -->
        @if (Auth::user()->isStaff() || Auth::user()->isAdmin())
          <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
              <i class="lni lni-bullhorn text-primary"></i>
              Notifications
            </h3>

            <div class="space-y-3">
              <div class="flex items-center gap-3">
                @if ($announcement->send_email)
                  <i class="lni lni-checkmark-circle text-green-500 text-xl"></i>
                  <span class="text-gray-700 dark:text-gray-300">Email notification sent</span>
                @else
                  <i class="lni lni-close text-gray-400 text-xl"></i>
                  <span class="text-gray-500 dark:text-gray-400">No email notification</span>
                @endif
              </div>

              <div class="flex items-center gap-3">
                @if ($announcement->send_push)
                  <i class="lni lni-checkmark-circle text-green-500 text-xl"></i>
                  <span class="text-gray-700 dark:text-gray-300">Push notification sent</span>
                @else
                  <i class="lni lni-close text-gray-400 text-xl"></i>
                  <span class="text-gray-500 dark:text-gray-400">No push notification</span>
                @endif
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
      <a href="{{ route('announcements.index') }}"
        class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
        <i class="lni lni-arrow-left"></i>
        Back to All Announcements
      </a>
    </div>
  </div>

  @push('scripts')
    <script>
      function copyLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
          alert('Link copied to clipboard!');
        }).catch(err => {
          console.error('Failed to copy:', err);
        });
      }
    </script>
  @endpush
@endsection
@extends('layouts.dashboard')

@section('page-title', 'Announcements')

@section('content')
  <!-- Page Header -->
  <div class="mb-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Community Announcements</h1>
        <p class="text-gray-600 dark:text-gray-400">Stay updated with the latest news and events</p>
      </div>
      <!-- Tailwind Safelist - Hidden -->
      <div
        class="hidden bg-red-500 bg-red-600 bg-purple-500 bg-orange-500 bg-blue-500 bg-green-500 bg-teal-500 bg-indigo-500 bg-gray-500">
      </div>
      @if(Auth::user()->isStaff() || Auth::user()->isAdmin())
        <a href="{{ route('announcements.create') }}"
          class="px-6 py-3 bg-primary hover:bg-blue-700 hover:text-white text-white font-medium rounded-lg transition-colors flex items-center gap-2 shadow-md hover:shadow-lg">
          <i class="lni lni-plus"></i>
          Create Announcement
        </a>
      @endif
    </div>
  </div>

  <!-- Success Message -->
  @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded-lg">
      <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
    </div>
  @endif

  <!-- Filter Tabs -->
  <div class="bg-white dark:bg-gray-800 rounded-xl p-4 mb-6 shadow-md">
    <form method="GET" action="{{ route('announcements.index') }}">
      <!-- Mobile: Horizontal Scroll -->
      <div class="md:hidden overflow-x-auto -mx-4 px-4 pb-2">
        <div class="flex gap-2 min-w-max">
          <button type="submit" name="category" value=""
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            All Announcements
          </button>
          <button type="submit" name="category" value="important"
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ request('category') == 'important' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            Important
          </button>
          <button type="submit" name="category" value="event"
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ request('category') == 'event' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            Events
          </button>
          <button type="submit" name="category" value="maintenance"
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ request('category') == 'maintenance' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            Maintenance
          </button>
          <button type="submit" name="category" value="update"
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ request('category') == 'update' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            Updates
          </button>
          <button type="submit" name="category" value="security"
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ request('category') == 'security' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            Security
          </button>
          <button type="submit" name="category" value="community"
            class="px-4 py-2 rounded-lg whitespace-nowrap {{ request('category') == 'community' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
            Community
          </button>
        </div>
      </div>

      <!-- Desktop: Wrapped Layout -->
      <div class="hidden md:flex flex-wrap gap-2">
        <button type="submit" name="category" value=""
          class="px-4 py-2 rounded-lg {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          All Announcements
        </button>
        <button type="submit" name="category" value="important"
          class="px-4 py-2 rounded-lg {{ request('category') == 'important' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          Important
        </button>
        <button type="submit" name="category" value="event"
          class="px-4 py-2 rounded-lg {{ request('category') == 'event' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          Events
        </button>
        <button type="submit" name="category" value="maintenance"
          class="px-4 py-2 rounded-lg {{ request('category') == 'maintenance' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          Maintenance
        </button>
        <button type="submit" name="category" value="update"
          class="px-4 py-2 rounded-lg {{ request('category') == 'update' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          Updates
        </button>
        <button type="submit" name="category" value="security"
          class="px-4 py-2 rounded-lg {{ request('category') == 'security' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          Security
        </button>
        <button type="submit" name="category" value="community"
          class="px-4 py-2 rounded-lg {{ request('category') == 'community' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }} font-medium text-sm transition-colors">
          Community
        </button>
      </div>
    </form>
  </div>

  <!-- Announcements Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($announcements as $announcement)
      <!-- Announcement Card -->
      <article
        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group">

        <!-- Image -->
        <div class="relative h-56 overflow-hidden">
          @if($announcement->image)
            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
          @else
            <!-- Fallback gradient background if no image -->
            <div
              class="w-full h-full bg-gradient-to-br {{ $announcement->getCategoryBadgeColor() }} flex items-center justify-center">
              <i class="lni lni-bullhorn text-8xl text-white opacity-20"></i>
            </div>
          @endif

          <!-- Priority Badge -->
          <span
            class="absolute top-3 left-3 px-3 py-1 {{ $announcement->getPriorityBadgeColor() }} text-xs font-semibold rounded-full">
            {{ $announcement->getPriorityLabel() }}
          </span>

          <!-- Category Badge -->
          <span
            class="absolute top-3 right-3 px-3 py-1 {{ $announcement->getCategoryBadgeColor() }} text-xs font-semibold rounded-full">
            {{ $announcement->getCategoryLabel() }}
          </span>

          <!-- Date Badge -->
          <div class="absolute bottom-3 left-3 bg-white dark:bg-gray-800 rounded-lg px-3 py-1.5 shadow-md">
            <div class="flex items-center gap-2 text-xs">
              <i class="lni lni-calendar text-primary"></i>
              <span
                class="font-medium text-gray-700 dark:text-gray-300">{{ $announcement->start_date->format('M d, Y') }}</span>
            </div>
          </div>

          <!-- Status Badges -->
          @if($announcement->isExpired())
            <span class="absolute top-12 left-3 px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">
              Expired
            </span>
          @elseif(!$announcement->isPublished())
            <span class="absolute top-12 left-3 px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full">
              Draft
            </span>
          @endif
        </div>

        <!-- Content -->
        <div class="p-5">
          <h3
            class="text-lg font-bold text-gray-800 dark:text-white mb-2 line-clamp-2 group-hover:text-primary transition-colors">
            {{ $announcement->title }}
          </h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
            {{ $announcement->excerpt }}
          </p>

          <!-- Footer -->
          <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
              <i class="lni lni-user"></i>
              <span>{{ $announcement->creator->name }}</span>
            </div>
            @if($announcement->condominium)
              <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <i class="lni lni-apartment"></i>
                <span>{{ $announcement->condominium->name }}</span>
              </div>
            @endif
          </div>

          <!-- View Button -->
          <a href="{{ route('announcements.show', $announcement) }}"
            class="mt-4 w-full block text-center px-4 py-2 bg-primary/10 hover:bg-primary text-primary hover:text-white font-medium text-sm rounded-lg transition-colors">
            View Details
          </a>

          <!-- Staff Action Buttons -->
          @if(Auth::user()->isStaff() || Auth::user()->isAdmin())
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex gap-2">
              <a href="{{ route('announcements.edit', $announcement) }}"
                class="flex-1 px-3 py-2 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium text-sm rounded-lg transition-colors flex items-center justify-center gap-2">
                <i class="lni lni-pencil"></i>
                Edit
              </a>
              <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" class="flex-1"
                onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="w-full px-3 py-2 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400 font-medium text-sm rounded-lg transition-colors flex items-center justify-center gap-2">
                  <i class="lni lni-trash"></i>
                  Delete
                </button>
              </form>
            </div>
          @endif
        </div>
      </article>
    @empty
      <div class="col-span-full bg-white dark:bg-gray-800 rounded-xl shadow-md p-12 text-center">
        <i class="lni lni-bullhorn text-6xl text-gray-400 mb-4"></i>
        <p class="text-gray-500 dark:text-gray-400 text-lg mb-2">No announcements found</p>
        <p class="text-gray-400 dark:text-gray-500 text-sm">Check back later for community updates</p>
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  <div class="mt-8">
    {{ $announcements->links() }}
  </div>
@endsection
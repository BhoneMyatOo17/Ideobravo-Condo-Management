@include('components.login-loading')

@extends('layouts.dashboard')

@section('page-title', 'Dashboard')


@section('content')
    <!-- Welcome Card -->
    <div class="bg-primary bg-rings rounded-t-xl p-6 mb-6 text-white">
        <h2 class="text-2xl font-bold mb-2 text-white">Welcome back, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-blue-100">Here's what's happening...</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Announcements Card -->
        <a href="{{ route('announcements.index') }}"
            class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <i class="lni lni-bullhorn text-2xl text-primary"></i>
                </div>
                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-primary text-sm font-semibold rounded-full">
                    {{ $stats['announcements']['count'] ?? 0 }} {{ $stats['announcements']['label'] ?? 'New' }}
                </span>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Announcements</h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Latest updates from management</p>
        </a>

        <!-- Parcels Card -->
        <a href="{{ Auth::user()->isResident() ? route('parcels.my-parcels') : route('parcels.index') }}"
            class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <i class="lni lni-package text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <span
                    class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 text-sm font-semibold rounded-full">
                    {{ $stats['parcels']['count'] ?? 0 }} {{ $stats['parcels']['label'] ?? 'Ready' }}
                </span>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">
                @if(Auth::user()->isResident())
                    My Parcels
                @else
                    Parcels
                @endif
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                @if(Auth::user()->isResident())
                    Packages ready for pickup
                @else
                    Manage resident parcels
                @endif
            </p>
        </a>

        <!-- Bills Card -->
        <a href="{{ Auth::user()->isResident() ? route('my-bills.index') : route('bills.index') }}"
            class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                    <i class="lni lni-credit-cards text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <span
                    class="px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-400 text-sm font-semibold rounded-full">
                    @if(Auth::user()->isResident() && isset($stats['bills']['next_due']))
                        Due {{ $stats['bills']['next_due']->due_date->format('M d') }}
                    @else
                        {{ $stats['bills']['count'] ?? 0 }} {{ $stats['bills']['label'] ?? 'Pending' }}
                    @endif
                </span>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">
                @if(Auth::user()->isResident())
                    My Bills
                @else
                    Bills
                @endif
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                @if(Auth::user()->isResident())
                    {{ $stats['bills']['count'] ?? 0 }} pending payment(s)
                @else
                    Manage resident billing
                @endif
            </p>
        </a>
    </div>

    <!-- Feature Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Announcements Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Recent Announcements</h3>

            @if(isset($announcements) && $announcements->count() > 0)
                <div class="space-y-4">
                    @foreach($announcements as $announcement)
                        <a href="{{ route('announcements.show', $announcement) }}"
                            class="block p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="font-semibold text-gray-800 dark:text-white">{{ $announcement->title }}</h4>
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300">
                                    {{ ucfirst($announcement->category) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                {{ Str::limit($announcement->content, 100) }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-500">
                                {{ $announcement->created_at->diffForHumans() }}
                            </p>
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('announcements.index') }}"
                    class="mt-4 inline-block text-primary hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
                    View All Announcements →
                </a>
            @else
                <div class="text-center py-8">
                    <i class="lni lni-bullhorn text-5xl text-gray-300 dark:text-gray-600 mb-3"></i>
                    <p class="text-gray-500 dark:text-gray-400">No announcements at the moment</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Quick Actions</h3>

            <div class="grid grid-cols-2 gap-4">
                @if(Auth::user()->isResident())
                    <!-- Resident Quick Actions -->
                    <a href="{{ route('my-bills.index') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-credit-cards text-3xl text-blue-600 dark:text-blue-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">View Bills</span>
                    </a>

                    <a href="{{ route('parcels.my-parcels') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-green-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-package text-3xl text-green-600 dark:text-green-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">My Parcels</span>
                    </a>

                    <a href="{{ route('announcements.index') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-purple-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-bullhorn text-3xl text-purple-600 dark:text-purple-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Announcements</span>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-user text-3xl text-gray-600 dark:text-gray-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">My Profile</span>
                    </a>

                @elseif(Auth::user()->isStaff())
                    <!-- Staff Quick Actions -->
                    <a href="{{ route('parcels.create') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-green-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-package text-3xl text-green-600 dark:text-green-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Register Parcel</span>
                    </a>

                    <a href="{{ route('bills.create') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-credit-cards text-3xl text-blue-600 dark:text-blue-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Create Bill</span>
                    </a>

                    <a href="{{ route('announcements.create') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-purple-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-bullhorn text-3xl text-purple-600 dark:text-purple-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">New Announcement</span>
                    </a>

                    <a href="{{ route('profile.index') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-users text-3xl text-gray-600 dark:text-gray-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Residents</span>
                    </a>

                @else
                    <!-- Admin Quick Actions -->
                    <a href="{{ route('condominiums.index') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-apartment text-3xl text-blue-600 dark:text-blue-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Condominiums</span>
                    </a>

                    <a href="{{ route('dashboard') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-green-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-bar-chart text-3xl text-green-600 dark:text-green-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Reports</span>
                    </a>

                    <a href="{{ route('profile.index') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-purple-50 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-briefcase text-3xl text-purple-600 dark:text-purple-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">Staff</span>
                    </a>

                    <a href="{{ route('profile.index') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors group">
                        <i
                            class="lni lni-users text-3xl text-gray-600 dark:text-gray-400 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">All Users</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
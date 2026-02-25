@extends('layouts.dashboard')

@section('page-title', 'Parcel Details')

@section('content')
    <div class="container-fluid px-6 py-8">
        <!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center">
        <a href="{{ route('parcels.index') }}"
            class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
            <i class="lni lni-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Parcel Details</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                Tracking: {{ $parcel->tracking_number ?? 'N/A' }}
            </p>
        </div>
    </div>

    <!-- Action Buttons (Staff/Admin) -->
    @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
        <div class="flex flex-wrap gap-3">
            @if($parcel->status != 'picked_up')
                <form action="{{ route('parcels.mark-picked-up', $parcel) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Mark this parcel as picked up?')"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center gap-2 whitespace-nowrap">
                        <i class="lni lni-checkmark-circle"></i>
                        Mark as Picked Up
                    </button>
                </form>
            @endif

            <a href="{{ route('parcels.edit', $parcel) }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 hover:text-white text-white rounded-lg transition-colors flex items-center gap-2 whitespace-nowrap">
                <i class="lni lni-pencil"></i>
                Edit
            </a>

            <form action="{{ route('parcels.destroy', $parcel) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this parcel?')"
                    class="px-4 py-2 hidden md:block bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors flex items-center gap-2 whitespace-nowrap">
                    <i class="lni lni-warning"></i>
                    Delete
                </button>
            </form>
        </div>
    @endif
</div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Parcel Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Parcel Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tracking
                                Number</label>
                            <p class="text-gray-900 dark:text-white font-medium">
                                {{ $parcel->tracking_number ?? 'Not provided' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Courier
                                Service</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $parcel->courier_service }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                            <span
                                class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ $parcel->getStatusBadgeColor() }}">
                                {{ $parcel->getStatusLabel() }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Received
                                Date</label>
                            <p class="text-gray-900 dark:text-white">{{ $parcel->received_date->format('M d, Y') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $parcel->received_date->diffForHumans() }}</p>
                        </div>

                        @if($parcel->picked_up_date)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Picked Up
                                    Date</label>
                                <p class="text-gray-900 dark:text-white">{{ $parcel->picked_up_date->format('M d, Y H:i') }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $parcel->picked_up_date->diffForHumans() }}</p>
                            </div>
                        @endif

                        @if($parcel->days_since_received > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Days Since
                                    Received</label>
                                <p class="text-gray-900 dark:text-white font-medium">
                                    {{ $parcel->days_since_received }}
                                    <span class="text-sm">{{ Str::plural('day', $parcel->days_since_received) }}</span>
                                    @if($parcel->days_since_received > 7)
                                        <span class="ml-2 text-xs text-orange-600 dark:text-orange-400">(Long storage)</span>
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>

                    @if($parcel->notes)
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Notes</label>
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $parcel->notes }}</p>
                        </div>
                    @endif
                </div>
            <!-- Parcel Image -->
            @if($parcel->image)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Parcel Image</h3>
                <div class="relative">
                    <img src="{{ Storage::url($parcel->image) }}" alt="Parcel image"
                        class="w-full max-h-96 object-contain rounded-lg border border-gray-300 dark:border-gray-600"
                        onerror="this.closest('.bg-white, .dark\\:bg-gray-800').style.display='none'">
                </div>
            </div>
        @endif
                <!-- Staff Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Processing Information</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Received
                                By</label>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                    <i class="lni lni-user text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 dark:text-white font-medium">
                                        {{ $parcel->receivedByStaff->name ?? 'System' }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Staff Member</p>
                                </div>
                            </div>
                        </div>

                        @if($parcel->picked_up_by && $parcel->pickedUpByResident)
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Picked Up
                                    By</label>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                                        <i class="lni lni-checkmark-circle text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-900 dark:text-white font-medium">
                                            {{ $parcel->pickedUpByResident->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $parcel->picked_up_date->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Resident Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recipient Details</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Recipient
                                Name</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $parcel->recipient_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Room
                                Number</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $parcel->unit_number }}</p>
                        </div>

                        @if($parcel->resident)
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Registered
                                    Resident</label>
                                <div
                                    class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3 border border-green-200 dark:border-green-800">
                                    <p class="text-sm text-green-800 dark:text-green-200 mb-1">
                                        <i class="lni lni-checkmark-circle mr-1"></i>
                                        Matched to registered resident
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $parcel->resident->user->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $parcel->resident->user->email }}</p>
                                    @if($parcel->resident->phone_number)
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $parcel->resident->phone_number }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div
                                    class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <i class="lni lni-information mr-1"></i>
                                        Not linked to a registered resident account
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Timeline</h3>

                    <div class="space-y-4">
                        <!-- Received -->
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center">
                                    <i class="lni lni-package text-blue-600 dark:text-blue-400 text-sm"></i>
                                </div>
                                @if($parcel->status != 'received')
                                    <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-2"></div>
                                @endif
                            </div>
                            <div class="pb-6">
                                <p class="font-medium text-gray-900 dark:text-white">Parcel Received</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $parcel->received_date->format('M d, Y H:i') }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">by
                                    {{ $parcel->receivedByStaff->name ?? 'System' }}</p>
                            </div>
                        </div>

                        <!-- Notified -->
                        @if(in_array($parcel->status, ['notified', 'picked_up']))
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900/20 flex items-center justify-center">
                                        <i class="lni lni-bell text-yellow-600 dark:text-yellow-400 text-sm"></i>
                                    </div>
                                    @if($parcel->status != 'notified')
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-2"></div>
                                    @endif
                                </div>
                                <div class="pb-6">
                                    <p class="font-medium text-gray-900 dark:text-white">Resident Notified</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $parcel->notified_at ? $parcel->notified_at->format('M d, Y H:i') : 'Via system' }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Picked Up -->
                        @if($parcel->status == 'picked_up')
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                                        <i class="lni lni-checkmark-circle text-green-600 dark:text-green-400 text-sm"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Picked Up</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $parcel->picked_up_date->format('M d, Y H:i') }}</p>
                                    @if($parcel->pickedUpByResident)
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">by
                                            {{ $parcel->pickedUpByResident->name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Quick Actions</h3>

                        <div class="space-y-3">
                            @if($parcel->status != 'picked_up')
                                <form action="{{ route('parcels.mark-picked-up', $parcel) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Mark as picked up?')"
                                        class="w-full px-4 py-2 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg transition-colors flex items-center justify-center gap-2">
                                        <i class="lni lni-checkmark-circle"></i>
                                        Mark as Picked Up
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('parcels.edit', $parcel) }}"
                                class="block w-full px-4 py-2 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg transition-colors text-center">
                                <i class="lni lni-pencil mr-2"></i>
                                Edit Parcel
                            </a>

                            <button onclick="window.print()"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg transition-colors">
                                <i class="lni lni-printer mr-2"></i>
                                Print Details
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
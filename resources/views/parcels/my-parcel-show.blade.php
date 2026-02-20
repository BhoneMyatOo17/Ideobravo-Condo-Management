@extends('layouts.dashboard')

@section('page-title', 'Parcel Details')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center mb-6">
      <a href="{{ route('parcels.my-parcels') }}"
        class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
        <i class="lni lni-arrow-left text-xl"></i>
      </a>
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Parcel Details</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $parcel->tracking_number }}</p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Details -->
      <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Parcel Information</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tracking Number</label>
              <p class="text-gray-900 dark:text-white font-medium font-mono">{{ $parcel->tracking_number }}</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Courier</label>
              <p class="text-gray-900 dark:text-white">{{ $parcel->courier_service }}</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
              <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ $parcel->getStatusBadgeColor() }}">
                {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
              </span>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Received Date</label>
              <p class="text-gray-900 dark:text-white">{{ $parcel->received_date->format('F d, Y') }}</p>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ $parcel->received_date->format('h:i A') }}</p>
            </div>

            @if($parcel->picked_up_date)
              <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Picked Up Date</label>
                <p class="text-gray-900 dark:text-white">{{ $parcel->picked_up_date->format('F d, Y') }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $parcel->picked_up_date->format('h:i A') }}</p>
              </div>
            @endif

            @if($parcel->notes)
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Notes</label>
                <p class="text-gray-900 dark:text-white">{{ $parcel->notes }}</p>
              </div>
            @endif
          </div>

          <!-- Parcel Image -->
          @if($parcel->image)
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Parcel Image</label>
              <div class="max-w-md">
                <img src="{{ Storage::url($parcel->image) }}" alt="Parcel image"
                  class="w-full rounded-lg shadow-lg cursor-pointer hover:opacity-90 transition"
                  onclick="document.getElementById('imageModal').classList.remove('hidden')">
              </div>
            </div>

            <!-- Image Modal -->
            <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 items-center justify-center p-4"
              onclick="this.classList.add('hidden')">
              <div class="max-w-4xl w-full">
                <img src="{{ Storage::url($parcel->image) }}" alt="Parcel image" class="w-full rounded-lg">
              </div>
            </div>
          @endif

          <!-- QR Code for Pickup Verification -->
          @if($parcel->status === 'pending' || $parcel->status === 'notified')
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pickup Verification</h3>

              <div class="bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <div class="flex flex-col md:flex-row items-center gap-6">
                  <!-- QR Code Image -->
                  <div class="flex-shrink-0">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                      <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('parcels.show', $parcel->id)) }}"
                        alt="Pickup QR Code" class="w-[200px] h-[200px]">
                    </div>
                    <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-2">Parcel #{{ $parcel->id }}</p>
                  </div>

                  <!-- Instructions -->
                  <div class="flex-1 text-center md:text-left">
                    <h4 class="text-base font-semibold text-gray-800 dark:text-white mb-2">
                      <i class="lni lni-qrcode text-primary mr-2"></i>Scan to Verify Pickup
                    </h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                      Present this QR code to the juristic office staff when picking up your parcel. Staff will scan it to
                      verify and confirm pickup.
                    </p>
                    <div class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                      <p><i class="lni lni-checkmark-circle text-green-600 mr-2"></i>Quick verification process</p>
                      <p><i class="lni lni-checkmark-circle text-green-600 mr-2"></i>Secure pickup confirmation</p>
                      <p><i class="lni lni-checkmark-circle text-green-600 mr-2"></i>Instant status update</p>
                    </div>
                    <div
                      class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                      <p class="text-xs text-blue-800 dark:text-blue-200">
                        <i class="lni lni-information mr-1"></i>
                        <strong>Note:</strong> Staff can also verify with your ID card if needed
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pickup Instructions -->
            <div class="mt-6">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pickup Instructions</h3>
              <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <p class="text-sm text-blue-800 dark:text-blue-200 mb-3">
                  <i class="lni lni-information mr-2"></i>
                  Your parcel is ready for pickup at the juristic office.
                </p>
                <div class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                  <p><strong>Location:</strong> Juristic Office, Ground Floor</p>
                  <p><strong>Hours:</strong> Monday - Sunday, 9:00 AM - 6:00 PM</p>
                  <p><strong>Required:</strong> Please bring your ID card or unit key for verification</p>
                </div>
              </div>
            </div>
          @endif

          @if($parcel->status === 'picked_up')
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
              <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <p class="text-sm text-green-800 dark:text-green-200">
                  <i class="lni lni-checkmark-circle mr-2"></i>
                  This parcel has been picked up on {{ $parcel->picked_up_date->format('F d, Y \a\t h:i A') }}.
                </p>
              </div>
            </div>
          @endif
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Property Info -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Delivery Location</h3>
          <div class="space-y-3">
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Condominium</label>
              <p class="text-gray-900 dark:text-white">{{ $parcel->condominium->name }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Unit Number</label>
              <p class="text-gray-900 dark:text-white">{{ $parcel->unit_number }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Location</label>
              <p class="text-gray-900 dark:text-white">{{ $parcel->condominium->location }}</p>
            </div>
          </div>
        </div>

        <!-- Received By -->
        @if($parcel->receivedByStaff)
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Received By</h3>
            <div class="space-y-3">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                  <i class="lni lni-user text-primary"></i>
                </div>
                <div>
                  <p class="text-gray-900 dark:text-white font-medium">{{ $parcel->receivedByStaff->name }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    @if($parcel->receivedByStaff->isAdmin())
                      Administrator
                    @elseif($parcel->receivedByStaff->isStaff())
                      Juristic Staff
                    @else
                      Staff Member
                    @endif
                  </p>
                </div>
              </div>
            </div>
          </div>
        @endif

        <!-- Contact Help -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Need Help?</h3>
          <div class="space-y-3 text-sm">
            <p class="text-gray-600 dark:text-gray-400">
              If you have questions about this parcel, please contact the juristic office.
            </p>
            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
              <p class="text-gray-700 dark:text-gray-300">
                <i class="lni lni-phone mr-2 text-primary"></i>
                Phone: +66 63126312
              </p>
              <p class="text-gray-700 dark:text-gray-300 mt-2">
                <i class="lni lni-envelope mr-2 text-primary"></i>
                Email: pickup@ideo.co.th
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
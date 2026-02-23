@extends('layouts.dashboard')

@section('page-title', 'Edit Parcel')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center mb-6">
      <a href="{{ route('parcels.index') }}"
        class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
        <i class="lni lni-arrow-left text-xl"></i>
      </a>
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Parcel</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Update parcel information</p>
      </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-3xl">
      <form action="{{ route('parcels.update', $parcel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Recipient Name -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Recipient Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="recipient_name" value="{{ old('recipient_name', $parcel->recipient_name) }}" required
              placeholder="Name as shown on parcel"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('recipient_name') border-red-500 @enderror">
            @error('recipient_name')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Room Number -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Room Number <span class="text-red-500">*</span>
            </label>
            <input type="text" name="room_number" value="{{ old('room_number', $parcel->unit_number) }}" required
              placeholder="e.g., 501, A-1205"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('room_number') border-red-500 @enderror">
            @error('room_number')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Tracking Number -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Tracking Number
            </label>
            <input type="text" name="tracking_number" value="{{ old('tracking_number', $parcel->tracking_number) }}"
              placeholder="Enter tracking number"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('tracking_number') border-red-500 @enderror">
            @error('tracking_number')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Courier Service -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Courier Service <span class="text-red-500">*</span>
            </label>
            <input type="text" name="courier_service" value="{{ old('courier_service', $parcel->courier_service) }}"
              required placeholder="e.g., Kerry, Flash, Ninja Van"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('courier_service') border-red-500 @enderror">
            @error('courier_service')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Received Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Received Date <span class="text-red-500">*</span>
            </label>
            <input type="date" name="received_date"
              value="{{ old('received_date', $parcel->received_date->format('Y-m-d')) }}" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('received_date') border-red-500 @enderror">
            @error('received_date')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Status -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Status <span class="text-red-500">*</span>
            </label>
            <select name="status" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('status') border-red-500 @enderror">
              <option value="received" {{ old('status', $parcel->status) == 'received' ? 'selected' : '' }}>Received
              </option>
              <option value="notified" {{ old('status', $parcel->status) == 'notified' ? 'selected' : '' }}>Notified
              </option>
              <option value="picked_up" {{ old('status', $parcel->status) == 'picked_up' ? 'selected' : '' }}>Picked Up
              </option>
              <option value="returned" {{ old('status', $parcel->status) == 'returned' ? 'selected' : '' }}>Returned
              </option>
            </select>
            @error('status')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Current Parcel Image -->
          @if($parcel->image_path)
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Current Image
              </label>
              <div class="relative inline-block">
                <img src="{{ Storage::url($parcel->image_path) }}" alt="Current parcel image"
                  class="w-48 h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
              </div>
            </div>
          @endif

          <!-- New Parcel Image -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ $parcel->image_path ? 'Replace Image (Optional)' : 'Parcel Image' }}
            </label>
            <div class="flex items-center justify-center w-full">
              <label
                class="flex flex-col w-full border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <div class="flex flex-col items-center justify-center pt-7 pb-6">
                  <i class="lni lni-cloud-upload text-4xl text-gray-400 mb-3"></i>
                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-semibold">Click to upload</span> or drag and drop
                  </p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (MAX. 2MB)</p>
                </div>
                <input type="file" name="image" accept="image/*" class="hidden" id="image-input" />
              </label>
            </div>
            <div id="image-preview" class="mt-4 hidden">
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">New image preview:</p>
              <img id="preview-img" src="" alt="Preview"
                class="w-48 h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
            </div>
            @error('image')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Notes -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
            <textarea name="notes" rows="3"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('notes') border-red-500 @enderror"
              placeholder="Additional notes...">{{ old('notes', $parcel->notes) }}</textarea>
            @error('notes')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
          <div class="flex gap-4">
            <a href="{{ route('parcels.index') }}"
              class="px-6 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
              Cancel
            </a>
            <a href="{{ route('parcels.show', $parcel) }}"
              class="px-6 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
              View Details
            </a>
          </div>
          <button type="submit"
            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            Update Parcel
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('image-input').addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById('preview-img').src = e.target.result;
          document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
      }
    });
  </script>
@endsection
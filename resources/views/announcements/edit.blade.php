@extends('layouts.dashboard')

@section('page-title', 'Edit Announcement')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center mb-6">
      <a href="{{ route('announcements.index') }}"
        class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
        <i class="lni lni-arrow-left text-xl"></i>
      </a>
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Announcement</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Update announcement details</p>
      </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-4xl">
      <form action="{{ route('announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Title -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required
              placeholder="Enter announcement title"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('title') border-red-500 @enderror">
            @error('title')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Description <span class="text-red-500">*</span>
            </label>
            <textarea name="description" rows="8" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('description') border-red-500 @enderror"
              placeholder="Write your announcement description here...">{{ old('description', $announcement->description) }}</textarea>
            @error('description')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Category -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Category <span class="text-red-500">*</span>
            </label>
            <select name="category" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('category') border-red-500 @enderror">
              <option value="">Select Category</option>
              <option value="important" {{ old('category', $announcement->category) == 'important' ? 'selected' : '' }}>
                Important</option>
              <option value="event" {{ old('category', $announcement->category) == 'event' ? 'selected' : '' }}>Event
              </option>
              <option value="maintenance" {{ old('category', $announcement->category) == 'maintenance' ? 'selected' : '' }}>
                Maintenance</option>
              <option value="update" {{ old('category', $announcement->category) == 'update' ? 'selected' : '' }}>Update
              </option>
              <option value="new" {{ old('category', $announcement->category) == 'new' ? 'selected' : '' }}>New</option>
              <option value="eco" {{ old('category', $announcement->category) == 'eco' ? 'selected' : '' }}>Eco</option>
              <option value="security" {{ old('category', $announcement->category) == 'security' ? 'selected' : '' }}>
                Security</option>
              <option value="community" {{ old('category', $announcement->category) == 'community' ? 'selected' : '' }}>
                Community</option>
            </select>
            @error('category')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Priority -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Priority <span class="text-red-500">*</span>
            </label>
            <select name="priority" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('priority') border-red-500 @enderror">
              <option value="normal" {{ old('priority', $announcement->priority) == 'normal' ? 'selected' : '' }}>Normal
              </option>
              <option value="high" {{ old('priority', $announcement->priority) == 'high' ? 'selected' : '' }}>High
              </option>
              <option value="urgent" {{ old('priority', $announcement->priority) == 'urgent' ? 'selected' : '' }}>Urgent
              </option>
            </select>
            @error('priority')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Condominium -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Condominium <span class="text-red-500">*</span>
            </label>
            <select name="condominium_id" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('condominium_id') border-red-500 @enderror">
              <option value="">Select Condominium</option>
              @foreach ($condominiums as $condo)
                <option value="{{ $condo->id }}"
                  {{ old('condominium_id', $announcement->condominium_id) == $condo->id ? 'selected' : '' }}>
                  {{ $condo->name }}
                </option>
              @endforeach
            </select>
            @error('condominium_id')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Start Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Start Date <span class="text-red-500">*</span>
            </label>
            <input type="date" name="start_date"
              value="{{ old('start_date', $announcement->start_date->format('Y-m-d')) }}" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('start_date') border-red-500 @enderror">
            @error('start_date')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- End Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              End Date (Optional)
            </label>
            <input type="date" name="end_date"
              value="{{ old('end_date', $announcement->end_date?->format('Y-m-d')) }}"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('end_date') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty for no expiry</p>
            @error('end_date')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Current Image Preview -->
          @if ($announcement->image)
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Current Image
              </label>
              <div class="relative w-full max-w-md">
                <img src="{{ Storage::url($announcement->image) }}" alt="{{ $announcement->title }}"
                  class="w-full h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                <div class="mt-2 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                  <i class="lni lni-checkmark-circle text-green-500"></i>
                  <span>Image uploaded</span>
                </div>
              </div>
            </div>
          @endif

          <!-- Image Upload -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ $announcement->image ? 'Replace Image (Optional)' : 'Image (Optional)' }}
            </label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" id="image-input"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('image') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Max 5MB (JPEG, PNG, JPG, WEBP)
              @if ($announcement->image)
                - Upload a new image to replace the current one
              @endif
            </p>
            @error('image')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            <!-- New Image Preview -->
            <div id="image-preview" class="mt-4 hidden">
              <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Image Preview:</p>
              <img id="preview-image" src="" alt="Preview"
                class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
            </div>
          </div>

          <!-- Target Audience -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Target Audience
            </label>
            <input type="text" name="target_audience"
              value="{{ old('target_audience', $announcement->target_audience) }}" placeholder="all"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('target_audience') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">e.g., "all", "residents", "floor 5-10"</p>
            @error('target_audience')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Notification Options -->
          <div class="md:col-span-2 space-y-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Notification Options
            </label>
            <label class="flex items-center">
              <input type="checkbox" name="send_email" value="1"
                {{ old('send_email', $announcement->send_email) ? 'checked' : '' }}
                class="rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Send email notification</span>
            </label>
            <label class="flex items-center">
              <input type="checkbox" name="send_push" value="1"
                {{ old('send_push', $announcement->send_push) ? 'checked' : '' }}
                class="rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Send push notification</span>
            </label>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
          <a href="{{ route('announcements.index') }}"
            class="px-6 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
            Cancel
          </a>
          <div class="flex gap-4">
            <a href="{{ route('announcements.show', $announcement) }}"
              class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              View Announcement
            </a>
            <button type="submit"
              class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
              Update Announcement
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      // Image preview on file selection
      document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(event) {
            document.getElementById('preview-image').src = event.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
          };
          reader.readAsDataURL(file);
        } else {
          document.getElementById('image-preview').classList.add('hidden');
        }
      });
    </script>
  @endpush
@endsection
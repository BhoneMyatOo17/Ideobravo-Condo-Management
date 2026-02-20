@extends('layouts.dashboard')

@section('page-title', 'Create Announcement')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center mb-6">
      <a href="{{ route('announcements.index') }}"
        class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
        <i class="lni lni-arrow-left text-xl"></i>
      </a>
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Create Announcement</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Post a new announcement for residents</p>
      </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-4xl">
      <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Title -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="Enter announcement title"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('title') border-red-500 @enderror">
            @error('title')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description (not "content") -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Description <span class="text-red-500">*</span>
            </label>
            <textarea name="description" rows="8" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('description') border-red-500 @enderror"
              placeholder="Write your announcement description here...">{{ old('description') }}</textarea>
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
              <option value="important" {{ old('category') == 'important' ? 'selected' : '' }}>Important</option>
              <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
              <option value="maintenance" {{ old('category') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
              <option value="update" {{ old('category') == 'update' ? 'selected' : '' }}>Update</option>
              <option value="new" {{ old('category') == 'new' ? 'selected' : '' }}>New</option>
              <option value="eco" {{ old('category') == 'eco' ? 'selected' : '' }}>Eco</option>
              <option value="security" {{ old('category') == 'security' ? 'selected' : '' }}>Security</option>
              <option value="community" {{ old('category') == 'community' ? 'selected' : '' }}>Community</option>
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
              <option value="normal" {{ old('priority', 'normal') == 'normal' ? 'selected' : '' }}>Normal</option>
              <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
              <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
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
              @foreach($condominiums as $condo)
                <option value="{{ $condo->id }}" {{ old('condominium_id') == $condo->id ? 'selected' : '' }}>
                  {{ $condo->name }}
                </option>
              @endforeach
            </select>
            @error('condominium_id')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Start Date (not "published_at") -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Start Date <span class="text-red-500">*</span>
            </label>
            <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('start_date') border-red-500 @enderror">
            @error('start_date')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- End Date (not "expires_at") -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              End Date (Optional)
            </label>
            <input type="date" name="end_date" value="{{ old('end_date') }}"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('end_date') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty for no expiry</p>
            @error('end_date')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Image Upload -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Image (Optional)
            </label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('image') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Max 5MB (JPEG, PNG, JPG, WEBP)</p>
            @error('image')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Target Audience -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Target Audience
            </label>
            <input type="text" name="target_audience" value="{{ old('target_audience', 'all') }}" placeholder="all"
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
              <input type="checkbox" name="send_email" value="1" {{ old('send_email') ? 'checked' : '' }}
                class="rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Send email notification</span>
            </label>
            <label class="flex items-center">
              <input type="checkbox" name="send_push" value="1" {{ old('send_push') ? 'checked' : '' }}
                class="rounded border-gray-300 dark:border-gray-600 text-primary focus:ring-primary">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Send push notification</span>
            </label>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
          <a href="{{ route('announcements.index') }}"
            class="px-6 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
            Cancel
          </a>
          <button type="submit"
            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            Create Announcement
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
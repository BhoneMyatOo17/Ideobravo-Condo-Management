@extends('layouts.dashboard')

@section('page-title', 'Send Newsletter')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="mb-6">
      <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
        <a href="{{ route('newsletter.index') }}" class="hover:text-primary">Newsletter</a>
        <i class="lni lni-chevron-right text-xs"></i>
        <span>Send Newsletter</span>
      </div>
      <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Send Newsletter</h1>
      <p class="text-gray-600 dark:text-gray-400 mt-1">Create and send a newsletter to {{ $subscriberCount }}
        subscriber(s)</p>
    </div>

    <!-- Info Alert -->
    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 rounded">
      <div class="flex items-start">
        <i class="lni lni-information text-blue-600 dark:text-blue-400 text-xl mr-3 mt-1"></i>
        <div>
          <p class="text-blue-700 dark:text-blue-400 font-semibold">Newsletter Preview</p>
          <p class="text-blue-600 dark:text-blue-300 text-sm mt-1">This newsletter will be sent to all
            {{ $subscriberCount }} subscribers. Please review carefully before sending.
          </p>
        </div>
      </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
      <form action="{{ route('newsletter.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="p-6 space-y-6">
          <!-- Title -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Newsletter Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('title') border-red-500 @enderror"
              placeholder="e.g., Monthly Update - December 2025">
            @error('title')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Body -->
          <div>
            <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Newsletter Body <span class="text-red-500">*</span>
            </label>
            <textarea name="body" id="body" rows="10" required
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('body') border-red-500 @enderror"
              placeholder="Write your newsletter content here...">{{ old('body') }}</textarea>
            @error('body')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Image Upload -->
          <div>
            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Featured Image (Optional)
            </label>
            <input type="file" name="image" id="image" accept="image/*"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('image') border-red-500 @enderror">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
            @error('image')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Call-to-Action Button -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="button_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Button Text (Optional)
              </label>
              <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('button_text') border-red-500 @enderror"
                placeholder="e.g., Visit Our Website">
              @error('button_text')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="button_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Button Link (Optional)
              </label>
              <input type="url" name="button_link" id="button_link" value="{{ old('button_link') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('button_link') border-red-500 @enderror"
                placeholder="https://example.com">
              @error('button_link')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div
          class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
          <a href="{{ route('newsletter.index') }}"
            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            Cancel
          </a>
          <button type="submit"
            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <i class="lni lni-envelope mr-2"></i>
            Send Newsletter
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
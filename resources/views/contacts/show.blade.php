@extends('layouts.dashboard')

@section('content')
  <div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('contacts.index') }}" class="inline-flex items-center text-primary hover:text-primary-dark">
        <i class="lni lni-arrow-left mr-2"></i>
        Back to Contact Requests
      </a>
    </div>

    @if(session('success'))
      <div
        class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Contact Details -->
      <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
          <!-- Header -->
          <div class="bg-primary bg-rings px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
              <div
                class="h-12 w-12 rounded-full bg-white flex items-center justify-center text-primary font-bold text-lg">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
              </div>
              <div class="ml-4">
                <h2 class="text-xl font-bold text-white">{{ $contact->name }}</h2>
                <p class="text-slate-100 text-sm">Contact Request #{{ $contact->id }}</p>
              </div>
            </div>
            <div>
              @if($contact->isPending())
                <span class="px-3 py-2 text-sm font-semibold rounded-full bg-yellow-400 text-yellow-900">
                  Pending
                </span>
              @else
                <span class="px-3 py-2 text-sm font-semibold rounded-full bg-green-500 text-slate-100">
                  Resolved
                </span>
              @endif
            </div>
          </div>

          <!-- Contact Information -->
          <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
              <div class="flex items-start">
                <i class="lni lni-envelope text-primary text-xl mr-3 mt-1"></i>
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                  <a href="mailto:{{ $contact->email }}" class="text-gray-900 dark:text-white hover:text-primary">
                    {{ $contact->email }}
                  </a>
                </div>
              </div>
              <div class="flex items-start">
                <i class="lni lni-phone text-primary text-xl mr-3 mt-1"></i>
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                  <a href="tel:{{ $contact->phone }}" class="text-gray-900 dark:text-white hover:text-primary">
                    {{ $contact->phone }}
                  </a>
                </div>
              </div>
              <div class="flex items-start">
                <i class="lni lni-map-marker text-primary text-xl mr-3 mt-1"></i>
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Property Interest</p>
                  <p class="text-gray-900 dark:text-white">
                    {{ $contact->property_interest ? ucfirst(str_replace('_', ' ', $contact->property_interest)) : 'Not specified' }}
                  </p>
                </div>
              </div>
              <div class="flex items-start">
                <i class="lni lni-calendar text-primary text-xl mr-3 mt-1"></i>
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Submitted</p>
                  <p class="text-gray-900 dark:text-white">
                    {{ $contact->created_at->format('M d, Y \a\t h:i A') }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Message -->
            <div class="mb-6">
              <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-2">Message</h4>
              <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $contact->message }}</p>
              </div>
            </div>

            @if($contact->isResolved())
              <!-- Resolution Details -->
              <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                  <i class="lni lni-checkmark-circle text-green-500 mr-2"></i>
                  Resolution Details
                </h4>
                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg mb-4">
                  <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $contact->resolution_note }}</p>
                </div>
                <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                  <div class="flex items-center">
                    <i class="lni lni-user mr-2"></i>
                    <span>Resolved by: <strong
                        class="text-gray-900 dark:text-white">{{ $contact->resolver->name ?? 'Unknown' }}</strong></span>
                  </div>
                  <div class="flex items-center">
                    <i class="lni lni-calendar mr-2"></i>
                    <span>{{ $contact->resolved_at->format('M d, Y \a\t h:i A') }}</span>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Sidebar Actions -->
      <div class="lg:col-span-1">
        @if($contact->isPending())
          <!-- Resolve Form -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
              <i class="lni lni-checkmark-circle text-primary mr-2"></i>
              Mark as Resolved
            </h3>
            <form action="{{ route('contacts.resolve', $contact) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="mb-4">
                <label for="resolution_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Resolution Note <span class="text-red-500">*</span>
                </label>
                <textarea id="resolution_note" name="resolution_note" rows="6" required
                  class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white @error('resolution_note') border-red-500 @enderror"
                  placeholder="Describe how this contact request was handled...">{{ old('resolution_note') }}</textarea>
                @error('resolution_note')
                  <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
              </div>

              <button type="submit"
                class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center">
                <i class="lni lni-checkmark mr-2"></i>
                Mark as Resolved
              </button>
            </form>
          </div>
        @else
          <!-- Already Resolved Info -->
          <div
            class="bg-green-50 dark:bg-green-900/20 rounded-lg shadow-lg p-6 border border-green-200 dark:border-green-800">
            <div class="text-center">
              <i class="lni lni-checkmark-circle text-green-500 text-5xl mb-3"></i>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                Request Resolved
              </h3>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                This contact request has been successfully resolved.
              </p>
            </div>
          </div>
        @endif

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mt-6">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
          <div class="space-y-3">
            <a href="mailto:{{ $contact->email }}"
              class="block w-full px-4 py-2 bg-primary hover:bg-primary-dark hover:text-white text-white text-center rounded-lg transition duration-200">
              <i class="lni lni-envelope mr-2"></i>
              Send Email
            </a>
            <a href="tel:{{ $contact->phone }}"
              class="block w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 hover:text-white text-white text-center rounded-lg transition duration-200">
              <i class="lni lni-phone mr-2"></i>
              Call Customer
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
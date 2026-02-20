@extends('dashboard')

@section('page-title', 'Edit ' . $condominium->name)

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('condominiums.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors">
        <i class="lni lni-arrow-left"></i>
        Back to Condominiums
      </a>
    </div>

    <!-- Page Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Condominium</h1>
      <p class="text-gray-500 dark:text-gray-400 mt-1">Update information for {{ $condominium->name }}</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
      <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
        <div class="flex items-start gap-3">
          <i class="lni lni-warning text-red-500 text-xl mt-0.5"></i>
          <div>
            <p class="text-red-700 dark:text-red-400 font-medium mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ route('condominiums.update', $condominium) }}">
      @csrf
      @method('PUT')

      <!-- Basic Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-apartment text-primary"></i>
            Basic Information
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="sm:col-span-2">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Condominium Name <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" value="{{ old('name', $condominium->name) }}" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary @error('name') border-red-500 @enderror">
            </div>

            <!-- Address -->
            <div class="sm:col-span-2">
              <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Address <span class="text-red-500">*</span>
              </label>
              <textarea name="address" id="address" rows="2" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary @error('address') border-red-500 @enderror">{{ old('address', $condominium->address) }}</textarea>
            </div>

            <!-- Invitation Code (Read-only) -->
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Invitation Code
              </label>
              <div class="flex items-center gap-3">
                <code
                  class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-lg font-mono text-gray-800 dark:text-gray-200">
                              {{ $condominium->code }}
                            </code>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                  (Use "Regenerate Code" on the view page to change)
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-phone text-primary"></i>
            Contact Information
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Phone -->
            <div>
              <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone Number
              </label>
              <input type="tel" name="phone_number" id="phone_number"
                value="{{ old('phone_number', $condominium->phone_number) }}" placeholder="+66 2 XXX XXXX"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email
              </label>
              <input type="email" name="email" id="email" value="{{ old('email', $condominium->email) }}"
                placeholder="juristic@example.com"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- LINE ID -->
            <div>
              <label for="line_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                LINE ID
              </label>
              <input type="text" name="line_id" id="line_id" value="{{ old('line_id', $condominium->line_id) }}"
                placeholder="@condolineid"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>
          </div>
        </div>
      </div>

      <!-- Building Details -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-home text-primary"></i>
            Building Details
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Total Floors -->
            <div>
              <label for="total_floors" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Total Floors
              </label>
              <input type="number" name="total_floors" id="total_floors"
                value="{{ old('total_floors', $condominium->total_floors) }}" min="1" placeholder="e.g., 35"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Total Units -->
            <div>
              <label for="total_units" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Total Units
              </label>
              <input type="number" name="total_units" id="total_units"
                value="{{ old('total_units', $condominium->total_units) }}" min="1" placeholder="e.g., 500"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Built Year -->
            <div>
              <label for="built_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Built Year
              </label>
              <input type="number" name="built_year" id="built_year"
                value="{{ old('built_year', $condominium->built_year) }}" min="1900" max="{{ date('Y') + 5 }}"
                placeholder="e.g., 2020"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>
          </div>
        </div>
      </div>

      <!-- Form Actions -->
      <div class="flex gap-4 justify-end">
        <a href="{{ route('condominiums.show', $condominium) }}"
          class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
          Cancel
        </a>
        <button type="submit"
          class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
          <i class="lni lni-checkmark"></i>
          Save Changes
        </button>
      </div>
    </form>


  </div>
@endsection
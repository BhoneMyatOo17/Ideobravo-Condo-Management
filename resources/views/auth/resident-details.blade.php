<x-guest-layout>
  <!-- Header -->
  <div class="text-center mb-6">
    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
      <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-bold text-body-light-12 dark:text-body-dark-12 mb-1">
      Complete Your Profile
    </h2>
    <p class="text-sm text-body-light-11 dark:text-body-dark-11">
      {{ $condominium->name }}
    </p>
    <p class="text-xs text-body-light-10 dark:text-body-dark-10 mt-1">
      {{ $condominium->address }}
    </p>
  </div>

  <!-- Resident Details Form -->
  <form method="POST" action="{{ route('resident.complete') }}" class="space-y-3.5">
    @csrf
    <input type="hidden" name="condominium_id" value="{{ $condominium->id }}">

    <!-- Unit Number -->
    <div>
      <label for="unit_number" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
        Unit Number <span class="text-red-500">*</span>
      </label>
      <input id="unit_number" type="text" name="unit_number" value="{{ old('unit_number') }}" required
        placeholder="e.g., 12A, 305, B-1502"
        class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
      <x-input-error :messages="$errors->get('unit_number')" class="mt-1" />
    </div>

    <!-- Floor -->
    <div>
      <label for="floor" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
        Floor (Optional)
      </label>
      <input id="floor" type="text" name="floor" value="{{ old('floor') }}" placeholder="e.g., 12, Ground, B1"
        class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
      <x-input-error :messages="$errors->get('floor')" class="mt-1" />
    </div>

    <!-- Residency Status -->
    <div>
      <label for="residency_status" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
        Residency Status <span class="text-red-500">*</span>
      </label>
      <select id="residency_status" name="residency_status" required
        class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200">
        <option value="">Select status</option>
        <option value="owner" {{ old('residency_status') == 'owner' ? 'selected' : '' }}>Owner</option>
        <option value="tenant" {{ old('residency_status') == 'tenant' ? 'selected' : '' }}>Tenant</option>
      </select>
      <x-input-error :messages="$errors->get('residency_status')" class="mt-1" />
    </div>

    <!-- Move-in Date -->
    <div>
      <label for="move_in_date" class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
        Move-in Date (Optional)
      </label>
      <input id="move_in_date" type="date" name="move_in_date" value="{{ old('move_in_date') }}"
        class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
      <x-input-error :messages="$errors->get('move_in_date')" class="mt-1" />
    </div>

    <!-- Number of Occupants -->
    <div>
      <label for="number_of_occupants"
        class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
        Number of Occupants
      </label>
      <input id="number_of_occupants" type="number" name="number_of_occupants"
        value="{{ old('number_of_occupants', 1) }}" min="1" max="20"
        class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
      <x-input-error :messages="$errors->get('number_of_occupants')" class="mt-1" />
    </div>

    <!-- Emergency Contact Section -->
    <div class="pt-3 border-t border-alpha-light dark:border-alpha-dark">
      <h3 class="text-sm font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">
        Emergency Contact (Optional)
      </h3>

      <div class="space-y-3">
        <!-- Emergency Contact Name -->
        <div>
          <label for="emergency_contact_name"
            class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
            Name
          </label>
          <input id="emergency_contact_name" type="text" name="emergency_contact_name"
            value="{{ old('emergency_contact_name') }}" placeholder="Full name"
            class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
          <x-input-error :messages="$errors->get('emergency_contact_name')" class="mt-1" />
        </div>

        <!-- Emergency Contact Phone -->
        <div>
          <label for="emergency_contact_phone"
            class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
            Phone Number
          </label>
          <input id="emergency_contact_phone" type="tel" name="emergency_contact_phone"
            value="{{ old('emergency_contact_phone') }}" placeholder="+66 81 234 5678"
            class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
          <x-input-error :messages="$errors->get('emergency_contact_phone')" class="mt-1" />
        </div>

        <!-- Emergency Contact Relationship -->
        <div>
          <label for="emergency_contact_relationship"
            class="block text-xs font-medium text-body-light-12 dark:text-body-dark-12 mb-1.5">
            Relationship
          </label>
          <input id="emergency_contact_relationship" type="text" name="emergency_contact_relationship"
            value="{{ old('emergency_contact_relationship') }}" placeholder="e.g., Spouse, Parent, Sibling"
            class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-alpha-light dark:border-alpha-dark bg-white dark:bg-gray-800 text-body-light-12 dark:text-body-dark-12 placeholder-body-light-10 dark:placeholder-body-dark-10 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" />
          <x-input-error :messages="$errors->get('emergency_contact_relationship')" class="mt-1" />
        </div>
      </div>
    </div>

    <!-- Submit Button -->
    <button type="submit"
      class="w-full px-4 py-2.5 text-sm rounded-lg bg-primary text-primary-color font-semibold hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:ring-4 focus:ring-primary/20 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 mt-4">
      Complete Registration
    </button>
  </form>

  <!-- Back Link -->
  <div class="text-center mt-4">
    <a href="{{ route('condo-code') }}"
      class="text-xs text-body-light-11 dark:text-body-dark-11 hover:text-primary dark:hover:text-primary transition-colors duration-200">
      ← Back to code entry
    </a>
  </div>
</x-guest-layout>
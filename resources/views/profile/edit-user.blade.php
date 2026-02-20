@extends('dashboard')

@section('page-title', 'Edit Resident')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('profile.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors">
        <i class="lni lni-arrow-left"></i>
        Back to Profile List
      </a>
    </div>

    <!-- Page Header -->
    <div class="mb-6 flex justify-between items-start">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Resident</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Update {{ $user->name }}'s profile information</p>
      </div>
      
      <!-- Delete Button - Only visible to Admin and Staff -->
      @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
        <button type="button" onclick="openDeleteModal()"
          class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors">
          <i class="lni lni-trash-can"></i>
          Delete Resident
        </button>
      @endif
    </div>

    <!-- Messages -->
    @if(session('error'))
      <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
        <div class="flex items-center gap-3">
          <i class="lni lni-warning text-red-500 text-xl"></i>
          <p class="text-red-700 dark:text-red-400">{{ session('error') }}</p>
        </div>
      </div>
    @endif

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

    <form method="POST" action="{{ route('profile.updateUser', $user) }}">
      @csrf
      @method('PATCH')

      <!-- Account Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-user text-primary"></i>
            Account Information
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Full Name <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary @error('name') border-red-500 @enderror">
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary @error('email') border-red-500 @enderror">
            </div>

            <!-- Phone Number -->
            <div>
              <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone Number
              </label>
              <input type="tel" name="phone_number" id="phone_number"
                value="{{ old('phone_number', $user->phone_number) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Status -->
            <div>
              <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Account Status
              </label>
              <select name="is_active" id="is_active"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
                <option value="1" {{ old('is_active', $profileData->is_active ?? true) ? 'selected' : '' }}>Active
                </option>
                <option value="0" {{ old('is_active', $profileData->is_active ?? true) ? '' : 'selected' }}>Inactive
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- Residency Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-home text-primary"></i>
            Residency Information
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Unit Number -->
            <div>
              <label for="unit_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Unit Number <span class="text-red-500">*</span>
              </label>
              <input type="text" name="unit_number" id="unit_number"
                value="{{ old('unit_number', $profileData->unit_number ?? '') }}" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Floor -->
            <div>
              <label for="floor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Floor
              </label>
              <input type="text" name="floor" id="floor" value="{{ old('floor', $profileData->floor ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Residency Status -->
            <div>
              <label for="residency_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Residency Status <span class="text-red-500">*</span>
              </label>
              <select name="residency_status" id="residency_status" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
                <option value="owner" {{ old('residency_status', $profileData->residency_status ?? '') === 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="tenant" {{ old('residency_status', $profileData->residency_status ?? '') === 'tenant' ? 'selected' : '' }}>Tenant</option>
              </select>
            </div>

            <!-- Move-in Date -->
            <div>
              <label for="move_in_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Move-in Date
              </label>
              <input type="date" name="move_in_date" id="move_in_date"
                value="{{ old('move_in_date', $profileData->move_in_date ? \Carbon\Carbon::parse($profileData->move_in_date)->format('Y-m-d') : '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Number of Occupants -->
            <div>
              <label for="number_of_occupants" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Number of Occupants
              </label>
              <input type="number" name="number_of_occupants" id="number_of_occupants" min="1" max="20"
                value="{{ old('number_of_occupants', $profileData->number_of_occupants ?? 1) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>
          </div>
        </div>
      </div>

      <!-- Emergency Contact -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-phone text-primary"></i>
            Emergency Contact
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Contact Name -->
            <div>
              <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Contact Name
              </label>
              <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                value="{{ old('emergency_contact_name', $profileData->emergency_contact_name ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Contact Phone -->
            <div>
              <label for="emergency_contact_phone"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Contact Phone
              </label>
              <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone"
                value="{{ old('emergency_contact_phone', $profileData->emergency_contact_phone ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>

            <!-- Relationship -->
            <div>
              <label for="emergency_contact_relationship"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Relationship
              </label>
              <input type="text" name="emergency_contact_relationship" id="emergency_contact_relationship"
                value="{{ old('emergency_contact_relationship', $profileData->emergency_contact_relationship ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
            </div>
          </div>
        </div>
      </div>

      <!-- Form Actions -->
      <div class="flex flex-col sm:flex-row gap-4 justify-end">
        <a href="{{ route('profile.showUser', $user) }}"
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

  <!-- Delete Resident Modal -->
  <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full mx-4">
      <form method="POST" action="{{ route('profile.deleteResident', $user) }}" id="deleteForm">
        @csrf
        @method('DELETE')
        
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="lni lni-warning text-red-500"></i>
              Delete Resident Profile
            </h3>
            <button type="button" onclick="closeDeleteModal()"
              class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
              <i class="lni lni-close text-2xl"></i>
            </button>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="px-6 py-4">
          <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <p class="text-sm text-red-700 dark:text-red-400">
              <strong class="text-red-700">Warning:</strong> This will permanently delete the resident profile for:
               <label class="text-sm text-red-700 dark:text-red-400 mt-2">
              <strong>{{ $user->name }}</strong> (Unit {{ $profileData->unit_number ?? 'N/A' }})
            </label>
            </p>
           
          </div>

          <div class="mb-4">
            <label for="deletion_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Reason for Deletion <span class="text-red-500">*</span>
            </label>
            <textarea name="deletion_reason" id="deletion_reason" rows="4" required
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary"
              placeholder="Please provide a detailed reason for deleting this resident profile..."></textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
              This reason will be sent to the resident via email and stored in deletion logs.
            </p>
          </div>

        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex gap-3 justify-end">
          <button type="button" onclick="closeDeleteModal()"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
            Cancel
          </button>
          <button type="submit"
            class="px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors">
            <i class="lni lni-checkmark-circle"></i>
            Confirm & Send Notice
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openDeleteModal() {
      document.getElementById('deleteModal').classList.remove('hidden');
      document.getElementById('deleteModal').classList.add('flex');
      document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
      document.getElementById('deleteModal').classList.add('hidden');
      document.getElementById('deleteModal').classList.remove('flex');
      document.body.style.overflow = 'auto';
      document.getElementById('deleteForm').reset();
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeDeleteModal();
      }
    });

    // Close modal on outside click
    document.getElementById('deleteModal').addEventListener('click', function(event) {
      if (event.target === this) {
        closeDeleteModal();
      }
    });
  </script>
@endsection
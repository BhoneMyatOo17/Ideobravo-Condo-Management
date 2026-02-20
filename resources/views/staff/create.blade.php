@extends('layouts.dashboard')

@section('page-title', 'Add New Staff')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Header with Back Button -->
    <div class="mb-6 flex items-center gap-4">
      <a href="{{ route('staff.index') }}"
        class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
        <i class="lni lni-arrow-left text-xl text-gray-600 dark:text-gray-400"></i>
      </a>
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Staff Member</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create a new staff account and profile</p>
      </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
      <form method="POST" action="{{ route('staff.store') }}" class="p-6 space-y-6">
        @csrf

        <!-- Personal Information Section -->
        <div>
          <h3
            class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
            Personal Information
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div class="md:col-span-2">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Full Name <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                placeholder="Enter full name">
              @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                placeholder="staff@example.com">
              @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Phone Number -->
            <div>
              <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone Number
              </label>
              <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone_number') border-red-500 @enderror"
                placeholder="+66 XX XXX XXXX">
              @error('phone_number')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
       <!-- Account Security Section -->
        <div>
          <h3
            class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
            Account Security
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Password (Hidden, Default Value) -->
            <div>
              <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                  Default Password <span class="text-red-500">*</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" id="manual_password_toggle" 
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                  <span class="text-xs text-gray-600 dark:text-gray-400">Set Password Manually</span>
                </label>
              </div>
              <input type="password" name="password" id="password" value="ideo@1234" readonly required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400 cursor-not-allowed"
                placeholder="ideo@1234">
              <input type="hidden" name="password_confirmation" id="password_confirmation" value="ideo@1234">
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="password_help_text">Staff will be required to change this on first login</p>
            </div>
          </div>
        </div>

        <!-- Employment Details Section -->
        <div>
          <h3
            class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
            Employment Details
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Condominium Assignment -->
            <div class="md:col-span-2">
              <label for="condominium_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Assigned Condominium
              </label>
              <select name="condominium_id" id="condominium_id"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('condominium_id') border-red-500 @enderror">
                <option value="">General Management (No specific condo)</option>
                @foreach($condominiums as $condo)
                  <option value="{{ $condo->id }}" {{ old('condominium_id') == $condo->id ? 'selected' : '' }}>
                    {{ $condo->name }} ({{ $condo->code }})
                  </option>
                @endforeach
              </select>
              @error('condominium_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty for general management staff who
                oversee multiple condos</p>
            </div>

            <!-- Position -->
            <div>
              <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Position <span class="text-red-500">*</span>
              </label>
              <input type="text" name="position" id="position" value="{{ old('position') }}" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('position') border-red-500 @enderror"
                placeholder="e.g., Manager, Receptionist">
              @error('position')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Department -->
            <div>
              <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Department
              </label>
              <input type="text" name="department" id="department" value="{{ old('department') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('department') border-red-500 @enderror"
                placeholder="e.g., Administration, Security">
              @error('department')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Employee ID -->
            <div>
              <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Employee ID
              </label>
              <input type="text" name="employee_id" id="employee_id" value="{{ old('employee_id') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('employee_id') border-red-500 @enderror"
                placeholder="Auto-generated if left empty">
              @error('employee_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate</p>
            </div>

            <!-- Employment Type -->
            <div>
              <label for="employment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Employment Type <span class="text-red-500">*</span>
              </label>
              <select name="employment_type" id="employment_type" required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('employment_type') border-red-500 @enderror">
                <option value="">Select employment type</option>
                <option value="full-time" {{ old('employment_type') === 'full-time' ? 'selected' : '' }}>Full-Time</option>
                <option value="part-time" {{ old('employment_type') === 'part-time' ? 'selected' : '' }}>Part-Time</option>
                <option value="contract" {{ old('employment_type') === 'contract' ? 'selected' : '' }}>Contract</option>
              </select>
              @error('employment_type')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Hire Date -->
            <div>
              <label for="hire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Hire Date
              </label>
              <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', date('Y-m-d')) }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('hire_date') border-red-500 @enderror">
              @error('hire_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Work Phone -->
            <div>
              <label for="work_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Work Phone
              </label>
              <input type="text" name="work_phone" id="work_phone" value="{{ old('work_phone') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('work_phone') border-red-500 @enderror"
                placeholder="+66 XX XXX XXXX">
              @error('work_phone')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Work Email -->
            <div>
              <label for="work_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Work Email
              </label>
              <input type="email" name="work_email" id="work_email" value="{{ old('work_email') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('work_email') border-red-500 @enderror"
                placeholder="work@example.com">
              @error('work_email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
          <a href="{{ route('staff.index') }}"
            class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            Cancel
          </a>
          <button type="submit"
            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2">
            <i class="lni lni-checkmark"></i>
            <span>Create Staff Member</span>
          </button>
        </div>
      </form>
    </div>

    <!-- Help Text -->
    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
      <div class="flex gap-3">
        <i class="lni lni-information text-blue-600 dark:text-blue-400 text-xl flex-shrink-0"></i>
        <div class="text-sm text-blue-800 dark:text-blue-300">
          <p class="font-medium mb-1">Important Information:</p>
          <ul class="list-disc list-inside space-y-1">
            <li>The staff member will receive login credentials at the provided email address</li>
            <li>Employee ID will be auto-generated if not provided</li>
            <li>All staff members are set to "Active" status by default</li>
            <li>General management staff can access multiple condominiums</li>
            <li>Assigned staff will only have access to their specific condominium</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  @if(session('error'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        alert('{{ session('error') }}');
      });
    </script>
  @endif
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggle = document.getElementById('manual_password_toggle');
      const passwordField = document.getElementById('password');
      const confirmPasswordHidden = document.getElementById('password_confirmation');
      const helpText = document.getElementById('password_help_text');

      toggle.addEventListener('change', function() {
        if (this.checked) {
          // Enable manual password
          passwordField.value = '';
          passwordField.readOnly = false;
          passwordField.classList.remove('bg-gray-100', 'dark:bg-gray-900', 'text-gray-500', 'dark:text-gray-400', 'cursor-not-allowed');
          passwordField.classList.add('bg-white', 'dark:bg-gray-700', 'text-gray-900', 'dark:text-white');
          passwordField.placeholder = 'Enter custom password';
          
          // Clear hidden confirmation field to avoid validation issues
          confirmPasswordHidden.value = '';
          
          // Update help text
          helpText.textContent = 'Enter a custom password for this staff member';
          
        } else {
          // Revert to default password
          passwordField.value = 'ideo@1234';
          passwordField.readOnly = true;
          passwordField.classList.remove('bg-white', 'dark:bg-gray-700', 'text-gray-900', 'dark:text-white');
          passwordField.classList.add('bg-gray-100', 'dark:bg-gray-900', 'text-gray-500', 'dark:text-gray-400', 'cursor-not-allowed');
          passwordField.placeholder = 'ideo@1234';
          
          // Set hidden confirmation back to default
          confirmPasswordHidden.value = 'ideo@1234';
          
          // Revert help text
          helpText.textContent = 'Staff will be required to change this on first login';
        }
      });

      // Sync password field with hidden confirmation when manually typing
      passwordField.addEventListener('input', function() {
        if (toggle.checked) {
          confirmPasswordHidden.value = this.value;
        }
      });
    });
  </script>
@endsection
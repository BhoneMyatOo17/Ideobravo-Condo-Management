@extends('dashboard')

@section('page-title', 'Add New User')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('profile.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors">
        <i class="lni lni-arrow-left"></i>
        Back to User Management
      </a>
    </div>

    <!-- Page Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New User</h1>
      <p class="text-gray-500 dark:text-gray-400 mt-1">Create a new resident or staff account</p>
    </div>

    <!-- Error Messages -->
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

    <form method="POST" action="{{ route('profile.store') }}" x-data="{ userType: '{{ old('user_type', 'resident') }}' }">
      @csrf

      <!-- User Type Selection -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-user text-primary"></i>
            User Type
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-{{ Auth::user()->isAdmin() ? '2' : '1' }} gap-4">
            <!-- Resident Option -->
            <label class="relative cursor-pointer">
              <input type="radio" name="user_type" value="resident" x-model="userType" class="peer sr-only" {{ old('user_type', 'resident') === 'resident' ? 'checked' : '' }}>
              <div
                class="p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <i class="lni lni-home text-xl text-blue-600 dark:text-blue-400"></i>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Resident</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Add a new resident to the condominium</p>
                  </div>
                </div>
              </div>
            </label>

            <!-- Staff Option (Admin Only) -->
            @if(Auth::user()->isAdmin())
              <label class="relative cursor-pointer">
                <input type="radio" name="user_type" value="staff" x-model="userType" class="peer sr-only" {{ old('user_type') === 'staff' ? 'checked' : '' }}>
                <div
                  class="p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                  <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                      <i class="lni lni-briefcase text-xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                      <p class="font-semibold text-gray-900 dark:text-white">Staff</p>
                      <p class="text-sm text-gray-500 dark:text-gray-400">Add a new staff member</p>
                    </div>
                  </div>
                </div>
              </label>
            @endif
          </div>
        </div>
      </div>

      <!-- Account Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-lock text-primary"></i>
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
              <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Enter full name"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors @error('name') border-red-500 @enderror">
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" required
                placeholder="email@example.com"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors @error('email') border-red-500 @enderror">
            </div>

            <!-- Phone Number -->
            <div>
              <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone Number
              </label>
              <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                placeholder="+66 XX XXX XXXX"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
            </div>

            <!-- Condominium (Admin can select, Staff auto-assigned) -->
            @if(Auth::user()->isAdmin())
              <div>
                <label for="condominium_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Condominium <span class="text-red-500">*</span>
                </label>
                <select name="condominium_id" id="condominium_id" required
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors @error('condominium_id') border-red-500 @enderror">
                  <option value="">Select Condominium</option>
                  @foreach($condominiums as $condo)
                    <option value="{{ $condo->id }}" {{ old('condominium_id') == $condo->id ? 'selected' : '' }}>
                      {{ $condo->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            @else
              <input type="hidden" name="condominium_id" value="{{ Auth::user()->condo_id }}">
            @endif

            <!-- Password (Fixed) -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Default Password
              </label>
              <input type="password" name="password" id="password" value="ideo@1234" disabled
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white cursor-not-allowed">
              <input type="hidden" name="password" value="ideo@1234">
              <input type="hidden" name="password_confirmation" value="ideo@1234">
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                All new accounts will use this default password: <code class="bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded font-mono">ideo@1234</code>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Resident-Specific Fields -->
      <div x-show="userType === 'resident'" x-transition
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-home text-primary"></i>
            Residence Information
          </h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Unit Number -->
            <div>
              <label for="unit_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Unit Number <span class="text-red-500">*</span>
              </label>
              <input type="text" name="unit_number" id="unit_number" value="{{ old('unit_number') }}"
                placeholder="e.g., 1234, A-505"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
            </div>

            <!-- Floor -->
            <div>
              <label for="floor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Floor
              </label>
              <input type="text" name="floor" id="floor" value="{{ old('floor') }}" placeholder="e.g., 5, G, B1"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
            </div>

            <!-- Residency Status -->
            <div>
              <label for="residency_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Residency Status <span class="text-red-500">*</span>
              </label>
              <select name="residency_status" id="residency_status"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                <option value="owner" {{ old('residency_status') === 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="tenant" {{ old('residency_status') === 'tenant' ? 'selected' : '' }}>Tenant</option>
              </select>
            </div>

            <!-- Move-in Date -->
            <div>
              <label for="move_in_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Move-in Date
              </label>
              <input type="date" name="move_in_date" id="move_in_date" value="{{ old('move_in_date') }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
            </div>

            <!-- Number of Occupants -->
            <div>
              <label for="number_of_occupants"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Number of Occupants
              </label>
              <input type="number" name="number_of_occupants" id="number_of_occupants"
                value="{{ old('number_of_occupants', 1) }}" min="1" max="20" placeholder="1"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
            </div>
          </div>

          <!-- Emergency Contact Section -->
          <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4"> <i class="lni lni-warning text-primary"></i> Emergency Contact (Optional)</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
              <div>
                <label for="emergency_contact_name"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Contact Name
                </label>
                <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                  value="{{ old('emergency_contact_name') }}" placeholder="e.g., John Doe"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>
              <div>
                <label for="emergency_contact_phone"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Contact Phone
                </label>
                <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone"
                  value="{{ old('emergency_contact_phone') }}" placeholder="+66 XX XXX XXXX"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>
              <div>
                <label for="emergency_contact_relationship"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Relationship
                </label>
                <input type="text" name="emergency_contact_relationship" id="emergency_contact_relationship"
                  value="{{ old('emergency_contact_relationship') }}" placeholder="e.g., Spouse, Parent"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Staff-Specific Fields -->
      @if(Auth::user()->isAdmin())
        <div x-show="userType === 'staff'" x-transition
          class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
              <i class="lni lni-briefcase text-primary"></i>
              Employment Information
            </h2>
          </div>
          <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <!-- Position -->
              <div>
                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Position <span class="text-red-500">*</span>
                </label>
                <input type="text" name="position" id="position" value="{{ old('position') }}"
                  placeholder="e.g., Juristic Manager, Security Guard"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>

              <!-- Department -->
              <div>
                <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Department
                </label>
                <input type="text" name="department" id="department" value="{{ old('department') }}"
                  placeholder="e.g., Management, Security, Maintenance"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>

              <!-- Employee ID -->
              <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Employee ID
                </label>
                <input type="text" name="employee_id" id="employee_id" value="{{ old('employee_id') }}"
                  placeholder="Auto-generated if blank"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>

              <!-- Employment Type -->
              <div>
                <label for="employment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Employment Type <span class="text-red-500">*</span>
                </label>
                <select name="employment_type" id="employment_type"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                  <option value="full-time" {{ old('employment_type') === 'full-time' ? 'selected' : '' }}>Full-time</option>
                  <option value="part-time" {{ old('employment_type') === 'part-time' ? 'selected' : '' }}>Part-time</option>
                  <option value="contract" {{ old('employment_type') === 'contract' ? 'selected' : '' }}>Contract</option>
                </select>
              </div>

              <!-- Hire Date -->
              <div>
                <label for="hire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Hire Date
                </label>
                <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
              </div>
            </div>

            <!-- Work Contact Section -->
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
              <h3 class="text-md font-medium text-gray-800 dark:text-white mb-4">Work Contact (Optional)</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                  <label for="work_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Work Phone
                  </label>
                  <input type="tel" name="work_phone" id="work_phone" value="{{ old('work_phone') }}"
                    placeholder="+66 XX XXX XXXX"
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                </div>
                <div>
                  <label for="work_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Work Email
                  </label>
                  <input type="email" name="work_email" id="work_email" value="{{ old('work_email') }}"
                    placeholder="work@ideobravo.com"
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif

      <!-- Form Actions -->
      <div class="flex flex-col sm:flex-row gap-4 justify-end">
        <a href="{{ route('profile.index') }}"
          class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
          Cancel
        </a>
        <button type="submit"
          class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
          <i class="lni lni-plus"></i>
          Create User
        </button>
      </div>
    </form>
  </div>
@endsection
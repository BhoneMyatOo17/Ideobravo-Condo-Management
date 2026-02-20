@extends('layouts.dashboard')

@section('page-title', 'Edit Staff')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header with Back Button -->
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('staff.show', $staff) }}" 
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
            <i class="lni lni-arrow-left text-xl text-gray-600 dark:text-gray-400"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Staff Member</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update staff account and profile information</p>
        </div>
    </div>

    <!-- Warning Box -->
    <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
        <div class="flex gap-3">
            <i class="lni lni-warning text-yellow-600 dark:text-yellow-400 text-xl flex-shrink-0"></i>
            <div class="text-sm text-yellow-800 dark:text-yellow-300">
                <p class="font-medium mb-1">Important:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Changing the email address will update the staff member's login credentials</li>
                    <li>Deactivating a staff member will revoke their system access</li>
                    <li>Changing condominium assignment will affect their data access permissions</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <form method="POST" action="{{ route('staff.update', $staff) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Personal Information Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Personal Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $staff->user->name) }}"
                               required
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
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email', $staff->user->email) }}"
                               required
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
                        <input type="text" 
                               name="phone_number" 
                               id="phone_number" 
                               value="{{ old('phone_number', $staff->user->phone_number) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone_number') border-red-500 @enderror"
                               placeholder="+66 XX XXX XXXX">
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Password Change Section (Optional) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Change Password <span class="text-sm font-normal text-gray-500">(Optional)</span>
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            New Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Leave empty to keep current">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Re-enter new password">
                    </div>
                </div>
            </div>

            <!-- Employment Details Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Employment Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Condominium Assignment -->
                    <div class="md:col-span-2">
                        <label for="condominium_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Assigned Condominium
                        </label>
                        <select name="condominium_id" 
                                id="condominium_id"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('condominium_id') border-red-500 @enderror">
                            <option value="">General Management (No specific condo)</option>
                            @foreach($condominiums as $condo)
                                <option value="{{ $condo->id }}" 
                                    {{ old('condominium_id', $staff->condominium_id) == $condo->id ? 'selected' : '' }}>
                                    {{ $condo->name }} ({{ $condo->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('condominium_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Changing assignment will affect data access permissions</p>
                    </div>

                    <!-- Position -->
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Position <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="position" 
                               id="position" 
                               value="{{ old('position', $staff->position) }}"
                               required
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
                        <input type="text" 
                               name="department" 
                               id="department" 
                               value="{{ old('department', $staff->department) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('department') border-red-500 @enderror"
                               placeholder="e.g., Administration, Security">
                        @error('department')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Employee ID -->
                    <div>
                        <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Employee ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="employee_id" 
                               id="employee_id" 
                               value="{{ old('employee_id', $staff->employee_id) }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('employee_id') border-red-500 @enderror"
                               readonly>
                        @error('employee_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Employee ID cannot be changed</p>
                    </div>

                    <!-- Employment Type -->
                    <div>
                        <label for="employment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Employment Type <span class="text-red-500">*</span>
                        </label>
                        <select name="employment_type" 
                                id="employment_type" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('employment_type') border-red-500 @enderror">
                            <option value="">Select employment type</option>
                            <option value="full-time" {{ old('employment_type', $staff->employment_type) === 'full-time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="part-time" {{ old('employment_type', $staff->employment_type) === 'part-time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="contract" {{ old('employment_type', $staff->employment_type) === 'contract' ? 'selected' : '' }}>Contract</option>
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
                        <input type="date" 
                               name="hire_date" 
                               id="hire_date" 
                               value="{{ old('hire_date', $staff->hire_date) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('hire_date') border-red-500 @enderror">
                        @error('hire_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="is_active" 
                                id="is_active" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('is_active') border-red-500 @enderror">
                            <option value="1" {{ old('is_active', $staff->is_active) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $staff->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Inactive staff cannot log in to the system</p>
                    </div>

                    <!-- Work Phone -->
                    <div>
                        <label for="work_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Work Phone
                        </label>
                        <input type="text" 
                               name="work_phone" 
                               id="work_phone" 
                               value="{{ old('work_phone', $staff->work_phone) }}"
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
                        <input type="email" 
                               name="work_email" 
                               id="work_email" 
                               value="{{ old('work_email', $staff->work_email) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('work_email') border-red-500 @enderror"
                               placeholder="work@example.com">
                        @error('work_email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="button"
                        onclick="if(confirm('Are you sure you want to delete this staff member? This action cannot be undone.')) { document.getElementById('delete-form').submit(); }"
                        class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors flex items-center gap-2">
                    <i class="lni lni-trash"></i>
                    <span>Delete Staff</span>
                </button>

                <div class="flex items-center gap-4">
                    <a href="{{ route('staff.show', $staff) }}" 
                       class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2">
                        <i class="lni lni-save"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" 
              action="{{ route('staff.destroy', $staff) }}" 
              method="POST" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session('error') }}');
    });
</script>
@endif
@endsection
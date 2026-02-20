@extends('dashboard')

@section('page-title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('profile.show') }}"
                class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors">
                <i class="lni lni-arrow-left"></i>
                Back to Profile
            </a>
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

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Profile Header -->
            <div class="bg-primary rounded-2xl p-6 sm:p-8 mb-6 bg-rings">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Avatar -->
                    <div
                        class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-white/20 flex items-center justify-center text-white text-4xl sm:text-5xl font-bold shadow-lg">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>

                    <!-- User Info -->
                    <div class="text-center sm:text-left flex-1">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Edit Your Profile</h1>
                        <p class="text-white/80">Update your personal information and contact details</p>
                        <div class="flex flex-wrap justify-center sm:justify-start gap-2 mt-3">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/20 text-white text-sm font-medium rounded-full">
                                <i class="lni lni-user"></i>
                                {{ $user->getRoleName() }}
                            </span>
                            @if($user->condominium)
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/20 text-white text-sm font-medium rounded-full">
                                    <i class="lni lni-apartment"></i>
                                    {{ $user->condominium->name }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

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
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            @if(!$user->email_verified_at)
                                <p class="mt-1 text-sm text-yellow-600 dark:text-yellow-400">
                                    <i class="lni lni-warning"></i> Your email is not verified.
                                </p>
                            @endif
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone_number"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}" placeholder="+66 XX XXX XXXX"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors @error('phone_number') border-red-500 @enderror">
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Member Since (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Member Since
                            </label>
                            <div
                                class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400">
                                {{ $user->created_at->format('F j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resident-Specific Fields -->
            @if($user->isResident() && $profileData)
                <!-- Residency Info (Read-only) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="lni lni-home text-primary"></i>
                            Residency Information
                            <span class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-400">(Contact management to
                                update)</span>
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Unit
                                    Number</label>
                                <div
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white font-semibold">
                                    {{ $profileData->unit_number }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Floor</label>
                                <div
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400">
                                    {{ $profileData->floor ?? '—' }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Residency
                                    Status</label>
                                <div
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400">
                                    {{ ucfirst($profileData->residency_status) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact (Editable) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="lni lni-phone text-primary"></i>
                            Emergency Contact
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label for="emergency_contact_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Contact Name
                                </label>
                                <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                                    value="{{ old('emergency_contact_name', $profileData->emergency_contact_name) }}"
                                    placeholder="e.g., John Doe"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>
                            <div>
                                <label for="emergency_contact_phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Contact Phone
                                </label>
                                <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone"
                                    value="{{ old('emergency_contact_phone', $profileData->emergency_contact_phone) }}"
                                    placeholder="+66 XX XXX XXXX"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>
                            <div>
                                <label for="emergency_contact_relationship"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Relationship
                                </label>
                                <input type="text" name="emergency_contact_relationship" id="emergency_contact_relationship"
                                    value="{{ old('emergency_contact_relationship', $profileData->emergency_contact_relationship) }}"
                                    placeholder="e.g., Spouse, Parent, Sibling"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Number of Occupants -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="lni lni-users text-primary"></i>
                            Household Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="max-w-xs">
                            <label for="number_of_occupants"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Number of Occupants
                            </label>
                            <input type="number" name="number_of_occupants" id="number_of_occupants" min="1" max="20"
                                value="{{ old('number_of_occupants', $profileData->number_of_occupants) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total number of people living in your unit
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Staff-Specific Fields -->
            @if($user->isStaff() && $profileData)
                <!-- Employment Info (Read-only) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="lni lni-briefcase text-primary"></i>
                            Employment Information
                            <span class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-400">(Contact HR to
                                update)</span>
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Position</label>
                                <div
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white font-semibold">
                                    {{ $profileData->position }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Department</label>
                                <div
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400">
                                    {{ $profileData->department ?? '—' }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Employee
                                    ID</label>
                                <div
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400 font-mono">
                                    {{ $profileData->employee_id ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Contact (Editable) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="lni lni-phone text-primary"></i>
                            Work Contact
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="work_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Work Phone
                                </label>
                                <input type="tel" name="work_phone" id="work_phone"
                                    value="{{ old('work_phone', $profileData->work_phone) }}" placeholder="+66 XX XXX XXXX"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>
                            <div>
                                <label for="work_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Work Email
                                </label>
                                <input type="email" name="work_email" id="work_email"
                                    value="{{ old('work_email', $profileData->work_email) }}" placeholder="work@ideobravo.com"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('profile.show') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    <i class="lni lni-save"></i>
                    Save Changes
                </button>
            </div>
        </form>

        <!-- Danger Zone -->
        <div
            class="mt-10 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-red-200 dark:border-red-900 overflow-hidden">
            <div class="px-6 py-4 bg-red-50 dark:bg-red-900/20 border-b border-red-200 dark:border-red-800">
                <h2 class="text-lg font-semibold text-red-700 dark:text-red-400 flex items-center gap-2">
                    <i class="lni lni-warning"></i>
                    Danger Zone
                </h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="font-medium text-gray-900 dark:text-white">Delete Account</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Once deleted, all your data will be permanently
                            removed.</p>
                    </div>
                    <button type="button"
                        onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                        <i class="lni lni-trash-can"></i>
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

   <!-- Delete Account Modal -->
<div id="delete-account-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/75 transition-opacity"
            onclick="document.getElementById('delete-account-modal').classList.add('hidden')"></div>

        <!-- Modal Content -->
        <div
            class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6 mx-auto transform transition-all">
            <div class="text-center mb-6">
                <div
                    class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="lni lni-warning text-3xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Delete Your Account?</h3>
                <p class="text-gray-500 dark:text-gray-400">This action cannot be undone. All your data will be
                    permanently deleted.</p>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-6">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 text-left">
                        Confirm your password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-colors @error('password', 'userDeletion') border-red-500 @enderror"
                        placeholder="Enter your password">
                    @error('password', 'userDeletion')
                        <p class="mt-1 text-sm text-red-500 text-left">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="button"
                        onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                        class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Auto-open modal if there's a password error -->
<script>
    @if($errors->userDeletion->has('password'))
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('delete-account-modal').classList.remove('hidden');
        });
    @endif
</script>
@endsection
@extends('dashboard')

@section('page-title', 'My Profile')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
        <div class="flex items-center gap-3">
          <i class="lni lni-checkmark-circle text-green-500 text-xl"></i>
          <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    <!-- Profile Header Card -->
    <div class="bg-primary rounded-2xl p-6 sm:p-8 mb-6 bg-rings">
      <div class="flex flex-col sm:flex-row items-center gap-6">
        <!-- Avatar -->
        <div
          class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-white/20 flex items-center justify-center text-white text-4xl sm:text-5xl font-bold shadow-lg">
          @if($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
          @else
            {{ strtoupper(substr($user->name, 0, 1)) }}
          @endif
        </div>

        <!-- User Info -->
        <div class="text-center sm:text-left flex-1">
          <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">{{ $user->name }}</h1>
          <p class="text-white/80 mb-3">{{ $user->email }}</p>
          <div class="flex flex-wrap justify-center sm:justify-start gap-2">
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

        <!-- Edit Button -->
        <a href="{{ $user->id === Auth::id() ? route('profile.edit') : route('profile.editUser', $user) }}"
          class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary font-medium rounded-lg hover:bg-gray-100 transition-colors">
          <i class="lni lni-pencil"></i>
          Edit Profile
        </a>
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
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Full Name</dt>
            <dd class="text-gray-900 dark:text-white">{{ $user->name }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email Address</dt>
            <dd class="text-gray-900 dark:text-white flex items-center gap-2">
              {{ $user->email }}
              @if($user->email_verified_at)
                <span class="inline-flex items-center gap-1 text-xs text-green-600 dark:text-green-400">
                  <i class="lni lni-checkmark-circle"></i> Verified
                </span>
              @else
                <span class="inline-flex items-center gap-1 text-xs text-yellow-600 dark:text-yellow-400">
                  <i class="lni lni-warning"></i> Not verified
                </span>
              @endif
            </dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Phone Number</dt>
            <dd class="text-gray-900 dark:text-white">{{ $user->phone_number ?? '—' }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Member Since</dt>
            <dd class="text-gray-900 dark:text-white">{{ $user->created_at->format('F j, Y') }}</dd>
          </div>
          
          <!-- Assigned Condominium (For Residents and Staff) -->
          @if(($user->isResident() || $user->isStaff()) && $profileData && $profileData->condominium)
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Condominium</dt>
              <dd class="text-gray-900 dark:text-white flex items-center gap-2">
                <i class="lni lni-apartment text-primary"></i>
                {{ $profileData->condominium->name }}
              </dd>
            </div>
          @endif
        </dl>
      </div>
    </div>

    <!-- Resident-Specific Information -->
    @if($user->isResident() && $profileData)
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-home text-primary"></i>
            Residency Information
          </h2>
        </div>
        <div class="p-6">
          <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Unit Number</dt>
              <dd class="text-gray-900 dark:text-white font-semibold text-lg">{{ $profileData->unit_number }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Floor</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->floor ?? '—' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Residency Status</dt>
              <dd>
                <span
                  class="inline-flex items-center px-2.5 py-1 text-sm font-medium rounded-full
                              {{ $profileData->residency_status === 'owner' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' }}">
                  {{ ucfirst($profileData->residency_status) }}
                </span>
              </dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Number of Occupants</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->number_of_occupants }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Move-in Date</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->move_in_date?->format('F j, Y') ?? '—' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</dt>
              <dd>
                <span
                  class="inline-flex items-center px-2.5 py-1 text-sm font-medium rounded-full
                              {{ $profileData->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                  {{ $profileData->is_active ? 'Active' : 'Inactive' }}
                </span>
              </dd>
            </div>
          </dl>
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
          @if($profileData->emergency_contact_name)
            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-6">
              <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Name</dt>
                <dd class="text-gray-900 dark:text-white">{{ $profileData->emergency_contact_name }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Phone Number</dt>
                <dd class="text-gray-900 dark:text-white">{{ $profileData->emergency_contact_phone ?? '—' }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Relationship</dt>
                <dd class="text-gray-900 dark:text-white">{{ $profileData->emergency_contact_relationship ?? '—' }}</dd>
              </div>
            </dl>
          @else
            <div class="text-center py-6">
              <i class="lni lni-warning text-3xl text-yellow-500 mb-2"></i>
              <p class="text-gray-500 dark:text-gray-400">No emergency contact added yet.</p>
              <a href="{{ route('profile.edit') }}" class="text-primary hover:underline text-sm mt-1 inline-block">Add
                emergency contact</a>
            </div>
          @endif
        </div>
      </div>
    @endif

    <!-- Staff-Specific Information -->
    @if($user->isStaff() && $profileData)
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-briefcase text-primary"></i>
            Employment Information
          </h2>
        </div>
        <div class="p-6">
          <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Position</dt>
              <dd class="text-gray-900 dark:text-white font-semibold">{{ $profileData->position }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Department</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->department ?? '—' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Employee ID</dt>
              <dd class="text-gray-900 dark:text-white font-mono">{{ $profileData->employee_id ?? '—' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Employment Type</dt>
              <dd>
                <span class="inline-flex items-center px-2.5 py-1 text-sm font-medium rounded-full
                              @if($profileData->employment_type === 'full-time') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                              @elseif($profileData->employment_type === 'part-time') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                              @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 @endif">
                  {{ ucfirst(str_replace('-', ' ', $profileData->employment_type)) }}
                </span>
              </dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Hire Date</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->hire_date?->format('F j, Y') ?? '—' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</dt>
              <dd>
                <span
                  class="inline-flex items-center px-2.5 py-1 text-sm font-medium rounded-full
                              {{ $profileData->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                  {{ $profileData->is_active ? 'Active' : 'Inactive' }}
                </span>
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- Work Contact -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-phone text-primary"></i>
            Work Contact
          </h2>
        </div>
        <div class="p-6">
          <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Work Phone</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->work_phone ?? '—' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Work Email</dt>
              <dd class="text-gray-900 dark:text-white">{{ $profileData->work_email ?? '—' }}</dd>
            </div>
          </dl>
        </div>
      </div>
    @endif

    <!-- Admin Information -->
    @if($user->isAdmin())
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="lni lni-shield text-primary"></i>
            Administrator Access
          </h2>
        </div>
        <div class="p-6">
          <div class="flex items-center gap-3 p-4 bg-primary/5 dark:bg-primary/10 rounded-lg">
            <i class="lni lni-checkmark-circle text-2xl text-primary"></i>
            <div>
              <p class="font-medium text-gray-900 dark:text-white">Full System Access</p>
              <p class="text-sm text-gray-500 dark:text-gray-400">You have administrator privileges across all condominiums
                and system features.</p>
            </div>
          </div>
        </div>
      </div>
    @endif

  </div>
@endsection
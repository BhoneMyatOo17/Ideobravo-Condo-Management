@extends('layouts.dashboard')

@section('page-title', 'Register New Parcel')

@section('content')
<div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center mb-6">
        <a href="{{ route('parcels.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
            <i class="lni lni-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Register New Parcel</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Add incoming parcel information</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-3xl">
        <form action="{{ route('parcels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Fixed Condominium Display -->
            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">
                        <i class="lni lni-apartment text-white"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Registering parcel for</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $condominium->name }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recipient Name on Parcel -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Name on Parcel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="recipient_name" value="{{ old('recipient_name') }}" required
                           placeholder="Enter name exactly as written on parcel"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('recipient_name') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter the name as shown on the parcel label (can be nickname or any name)</p>
                    @error('recipient_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Room Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Room Number <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="room_number" value="{{ old('room_number') }}" required
                           placeholder="e.g., 501, A-1205"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('room_number') border-red-500 @enderror">
                    @error('room_number')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Courier Service -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Courier Service <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="courier_service" value="{{ old('courier_service') }}" required
                           placeholder="e.g., Kerry, Flash, Ninja Van, Lalamove"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('courier_service') border-red-500 @enderror">
                    @error('courier_service')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tracking Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tracking Number <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tracking_number" value="{{ old('tracking_number') }}" required
                           placeholder="TH1234567890"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('tracking_number') border-red-500 @enderror">
                    @error('tracking_number')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Received Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Received Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="received_date" value="{{ old('received_date', date('Y-m-d')) }}" required
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('received_date') border-red-500 @enderror">
                    @error('received_date')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parcel Image -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Parcel Photo (Optional)
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div class="flex flex-col items-center justify-center pt-7 pb-6">
                                <i class="lni lni-camera text-4xl text-gray-400 mb-3"></i>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (MAX. 5MB)</p>
                            </div>
                            <input type="file" name="parcel_image" accept="image/*" class="hidden" id="image-input" />
                        </label>
                    </div>
                    <div id="image-preview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview:</p>
                        <img id="preview-img" src="" alt="Preview" class="w-48 h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                    </div>
                    @error('parcel_image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Additional Notes
                    </label>
                    <textarea name="notes" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('notes') border-red-500 @enderror"
                              placeholder="Parcel condition, special instructions, etc...">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Send Notification Checkbox -->
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="send_notification" value="1" {{ old('send_notification') ? 'checked' : '' }}
                               class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                        <div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Send notification to resident</span>
                            <p class="text-xs text-gray-500 dark:text-gray-400">If room number matches a registered resident, they will receive a notification</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('parcels.index') }}" class="px-6 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2">
                    <i class="lni lni-checkmark-circle"></i>
                    Register Parcel
                </button>
            </div>
        </form>
    </div>

    <!-- Quick Tips -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 max-w-3xl">
        <div class="flex items-start gap-3">
            <i class="lni lni-information text-blue-600 dark:text-blue-400 text-xl mt-0.5"></i>
            <div>
                <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Quick Tips</h3>
                <ul class="text-sm text-blue-800 dark:text-blue-200 space-y-1">
                    <li>• Enter the name exactly as it appears on the parcel label</li>
                    <li>• Names can be nicknames, company names, or any name used for delivery</li>
                    <li>• Room number is the primary identifier for parcel pickup</li>
                    <li>• Taking a photo helps verify the correct parcel during pickup</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
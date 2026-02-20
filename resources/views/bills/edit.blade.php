@extends('layouts.dashboard')

@section('page-title', 'Edit Bill')

@section('content')
    <div class="container-fluid px-6 py-8">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('bills.index') }}"
                class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <i class="lni lni-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Bill</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $bill->bill_number }}</p>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-3xl">
            <form action="{{ route('bills.update', $bill) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Resident -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Resident <span class="text-red-500">*</span>
                        </label>
                        <select name="resident_id" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('resident_id') border-red-500 @enderror">
                            <option value="">Select Resident</option>
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}" {{ old('resident_id', $bill->resident_id) == $resident->id ? 'selected' : '' }}>
                                    {{ $resident->user->name }} - Unit {{ $resident->unit_number }}
                                </option>
                            @endforeach
                        </select>
                        @error('resident_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bill Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Bill Type <span class="text-red-500">*</span>
                        </label>
                        <select name="bill_type" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('bill_type') border-red-500 @enderror">
                            <option value="">Select Type</option>
                            <option value="common_area" {{ old('bill_type', $bill->bill_type) == 'common_area' ? 'selected' : '' }}>Common Area Fee</option>
                            <option value="electricity" {{ old('bill_type', $bill->bill_type) == 'electricity' ? 'selected' : '' }}>Electricity</option>
                            <option value="water" {{ old('bill_type', $bill->bill_type) == 'water' ? 'selected' : '' }}>Water
                            </option>
                            <option value="insurance" {{ old('bill_type', $bill->bill_type) == 'insurance' ? 'selected' : '' }}>Insurance</option>
                            <option value="parking" {{ old('bill_type', $bill->bill_type) == 'parking' ? 'selected' : '' }}>
                                Parking Fee</option>
                            <option value="other" {{ old('bill_type', $bill->bill_type) == 'other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                        @error('bill_type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Amount (฿) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="amount" step="0.01" min="0" value="{{ old('amount', $bill->amount) }}"
                            required placeholder="0.00"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('amount') border-red-500 @enderror">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Issue Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Issue Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="issue_date"
                            value="{{ old('issue_date', $bill->issue_date->format('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('issue_date') border-red-500 @enderror">
                        @error('issue_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Due Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="due_date" value="{{ old('due_date', $bill->due_date->format('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('due_date') border-red-500 @enderror">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status', $bill->status) == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="paid" {{ old('status', $bill->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="overdue" {{ old('status', $bill->status) == 'overdue' ? 'selected' : '' }}>Overdue
                            </option>
                            <option value="cancelled" {{ old('status', $bill->status) == 'cancelled' ? 'selected' : '' }}>
                                Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                        <textarea name="notes" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary @error('notes') border-red-500 @enderror"
                            placeholder="Additional notes...">{{ old('notes', $bill->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('bills.index') }}"
                        class="px-6 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                        Update Bill
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
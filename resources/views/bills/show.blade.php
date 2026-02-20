@extends('layouts.dashboard')

@section('page-title', 'Bill Details')

@section('content')
    <div class="container-fluid px-6 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('bills.index') }}"
                    class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="lni lni-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Bill Details</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $bill->bill_number }}</p>
                </div>
            </div>
            <div class="flex gap-2 mt-4 md:mt-0">
                @if($bill->status != 'paid' && (Auth::user()->isAdmin() || Auth::user()->isStaff()))
                    <button type="button" onclick="document.getElementById('markPaidModal').classList.remove('hidden')"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="lni lni-checkmark mr-2"></i>Mark as Paid
                    </button>
                @endif
                @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
                    @if($bill->status !== 'paid')
                        <a href="{{ route('bills.edit', $bill->id) }}"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            <i class="lni lni-pencil mr-2"></i>Edit
                        </a>
                    @endif
                @endif
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded">
                <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Bill Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Bill
                                Number</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $bill->bill_number }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Bill Type</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->getBillTypeLabel() }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Amount</label>
                            <p class="text-2xl font-bold text-primary">{{ $bill->formatted_amount }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                            <span
                                class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ $bill->getStatusBadgeColor() }}">
                                {{ ucfirst($bill->status) }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Issue
                                Date</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->issue_date->format('F d, Y') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Due Date</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->due_date->format('F d, Y') }}</p>
                            @if($bill->isOverdue())
                                <p class="text-sm text-red-600 dark:text-red-400 mt-1">
                                    Overdue by {{ $bill->overdue_days }} days
                                </p>
                            @endif
                        </div>

                        @if($bill->paid_date)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Paid Date</label>
                                <p class="text-gray-900 dark:text-white">{{ $bill->paid_date->format('F d, Y') }}</p>
                            </div>
                        @endif

                        @if($bill->payment_method)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Payment
                                    Method</label>
                                <p class="text-gray-900 dark:text-white capitalize">{{ $bill->payment_method }}</p>
                            </div>
                        @endif

                        @if($bill->payment_reference)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Payment
                                    Reference</label>
                                <p class="text-gray-900 dark:text-white font-mono">{{ $bill->payment_reference }}</p>
                            </div>
                        @endif

                        @if($bill->notes)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Notes</label>
                                <p class="text-gray-900 dark:text-white">{{ $bill->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Resident Info -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Resident Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->resident->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->resident->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Unit
                                Number</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->unit_number }}</p>
                        </div>
                    </div>
                </div>

                <!-- Condominium Info -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Condominium</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Property</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->condominium->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Location</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->condominium->location }}</p>
                        </div>
                    </div>
                </div>

                <!-- Generated By -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Record Information</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 mb-1">Generated By</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->generatedByStaff->name }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 mb-1">Created</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 mb-1">Last Updated</label>
                            <p class="text-gray-900 dark:text-white">{{ $bill->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mark as Paid Modal -->
    <div id="markPaidModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Mark Bill as Paid</h3>
                <form action="{{ route('bills.mark-as-paid', $bill) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Payment Method <span class="text-red-500">*</span>
                            </label>
                            <select name="payment_method" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="qr_code">QR Code</option>
                                <option value="credit_card">Credit Card</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Payment Reference
                            </label>
                            <input type="text" name="payment_reference" placeholder="Transaction ID (optional)"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary">
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-4 mt-6">
                        <button type="button" onclick="document.getElementById('markPaidModal').classList.add('hidden')"
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Confirm Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
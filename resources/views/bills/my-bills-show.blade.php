@extends('layouts.dashboard')

@section('page-title', 'Bill Details')

@section('content')
  <div class="container-fluid px-6 py-8">
    <!-- Header -->
    <div class="flex items-center mb-6">
      <a href="{{ route('my-bills.index') }}"
        class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
        <i class="lni lni-arrow-left text-xl"></i>
      </a>
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Bill Details</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $bill->bill_number }}</p>
      </div>
    </div>

    <!-- Payment Submitted Success Message -->
    @if(session('success'))
      <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-2 border-green-500 rounded-xl p-6 text-center">
        <div class="flex justify-center mb-4">
          <div class="w-16 h-16 bg-green-100 dark:bg-green-900/40 rounded-full flex items-center justify-center">
            <i class="lni lni-checkmark text-3xl text-green-600 dark:text-green-400"></i>
          </div>
        </div>
        <h3 class="text-xl font-bold text-green-800 dark:text-green-200 mb-2">
          Payment Proof Submitted Successfully!
        </h3>
        <p class="text-green-700 dark:text-green-300 mb-4">
          Your payment slip has been received. Our staff will review and approve it within 24 hours.
          You'll receive a notification once your payment is confirmed.
        </p>
        <a href="{{ route('my-bills.index') }}"
          class="inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium hover:text-white rounded-lg transition-colors">
          <i class="lni lni-arrow-left mr-2"></i>
          Back to Bills Page
        </a>
      </div>
    @endif

    <!-- Payment Pending Approval Notice -->
    @if($bill->hasPendingProof() && !session('success'))
      <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-300 dark:border-yellow-700 rounded-xl p-6">
        <div class="flex items-start">
          <div class="flex-shrink-0">
            <i class="lni lni-hourglass text-2xl text-yellow-600 dark:text-yellow-400"></i>
          </div>
          <div class="ml-4 flex-grow">
            <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2">
              Payment Under Review
            </h3>
            <p class="text-yellow-700 dark:text-yellow-300 mb-3">
              Your payment proof was submitted on {{ $bill->payment_submitted_at->format('F d, Y \a\t g:i A') }}.
              Our staff is reviewing your submission.
            </p>
            @if($bill->payment_proof)
              <div class="mt-3">
                <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-2 font-medium">Submitted Payment Slip:</p>
                <img src="{{ Storage::url($bill->payment_proof) }}" alt="Payment Proof"
                  class="max-w-xs rounded-lg border-2 border-yellow-300 dark:border-yellow-700">
              </div>
            @endif
          </div>
        </div>
      </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Details -->
      <div class="lg:col-span-2 space-y-6">
        @if ($bill->status === 'paid')
          <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4">
            <p class="text-sm font-medium text-green-800 dark:text-green-200">
              ✅ Your payment has been received. The Juristic staff will review and confirm your payment.
            </p>
          </div>
        @endif

        <!-- Bill Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Bill Information</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Bill Number</label>
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
              <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ $bill->getStatusBadgeColor() }}">
                {{ ucfirst($bill->status) }}
              </span>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Issue Date</label>
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
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Payment Method</label>
                <p class="text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $bill->payment_method) }}</p>
              </div>
            @endif

            @if($bill->payment_reference)
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Payment Reference</label>
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

        <!-- Payment Section (Only for pending/overdue bills without pending proof) -->
        @if(($bill->status === 'pending' || $bill->status === 'overdue') && !$bill->hasPendingProof())
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Payment Options</h2>

            <!-- Payment Method Selection -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
              <!-- QR Code Payment -->
              <button type="button" onclick="showPaymentMethod('qr')"
                class="payment-method-btn active p-6 rounded-lg border-2 border-primary bg-primary/5 dark:bg-primary/10 text-left transition-all hover:border-primary hover:bg-primary/10">
                <div class="flex items-center mb-2">
                  <i class="lni lni-qr text-3xl text-primary mr-3"></i>
                  <span class="font-semibold text-gray-800 dark:text-white">QR Code</span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Scan QR to pay instantly</p>
              </button>

              <!-- Card Payment -->
              <button type="button" onclick="showPaymentMethod('card')"
                class="payment-method-btn p-6 rounded-lg border-2 border-gray-200 dark:border-gray-700 text-left transition-all hover:border-primary hover:bg-primary/10">
                <div class="flex items-center mb-2">
                  <i class="lni lni-credit-cards text-3xl text-gray-600 dark:text-gray-400 mr-3"></i>
                  <span class="font-semibold text-gray-800 dark:text-white">Card Payment</span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Pay with credit/debit card</p>
              </button>

              <!-- Cash at Office -->
              <button type="button" onclick="showPaymentMethod('cash')"
                class="payment-method-btn p-6 rounded-lg border-2 border-gray-200 dark:border-gray-700 text-left transition-all hover:border-primary hover:bg-primary/10">
                <div class="flex items-center mb-2">
                  <i class="lni lni-money-protection text-3xl text-gray-600 dark:text-gray-400 mr-3"></i>
                  <span class="font-semibold text-gray-800 dark:text-white">Cash Payment</span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Pay at juristic office</p>
              </button>
            </div>

            <!-- QR Code Payment Content -->
            <div id="qr-payment" class="payment-content">
              <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Scan QR Code to Pay</h3>

                  <!-- QR Code -->
                  <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <img
                      src="https://api.qrserver.com/v1/create-qr-code/?size=256x256&data={{ urlencode('https://ideobravo.site/payment?amount=' . $bill->amount . '&bill=' . $bill->bill_number) }}"
                      alt="Payment QR Code" class="w-64 h-64">
                  </div>
                  <p class="text-xs text-center text-gray-500 dark:text-gray-400 mb-4">Bill #{{ $bill->bill_number }}</p>

                  <!-- Amount Display -->
                  <div
                    class="bg-gradient-to-r from-primary/10 to-blue-500/10 border-2 border-primary/30 rounded-lg p-4 mb-6 w-full max-w-md">
                    <p class="text-center text-gray-700 dark:text-gray-300 text-sm mb-1">Amount to Pay</p>
                    <p class="text-center text-3xl font-bold text-primary">{{ $bill->formatted_amount }}</p>
                  </div>

                  <!-- Instructions -->
                  <div class="w-full max-w-md mb-6">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                      <div class="flex items-start">
                        <i class="lni lni-information text-blue-600 dark:text-blue-400 text-xl mr-3 mt-0.5"></i>
                        <div>
                          <p class="text-sm text-blue-800 dark:text-blue-200 font-medium mb-2">
                            How to Pay:
                          </p>
                          <ol class="text-sm text-blue-700 dark:text-blue-300 space-y-1 list-decimal list-inside">
                            <li>Open your mobile banking app</li>
                            <li>Scan the QR code above</li>
                            <li>Confirm the payment amount</li>
                            <li>Complete the transaction</li>
                            <li>Upload your payment slip below</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Upload Form -->
                  <div class="w-full max-w-md">
                    <form action="{{ route('my-bills.upload-payment', $bill->id) }}" method="POST"
                      enctype="multipart/form-data" class="space-y-4">

                      @csrf

                      <!-- Upload Area -->
                      <div
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-primary transition-colors bg-white dark:bg-gray-800">
                        <div class="space-y-3">
                          <div class="flex justify-center">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                              <i class="lni lni-cloud-upload text-3xl text-primary"></i>
                            </div>
                          </div>

                          <div>
                            <label for="payment_slip" class="cursor-pointer">
                              <span class="text-primary hover:text-primary/80 font-medium">Click to upload</span>
                              <span class="text-gray-600 dark:text-gray-400"> or drag and drop</span>
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                              PNG, JPG, JPEG up to 5MB
                            </p>
                          </div>

                          <input type="file" id="payment_slip" name="payment_slip" accept="image/png,image/jpeg,image/jpg"
                            required class="hidden" onchange="previewPaymentSlip(this)">

                          @error('payment_slip')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                          @enderror
                        </div>

                        <!-- Preview Area -->
                        <div id="preview-container" class="hidden mt-4">
                          <div class="relative inline-block">
                            <img id="preview-image" src="" alt="Payment Slip Preview"
                              class="max-w-full h-48 rounded-lg border-2 border-gray-200 dark:border-gray-600">
                            <button type="button" onclick="removePreview()"
                              class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg transition-colors">
                              <i class="lni lni-close text-sm"></i>
                            </button>
                          </div>
                          <p id="file-name" class="text-sm text-gray-600 dark:text-gray-400 mt-2"></p>
                        </div>
                      </div>

                      <!-- Additional Information -->
                      <div>
                        <label for="payment_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                          Additional Notes (Optional)
                        </label>
                        <textarea id="payment_note" name="payment_note" rows="3"
                          placeholder="Add any additional information about your payment..."
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent resize-none"></textarea>
                        @error('payment_note')
                          <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                      </div>

                      <!-- Submit Button -->
                      <button type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2 shadow-md hover:shadow-lg">
                        <i class="lni lni-checkmark-circle"></i>
                        <span>Submit Payment Proof</span>
                      </button>

                      <!-- Success Info -->
                      <div
                        class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <div class="flex items-start">
                          <i class="lni lni-checkmark text-green-600 dark:text-green-400 text-xl mr-3 mt-0.5"></i>
                          <p class="text-sm text-green-800 dark:text-green-200">
                            Your payment will be verified within 24 hours. You'll receive a confirmation notification once
                            approved.
                          </p>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card Payment Content -->
            <div id="card-payment" class="payment-content hidden">
              <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Card Payment Details</h3>
                <form action="{{ route('my-bills.card.submit', $bill) }}" method="POST" class="space-y-4">
                  @csrf
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Card Number
                    </label>
                    <input type="text" name="card_number" placeholder="1234 5678 9012 3456" required maxlength="19"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                      Cardholder Name
                    </label>
                    <input type="text" name="card_name" placeholder="John Doe" required
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Expiry Date
                      </label>
                      <input type="text" name="expiry" placeholder="MM/YY" required maxlength="5"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        CVV
                      </label>
                      <input type="text" name="cvv" placeholder="123" required maxlength="4"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                  </div>
                  <div
                    class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <p class="text-sm text-yellow-800 dark:text-yellow-200">
                      <i class="lni lni-lock mr-2"></i>
                      Your payment information is encrypted and secure
                    </p>
                  </div>
                  <button type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                    Pay {{ $bill->formatted_amount }}
                  </button>
                </form>
              </div>
            </div>

            <!-- Cash Payment Content -->
            <div id="cash-payment" class="payment-content hidden">
              <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Cash Payment at Juristic Office</h3>
                <div class="space-y-4">
                  <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <p class="text-sm text-blue-800 dark:text-blue-200 mb-3">
                      <i class="lni lni-information mr-2"></i>
                      Please visit the juristic office to make your payment in cash.
                    </p>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                      <div class="flex items-start mb-3">
                        <i class="lni lni-map-marker text-primary text-xl mr-3 mt-1"></i>
                        <div>
                          <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Location</h4>
                          <p class="text-sm text-gray-600 dark:text-gray-400">
                            Juristic Office<br>
                            {{ $bill->condominium->name }}<br>
                            Ground Floor, Building A
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                      <div class="flex items-start mb-3">
                        <i class="lni lni-alarm-clock text-primary text-xl mr-3 mt-1"></i>
                        <div>
                          <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Office Hours</h4>
                          <p class="text-sm text-gray-600 dark:text-gray-400">
                            Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 9:00 AM - 1:00 PM<br>
                            Sunday: Closed
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-3">What to Bring:</h4>
                    <ul class="space-y-2">
                      <li class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                        <i class="lni lni-checkmark text-primary mr-2 mt-1"></i>
                        <span>Bill Number: <span class="font-mono font-semibold">{{ $bill->bill_number }}</span></span>
                      </li>
                      <li class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                        <i class="lni lni-checkmark text-primary mr-2 mt-1"></i>
                        <span>Exact amount or cash for change</span>
                      </li>
                      <li class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                        <i class="lni lni-checkmark text-primary mr-2 mt-1"></i>
                        <span>Your ID card or resident identification</span>
                      </li>
                    </ul>
                  </div>
                  <div
                    class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <p class="text-sm text-green-800 dark:text-green-200">
                      <i class="lni lni-offer mr-2"></i>
                      You will receive an official receipt upon payment confirmation.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Property Info -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Property Information</h3>
          <div class="space-y-3">
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Condominium</label>
              <p class="text-gray-900 dark:text-white">{{ $bill->condominium->name }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Unit Number</label>
              <p class="text-gray-900 dark:text-white">{{ $bill->unit_number }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Location</label>
              <p class="text-gray-900 dark:text-white">{{ $bill->condominium->location }}</p>
            </div>
          </div>
        </div>

        <!-- Help -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Need Help?</h3>
          <div class="space-y-3 text-sm">
            <p class="text-gray-600 dark:text-gray-400">
              If you have questions about this bill or payment, please contact the juristic office.
            </p>
            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
              <p class="text-gray-700 dark:text-gray-300">
                <i class="lni lni-phone mr-2 text-primary"></i>
                Phone: +66 2 123 4567
              </p>
              <p class="text-gray-700 dark:text-gray-300 mt-2">
                <i class="lni lni-envelope mr-2 text-primary"></i>
                Email: juristic@ideo.co.th
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function showPaymentMethod(method) {
      // Hide all payment contents
      document.querySelectorAll('.payment-content').forEach(content => {
        content.classList.add('hidden');
      });

      // Remove active class from all buttons
      document.querySelectorAll('.payment-method-btn').forEach(btn => {
        btn.classList.remove('active', 'border-primary', 'bg-primary/5', 'dark:bg-primary/10');
        btn.classList.add('border-gray-200', 'dark:border-gray-700');
      });

      // Show selected payment content
      document.getElementById(`${method}-payment`).classList.remove('hidden');

      // Add active class to selected button
      event.currentTarget.classList.add('active', 'border-primary', 'bg-primary/5', 'dark:bg-primary/10');
      event.currentTarget.classList.remove('border-gray-200', 'dark:border-gray-700');
    }

    // Card number formatting
    document.querySelector('input[name="card_number"]')?.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\s/g, '');
      let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
      e.target.value = formattedValue;
    });

    // Expiry date formatting
    document.querySelector('input[name="expiry"]')?.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length >= 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4);
      }
      e.target.value = value;
    });

    // CVV number only
    document.querySelector('input[name="cvv"]')?.addEventListener('input', function (e) {
      e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Payment slip preview
    function previewPaymentSlip(input) {
      const previewContainer = document.getElementById('preview-container');
      const previewImage = document.getElementById('preview-image');
      const fileName = document.getElementById('file-name');

      if (input.files && input.files[0]) {
        const file = input.files[0];

        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
          alert('File size must be less than 5MB');
          input.value = '';
          return;
        }

        // Validate file type
        if (!['image/png', 'image/jpeg', 'image/jpg'].includes(file.type)) {
          alert('Only PNG, JPG, and JPEG files are allowed');
          input.value = '';
          return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
          previewImage.src = e.target.result;
          fileName.textContent = file.name;
          previewContainer.classList.remove('hidden');
        };

        reader.readAsDataURL(file);
      }
    }

    function removePreview() {
      const input = document.getElementById('payment_slip');
      const previewContainer = document.getElementById('preview-container');
      const previewImage = document.getElementById('preview-image');

      input.value = '';
      previewImage.src = '';
      previewContainer.classList.add('hidden');
    }

    // Drag and drop functionality
    const dropArea = document.querySelector('#qr-payment .border-dashed');

    if (dropArea) {
      ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
      });

      function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
      }

      ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => {
          dropArea.classList.add('border-primary', 'bg-primary/5');
        }, false);
      });

      ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => {
          dropArea.classList.remove('border-primary', 'bg-primary/5');
        }, false);
      });

      dropArea.addEventListener('drop', function (e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const input = document.getElementById('payment_slip');

        if (files.length > 0) {
          input.files = files;
          previewPaymentSlip(input);
        }
      }, false);
    }
  </script>
@endsection
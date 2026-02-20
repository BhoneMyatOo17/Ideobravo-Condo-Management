<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Bill</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      color: #333;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f4f4f4;
    }

    .container {
      background-color: #ffffff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      padding-bottom: 20px;
      border-bottom: 3px solid #3d63dd;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      color: #3d63dd;
      margin-bottom: 10px;
    }

    .content {
      padding: 30px 0;
    }

    .bill-summary {
      background-color: #f8f9fa;
      border-left: 4px solid #3d63dd;
      padding: 20px;
      margin: 20px 0;
      border-radius: 4px;
    }

    .bill-summary h3 {
      margin-top: 0;
      color: #3d63dd;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #e9ecef;
    }

    .info-row:last-child {
      border-bottom: none;
    }

    .info-label {
      font-weight: 600;
      color: #666;
    }

    .info-value {
      color: #333;
    }

    .amount-box {
      background-color: #3d63dd;
      color: white;
      padding: 20px;
      text-align: center;
      border-radius: 8px;
      margin: 20px 0;
    }

    .amount-box .label {
      font-size: 14px;
      opacity: 0.9;
      margin-bottom: 5px;
    }

    .amount-box .amount {
      font-size: 32px;
      font-weight: bold;
    }

    .btn {
      display: inline-block;
      padding: 12px 30px;
      background-color: #3d63dd;
      color: #ffffff;
      text-decoration: none;
      border-radius: 6px;
      margin: 20px 0;
      font-weight: 600;
    }

    .btn:hover {
      background-color: #2d4fbd;
    }

    .alert {
      background-color: #fff3cd;
      padding: 15px;
      border-radius: 4px;
      margin: 15px 0;
      border-left: 4px solid #ffc107;
    }

    .footer {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid #e9ecef;
      color: #666;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="logo">IdeoBravo</div>
      <p style="color: #666; margin: 0;">Condominium Management System</p>
    </div>

    <div class="content">
      <h2 style="color: #3d63dd;">💳 New Bill Generated</h2>

      <p>Dear {{ $recipientName }},</p>

      <p>A new bill has been generated for your unit at <strong>{{ $bill->condominium->name }}</strong>.</p>

      <div class="amount-box">
        <div class="label">Amount Due</div>
        <div class="amount">฿{{ number_format($bill->amount, 2) }}</div>
      </div>

      <div class="bill-summary">
        <h3>Bill Details</h3>
        <div class="info-row">
          <span class="info-label">Bill Number:</span>
          <span class="info-value"><strong>{{ $bill->bill_number }}</strong></span>
        </div>
        <div class="info-row">
          <span class="info-label">Bill Type:</span>
          <span class="info-value">{{ $bill->getBillTypeLabel() }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Unit Number:</span>
          <span class="info-value">{{ $bill->unit_number }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Issue Date:</span>
          <span class="info-value">{{ $bill->issue_date->format('M d, Y') }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Due Date:</span>
          <span class="info-value"><strong
              style="color: #dc3545;">{{ $bill->due_date->format('M d, Y') }}</strong></span>
        </div>
        <div class="info-row">
          <span class="info-label">Status:</span>
          <span class="info-value">{{ ucfirst($bill->status) }}</span>
        </div>
      </div>

      @if($bill->notes)
        <div class="alert">
          <strong>📝 Note:</strong> {{ $bill->notes }}
        </div>
      @endif

      <p>Please ensure payment is made by the due date to avoid any late fees.</p>

      <div style="text-align: center;">
        <a href="{{ route('login') }}" class="btn">View Bill & Pay Online</a>
      </div>

      <p style="font-size: 14px; color: #666; margin-top: 20px;">
        <strong>Payment Methods Available:</strong><br>
        • Bank Transfer<br>
        • QR Code Payment<br>
        • Cash at Juristic Office<br>
        • Credit Card (Online)
      </p>
    </div>

    <div class="footer">
      <p>This is an automated notification from IdeoBravo Condominium Management System.</p>
      <p style="margin: 5px 0;">{{ $bill->condominium->name }}</p>
      <p style="margin: 5px 0;">{{ $bill->condominium->address }}</p>
      @if($bill->condominium->phone_number)
        <p style="margin: 5px 0;">Phone: {{ $bill->condominium->phone_number }}</p>
      @endif
    </div>
  </div>
</body>

</html>
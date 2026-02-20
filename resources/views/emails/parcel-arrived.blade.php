<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parcel Arrived</title>
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

    .parcel-info {
      background-color: #f8f9fa;
      border-left: 4px solid #3d63dd;
      padding: 20px;
      margin: 20px 0;
      border-radius: 4px;
    }

    .parcel-info h3 {
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

    .footer {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid #e9ecef;
      color: #666;
      font-size: 14px;
    }

    .highlight {
      background-color: #fff3cd;
      padding: 15px;
      border-radius: 4px;
      margin: 15px 0;
      border-left: 4px solid #ffc107;
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
      <h2 style="color: #3d63dd;">📦 You Have a Parcel Waiting!</h2>

      <p>Dear {{ $parcel->recipient_name }},</p>

      <p>Good news! A parcel has arrived for you at <strong>{{ $parcel->condominium->name }}</strong>.</p>

      <div class="parcel-info">
        <h3>Parcel Details</h3>
        <div class="info-row">
          <span class="info-label">Tracking Number:</span>
          <span class="info-value"><strong>{{ $parcel->tracking_number }}</strong></span>
        </div>
        <div class="info-row">
          <span class="info-label">Courier Service:</span>
          <span class="info-value">{{ $parcel->courier_service }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Unit Number:</span>
          <span class="info-value">{{ $parcel->unit_number }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Received Date:</span>
          <span class="info-value">{{ $parcel->received_date->format('M d, Y h:i A') }}</span>
        </div>
        @if($parcel->parcel_size)
          <div class="info-row">
            <span class="info-label">Size:</span>
            <span class="info-value">{{ ucfirst($parcel->parcel_size) }}</span>
          </div>
        @endif
      </div>

      @if($parcel->notes)
        <div class="highlight">
          <strong>📝 Note:</strong> {{ $parcel->notes }}
        </div>
      @endif

      <p>Please collect your parcel from the juristic office during office hours.</p>

      <div style="text-align: center;">
        <a href="{{ route('login') }}" class="btn">Login to IdeoBravo</a>
      </div>

      <p style="font-size: 14px; color: #666;">
        <strong>Office Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM<br>
        <strong>Location:</strong> Juristic Office, Ground Floor
      </p>
    </div>

    <div class="footer">
      <p>This is an automated notification from IdeoBravo Condominium Management System.</p>
      <p style="margin: 5px 0;">{{ $parcel->condominium->name }}</p>
      <p style="margin: 5px 0;">{{ $parcel->condominium->address }}</p>
    </div>
  </div>
</body>

</html>
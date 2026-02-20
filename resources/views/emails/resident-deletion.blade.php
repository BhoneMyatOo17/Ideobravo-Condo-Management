<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resident Profile Deletion Notice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-color: #3d63dd;
      color: #ffffff;
      padding: 30px 20px;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
    }

    .content {
      padding: 30px 20px;
    }

    .info-box {
      background-color: #f8f9fa;
      border-left: 4px solid #3d63dd;
      padding: 15px;
      margin: 20px 0;
    }

    .info-box p {
      margin: 5px 0;
    }

    .reason-box {
      background-color: #fff3cd;
      border-left: 4px solid #ffc107;
      padding: 15px;
      margin: 20px 0;
    }

    .footer {
      background-color: #f8f9fa;
      padding: 20px;
      text-align: center;
      font-size: 12px;
      color: #6c757d;
    }

    .button {
      display: inline-block;
      padding: 12px 30px;
      background-color: #3d63dd;
      color: #ffffff;
      text-decoration: none;
      border-radius: 5px;
      margin: 20px 0;
    }

    .alert {
      background-color: #f8d7da;
      border-left: 4px solid #dc3545;
      padding: 15px;
      margin: 20px 0;
      color: #721c24;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Resident Profile Deletion Notice</h1>
    </div>

    <div class="content">
      <p>Dear {{ $userName }},</p>

      <div class="alert">
        <strong>Important Notice:</strong> Your resident profile has been removed from the {{ $condominiumName }}
        management system.
      </div>

      <p>We are writing to inform you that your resident profile associated with <strong>Unit {{ $unitNumber }}</strong>
        has been deleted from our system.</p>

      <div class="info-box">
        <p><strong>Account Details:</strong></p>
        <p>Name: {{ $userName }}</p>
        <p>Email: {{ $userEmail }}</p>
        <p>Unit Number: {{ $unitNumber }}</p>
        <p>Condominium: {{ $condominiumName }}</p>
      </div>

      <div class="reason-box">
        <p><strong>Reason for Deletion:</strong></p>
        <p>{{ $deletionReason }}</p>
      </div>

      <p><strong>What this means:</strong></p>
      <ul>
        <li>Your resident-specific data has been removed from our system</li>
        <li>You will no longer have access to resident features (bills, parcels, announcements)</li>
        <li>Your user account remains active and can be used if you register with a new unit in the future</li>
        <li>This action was performed by: <strong>{{ $deletedBy }}</strong></li>
      </ul>

      <p>If you believe this action was taken in error or have any questions, please contact the management office
        immediately.</p>

      <p>Thank you for your understanding.</p>

      <p>Best regards,<br>
        {{ $condominiumName }} Management Team</p>
    </div>

    <div class="footer">
      <p>This is an automated notification from {{ $condominiumName }} Management System.</p>
      <p>Please do not reply to this email. For assistance, contact your building management office.</p>
      <p>&copy; {{ date('Y') }} IdeoBravo. All rights reserved.</p>
    </div>
  </div>
</body>

</html>
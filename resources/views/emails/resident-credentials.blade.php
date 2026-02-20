<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to IdeoBravo</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      color: #333333;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .email-container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #ffffff;
      padding: 30px 20px;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      font-size: 28px;
      font-weight: 600;
    }

    .header p {
      margin: 10px 0 0;
      font-size: 14px;
      opacity: 0.9;
    }

    .welcome-banner {
      background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
      padding: 20px;
      text-align: center;
      border-bottom: 3px solid #10b981;
    }

    .welcome-banner h2 {
      margin: 0;
      color: #065f46;
      font-size: 24px;
    }

    .welcome-banner p {
      margin: 10px 0 0;
      color: #047857;
      font-size: 14px;
    }

    .content {
      padding: 30px;
    }

    .greeting {
      font-size: 18px;
      color: #1f2937;
      margin-bottom: 20px;
    }

    .message {
      color: #4b5563;
      margin-bottom: 25px;
      font-size: 15px;
    }

    .unit-info {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      border-left: 4px solid #10b981;
      padding: 20px;
      margin: 25px 0;
      border-radius: 8px;
    }

    .unit-info h3 {
      margin: 0 0 10px;
      color: #065f46;
      font-size: 16px;
    }

    .unit-info p {
      margin: 5px 0;
      color: #047857;
      font-size: 15px;
    }

    .unit-info strong {
      color: #065f46;
    }

    .credentials-box {
      background-color: #f9fafb;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      padding: 20px;
      margin: 25px 0;
    }

    .credential-item {
      margin-bottom: 15px;
    }

    .credential-item:last-child {
      margin-bottom: 0;
    }

    .credential-label {
      font-weight: 600;
      color: #374151;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 5px;
    }

    .credential-value {
      font-size: 16px;
      color: #1f2937;
      font-weight: 500;
      padding: 10px;
      background-color: #ffffff;
      border-radius: 4px;
      border: 1px solid #d1d5db;
      font-family: 'Courier New', monospace;
    }

    .login-button {
      display: inline-block;
      background-color: #10b981;
      color: #ffffff;
      text-decoration: none;
      padding: 12px 30px;
      border-radius: 6px;
      font-weight: 600;
      margin: 20px 0;
      transition: background-color 0.3s;
    }

    .login-button:hover {
      background-color: #059669;
    }

    .features-box {
      background-color: #f0fdf4;
      border-left: 4px solid #10b981;
      padding: 20px;
      margin: 25px 0;
      border-radius: 4px;
    }

    .features-box h3 {
      margin: 0 0 15px;
      color: #065f46;
      font-size: 16px;
    }

    .features-list {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .features-list li {
      padding: 8px 0;
      color: #047857;
      font-size: 14px;
      display: flex;
      align-items: start;
    }

    .features-list li:before {
      content: "✓";
      color: #10b981;
      font-weight: bold;
      font-size: 18px;
      margin-right: 10px;
    }

    .warning-box {
      background-color: #fef3c7;
      border-left: 4px solid #f59e0b;
      padding: 15px;
      margin: 20px 0;
      border-radius: 4px;
    }

    .warning-box p {
      margin: 0;
      color: #92400e;
      font-size: 14px;
    }

    .footer {
      background-color: #f9fafb;
      padding: 20px;
      text-align: center;
      font-size: 13px;
      color: #6b7280;
      border-top: 1px solid #e5e7eb;
    }

    .footer p {
      margin: 5px 0;
    }

    .divider {
      height: 1px;
      background-color: #e5e7eb;
      margin: 25px 0;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <!-- Header -->
    <div class="header">
      <h1>🏢 IdeoBravo</h1>
      <p>Condominium Management System</p>
    </div>

    <!-- Welcome Banner -->
    <div class="welcome-banner">
      <h2>🎉 Welcome to Your New Home!</h2>
      <p>Your resident account has been created</p>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="greeting">
        Hello {{ $user->name }},
      </div>

      <div class="message">
        Welcome to <strong>{{ $condominium->name }}</strong>! You now have access to all the features of the
        IdeoBravo management system.
      </div>

      <!-- Unit Information -->
      <div class="unit-info">
        <h3>📍 Your Residence Information</h3>
        <p><strong>Condominium:</strong> {{ $condominium->name }} ({{ $condominium->code }})</p>
        <p><strong>Unit Number:</strong> {{ $unitNumber }}</p>
      </div>

      <!-- Credentials Box -->
      <div class="credentials-box">
        <div class="credential-item">
          <div class="credential-label">Email Address</div>
          <div class="credential-value">{{ $user->email }}</div>
        </div>
        <div class="credential-item">
          <div class="credential-label">Temporary Password</div>
          <div class="credential-value">{{ $password }}</div>
        </div>
      </div>

      <!-- Login Button -->
      <div style="text-align: center;">
        <a href="{{ url('/login') }}" class="login-button">
          Login to IdeoBravo
        </a>
      </div>

      <div class="divider"></div>

      <!-- Security Warning -->
      <div class="warning-box">
        <p><strong>⚠️ Important Security Notice:</strong></p>
        <p>Please change your password immediately after your first login. This temporary password should not be shared
          with anyone.</p>
      </div>

      <div class="message">
        If you have any questions or need assistance getting started, please don't hesitate to contact
        the building management or our support team.
      </div>

      <div class="message" style="margin-top: 30px;">
        Welcome home!<br>
        <strong>The IdeoBravo Team</strong>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p><strong>IdeoBravo - Condominium Management System</strong></p>
      <p>{{ $condominium->name }} ({{ $condominium->code }})</p>
      <p style="margin-top: 10px;">This is an automated message. Please do not reply to this email.</p>
      <p style="margin-top: 15px; font-size: 12px;">
        © {{ date('Y') }} IdeoBravo. All rights reserved.
      </p>
    </div>
  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $newsletterData['title'] }}</title>
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
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
      background: linear-gradient(135deg, #3d63dd 0%, #2d4fbd 100%);
      color: white;
      padding: 30px;
      text-align: center;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .tagline {
      font-size: 14px;
      opacity: 0.9;
    }

    .content {
      padding: 30px;
    }

    .greeting {
      font-size: 18px;
      color: #3d63dd;
      margin-bottom: 20px;
    }

    .newsletter-title {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .featured-image {
      width: 100%;
      max-width: 540px;
      height: auto;
      border-radius: 8px;
      margin: 20px 0;
    }

    .body-text {
      color: #555;
      line-height: 1.8;
      margin-bottom: 25px;
      white-space: pre-wrap;
    }

    .btn {
      display: inline-block;
      padding: 14px 32px;
      background-color: #3d63dd;
      color: #ffffff !important;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      margin: 20px 0;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #2d4fbd;
    }

    .divider {
      height: 1px;
      background-color: #e9ecef;
      margin: 30px 0;
    }

    .footer {
      background-color: #f8f9fa;
      padding: 30px;
      text-align: center;
      color: #666;
      font-size: 14px;
    }

    .footer-logo {
      font-size: 20px;
      font-weight: bold;
      color: #3d63dd;
      margin-bottom: 10px;
    }

    .social-links {
      margin: 20px 0;
    }

    .social-links a {
      display: inline-block;
      margin: 0 10px;
      color: #3d63dd;
      text-decoration: none;
      font-size: 24px;
    }

    .unsubscribe {
      font-size: 12px;
      color: #999;
      margin-top: 15px;
    }

    .unsubscribe a {
      color: #3d63dd;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <div class="logo">IdeoBravo</div>
      <div class="tagline">Condominium Management System</div>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="greeting">Hello {{ $subscriberName }},</div>

      <div class="newsletter-title">{{ $newsletterData['title'] }}</div>

      @if($newsletterData['image'])
        <img src="data:{{ $newsletterData['image']['mime'] }};base64,{{ $newsletterData['image']['data'] }}"
          alt="Newsletter Image" class="featured-image">
      @endif

      <div class="body-text">{{ $newsletterData['body'] }}</div>

      @if($newsletterData['button_text'] && $newsletterData['button_link'])
        <div style="text-align: center;">
          <a href="{{ $newsletterData['button_link'] }}" class="btn">{{ $newsletterData['button_text'] }}</a>
        </div>
      @endif
    </div>

    <!-- Footer -->
    <div class="footer">
      <div class="footer-logo">IdeoBravo</div>
      <p style="margin: 10px 0;">Leading the future of urban living in Thailand</p>

      <div class="divider"></div>

      <p style="margin: 10px 0;">© {{ date('Y') }} IdeoBravo Condominiums. All rights reserved.</p>
      <p style="margin: 5px 0;">Bangkok, Thailand</p>

      <div class="unsubscribe">
        <p>You're receiving this email because you subscribed to our newsletter.</p>
      </div>
    </div>
  </div>
</body>

</html>
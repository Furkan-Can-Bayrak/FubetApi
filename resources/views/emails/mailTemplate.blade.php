<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        h2 {
            color: #333333;
        }

        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            background-color: #000000;  /* Siyah arka plan */
            color: white !important;  /* Beyaz yazı rengi ve !important ekledim */
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <img src="{{ asset('logo/logo.png') }}" alt="Logo">
    </div>

    <h2>{{ $greeting }}</h2>

    <p>{{ $content }}</p>

    @if (!empty($buttonUrl) && !empty($buttonText))
        <p style="text-align: center;">
            <a href="{{ $buttonUrl }}" class="btn">{{ $buttonText }}</a>
        </p>
    @endif

    <p>Saygılarımızla,<br><strong>Fubet Ekibi</strong></p>

    <div class="footer">
        Bu e-posta Fubet sisteminden otomatik gönderilmiştir. Yanıtlamayınız.
    </div>
</div>
</body>
</html>

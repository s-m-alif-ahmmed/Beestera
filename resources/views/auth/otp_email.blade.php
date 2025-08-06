<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            border-radius: 5px 5px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .otp {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0;
        }

        .message {
            font-size: 16px;
            color: #555555;
            margin: 10px 0;
        }

        .footer {
            font-size: 12px;
            color: #777777;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Your OTP Code</h1>
        </div>
        <div class="otp">
            <span>{{ $token }}</span>
        </div>
        <div class="message">
            <p>This code will expire in 5 minutes. Please enter it on the OTP verification page.</p>
        </div>
        <div class="footer">
            <p>If you did not request this, please ignore this email.</p>
        </div>
    </div>
</body>

</html>

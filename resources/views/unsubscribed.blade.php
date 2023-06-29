<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Unsubscribe</title>
    <style>
        /* Add your custom styles here */

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }

        .unsubscribe-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            color: #777777;
            font-size: 16px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333333;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #555555;
        }

        .footer {
            margin-top: 30px;
            color: #999999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="unsubscribe-container">
        <h1>{{$text}}</h1>
        <p>You have successfully unsubscribed from our email communications.</p>
        <p>If you have unsubscribed by mistake, you can re-subscribe at any time by visiting our website or contacting our support team.</p>
        {{-- <a href="https://example.com" class="btn">Go to Homepage</a> --}}
    </div>

    <div class="footer">
        <p>© 2023 {{get_setting('title')}}.</p>
    </div>
</body>
</html>

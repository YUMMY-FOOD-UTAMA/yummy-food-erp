<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #D5D9E2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 45px 20px;
            border-radius: 24px;
            text-align: center;
        }

        .logo img {
            height: 35px;
        }

        .icon img {
            margin: 15px 0;
        }

        .content {
            font-size: 15px;
            color: #2F3044;
            line-height: 1.5;
        }

        .content p {
            margin: 9px 0;
        }

        .button {
            display: inline-block;
            padding: 11px 19px;
            background-color: #50cd89;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        .footer {
            font-size: 13px;
            color: #A1A5B7;
            margin-top: 20px;
        }

        .footer p {
            margin: 4px 0;
        }

        .social-icons img {
            margin: 0 10px;
        }

        a:hover {
            color: #009ef7;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{asset('assets/media/email/logo-1.svg')}}" alt="Logo">
    </div>
    <div class="icon">
        <img src="{{asset('assets/media/email/icon-positive-vote-2.svg')}}" alt="Positive Icon">
    </div>
    <div class="content">
        <p style="font-size: 22px; font-weight: 700; color: #181C32;">Reset your password!</p>
        <p style="color: #7E8299;">We received a request to reset your password. Click the button below to set a new
            password:</p>
        <a href="{{$url}}" class="button"
           style="background-color: #50cd89; color: #ffffff; text-decoration: none; padding: 11px 19px; border-radius: 6px; font-size: 14px; font-weight: 500;">Reset
            Password</a>
        <p style="color: #7E8299; margin-top: 20px;">If you did not request a password reset, please ignore this email
            or contact support if you have questions.</p>

        <br>
    </div>
    <div class="footer">
        <p style="font-size: 16px; padding: 10px; font-weight: 600; color: #181C32;">It’s all about customers!</p>
        <p style="padding: 2px">Call our customer care number: <span
                style="font-weight: 600;color: #181C32;">{{env('APP_INFO_PHONE_NUMBER')}}</span></p>
        <p style="padding: 2px">You may reach us at <a href="https://devs.keenthemes.com" target="_blank"
                                                       style="font-weight: 600;">devs.keenthemes.com</a>.
        </p>
        <p style="padding: 2px">We serve Mon-Fri, 9AM-18AM</p>
        <br>
        <div class="social-icons">
            <a href="#"><img src="{{asset('assets/media/email/icon-linkedin.svg')}}" alt="LinkedIn"></a>
            <a href="#"><img src="{{asset('assets/media/email/icon-dribbble.svg')}}" alt="Dribbble"></a>
            <a href="#"><img src="{{asset('assets/media/email/icon-facebook.svg')}}" alt="Facebook"></a>
            <a href="#"><img src="{{asset('assets/media/email/icon-twitter.svg')}}" alt="Twitter"></a>
        </div>
        <br>
        <p>&copy; Copyright Admin template.</p>
    </div>
</div>
</body>
</html>

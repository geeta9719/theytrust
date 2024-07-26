<!DOCTYPE html>
<html>
<head>
    <title>Review Request Resent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .email-container {
            background-color: white;
            border: 1px solid #d9d9d9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            padding: 20px;
            border-radius: 8px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            font-size: 14px;
            color: #333333;
        }
        .note {
            margin: 20px 0;
            padding: 15px;
            border-left: 3px solid #007bff;
            background-color: #f9f9f9;
        }
        .cta {
            display: block;
            width: fit-content;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="your-logo-url" alt="TheyTrust.us">
        </div>
        <div class="content">
            <p>Hi {{ $company->name }},</p>
            <p>Your service provider "<strong>{{ $company->name }}</strong>" has submitted a review request for the services they provided you.</p>
            <p>Please see a note by your provider:</p>
            <div class="note">
                {{ $review->details }}
            </div>
            <a href="your-review-link" class="cta">Click Here to write your review</a>
            <p>Thank you,</p>
            <p>They Trust Us team</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 They Trust Us. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

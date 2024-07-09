<!DOCTYPE html>
<html>
<head>
    <title>New Review Request</title>
</head>
<body>
    <p>Dear {{ $company->name }},</p>

    <p>A new review request has been submitted for your company. Here are the details:</p>

    <p><strong>Name:</strong> {{ $review->name }}</p>
    <p><strong>Email:</strong> {{ $review->email }}</p>
    <p><strong>Note:</strong> {{ $review->note }}</p>

    <p>Thank you,</p>
    <p>Your Company Name</p>
</body>
</html>

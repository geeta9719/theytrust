<!DOCTYPE html>
<html>
<head>
    <title>Review Request Resent</title>
</head>
<body>
    <p>Dear {{ $company->name }},</p>

    <p>The review request for your company has been resent. Here are the details:</p>

    <p><strong>Review ID:</strong> {{ $review->id }}</p>
    <p><strong>Review Details:</strong> {{ $review->details }}</p>

    <p>Thank you,</p>
    <p>Your Company Name</p>
</body>
</html>

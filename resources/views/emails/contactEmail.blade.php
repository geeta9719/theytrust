<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['subject'] }} | TheyTrustUs</title>
</head>
<body>
    <h2>Hi Admin, you have a new contact email. The details are below: </h2>
    <p>First Name: {{ $details['first_name'] }}</p>
    <p>Last Name: {{ $details['last_name'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    <p>Phone: {{ $details['phone'] }}</p>
    <p>Help Option: {{ $details['help_options'] }}</p>
    <p>Thank you</p>
    <p>TheyTrustUs</p>
</body>
</html>
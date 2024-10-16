<!DOCTYPE html>
<html>
<head>
    <title>Account Verification</title>
</head>
<body>
    <div style="background-color: #f9f9f9; padding: 20px; font-family: Arial, sans-serif;">
        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <img src="https://theytrust-us.developmentserver.info/front_components/images/logo.png" alt="They Trust Us Logo" style="width: 150px; display: block; margin: 0 auto;">
            <h2 style="text-align: center; color: #333;">Account Verification for They Trust Us</h2>
            <p>Hi {{ $user->first_name }} {{ $user->last_name }},</p>
            <p>Thanks for signing up for "They Trust Us". Before we get started, please click the button below to verify your email address. This link will expire after 7 days.</p>
            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ url('verify-email/' . $user->verification_token) }}" style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Verify Email</a>
            </div>
            <p>Or copy and paste this link to your browser:</p>
            <p><a href="{{ url('verify-email/' . $user->verification_token) }}">{{ url('verify-email/' . $user->verification_token) }}</a></p>
            <p>See you aboard!</p>
            <p>They Trust Us team</p>
        </div>
    </div>
</body>
</html>

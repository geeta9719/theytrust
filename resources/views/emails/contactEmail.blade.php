<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $details['subject'] }} | They Trust Us</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#1a1a2e; padding:24px; text-align:center;">
                            <img src="https://theytrust.us/front_components/images/logo.png" alt="They Trust Us" style="max-width:140px;" />
                        </td>
                    </tr>
                    {{-- Title --}}
                    <tr>
                        <td style="padding:28px 30px 10px; text-align:center;">
                            <h2 style="margin:0; color:#1a1a2e; font-size:20px;">New Contact Enquiry</h2>
                        </td>
                    </tr>
                    {{-- Body --}}
                    <tr>
                        <td style="padding:10px 30px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:15px; color:#333333; line-height:1.8;">
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; width:140px; vertical-align:top;">First Name:</td>
                                    <td style="padding:8px 0;">{{ $details['first_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; vertical-align:top;">Last Name:</td>
                                    <td style="padding:8px 0;">{{ $details['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; vertical-align:top;">Email:</td>
                                    <td style="padding:8px 0;"><a href="mailto:{{ $details['email'] }}" style="color:#4a6cf7;">{{ $details['email'] }}</a></td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; vertical-align:top;">Phone:</td>
                                    <td style="padding:8px 0;">{{ $details['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; vertical-align:top;">Help Option:</td>
                                    <td style="padding:8px 0;">{{ $details['help_options'] }}</td>
                                </tr>
                                @if(!empty($details['message']))
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; vertical-align:top;">Message:</td>
                                    <td style="padding:8px 0;">{{ $details['message'] }}</td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#f8f9fa; padding:20px 30px; text-align:center; font-size:12px; color:#888888; border-top:1px solid #eeeeee;">
                            &copy; {{ date('Y') }} They Trust Us. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

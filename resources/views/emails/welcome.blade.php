<!DOCTYPE html>
<html>
<head>
    <title>Welcome to They Trust Us</title>
</head>
<body>
    <div style="background-color: #f4f4f4; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px;">
            <div style="text-align: center;">
                <img src="https://theytrust-us.developmentserver.info/front_components/images/logo.png" alt="They Trust Us" style="max-width: 100px;">
            </div>
            <h2 style="text-align: center;">Trust starts here - Welcome to They Trust Us</h2>
            <p>Hi {{ $name }},</p>
            <p>Whether you are a service provider or looking for a reliable vendor, We are here to help.</p>
            <p>If you are a service provider</p>
            <ol>
                <li>Create a <a href="{{ url('/profile') }}">profile</a></li>
                <li>Add your <a href="{{ url('/portfolio') }}">project portfolio</a></li>
                <li><a href="{{ url('/reviews') }}">Request reviews</a> from your customers</li>
                <li>Add predefined <a href="{{ url('/bundles') }}">Bundles</a></li>
                <li>Search <a href="{{ url('/projects') }}">Projects</a></li>
            </ol>
            <p>If you are a buyer</p>
            <ol>
                <li><a href="{{ url('/leave-review') }}">Leave a review</a> for your service provider</li>
                <li><a href="{{ url('/search') }}">Search a service provider</a></li>
                <li><a href="{{ url('/post-project') }}">Post a project</a></li>
                <li>Search for <a href="{{ url('/bundles') }}">Bundles</a></li>
            </ol>
            <p>Thank you,</p>
            <p>They Trust Us team</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Companies Sitemap</title>
    <link rel="icon" type="image/png" href="https://theytrust.us/front_components/images/favicon.png">


    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { font-size: 26px; margin-bottom: 10px; }
        p { font-size: 14px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ccc; }
        th { background-color: #f9f9f9; }
        a { color: #0645AD; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Companies Sitemap</h1>
    <p>This sitemap contains published companies currently visible on the platform.</p>
    <table>
        <thead>
            <tr>
                <th>Company URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td><a href="{{ url('/profile/' . $company->slug) }}" target="_blank">
                        {{ url('/profile/' . $company->slug) }}
                    </a></td>
                    <td>
                        {{ \Carbon\Carbon::parse($company->updated_at ?? $company->created_at)->format('d-m-Y') }}
                        ({{ \Carbon\Carbon::parse($company->updated_at ?? $company->created_at)->diffForHumans() }})
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

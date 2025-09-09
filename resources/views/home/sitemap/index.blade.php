<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>XML Sitemap</title>
    <link rel="icon" type="image/png" href="https://theytrust.us/front_components/images/favicon.png">

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px 12px; border-bottom: 1px solid #ccc; }
        th { background-color: #f0f0f0; text-align: left; }
        a { color: #0645AD; text-decoration: none; }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>Sitemap</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sitemaps as $map)
                <tr>
                    <td><a href="{{ $map['url'] }}" target="_blank">{{ $map['url'] }}</a></td>
                    <td>{{ $map['lastmod'] }}</td>
                </tr>b                
            @endforeach
        </tbody>
    </table>
</body>
</html>

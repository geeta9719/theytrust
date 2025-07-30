<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page Sitemap</title>
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
    <h1>Page Sitemap</h1>
    <p>This sitemap contains static public pages that are crawlable by search engines.</p>
    <table>
        <thead>
            <tr>
                <th>URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td><a href="{{ url($page['url']) }}" target="_blank">{{ url($page['url']) }}</a></td>
                    <td>{{ $page['lastmod'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

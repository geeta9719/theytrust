<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Categories Sitemap</title>
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
    <h1>Categories Sitemap</h1>
    <p>This sitemap lists all categories currently available under the "companies" section.</p>
    <table>
        <thead>
            <tr>
                <th>Category URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td><a href="{{ url('companies/' . $category->slug) }}" target="_blank">
                        {{ url('companies/' . $category->slug) }}
                    </a></td>
                    <td>
                    {{ \Carbon\Carbon::parse($category->updated_at ?? $category->created_at) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

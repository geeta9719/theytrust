<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subcategories Sitemap</title>
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
    <h1>Subcategories Sitemap</h1>
    <p>This sitemap lists subcategories under their respective categories.</p>

    <table>
        <thead>
            <tr>
                <th>Subcategory URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $item)
                <tr>
                    <td>
                        <a href="{{ url('companies/' . $item->cat_slug . '/' . $item->sub_slug) }}" target="_blank" rel="noopener">
                            {{ url('companies/' . $item->cat_slug . '/' . $item->sub_slug) }}
                        </a>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($item->last_modified)}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Deep Skills Sitemap</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { font-size: 26px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ccc; }
        th { background-color: #f9f9f9; }
        a { color: #0645AD; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Deep Skills Sitemap</h1>
    <table>
        <thead>
            <tr>
                <th>Deep Skill URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deepskills as $item)
                <tr>
                    <td>
                        <a href="{{ url('companies/' . $item->cat_slug . '/' . $item->sub_slug . '/' . $item->subchild_slug . '/' . $item->skill_slug) }}" target="_blank">
                            {{ url('companies/' . $item->cat_slug . '/' . $item->sub_slug . '/' . $item->subchild_slug . '/' . $item->skill_slug) }}
                        </a>
                    </td>
                    <td>{{ $latestDate->format('d-m-Y') }} ({{ $latestDate->diffForHumans() }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Skills Sitemap</title>
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
    <h1>Skills Sitemap</h1>
    <table>
        <thead>
            <tr>
                <th>Skill URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skills as $item)
                @php
                    $dt = $item->updated_at ? \Carbon\Carbon::parse($item->updated_at) : null;
                @endphp
                <tr>
                    <td>
                        <a href="{{ url('companies/' . $item->cat_slug . '/' . $item->sub_slug . '/' . $item->subchild_slug) }}" target="_blank">
                            {{ url('companies/' . $item->cat_slug . '/' . $item->sub_slug . '/' . $item->subchild_slug) }}
                        </a>
                    </td>
                    <td>
                        @if($dt)
                            {{ $dt }} 
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

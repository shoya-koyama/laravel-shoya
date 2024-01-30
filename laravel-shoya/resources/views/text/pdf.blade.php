<!DOCTYPE html>
<html>
<head>
    <title>Exported Texts</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Exported Texts</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($texts as $text)
                <tr>
                    <td>{{ $text->id }}</td>
                    <td>{{ $text->content }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

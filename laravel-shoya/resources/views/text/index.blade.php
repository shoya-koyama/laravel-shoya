<!DOCTYPE html>
<html>
<head>
    <title>Text Saver</title>
    <style>
        .text-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .text-content {
            margin-bottom: 10px;
        }
        .delete-form {
            display: inline;
        }
    </style>
</head>
<body>
    <form method="POST" action="/text">
        @csrf
        <!-- フォームのフィールド -->
        <input type="text" name="content">
        <button type="submit">Submit</button>
    </form>

    <h2>Saved Texts</h2>
    <ul>
        @foreach ($texts as $text)
            <li class="text-item">
                <div class="text-content">{{ $text->content }}</div>
                <form class="delete-form" method="POST" action="/text/{{ $text->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>

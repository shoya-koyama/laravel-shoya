<!DOCTYPE html>
<html>
<head>
    <title>Text Saver</title>
</head>
<body>
    <form method="POST" action="/text">
        @csrf
        <label for="content">Text:</label>
        <input type="text" name="content" id="content">
        <button type="submit">Save</button>
    </form>

    <h2>Saved Texts</h2>
    <ul>
        @foreach ($texts as $text)
            <li>{{ $text->content }}</li>
        @endforeach
    </ul>
</body>
</html>

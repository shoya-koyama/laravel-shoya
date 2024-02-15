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
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    
    <form method="POST" action="/text" enctype="multipart/form-data">
        @csrf
        <input type="text" name="content">
        <br>
        <p>or</p>
        <textarea rows="10" cols="60" name="content">ここに記入してください</textarea>
        <input type="file" name="file">
        <button type="submit">Submit</button>
    </form>

    <h2>Saved Texts</h2>
    <ul>
        @foreach ($texts as $text)
        <li class="text-item">
            <div class="text-content">{{ $text->content }}</div>
            @if (!empty($text->file_path))
            <!-- ファイルが画像の場合は表示、それ以外はダウンロードリンク -->
            @if (in_array(pathinfo($text->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                <div>
                    <img src="{{ asset($text->file_path) }}" alt="uploaded image" style="max-width: 100px; max-height: 100px;">
                </div>
            @else
                <div>
                    <a href="{{ asset($text->file_path) }}" target="_blank">Download File</a>
                </div>
            @endif
            @endif
                
            <form class="delete-form" method="POST" action="/text/{{ $text->id }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
        @endforeach

    </ul>

    <a href="/text/pdf" class="btn btn-primary">Download PDF</a>
</body>
</html>

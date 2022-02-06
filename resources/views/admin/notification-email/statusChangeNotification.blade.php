<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h5>Printing Status of a book has been changed. The details are given below,</h5>
    <h3>changed By:{{ $change_by }}</h3>

    <p><b>Title:</b>&nbsp;{{ $book_info['title']??'' }}</p>
    <p><b>Serise:</b>&nbsp;{{ $book_info['serise']['name']??'' }}</p>
    <p><b>Language:</b>&nbsp;{{ $book_info['language']??'' }}</p>
    <p><b>Author:</b>&nbsp;{{ $book_info['author']??'' }}</p>


    @if (is_array($change_data))
        @foreach ($change_data as $key=>$change_val)
            <p><b>{{ $key }}</b>:&nbsp; {{ $change_val }} -> {{ $book_content[$key] }}</p>
        @endforeach
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    {!! $post->content !!}

    <a href="https://twitter.com/share?url={{ request()->url() }}&text={{ $post->title }}&via=test&hashtags=fff
    ">Share on Twitter</a>
    <a href="https://www.facebook.com/sharer.php?u={{ request()->url() }}
    ">Share on Facebook</a>
</body>
</html>

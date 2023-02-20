<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <style>
        p{
            text-align: justify;
        }
    </style>
</head>
<body>
    <h3>{{$blogPost->title}}</h3>
    <p>{!! $blogPost->body !!}</p>
    <p><strong>Category:</strong> @isset($blogPost->blogHasCategory->category) {{ $blogPost->blogHasCategory->category }} @endisset</p>
    <p><strong>Author:</strong> {{ $blogPost->blogHasUser->name}}</p>
</body>
</html>
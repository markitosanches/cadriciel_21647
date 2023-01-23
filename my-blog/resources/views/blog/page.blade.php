
<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
    </tr>
    @foreach($blogPosts as $blogPost)
    <tr>
        <td>{{$blogPost->title}}</td>
        <td>{{$blogPost->blogHasUser->name}}</td>
    </tr>
    @endforeach
</table>
 {{ $blogPosts }}
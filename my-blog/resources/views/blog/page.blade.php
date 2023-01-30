@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-striped">
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
        </div>
    </div>
</div>


 @endsection

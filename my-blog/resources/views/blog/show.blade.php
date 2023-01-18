@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm">Retouner</a>
            <h4 class="display-one mt-2">
                {{ $blogPost->title }}
            </h4>
            <hr>
            <p> {!! $blogPost->body !!}</p>
            <strong>Author: {{ $blogPost->user_id }}</strong>
            <hr>
        </div>
    </div>
    <div class="row text-center mb-2">
        <div class="col-6">
            <a href="{{route('blog.edit', $blogPost->id)}}" class="btn btn-success">Mettre a jour</a>
        </div>
        <div class="col-6">
            <form action="{{ route('blog.edit', $blogPost->id)}}" method="post">
                @csrf
                @method('delete')
            <input type="submit" class="btn btn-danger" value="Effacer">
            </form>
        </div>
    </div>
</div>
@endsection

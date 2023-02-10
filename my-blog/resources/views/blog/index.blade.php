@extends('layouts.app')
@section('title', 'Blog List')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one">
                    @lang('lang.my_blog')
                </h1>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            Bonne lecture de nos articles
                        </p>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('blog.create')}}" class="btn btn-outline-primary">
                            Ajouter un article
                        </a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Liste des articles
                        </div>
                        <div class="card-body">
                            <ul>
                                @forelse($blogs as $blog)
                                        <li><a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title }}</a></li>
                                @empty
                                        <li class="text-danger">Aucun article de blog disponible</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection

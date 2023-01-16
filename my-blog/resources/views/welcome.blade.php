@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">
                    {{ config('app.name')}}
                </h1>
                <p>
                Ce blog génial contient de nombreux articles, cliquez sur le bouton ci-dessous pour les voir
                </p>
                <a href="{{ route('blog.index')}}" class="btn btn-outline-primary">
                    Afficher le blog
                </a>
            </div>
        </div>
    </div>
@endsection
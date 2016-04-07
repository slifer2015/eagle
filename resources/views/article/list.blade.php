@extends('home.layout')

@section('left_aside')
    @include('partials.latestArticles')
@endsection

@section('right_aside')
    @include('partials.categories')
@endsection

@section('content')

    @foreach($articles as $article)
        @include('partials.articleBox', $article)
    @endforeach

    <div class="text-center">{!! $articles->render() !!}</div>

@endsection
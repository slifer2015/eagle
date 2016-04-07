@extends('home.layout')

@section('left_aside')
    @include('partials.latestArticles')
    @include('partials.latestSessions')
@endsection

@section('right_aside')
    {{--@include('partials.userAccount')--}}
    @include('partials.categories')
    @include('partials.startup')
@endsection

@section('content')

    <div class="row">
        @foreach($courses as $course)
            @include('partials.courseBox', $course)
        @endforeach
    </div>

    <div class="row">
        @foreach($articles as $article)
            @include('partials.articleBox', $article)
        @endforeach
        <div class="text-center">{!! $articles->render() !!}</div>
    </div>


@endsection
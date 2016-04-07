@extends('home.layout')

@section('left_aside')
    @include('partials.latestArticles')
@endsection

@section('right_aside')
    @include('partials.categories')
@endsection

@section('content')

    <div class="row">
        @foreach($courses as $course)
            @include('partials.courseBox', $course)
        @endforeach
    </div>

@endsection
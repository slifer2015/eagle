@extends('home.layout')

@section('left_aside')
    @include('partials.latestArticles')
    @include('partials.latestSessions')
@endsection

@section('right_aside')
    {{--@include('partials.userAccount')--}}
    {{--@include('partials.categories')--}}
    @include('partials.startup')
@endsection

@section('content')

    <div class="row">
        <div class="panel panel-custom user-info panel-gray">
            <div class="panel-heading">
                <h4>{{ $user->fullname }}</h4>
            </div>
            <div class="panel-body">
                <div class="text-center">
                    <div class="avatar">
                        <img class="img-circle" src="{{ asset('img/persons/'.$user->avatar) }}" title="{{ $user->fullname }}" alt="{{ $user->fullname }}">
                    </div>

                    <p style="margin-top: 20px;" class="text-muted">
                        {{$user->description}}
                    </p>
                </div>

            </div>

        </div>
    </div>

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
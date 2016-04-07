@extends('home.layout')

@section('left_aside')
    @include('partials.latestArticles')
@endsection

@section('right_aside')
    @include('partials.categories')
@endsection

@section('content')
    <div class="panel panel-image">
        <div class="image">
            <a href="#" ><img src="{{ asset('img/files/'.$article->image) }}" title="{{ $article->title }}" alt="{{ $article->title }}" ></a>
            <?php
            $category=$article->categories()->first();
            ?>
            <div class="type">{{ $category->getRoot()->name }} , {{$category->name}}</div>
        </div>
        <div class="panel-heading article-title">
            <a href="#" class="title">{{ $article->title }}</a>
        </div>
        <div class="panel-body">
            <div class="description article-content">
                {!! $article->content !!}
            </div>
        </div>
        <div class="panel-footer clearfix">
            <div class="pull-right writer"><i class="glyphicon glyphicon-user"></i>نویسنده :   <a href="{{route('home.profile.show',$article->user->id)}}">{{ $article->user->fullname }}</a></div>
            <div class="pull-left comments"> {{ $article->num_comment }} <i class="glyphicon glyphicon-comment"></i></div>
            <div class="pull-left duration"> {{ $article->num_visit }} <i class="glyphicon glyphicon-eye-open"></i></div>
            <div class="pull-left article-date"><i class="glyphicon glyphicon-calendar"></i> {{ $article->day_shamsi_created_at }} </div>
        </div>
    </div>
@endsection
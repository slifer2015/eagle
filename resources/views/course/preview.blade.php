@extends('home.layout')

@section('left_aside')
    @include('course.partials.courseOwner')
    @include('partials.latestArticles')
@endsection

@section('right_aside')
    @include('course.partials.courseInfo')
    @include('partials.categories')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-16">
            <div class="panel panel-image">
                <div class="image">
                    <img src="{{ asset('img/files/'.$course->image) }}" title="{{ $course->title }}" alt="{{ $course->title }}" >
                    <div class="price">رایگان</div>
                </div>
                <div class="panel-heading">
                    <div class="title course-title">{{ $course->title}}</div>
                </div>
                <div class="panel-body">
                    <div class="description">{{ $course->description }}</div>


                    <div class="session-tags">
                        <ul>
                            @foreach($course->tags as $tag)
                                <li><a href="#">{{$tag->name}}</a><i class="fa fa-tag"></i> </li>
                            @endforeach
                        </ul>
                    </div><hr>

                    <div class="text-center course-sessions">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                @foreach($course->sessions as $key=>$session)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="text-right">
                                            <a href="{{ route('course.session.preview',[$course->id, $session->id]) }}">
                                                <i class="fa fa-play-circle-o fa-lg"></i>
                                                    <span class="session-title">
                                                        {{$session->title}}
                                                    </span>

                                                    <span class="pull-left label label-success free-session">رایگان</span>

                                            </a>
                                        </td>
                                        <td>{{ $session->duration }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    {{--<button class="btn btn-success btn-sm btn-block">ورود به دوره</button>--}}
                </div>
                <div class="panel-footer clearfix">
                    <div class="pull-right date"><i class="glyphicon glyphicon-calendar"></i> {{ $course->day_shamsi_created_at }} </div>
                    <div class="pull-left comments"> {{ $course->num_comment }} <i class="glyphicon glyphicon-comment"></i></div>
                    <div class="pull-left duration"> {{ $course->num_student }} <i class="glyphicon glyphicon-user"></i></div>
                </div>
            </div>
        </div>
    </div>

@endsection
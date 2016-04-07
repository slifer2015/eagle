{{--<div class="panel panel-image">--}}
    {{--<div class="image">--}}
        {{--<img src="{{ asset('img/files/'.$course->image) }}" title="{{ $course->name }}" alt="{{ $course->name }}" >--}}
        {{--<div class="price">رایگان</div>--}}
    {{--</div>--}}
    {{--<div class="panel-heading">--}}
        {{--<div class="title">{{ $course->name}}</div>--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
        {{--<div class="description">{{ str_limit($course->description, 100, '...') }}</div>--}}
        {{--<a href="{{ route('course.preview', $course->id) }}" class="btn btn-success btn-sm btn-block">ورود به دوره</a>--}}
    {{--</div>--}}
    {{--<div class="panel-footer clearfix">--}}
        {{--<div class="pull-right date"><i class="glyphicon glyphicon-calendar"></i> {{ $course->day_shamsi_created_at }} </div>--}}
        {{--<div class="pull-left comments"> {{ $course->num_comment }} <i class="glyphicon glyphicon-comment"></i></div>--}}
        {{--<div class="pull-left duration"> {{ $course->num_student }} <i class="glyphicon glyphicon-user"></i></div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="panel panel-custom course-info panel-blue">
    <div class="panel-heading">
اطلاعات دوره
    </div>
    {{--<div class="image">--}}
        {{--<img src="{{ asset('img/files/'.$course->image) }}" title="{{ $course->name }}" alt="{{ $course->name }}" >--}}
    {{--</div>--}}
    <div class="panel-body">
        <div class="text-right">
            <h5>{{ $course->title }}</h5>
            <p class="text-muted">{{ str_limit($course->description, 100) }}</p>
        </div>
        <div class="text-right attributes">
            <ul>
                <li class="text-muted" ><i class="glyphicon glyphicon-user"></i> مدرس : <a href="{{route('home.profile.show',$course->user->id)}}">{{ $course->user->fullname }}</a></li>
                <li class="text-muted" ><i class="glyphicon glyphicon-list"></i> جلسات :  <span>{{ $course->sessions->count() }}</span> جلسه </li>
                <li class="text-muted" ><i class="glyphicon glyphicon-time"></i> مدت : <span>{{ $course->sessions->count() }}</span> ساعت </li>
                <li class="text-muted" ><i class="glyphicon glyphicon-shopping-cart"></i> قیمت : <span>{{ $course->human_price }}</span></li>
            </ul>
        </div>
        <a href="#" class="btn btn-info btn-block btn-sm">شروع دوره</a>
    </div>

</div>


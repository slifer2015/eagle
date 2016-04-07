<div class="col-sm-8 pull-right">
    <div class="panel panel-image">
        <div class="image">
            <img src="{{ asset('img/files/'.$course->image) }}" title="{{ $course->title }}" alt="{{ $course->title }}" >
            <div class="price">رایگان</div>
        </div>
        <div class="panel-heading">
            <div class="title">{{ $course->title}}</div>
        </div>
        <div class="panel-body">
            <div class="description">{{ str_limit($course->description, 100, '...') }}</div>
            <a href="{{ route('course.preview', $course->id) }}" class="btn btn-success btn-sm btn-block">ورود به دوره</a>
        </div>
        <div class="panel-footer clearfix">
            <div class="pull-right date"><i class="glyphicon glyphicon-calendar"></i> {{ $course->day_shamsi_created_at }} </div>
            <div class="pull-left comments"> {{ $course->num_comment }} <i class="glyphicon glyphicon-comment"></i></div>
            <div class="pull-left duration"> {{ $course->num_student }} <i class="glyphicon glyphicon-user"></i></div>
        </div>
    </div>
</div>
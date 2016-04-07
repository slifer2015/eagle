<div class="panel panel-custom user-info panel-gray">
    <div class="panel-heading">
        مدرس دوره
    </div>
    <div class="panel-body">
        <div class="text-center">
            <div class="avatar">
                <img class="img-circle" src="{{ asset('img/persons/'.$course->user->avatar) }}" title="{{ $course->user->fullname }}" alt="{{ $course->user->fullname }}">
            </div>
            <h4><a href="{{route('home.profile.show',$course->user->id)}}">{{ $course->user->fullname }}</a></h4>
            <p class="text-muted">
                {{$course->user->description}}
            </p>
            <a href="#" class="btn btn-success btn-block btn-sm">سایر دوره ها</a>
        </div>

    </div>

</div>
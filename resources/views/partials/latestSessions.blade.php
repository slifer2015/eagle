<div class="panel panel-custom panel-gray">
    <div class="panel-heading text-center">
    جدیدترین جلسات
    </div>
    <div class="panel-body">

        <ul class="media-list articles-list">
            @foreach($latestSessions as $session)
            <li class="media">
                <div class="media-right">
                    <a href="{{ route('course.index') }}">
                        <img class="media-object" src="{{ asset('img/files/'.$session->course->image) }}" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h6 class="media-heading" style="line-height: 16px; font-size: 11px">{{ $session->title }}</h6>
                    <p class="date"  style="font-size: 10px">{{ $session->course->title }}</p>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
    <div class="panel-footer">
        <div class="text-center" style="font-size: 11px">
            @if(count($latestSessions))
                              جدیدترین جلسه {{ $latestSessions->first()->human_shamsi_created_at }}
            @endif
        </div>
    </div>
</div>

@foreach($comments->where('parent_id','0') as $newMainComment)
    <li class="media @if($newMainComment->parent_id==0) level1 @else reply @endif" data-obj-value="{{$obj->id}}" data-comment-value="{{$newMainComment->id}}">
        <div class="media-right">
            <a href="#">
                <img class="media-object" src="{{asset('images/persons/'.$newMainComment->user->avatar)}}" alt="">
            </a>
        </div>
        <div class="media-body comment-media">
            <a class="comment-author" href="#">
                {{$newMainComment->user->full_name}}
            </a>

            <div class="pull-left date-container">
                <span class="comment-date">{{$newMainComment->day_shamsi_created_at}} |</span>
                @if($newMainComment->parent_id==0)
                    @can('login')
                    <a id="{{$model}}" class="pull-left reply-button" href="#"> پاسخ</a>
                    @endcan
                @endif
            </div>

            <p>
                {{$newMainComment->content}}
            </p>
        </div>
    </li>
    @foreach($comments->where('parent_id',"$newMainComment->id") as $newComment)
        @include('comment.comment')
    @endforeach
@endforeach
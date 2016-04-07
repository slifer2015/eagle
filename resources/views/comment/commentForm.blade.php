<li class="media comment-form">
    <div class="media-right">
        <a href="#">
            <img class="media-object" src="{{asset('images/persons/'.$user->avatar)}}" alt="">
        </a>
    </div>
    <div class="media-body">
        @if($model=='course')
        <form method="post" class="form-horizontal" data-remote="true" action="{{route('ajax.course.comment.store',[$obj->id,0])}}">

            <textarea class="form-control" placeholder="لطفا نظر خود را وارد نمایید ..." name="content" id=""></textarea>
            <button type="submit" class="btn btn-learn">
                <i class="fa fa-paper-plane-o"></i>
                ارسال نظر
            </button>
        </form>
        @elseif($model=='article')
            <form method="post" class="form-horizontal" data-remote="true" action="{{route('ajax.article.comment.store',[$obj->id,0])}}">

                <textarea class="form-control" placeholder="لطفا نظر خود را وارد نمایید ..." name="content" id=""></textarea>
                <button type="submit" class="btn btn-learn">
                    <i class="fa fa-paper-plane-o"></i>
                    ارسال نظر
                </button>
            </form>
        @elseif($model=='session')
            <form method="post" class="form-horizontal" data-remote="true" action="{{route('ajax.session.comment.store',[$obj->id,0])}}">

                <textarea class="form-control" placeholder="لطفا نظر خود را وارد نمایید ..." name="content" id=""></textarea>
                <button type="submit" class="btn btn-learn">
                    <i class="fa fa-paper-plane-o"></i>
                    ارسال نظر
                </button>
            </form>
        @endif
    </div>
</li>
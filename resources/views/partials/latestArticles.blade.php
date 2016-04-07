<div class="panel panel-custom panel-gray">
    <div class="panel-heading text-center">
        آخرین مقالات
    </div>
    <div class="panel-body">

        <ul class="media-list articles-list">
            @foreach($latestArticles as $article)
                <li class="media">
                    <div class="media-right">
                        <a href="{{ route('article.preview', $article->id) }}" >
                            <img class="media-object" src="{{ asset('img/files/'.$article->image) }}" alt="{{ $article->title }}" title="{{ $article->title }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading article-title"><a href="{{ route('article.preview', $article->id) }}" >{{ $article->title }}</a></h6>
                        <span class="date">{{ $article->human_shamsi_created_at }}</span>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
    <div class="panel-footer">
        <div class="text-center">
            <a href="{{ route('article.index') }}"> <i class="glyphicon glyphicon-plus"></i> لیست مقالات</a>
        </div>
    </div>
</div>

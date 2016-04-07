<div class="panel panel-custom panel-blue">
    <div class="panel-heading text-center">
        دسته بندی ها
    </div>
    <ul class="list-group categories-list">
        @foreach($totalCategories as $category)
        <li class="list-group-item">
            <span class="badge pull-left">{{ $category->num }}</span>
            <a class="" href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
        </li>
        @endforeach
    </ul>
</div>
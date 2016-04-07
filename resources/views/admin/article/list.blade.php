@extends('admin.layout')
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>نویسنده</th>
                <th>دسته بندی اصلی</th>
                <th>وضعیت</th>
                <th>تاریخ انتشار</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $key=>$article)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->user->full_name}}</td>
                    <td>{{$article->categories()->first()->parent->name}}</td>
                    <td>
                        @if($article->published)
                            <label class="label-success label" for="">منتشر شده</label>
                        @else
                            <label class="label-warning label" for="">منتشر نشده</label>
                        @endif
                            @if($article->active)
                                <label class="label-success label" for="">فعال</label>
                            @else
                                <label class="label-danger label" for="">غیرفعال</label>
                            @endif
                    </td>
                    <td>{{$article->shamsi_created_at}}</td>
                    <td>
                        <a href="{{route('article.preview',$article->id)}}" class="btn btn-primary btn-sm">نمایش</a>
                        <a href="{{route('admin.article.edit',$article->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                        <a data-delete-confirm href="" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
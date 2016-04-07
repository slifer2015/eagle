@extends('admin.layout')
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>عنوان دوره</th>
                <th>نویسنده</th>
                <th>هزینه دوره (تومان)</th>
                <th>دسته بندی اصلی</th>
                <th>وضعیت</th>
                <th>تاریخ انتشار</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $key=>$course)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$course->title}}</td>
                    <td>{{$course->user->full_name}}</td>
                    <td>{{$course->price}}</td>
                    <td>{{$course->categories()->first()->parent->name}}</td>
                    <td>
                        @if($course->active)
                            <label class="label-success label" for="">فعال</label>
                        @else
                            <label class="label-danger label" for="">غیرفعال</label>
                        @endif
                    </td>
                    <td>{{$course->shamsi_created_at}}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">نمایش</a>
                        <a href="{{route('admin.course.session.index',$course->id)}}" class="btn btn-primary btn-sm">جلسات</a>
                        <a href="{{route('admin.course.edit',$course->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                        <a data-delete-confirm href="" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
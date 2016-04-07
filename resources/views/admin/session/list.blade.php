@extends('admin.layout')
@section('content')
    <div class="form-group">
        <a class="btn btn-success btn-md" href="{{route('admin.course.session.create',[$course->id])}}" >افزودن جلسه جدید به این دوره</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>عنوان جلسه</th>
                <th>نویسنده</th>
                <th>سطح</th>
                <th>وضعیت</th>
                <th>تاریخ انتشار</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sessions as $key=>$session)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$session->title}}</td>
                    <td>{{$session->user->full_name}}</td>
                    <td>
                        @if($session->level==1)
                            مقدماتی
                        @elseif($session->level==2)
                            متوسط
                        @elseif($session->level==3)
                            پیشرفته
                        @endif
                    </td>
                    <td>
                        @if($session->active)
                            <label class="label-success label" for="">فعال</label>
                        @else
                            <label class="label-danger label" for="">غیرفعال</label>
                        @endif
                    </td>
                    <td>{{$session->shamsi_created_at}}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">نمایش</a>
                        <a href="{{route('admin.course.session.edit',[$course->id,$session->id])}}" class="btn btn-info btn-sm">ویرایش</a>
                        <a data-delete-confirm href="" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
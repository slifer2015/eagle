@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ویرایش جلسه
                    <span style="color: #ff685d">{{$session->title}}</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($session,['route'=>['admin.course.session.update',$course->id,$session->id],'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                {!! Form::text('title',null,['class'=>'form-control','id'=>'title']) !!}
                            </div>
                            <div class="form-group">
                                <label for="file">فیلم جلسه (نام فایل)</label>
                                {!! Form::text('file',explode('/', $session->file)[1],['class'=>'form-control','id'=>'file']) !!}
                                <div style="margin-top: 30px;" class="embed-responsive embed-responsive-16by9">
                                    <video loop controls class="embed-responsive-item" style="width: 600px">
                                        <source src="{{route('session.video',[$session->id])}}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duration">مدت فیلم</label>
                                {!! Form::text('duration',null,['class'=>'form-control','id'=>'duration']) !!}
                            </div>
                            <div class="form-group">
                                <label for="attachment">افزودن فایل های جلسه</label>
                                <input class="form-control" id="attachment" name="attachment[]" type="file" multiple>
                                <div class="table-responsive">
                                    <table style="margin-top: 10px;" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>نام ذخیره شده</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($session->attachments as $key=>$attachment)
                                            <tr>
                                                <td width="5%">{{$key+1}}</td>
                                                <td dir="ltr" width="35%">{{$attachment->real_name}}</td>
                                                <td dir="ltr" width="40%">{{$attachment->file}}</td>
                                                <td width="20%">
                                                    <a data-session="{{$session->id}}" data-attachment="{{$attachment->id}}" data-delete-confirm href="{{route('ajax.session.attachment.delete',[$session->id,$attachment->id])}}" class="delete-session-attachment btn btn-danger btn-sm">حذف</a>
                                                    <a href="{{route('session.showFile',[$attachment->file])}}" class="btn btn-info btn-sm">دانلود</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>سطح جلسه</label>
                                {!! Form::select('level', [1=>'مقدماتی', 2=>'متوسط',3=>'پیشرفته'], 2, ['class'=>'form-control select-status']) !!}
                            </div>
                            <div class="form-group">
                                <label>توضیحات</label>
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'10']) !!}
                            </div>
                            <div class="form-group">
                                <label>وضعیت</label>
                                {!! Form::select('active', [1=>'فعال', 0=>'غیرفعال'], 0, ['class'=>'form-control select-status']) !!}
                            </div>
                            <div class="form-group">
                                <label>برچسب ها</label>
                                {!! Form::select('tags[]', $tags, $selected, ['id'=>'tags_select','class'=>'form-control','multiple']) !!}
                            </div>
                            <button type="submit" class="btn btn-success">ویرایش</button>

                            {!! Form::close() !!}
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection
@section('script')
@endsection
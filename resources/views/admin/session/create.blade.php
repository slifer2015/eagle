@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    افزودن جلسه به
                    <span style="color: #ff685d">{{$course->title}}</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::open(['route'=>['admin.course.session.store',$course->id],'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input id="title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="file">فیلم جلسه (نام فایل)</label>
                                <input class="form-control" id="file" name="file" type="text">
                            </div>
                            <div class="form-group">
                                <label for="attachment">آپلود فایل های جلسه</label>
                                <input class="form-control" id="attachment" name="attachment[]" type="file" multiple>
                            </div>
                            <div class="form-group">
                                <label>سطح جلسه</label>
                                {!! Form::select('level', [1=>'مقدماتی', 2=>'متوسط',3=>'پیشرفته'], 2, ['class'=>'form-control select-status']) !!}
                            </div>
                            <div class="form-group">
                                <label for="duration">مدت فیلم</label>
                                {!! Form::text('duration',null,['class'=>'form-control','id'=>'duration']) !!}
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
                                {!! Form::select('tags[]', [], null, ['id'=>'tags_select','class'=>'form-control','multiple']) !!}
                            </div>
                            <button type="submit" class="btn btn-success">ثبت</button>

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
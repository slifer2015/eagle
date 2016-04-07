@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    مقاله جدید
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::open(['route'=>'admin.article.store','method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input id="title" name="title" class="form-control"
                                       placeholder="عنوان را وارد نمایید ...">
                            </div>
                            <div class="form-group">
                                <label>دسته بندی اصلی</label>
                                {!! Form::select('category',$main, [], ['class'=>'form-control select-status','id'=>'mainCategory']) !!}
                            </div>
                            <div class="form-group">
                                <label>دسته بندی فرعی</label>
                                {!! Form::select('categories[]', [], null, ['id'=>'categories_select','class'=>'form-control','multiple']) !!}
                            </div>
                            <div class="form-group">
                                <label for="image">درج تصویر</label>
                                <input class="form-control" id="image" name="image" type="file">
                            </div>
                            {{--summernote--}}
                            {!! Form::textarea('content', null, ['class'=>'form-control article_summernote', 'rows'=>'10']) !!}
                            <div class="form-group">
                                <label>وضعیت انتشار</label>
                                {!! Form::select('published', [1=>'منتشر شود', 0=>'منتشر نشود'], 1, ['class'=>'form-control select-status']) !!}
                            </div>
                            <div class="form-group">
                                <label>برچسب ها</label>
                                {!! Form::select('tags[]', [], null, ['id'=>'tags_select','class'=>'form-control','multiple']) !!}
                            </div>
                            <button type="submit" class="btn btn-success">ارسال</button>

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
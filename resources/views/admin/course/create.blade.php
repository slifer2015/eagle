@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ثبت دوره آموزشی
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::open(['route'=>'admin.course.store','method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input id="title" name="title" class="form-control"
                                       placeholder="عنوان را وارد نمایید ...">
                            </div>
                            <div class="form-group">
                                <label for="image">درج تصویر</label>
                                <input class="form-control" id="image" name="image" type="file">
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
                                <label>توضیحات</label>
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'10']) !!}
                            </div>
                            <div class="form-group">
                                <label for="price">هزینه دوره</label>
                                <input id="price" name="price" class="form-control" placeholder="هزینه (تومان)">
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
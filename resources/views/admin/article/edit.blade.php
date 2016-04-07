@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ویرایش مقاله
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::model($article,['route'=>['admin.article.update',$article->id],'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                {!! Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'عنوان را وارد نمایید ...']) !!}
                            </div>
                            <div class="form-group">
                                <label>دسته بندی اصلی</label>
                                {!! Form::select('category',$main, $selectedMainCategory, ['class'=>'form-control select-status','id'=>'mainCategory']) !!}
                            </div>
                            <div class="form-group">
                                <label>دسته بندی فرعی</label>
                                {!! Form::select('categories[]', $subCategories, $selectedSubCategories, ['id'=>'categories_select','class'=>'form-control','multiple']) !!}
                            </div>
                            <div class="form-group">
                                <label for="image">درج تصویر</label>
                                <input class="form-control" id="image" name="image" type="file">
                                @if($article->image)
                                    <img style="max-width: 50%;" src="{{asset('img/files/'.$article->image)}}" alt="">
                                @else
                                    <h5 class="alert alert-info">تصویری برای نمایش وجود ندارد</h5>
                                @endif
                            </div>
                            {{--summernote--}}
                            {!! Form::textarea('content', null, ['class'=>'form-control article_summernote', 'rows'=>'10']) !!}
                            <div class="form-group">
                                <label>وضعیت انتشار</label>
                                {!! Form::select('published', [1=>'منتشر شود', 0=>'منتشر نشود'], null, ['class'=>'form-control select-status', 'placeholder'=>'']) !!}
                            </div>
                            <div class="form-group">
                                <label>برچسب ها</label>
                                {!! Form::select('tags[]', $tags, $selected, ['id'=>'tags_select','class'=>'form-control','multiple', 'placeholder'=>'']) !!}
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
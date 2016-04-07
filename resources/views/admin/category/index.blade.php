@extends('admin.layout')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            اضافه کردن دسته بندی جدید
        </div>
        <div class="panel-body">
            {!! Form::open(['route'=>'admin.category.store','method'=>'post', 'class'=>'form-inline']) !!}
            <div class="form-group">
                {!! Form::label('name', 'نام :') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            {!! Form::submit('ثبت', ['class'=>'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            لیست دسته بندی ها
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key=>$category)
                        <tr>
                            <td width="10%">{{$key+1}}</td>
                            <td width="50%">{{$category->name}}</td>
                            <td width="40%">
                                <a href="{{route('admin.category.subCategory.index',$category->id)}}" class="btn btn-primary btn-sm">زیرمجموعه</a>
                                <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                                <a data-delete-confirm href="{{route('admin.category.delete',$category->id)}}" class="btn btn-danger btn-sm">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            ویرایش دسته بندی
        </div>
        <div class="panel-body">
            @if(!$hasEdit)
                مقداری برای ویرایش موجود نیست
            @else
                {!! Form::model($categoryEdit, ['route'=>['admin.category.update', $categoryEdit->id], 'method'=>'put', 'class'=>'form-inline']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'نام :') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                {!! Form::submit('ویرایش', ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.category.index') }}" class="btn btn-default" >بازگشت</a>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection
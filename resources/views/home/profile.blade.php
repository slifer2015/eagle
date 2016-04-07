@extends('home.layout')

@section('left_aside')
    @include('partials.latestArticles')
    @include('partials.latestSessions')
@endsection

@section('right_aside')
    @include('partials.categories')
@endsection

@section('content')
    @if(!$user->confirmed)
    <div class="panel panel-default panel-custom">
        <div class="panel-body">
            {!! Form::open(['url'=>'/email', 'method'=>'post']) !!}

            <div class="email-confirmation clearfix">
                <h4 class="text-muted" >فعالسازی آدرس ایمیل</h4><hr>

                <div class="col-sm-3  pull-right text-center"><i class="fa fa-at fa-5x"></i> </div>
                <div class="col-sm-13 pull-right">
                    کاربر گرامی در حال حاضر آدرس ایمیل شما تایید نشده است. شما برای مدت محدودی می توانید
                    با این شرایط در سایت فعالیت داشته باشد.
                    ما پیشنهاد می کنیم تا تنها با چند کلیک آدرس ایمیل خود را فعال کنید. تنها کافی است به
                    آدرس ایمیلی که با آن در سایت عضو شده اید مراجعه کرده
                    و بر روی لینک فعال سازی آدرس ایمیل که از طرف ما برای شما ارسال شده است کلیک نمایید.
                    در صورتی که که قصد دریافت مجدد ایمیل فعال سازی را دارید بر روی دکمه زیر کلیک نمایید.
                </div>

            </div>
            {!! Form::submit('ارسال مجدد ایمیل فعال سازی', ['class'=>'btn btn-learn']) !!}

            {!! Form::close() !!}

        </div>
    </div>
    @endif


    <div class="panel panel-default panel-custom">
        <div class="panel-body imagic-title">
            <h4 class="text-muted" >
                <img src="{{ asset('img/persons/'.$user->avatar) }}" class="img-circle">
                اطلاعات فردی

            </h4><hr>
            {!! Form::model($user,['route'=>'profile.store','class'=>'','files'=>true]) !!}
            <div class="row">
                <div class="col-sm-8">

                    <div class="form-group">
                        <label for="last_name" class="control-label">نام خانوادگی   <span class="text-danger">*</span></label>
                        <div class="">
                            {!! Form::text('last_name',null,['class'=>'form-control','id'=>'last_name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">ایمیل</label>
                        <p class="form-control-static">{{$user->email}}</p>
                    </div>

                </div>
                <div class="col-sm-8">

                    <div class="form-group">
                        <label for="first_name" class="control-label">نام <span class="text-danger">*</span></label>
                        {!! Form::text('first_name',null,['class'=>'form-control','id'=>'first_name']) !!}
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label">تصویر پروفایل</label>
                        <input name="image" id="image" type="file" class="">
                    </div>



                </div>

                <div class="col-sm-12 pull-right">
                    <div class="form-group">
                        <label for="description" class="control-label">توضیحات</label>
                        {!! Form::textarea('description',null,['class'=>'form-control','id'=>'description','rows'=>3]) !!}
                    </div>
                </div>
            </div>




            <button type="submit" class="btn btn-md btn-success">
                <i class="fa fa-save"></i>
                ذخیره تغییرات
            </button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

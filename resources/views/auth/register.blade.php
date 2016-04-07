@extends('auth.layout')

@section('title')
    ثبت نام
@endsection

@section('content')
    <div class="col-sm-7 center-block register-container" style="margin-top: 20px">
        <div class="panel panel-default register-panel">
            <div class="panel-heading text-right">
                <div class="register-title">
                    <i class="glyphicon glyphicon-user fa-lg"></i>
                    <b>عضویت در نمآموز</b>
                </div>
                <div class="register-image pull-left">
                    <img src="{{asset('img/logo/namamooz_gray.png')}}" alt="...">
                </div>
            </div>
            <div class="panel-body">

                <!--show validation errors-->
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="register-form">
                    {!! Form::open(['class'=>'form-horizontal','role'=>'form','action'=>'Auth\AuthController@register']) !!}
                    <div class="form-group @if($errors->has('first_name')) has-error @endif">
                        <label for="first_name" class="col-sm-6 control-label pull-right">نام</label>

                        <div class="col-sm-10 pull-right">
                            <input type="text" name="first_name" class="form-control" id="first_name" value="{{old('first_name')}}">
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('last_name')) has-error @endif">
                        <label for="last_name" class="col-sm-6 control-label pull-right">نام خانوادگی</label>

                        <div class="col-sm-10 pull-right">
                            <input type="text" name="last_name" class="form-control" id="last_name" value="{{old('last_name')}}">
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label for="email" class="col-sm-6 control-label pull-right">ایمیل</label>

                        <div class="col-sm-10 pull-right">
                            <input type="email" name="email" class="form-control" id="email" value="{{old('last_name')}}">
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('password')) has-error @endif">
                        <label for="password" class="col-sm-6 control-label pull-right">انتخاب کلمه عبور</label>

                        <div class="col-sm-10 pull-right">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>

                    <div class="form-group @if($errors->has('password')) has-error @endif">
                        <label for="password_confirmation" class="col-sm-6 control-label pull-right">تکرار کلمه عبور</label>

                        <div class="col-sm-10 pull-right">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>
                    </div>

                    <div class="col-xs-16 text-center register-description">
                        کلیک کردن بر روی پیوستن به ما بدین معنی است که شما
                        <a class="registration-link" href="#">شرایط و ضوابط فعالیت در سایت </a>
                        را مطالعه کرده و پذیرفته اید.
                    </div>
                    <button type="submit" class="btn btn-block btn-learn register-btn">پیوستن به ما</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel-footer">
                آیا قبلا به ما پیوسته اید ؟
                <a class="registration-link" href="{{url('/login')}}">وارد حساب کاربری خود شوید</a>
            </div>
        </div>
    </div>
@endsection


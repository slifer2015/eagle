@extends('auth.layout')
@section('title')
    بازیابی رمز عبور
@endsection
@section('content')
    <div class="col-sm-5 center-block register-container">
        <div class="register-panel">
            @if(Session::has('status'))
                <div class="alerts-box">
                    <div class="alert alert-success alert-dismissable tinker-alert" role="alert" >
                        <button type="button" class="close tinker-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <ul class="">
                            <li>{{ Session::get('status')  }}</li>
                        </ul>
                    </div>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="register-title">
                        <i class="fa fa-unlock fa-lg"></i>
                        بازیابی رمز عبور
                    </div>
                    <div class="register-image pull-left">
                        {{--<img src="{{asset('img/logo/namamooz_gray.png')}}" alt="...">--}}
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

                    <div class="password-reset-form">
                        {!! Form::open(['class'=>'form-horizontal','role'=>'form','action'=>'Auth\PasswordController@reset']) !!}
                        {!! Form::hidden('token',  "$token" ) !!}
                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            <label for="email" class="control-label">آدرس ایمیل عضویت در سایت</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group @if($errors->has('password')) has-error @endif">
                            <label for="password" class="control-label">انتخاب کلمه عبور جدید</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group @if($errors->has('password')) has-error @endif">
                            <label for="password_confirmation" class="control-label">تکرار کلمه عبور جدید</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>
                        <div class="form-group last">
                            <div class="text-center">
                                {!! Form::button('ثبت کلمه عبور جدید', ['type'=>'submit', 'class'=>'btn btn-learn btn-block'] ) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="panel-footer">
                    آیا قبلا به ما پیوسته اید ؟
                    <a class="registration-link" href="{{url('/login')}}">وارد حساب کاربری خود شوید</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

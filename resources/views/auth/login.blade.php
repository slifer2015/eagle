@extends('auth.layout')
@section('title')
    ورود به نمآموز
@endsection
@section('content')
    <div class="col-sm-9 center-block register-container" style="margin-top: 40px">
        <div class="register-panel">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="register-title">
                        <span class="glyphicon glyphicon-user fa-lg"></span>
                        <b>                        ورود به سایت </b>
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

                    <div class="col-sm-10 pull-right">
                        <div class="direct-login">
                            {!! Form::open(['class'=>'form-horizontal','role'=>'form','action'=>'Auth\AuthController@login']) !!}
                                <div class="form-group @if($errors->has('email')) has-error @endif">
                                    <label for="email" class="col-sm-4 control-label pull-right">ایمیل :</label>

                                    <div class="col-sm-12 pull-right">
                                        <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('password')) has-error @endif">
                                    <label for="password" class="col-sm-4 control-label pull-right">کلمه عبور :</label>

                                    <div class="col-sm-12 pull-right">
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-16 pull-right">
                                        <div class="checkbox checkbox-success">
                                            <input name="remember" id="remember" type="checkbox">
                                            <label for="remember">
                                                من را بخاطر بسپار
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-learn register-btn">ورود به سایت</button>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="col-sm-6 pull-right">
                        <h4 class="text-center" >ورود با</h4>
                        <div class="social-login center-block">

                            <a class="login-with google" href="#">ورود با گوگل<i class="fa fa-google"></i></a>
                            <a class="login-with yahoo" href="#">ورود با یاهو</a>
                            <a class="login-with linkedin" href="#">ورود با لینکداین<i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>


                </div>
                <div class="panel-footer">
                    آیا تاکنون عضو نشده اید؟
                    <a class="registration-link" href="{{url('/register')}}">پس همین الان عضو شوید</a>
                    <div class="pull-left">
                        <a class="forget-password" href="{{url('/password/reset')}}">فراموشی کلمه عبور</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
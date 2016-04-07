<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>بازیابی رمز عبور</title>
    <style>

    </style>
</head>
<body>
<img style="float: left" src="{{asset('images/tinker2.png')}}" alt="...">
<h4 style="direction: rtl;font-weight: normal;float: right;color: #f34336;">برای بازیابی رمز عبور بر روی لینک زیر کلیک کنید .</h4>

<div style="float: left">
    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
</div>
</body>
</html>



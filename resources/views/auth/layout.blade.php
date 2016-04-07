<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{--<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">--}}
    <link type="text/css" rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

@include('partials.navbar')

<header>
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</header>


<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@yield('script')
</body>
</html>
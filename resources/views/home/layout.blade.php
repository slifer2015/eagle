<!DOCTYPE html>
<html>
<head lang="fa">
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    @if(isset($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    @if(isset($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/video-js.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/logo/favicon.ico') }}">
</head>
<body>

@include('partials.navbar')

<div class="container">
    <div class="row">
        <div class="col-md-9 pull-right">@yield('content')</div>
        <div class="col-md-7 pull-right">
            <div class="col-md-8">@yield('left_aside')</div>
            <div class="col-md-8">@yield('right_aside')</div>
        </div>
    </div>
</div>

@include('partials.footer')

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/video.js') }}"></script>
@yield('script')

</body>
</html>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/font.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <style>
    </style>
</head>
<body>

<!--header begins-->
<header>

    <!--navbar begins-->
    @include('partials.navbar')
    <!--navbar ends-->

    <!--main header begins-->
    @include('partials.mainHeader')
    <!--main header ends-->

</header>
<!--header ends-->

<!--main begins-->
<main>
    <div class="container">
        <div class="row">
            <aside class="aside">
                <div class="col-sm-4">
                    @yield('aside')
                </div>
            </aside>
            <div class="main">
                <div class="col-sm-8">
                    <div class="general-content">

                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        @include('flash::message')

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<!--main ends-->

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/typed.js')}}"></script>
<script>
    $(function () {
        $(".element").typed({
            strings: ["Hi Guys, I'm <span style='color:red'>Tinker</span>.^5000 <br>$ Second sentence.^5000 <br>$ Well I wanna Learn how to Code clearly.^5000 <br>$ Hi Emad what do you think about it.^5000 <br>$ We are working hard to make it.^5000 <br>$ "],
            typeSpeed: 10,
            loop: true,
            backDelay: 5000,
            contentType: 'html'
        });
    });
</script>
@yield('script')
</body>
</html>
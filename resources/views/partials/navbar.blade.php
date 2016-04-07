<nav class="navbar navbar-default navbar-fixed-top navbar-inverse site-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"> Namamooz </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if(!Auth::check())
                <li>
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="{{ url('login') }}" class="btn btn-xs btn-dark-blue">ورود</a>
                        <a href="{{ url('register') }}" class="btn btn-xs btn-dark-blue">عضویت</a>
                    </div>
                </li>
                @else
                    <li class="dropdown">
                        <div class="btn-group">
                            <a href="#" class="dropdown-toggle btn btn-xs btn-dark-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i> {{ Auth::user()->fullname }}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile.me') }}"><i class="glyphicon glyphicon-user"></i> پروفایل من </a></li>
                                {{--<li><a href="#"></a></li>--}}
                                {{--<li><a href="#">Something else here</a></li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li class="dropdown-header">Nav header</li>--}}
                                {{--<li><a href="#">Separated link</a></li>--}}
                                <li><a class="text-danger" href="{{ url('logout') }}"><i class="glyphicon glyphicon-alert"></i> خروج از سایت </a></li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ (URL::current() === url('/')) ? 'active' : '' }}"><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> صفحه اصلی </a></li>
                <li class="{{ (strpos(URL::current(),route('course.index')) !== false) ? 'active' : '' }}"><a href="{{ route('course.index') }}"><i class="glyphicon glyphicon-education"></i> دوره های آموزشی</a></li>
                <li class="{{ (strpos(URL::current(),route('article.index')) !== false) ? 'active' : '' }}"><a href="{{ route('article.index') }}"><i class="glyphicon glyphicon-edit"></i> مقالات</a></li>
                <li><a href="#about"><i class="glyphicon glyphicon-phone-alt"></i> ارتباط با ما </a></li>
            </ul>
        </div>
    </div>
</nav>
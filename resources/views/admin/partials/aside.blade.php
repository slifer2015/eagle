<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="جستجو ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> داشبورد</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> مقالات<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.article.create')}}">مقاله جدید</a>
                    </li>
                    <li>
                        <a href="{{route('admin.article.index')}}">مشاهده / ویرایش</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> دوره های آموزشی<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.course.create')}}">ثبت دوره جدید</a>
                    </li>
                    <li>
                        <a href="{{route('admin.course.index')}}">مشاهده / ویرایش</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{route('admin.category.index')}}"><i class="fa fa-table fa-fw"></i> مدیریت دسته بندی</a>
            </li>
        </ul>
    </div>
</div>
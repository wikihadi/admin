<ul class="navbar-nav">
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>--}}
    {{--</li>--}}
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link"><i class="fa fa-home"></i> داشبورد</a>
    </li>
{{--    <li class="nav-item d-none d-sm-inline-block">--}}
{{--        <a href="/tasks" class="nav-link">کارهای من</a>--}}
{{--    </li>--}}
    @role('admin')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/status" class="nav-link">فعالیتها</a>
    </li>
    @endrole
    @role('admin|modir')
    {{--<li class="nav-item d-none d-sm-inline-block">--}}
        {{--<a href="/jobs" class="nav-link">مشاهده کارها</a>--}}
    {{--</li>--}}


    <li class="nav-item d-none d-sm-inline-block">
        <a href="/pending?nouser" class="nav-link">کارهای آتی</a>
    </li>


    @endrole

    <li class="nav-item d-none d-sm-inline-block">
        <a href="/posts" class="nav-link">اطلاعیه ها</a>
    </li>
</ul>

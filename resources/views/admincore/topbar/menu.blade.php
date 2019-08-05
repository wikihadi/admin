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
{{--    @role('admin')--}}
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/status" class="nav-link">فعالیتها</a>
    </li>
{{--    @endrole--}}
    @role('admin|modir')
    {{--<li class="nav-item d-none d-sm-inline-block">--}}
        {{--<a href="/jobs" class="nav-link">مشاهده کارها</a>--}}
    {{--</li>--}}
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            مدیریت
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/pending?nouser" target="_blank">کارهای آتی</a>
            @can('task-create')
                <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/tasks/create" target="_blank">کار جدید</a>
            @endcan
            <div class="dropdown-divider"></div>

            @hasanyrole('admin')
            <a class="dropdown-item" href="/statics" target="_blank">آمار کاربران</a>
            <a class="dropdown-item" href="/finance" target="_blank">مالی</a>
            @endhasanyrole
            @hasanyrole('finance')
            <a class="dropdown-item" href="/finance-final" target="_blank">مالی</a>
            @endhasanyrole
            @hasanyrole('modir')
            <a class="dropdown-item" href="/finance-check" target="_blank">مالی</a>
            @endhasanyrole
        </div>
    </li>

{{--    <li class="nav-item d-none d-sm-inline-block">--}}
{{--        <a href="/pending?nouser" class="nav-link">کارهای آتی</a>--}}
{{--    </li>--}}


    @endrole

    <li class="nav-item d-none d-sm-inline-block">
        <a href="/posts" class="nav-link">اطلاعیه ها</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/tools/intercom" class="nav-link">داخلی ها</a>
    </li>
    @hasanyrole('admin|finMan|finance')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/tools/fin" class="nav-link">مدیریت هزینه</a>
    </li>
    @endhasanyrole


</ul>

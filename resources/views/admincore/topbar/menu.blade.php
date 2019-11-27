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
    @role('admin|designer')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/status" class="nav-link">فعالیتها</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/posts" class="nav-link">اطلاعیه ها</a>
    </li>
    @endrole


    @role('admin|modir')

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
            @endhasanyrole

        </div>
    </li>


    @endrole

    @role('admin|taskMan')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            مدیریت کارها
            <span class="badge-info badge">!</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="/request" class="dropdown-item">ثبت کار</a>
            <a class="dropdown-item" href="/pending?nouser" target="_blank">کارهای بدون تیم</a>

            <a href="#" class="dropdown-item">لیست کارهای ثبت شده من <span class="badge-info badge">بزودی</span></a>
        </div>
    </li>
    @endrole
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/tools/intercom" class="nav-link">داخلی ها</a>
    </li>
    @hasanyrole('admin|finMan|finance|taskMan|designer')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/tools/fin" class="nav-link">مدیریت هزینه</a>
    </li>
    @endhasanyrole

    @hasanyrole('admin')
    <li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link" href="/finance" target="_blank">مالی</a>
    </li>

    @endhasanyrole
    @hasanyrole('finance')
    <li class="nav-item d-none d-sm-inline-block">

    <a class="nav-link" href="/finance-final" target="_blank">مالی</a>
    </li>

    @endhasanyrole
    @hasanyrole('modir')
    <li class="nav-item d-none d-sm-inline-block">

    <a class="nav-link" href="/finance-check" target="_blank">مالی</a>
    </li>

    @endhasanyrole
</ul>

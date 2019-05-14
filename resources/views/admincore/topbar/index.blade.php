<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
@include('admincore.topbar.menu')

    <!-- SEARCH FORM -->
{{--@include('admincore.topbar.search')--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">

            {{--@include('admincore.topbar.notification')--}}


        {{--@role('admin')--}}
        {{--<li class="nav-item dropdown">--}}
            {{--<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">--}}
                {{--مدیریت--}}
            {{--</a>--}}
            {{--<div class="dropdown-menu">--}}
                {{--<a class="dropdown-item" href="/comments">گفتگوها</a>--}}
                {{--<a class="dropdown-item" href="/jobs">مشاهده کارها</a>--}}
                {{--<a class="dropdown-item" href="/pending">در انتظار</a>--}}
            {{--</div>--}}
        {{--</li>--}}


        {{--@endrole--}}
            @if(session()->has('success'))
            <li class="nav-item timeout">
                <a href="#" class="nav-link animated heartBeat infinite"><i class="fa fa-check text-success"></i></a>

            </li>
        @endif
        @include('admincore.topbar.message')

        <li class="nav-item animated">
            <a class="nav-link hvr-grow  animated fadeInUp d-none d-md-block statusSmile" data-toggle="modal" data-target="#crateStatus" http="#"><i
                        class="fa fa-smile-o" ></i></a>
            <a class="nav-link hvr-grow  animated fadeInUp d-md-none statusSmile" data-toggle="collapse" data-target="#crateStatus2" http="#"><i
                        class="fa fa-smile-o" ></i></a>



                @include('statuses.fixedMobile')
                @include('statuses.desktopModal')
        </li>

        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#"><i--}}
                        {{--class="fa fa-meh-o"></i></a>--}}
        {{--</li>--}}
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-bars"></i></a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

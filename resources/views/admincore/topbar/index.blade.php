<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
@include('admincore.topbar.menu')

    <!-- SEARCH FORM -->
{{--@include('admincore.topbar.search')--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">

        {{--@include('admincore.topbar.message')--}}
        {{--@include('admincore.topbar.notification')--}}

        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

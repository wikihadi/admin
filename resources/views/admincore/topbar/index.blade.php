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
        <li class="nav-item animated">
            <a class="nav-link hvr-grow  animated fadeInUp d-none d-md-block statusSmile" data-toggle="modal" data-target="#crateStatus" http="#"><i
                        class="fa fa-smile-o" ></i></a>
            <a class="nav-link hvr-grow  animated fadeInUp d-md-none statusSmile" data-toggle="collapse" data-target="#crateStatus2" http="#"><i
                        class="fa fa-smile-o" ></i></a>
            <!-- Modal -->
            
            <div id="crateStatus" class="modal fade" role="dialog" style="padding-right: 0!important;">
                <div class="modal-dialog modal-dialog-centered">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">چه خبر..</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('status.store') }}">
                                @csrf
                            <div class="input-group">
                            <input type="text" class="form-control InputToFocus" name="content" autocomplete="off" placeholder="در جریان بزارید..">
                                <div class="input-group-append">
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">

                                <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!----------------Mobile-------------------->
            <div class="fixed-bottom collapse bg-light" id="crateStatus2">
                <form method="post" action="{{ route('status.store') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control InputToFocus form-control-lg" name="content" autocomplete="off" placeholder="در جریان بزارید..">
                        <div class="input-group-prepend">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-check"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </li>
        @include('statuses.modalCreate')

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

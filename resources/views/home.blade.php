
@extends('admincore.app')



@section('css')

    <style>
        body, .content-wrapper, .main-heade, .bg-white ,footer{
            background: #2b2a2e!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
.nav-link{
    color: #888!important;
}
    </style>
@endsection
@section('content')


    <div class="col-md-10 col-lg-8 col-xl-6 m-auto mt-sm-5" style="">
    <div class="col-md-10 col-lg-8 col-xl-6 m-auto">
        <div class="row m-0">
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/profile" title="" class="btn btn-dark btn-block hvr-grow  animated fadeInDown">صفحه من</a>
                </div>
            </div>
            <div class="m-2 col-12"></div>

            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="#" class="btn btn-info btn-block hvr-grow animated fadeInDown" title="بزودی">اطلاعیه و قوانین</a>
                </div>
            </div>
            <div class="m-2 col-12"></div>
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/tasks" class="btn btn-success btn-block hvr-grow animated fadeInDown">کارهای من</a>
                </div>
            </div>

            @role('admin')
            <div class="m-2 col-12"></div>

            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/all-tasks" class="btn btn-light btn-block hvr-grow animated fadeInDown">همه کارها</a>
                </div>
            </div>
            <div class="m-2 col-12"></div>

            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/users" class="btn btn-light btn-block hvr-grow animated fadeInDown">کاربران</a>
                </div>
            </div>
            @endrole
            <div class="m-2 col-12"></div>
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a class="btn btn-danger btn-block hvr-grow animated fadeInDown" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        خروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>                </div>
            </div>
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top"  src="img/1.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top"  src="img/2.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top" src="img/3.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="right" src="img/4.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top" src="img/5.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top" src="img/1.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top" src="img/2.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top"  src="img/3.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-4 m-0 p-0">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a href="/tasks"><img data-toggle="tooltip" data-placement="top"  src="img/4.jpg" alt="" class="img-fluid hvr-push"></a>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
        </div>

</div>

@endsection


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
            {{--<div class="">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<button type="button" class="btn btn-dark btn-block hvr-grow  animated fadeInDown" data-toggle="modal" data-target="#crateStatus">Open Large Modal</button>--}}

{{--@include('statuses.modalCreate')--}}
                {{--</div>--}}
            {{--</div>--}}
            @hasanyrole('designer|admin')
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/profile" title="" class="btn btn-dark btn-block hvr-grow  animated fadeInDown">صفحه من</a>
                </div>
            </div>
                @endhasanyrole

            <div class="m-2 col-12"></div>

            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/posts" class="btn btn-info btn-block hvr-grow animated fadeInDown" title="بزودی">اطلاعیه و قوانین</a>
                </div>
            </div>
            @hasanyrole('designer|admin')

            <div class="m-2 col-12"></div>
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/tasks" class="btn btn-success btn-block hvr-grow animated fadeInDown">کارهای من</a>
                </div>
            </div>

            @endhasanyrole
            @hasanyrole('modir|admin')
            <div class="m-2 col-12"></div>
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/jobs" class="btn btn-success btn-block hvr-grow animated fadeInDown">مشاهده کارها</a>
                </div>
            </div>
            @endhasanyrole
            @can('task-create')

            <div class="m-2 col-12"></div>
            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/tasks/create" class="btn btn-warning btn-block hvr-grow animated fadeInDown">کار جدید</a>
                </div>
            </div>
            @endcan

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
            <div class="m-2 col-12"></div>

            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/task-meters" class="btn btn-light btn-block hvr-grow animated fadeInDown">Task Meter - موقت</a>
                </div>
            </div>
            <div class="m-2 col-12"></div>

            <div class="col-12 m-0 p-0">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/comments" class="btn btn-dark btn-block hvr-grow animated fadeInDown">گفتگوها</a>
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
        <div class="alert alert-info mt-5 text-center">لطفا در صورت مشاهده هرگونه خطا، از این طریق ما را باخبر نمایید. متشکرم <a href="/tasks/28" class="btn-outline-warning btn">گزارش خطا</a></div>


    </div>

@endsection

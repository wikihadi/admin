
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
    @if($read == 0)
        <div class="">
            <a href="/posts/15">
                <div class="alert alert-warning animated flash delay-1s"><strong><i class="fa fa-exclamation-triangle"></i></strong> لطفا مشاهده کنید</div>
            </a>
        </div>
    @endif
    @if($off === 1)

        <div id="offUser" class="modal  fade" role="dialog" style="padding-right: 0!important;">
            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content-->
                <div class="modal-content">
                     <div class="modal-body">
                        <form  method="post" action="{{ route('status.store') }}" class="text-center">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <input type="hidden" name="status" value="on">
                            <input type="hidden" name="content" value="برگشت به کار {{Auth::user()->name}}">

                            <button class="btn btn-link mt-2 text-info hvr-buzz-out" title="برگشت به کار" type="submit"><i class="fa fa-5x fa-power-off"></i></button>

                        </form>
                    </div>



                </div>

            </div>
        </div>

    @endif


    <div class="col-md-12 mt-sm-5 d-none d-md-block" style="">

        <div class="col-md-12">
        <div class="row d-flex justify-content-center">
            @hasanyrole('designer|admin')
            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/profile" title="" class="btn btn-dark btn-block hvr-grow  animated fadeInDown"><i class="fa fa-user"></i> صفحه من</a>
                </div>
            </div>
                @endhasanyrole

            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/posts" class="btn btn-info btn-block hvr-grow animated fadeInDown" title="بزودی"><i class="fa fa-info-circle"></i> اطلاعیه ها </a>
                </div>
            </div>
            @hasanyrole('designer|admin')

            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/tasks" class="btn btn-success btn-block hvr-grow animated fadeInDown">کارهای من</a>
                </div>
            </div>

            @endhasanyrole
            @hasanyrole('modir|admin')
            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/jobs" class="btn btn-success btn-block hvr-grow animated fadeInDown">مشاهده کارها</a>
                </div>
            </div>
            @endhasanyrole
            @can('task-create')

                <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/tasks/create" class="btn btn-warning btn-block hvr-grow animated fadeInDown">کار جدید</a>
                </div>
            </div>
            @endcan

            @role('admin')


            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/users" class="btn btn-light btn-block hvr-grow animated fadeInDown">کاربران</a>
                </div>
            </div>


            @endrole

            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">
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
        {{--<div class="alert alert-info mt-5 text-center">لطفا در صورت مشاهده هرگونه خطا، از این طریق ما را باخبر نمایید. متشکرم <a href="/tasks/28" class="btn-outline-warning btn">گزارش خطا</a></div>--}}


    </div>

    <div class="col-12 row mt-5">
        <div class="col-md-4 animated zoomIn offset-md-2">
            <div class="card bg-dark">

            <div class="card-header"  >
            <div class="float-right " data-toggle="collapse" data-target="#myActivities" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> آخرین پیامها
            </div>
                <div data-target="#crateStatus" data-toggle="modal" style="cursor: pointer" class="float-left" title="ارسال پیام" data-toggle="tooltip"><i class="fa fa-plus-circle"></i></div>
            </div>

                <ul class="list-group collapse show list-group-flush bg-dark" id="myActivities">
                    @foreach($messages as $s)

                        <li class="list-group-item bg-dark">
                            @if($s->toUser->id != Auth::id())
                                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="img-size-50 ml-3 img-circle " title="{{$s->user->name}} به {{$s->toUser->name}}">

                            <img src="/storage/avatars/{{$s->toUser->avatar}}" alt=""  style="width: 30px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" title="{{$s->user->name}} به {{$s->toUser->name}}">
                            @else
                                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="img-size-50 ml-3 img-circle " title="{{$s->user->name}} به {{$s->toUser->name}}">

                            @endif
                            <small>{{$s->content}}</small>
                        </li>
                    @endforeach
                        <a href="/profile" class="dropdown-item dropdown-footer"><small>همه</small></a>
                </ul>
        </div>
        </div>
        {{--<div class="col-md-4 animated zoomIn">--}}
            {{--<div class="card bg-dark">--}}
            {{--<div class="card-header"  >--}}
            {{--<div class="float-right " data-toggle="collapse" data-target="#myTasks" style="cursor: pointer">--}}
                {{--<i class="fa fa-arrow-circle-down"></i> آخرین کارهای فعال--}}
            {{--</div>--}}
            {{--</div>--}}

                {{--<ul class="list-group collapse list-group-flush bg-dark" id="myTasks">--}}
                    {{--@foreach($lastMyTaskStatus as $l)--}}
                        {{--<a href="/tasks/{{$l->task->id}}"><li class="list-group-item bg-dark"><small>{{$l->task->title}}</small><i class="fa fa-arrow-left float-left"></i></li></a>--}}
                    {{--@endforeach--}}
                        {{--<a href="/tasks" class="btn-block btn btn-sm btn-link"><small>همه</small></a>--}}

                {{--</ul>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-4 animated zoomIn" data-toggle="collapse" data-target="#myComments">
            <div class="card bg-dark">
            <div class="card-header"  >
            <div class="" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> آخرین نظرات
            </div>
            </div>

                <ul class="list-group collapse show list-group-flush bg-dark" id="myComments">
                    @foreach($lastMyComments as $l)
                        <a href="/tasks/{{$l->task->id}}">
                            <li class="list-group-item bg-dark">
                                <div class="border-bottom mb-2">
                                    <small class="text-muted">
                                        <img src="/storage/avatars/{{$l->user->avatar}}" alt="{{$l->user->name}}" title="{{$l->user->name}}" data-toggle="tooltip" style="width: 20px" class="ml-3 img-circle">
                                        در  {{$l->task->title}}:</small>
                                </div>

                                <small>{{$l->content}}</small>
                                <i class="fa fa-arrow-left float-left"></i>
                            </li>
                        </a>
                    @endforeach

                </ul>
            {{--<a href="/tasks" class="btn-block btn btn-sm btn-link"><small>همه</small></a>--}}
        </div>
        </div>
    </div>

@endsection
@section('JS')
    <script type="text/javascript" src="/js/status.js"></script>
    <script>
        $(window).on('load',function(){
            $('#offUser').modal('show');

        });
        $(function () {
            $('#offUser').modal({backdrop: 'static', keyboard: false})

        })
    </script>

    @endsection
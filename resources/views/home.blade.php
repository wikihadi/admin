
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
        @role('admin')
        <div class="d-flex flex-wrap justify-content-center mb-4 animated fadeIn delay-1s">
            @foreach($users as $u)
                <div class="mx-2">
                    @if($u->status == 'off')
                    <span class="badge badge-info position-absolute"><i class="fa fa-clock-o"></i></span>
                    @endif
                    <a href="/jobs/{{$u->id}}" target="_blank">
                    <img src="/storage/avatars/{{ $u->avatar }}" style="width: 30px" alt="" class="img-circle hvr-pop" title="{{$u->name}}" data-toggle="tooltip">
                    </a>

                </div>
            @endforeach

        </div>
        @endrole
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

    <div class="col-12 row mt-5 justify-content-center">
@role('admin')
        <div class="col-md-2 animated zoomIn">

            <div class="card bg-dark">

            <div class="card-header"  >
            <div class="float-right" data-toggle="collapse" data-target="#myActivities" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> کارهای باز
            </div>
                <div data-target="#crateStatus" data-toggle="modal" style="cursor: pointer" class="float-left" title="ارسال پیام" data-toggle="tooltip"><i class="fa fa-plus-circle"></i></div>
            </div>

                <ul class="list-group collapse show list-group-flush bg-dark" id="myActivities">

                        @foreach($currentJobs as $c)

                                    <li class="list-group-item bg-success py-1 px-2">
                                        <a href="/tasks/{{$c->task->id}}" target="_blank">
                                    <img src="/storage/avatars/{{$c->user->avatar}}" alt="" class="img-circle" style="width: 30px" title="{{$c->user->name}}" data-toggle="tooltip">
                                        <small style="font-size: 75%">{{$c->task->title}}</small>
                                        </a>

                                    </li>
                        @endforeach
                </ul>
        </div>
        </div>
        @endrole
        <div class="col-md-3 animated zoomIn">

            <div class="card bg-dark">

            <div class="card-header"  >
            <div class="float-right" data-toggle="collapse" data-target="#myActivities" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> آخرین پیامها
            </div>
                <div data-target="#crateStatus" data-toggle="modal" style="cursor: pointer" class="float-left" title="ارسال پیام" data-toggle="tooltip"><i class="fa fa-plus-circle"></i></div>
            </div>

                <ul class="list-group collapse show list-group-flush bg-dark" id="myActivities">
                    @foreach($messages as $s)

                        <li class="list-group-item bg-dark" data-toggle="collapse" data-target="#reply-form-{{$s->id}}">
                            @if($s->toUser->id != Auth::id())
                                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="img-size-50 ml-3 img-circle " title="به {{$s->toUser->name}}">

                            <img src="/storage/avatars/{{$s->toUser->avatar}}" alt=""  style="width: 30px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" title="به {{$s->toUser->name}}">
                            @else
                                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="img-size-50 ml-3 img-circle " title="{{$s->user->name}}">

                            @endif
                            <small>{{$s->content}}</small>

                        </li>
                        <li class="list-group-item collapse " id="reply-form-{{$s->id}}">
                            <form  method="post" action="{{ route('status.store') }}">
                                @csrf
                                <input type="hidden" name="to_user" value="{{$s->user->id}}">
                                <input type="hidden" name="user_id" value="{{$s->toUser->id}}">

                                <div class="input-group">
                                    <input type="text" class="form-control InputToFocus inputUserStatus" name="content" autocomplete="off" placeholder=".....">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-arrow-circle-left"></i></button>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="status" class="statusStatus">


                            </form>
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
        @role('admin')
        <div class="col-md-3 animated zoomIn " data-toggle="collapse" data-target="#admin">
            <div class="card bg-info">
                <div class="card-header"  >
                    <div class="" style="cursor: pointer">
                        <i class="fa fa-arrow-circle-down"></i>مشاهده ده نظر اخیر - مدیر
                    </div>
                </div>

                <ul class="list-group collapse show list-group-flush bg-dark" id="admin">
                    @foreach($lastComments as $l)
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
        @else
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
            @endrole

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
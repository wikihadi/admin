
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
@section('afterBody')
    @if($user->lastStatus == 'lunch-start')
        <div class="position-fixed d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
            <form  method="post" action="{{ route('status.store') }}" class="text-center text-center">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="status" value="lunch-end">
                <input type="hidden" name="content" value="برگشت به کار {{Auth::user()->name}}">
                <i class="fa fa-cutlery fa-5x text-info" style="font-size: 15rem"></i>
                <div class="Timer-lunch text-info text-lg"></div>
                <button class="btn btn-lg btn-info mt-2 animated infinite pulse" type="submit">ادامه کار <i class="fa fa-arrow-circle-left"></i></button>

            </form>
        </div>
    @endif
    @if($user->lastStatus == 'off')
        <div class="position-fixed d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
            <form  method="post" action="{{ route('status.store') }}" class="text-center text-center">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="status" value="on">
                <input type="hidden" name="content" value="برگشت به کار {{Auth::user()->name}}">
                <i class="fa fa-clock-o fa-5x text-info" style="font-size: 15rem"></i>
                <div class="Timer text-info text-lg"></div>
                <button class="btn btn-lg btn-info mt-2 animated infinite pulse" type="submit">ادامه کار <i class="fa fa-arrow-circle-left"></i></button>

            </form>
        </div>
    @endif
    @if($user->lastStatus == 'out')
        <div class="position-fixed d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
            <form  method="post" action="{{ route('status.store') }}" class="text-center text-center">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="status" value="in">
                <input type="hidden" name="content" value="شروع کار {{Auth::user()->name}}">
                <i class="fa fa-power-off fa-5x text-secondary" style="font-size: 15rem"></i>
                <div class=" text-secondary text-lg"></div>
                <button class="btn btn-lg btn-secondary mt-2 animated infinite pulse" type="submit">شروع کار <i class="fa fa-arrow-circle-left"></i></button>

            </form>
        </div>
    @endif
    {{--<div class="text-muted position-fixed d-flex justify-content-center flex-row-reverse w-100" style="z-index: 10000000;top: 20px; font-weight: lighter"><div class="clockH"></div>:<div class="clockM"></div>:<div class="clockS"></div></div>--}}

@endsection
@section('content')
    @if($read == 0)
        <div class="">
            <a href="/posts/16">
                <div class="alert alert-warning animated flash delay-1s"><strong><i class="fa fa-exclamation-triangle"></i></strong> لطفا مشاهده کنید</div>
            </a>
        </div>
    @endif




    <div class="col-md-12 mt-sm-5 d-none d-md-block" style="">

        @role('admin|modir')
        <div class="d-flex flex-wrap justify-content-center mb-4 animated fadeIn delay-1s">
            @foreach($users as $u)

                <div class="mx-2 text-center">
                    @if($u->lastStatus == 'off')
                    <span class="badge badge-info position-absolute"><i class="fa fa-clock-o"></i></span>
                    @endif

{{--                        <div class="text-muted text-center" data-toggle="modal" data-target="#userModal{{$u->id}}"  style="cursor: pointer"><span>.</span></div>--}}
                       <div class="position-relative">
                           <a href="/jobs/{{$u->id}}" target="_blank">
                                            <img src="/storage/avatars/{{ $u->avatar }}" style="width: 30px" alt="" class="img-circle hvr-pop" title="{{$u->name}}" data-toggle="tooltip">
                           </a>
                           @role('admin')
                           <div style="width: 30px;height: 30px; bottom: -30px; cursor: pointer" class="position-absolute position-relative"  data-toggle="modal" data-target="#userModal{{$u->id}}">
                               <i class="text-muted fa fa-ellipsis-h"></i>
                           </div>
@endrole

                       </div>

                        @role('admin')
                        <div class="modal fade" id="userModal{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-dark">
                                        <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title">{{$u->name}}
                                            <img src="/storage/avatars/{{ $u->avatar }}" style="width: 50px" alt="" class="img-circle">
                                        </h5>

                                    </div>
                                    <div class="modal-body">
                                        @if(!empty($u->phone))
                                        <small data-toggle="tooltip" title="تلفن همراه"><i class="fa fa-phone"></i> {{$u->phone}}</small>
                                        <small class="mx-2"></small>
                                        @endif
                                        <small  data-toggle="tooltip" title="عضویت"><i class="fa fa-user-circle"></i> {{$u->diff}}</small>
                                            <small class="mx-2"></small>
{{--                                            <user-status-comments-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="نظرات ثبت شده"></user-status-comments-count>--}}
{{--                                            <user-tasks-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="کارهای ثبت شده توسط {{$u->name}}"></user-tasks-count>--}}
                                            <user-tasks-self :user="{{$u->id}}" class="d-inline"></user-tasks-self>
{{--                                            <user-status-comments-to-user-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="پیامهای ارسالی"></user-status-comments-to-user-count>--}}


                                            <hr>

                                    </div>
{{--                                    <div class="modal-footer">--}}
{{--                                        @foreach($users as $u)--}}
{{--                                            <img src="/storage/avatars/{{ $u->avatar }}" style="width: 30px" alt="" class="img-circle hvr-pop" data-toggle="modal" data-target="#userModal{{$u->id}}">--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        @endrole

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


            {{--<div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">--}}
                {{--<div class="wrimagecard wrimagecard-topimage">--}}
                    {{--<a class="btn btn-danger btn-block hvr-grow animated fadeInDown" href="{{ route('logout') }}"--}}
                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                        {{--خروج--}}
                    {{--</a>--}}
                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                        {{--@csrf--}}
                    {{--</form>                </div>--}}
            {{--</div>--}}




        </div>
        </div>


    </div>

        <div class="col-12 row mt-5 justify-content-center">
            <i class="fa fa-arrows-v text-primary" data-toggle="collapse" data-target=".collapse"></i>

            <div class="col-sm-6 col-md-4 col-xl-2 col-lg-3 animated zoomIn">
                <div class="card bg-dark">
                    <div class="card-header" data-toggle="collapse" data-target=".tasks" style="cursor: pointer">
                        باکس


                    </div>
                        <status-list-box v-bind:user="{{Auth::id()}}"></status-list-box>

                </div>
            </div>
            @if(count($orderRoutine) > 0)
            <div class="col-sm-6 col-md-4 col-xl-2 col-lg-3 animated zoomIn">
                <div class="card bg-dark">
                    <div class="card-header" data-toggle="collapse" data-target=".tasks" style="cursor: pointer">
                        کارهای روتین
                    </div>
                    <div class="list-group collapse list-group-flush bg-dark tasks">
                        @foreach($orderRoutine as $or)

                        <div class="list-group-item @if($or->lastStatus != 2) bg-dark @else bg-success @endif">
                            <form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="task_id" value="{{$or->task->id}}">
                                <input type="hidden" name="status" value="start">
                                <input type="hidden" name="content" value="شروع کار {{$or->task->id}} - {{$or->task->title}}">
                                <a href="/tasks/{{$or->task->id}}"><small>{{$or->task->title}}</small></a>
                                @if($or->lastStatus != 2)
                                <button class="btn btn-link text-light p-0 mx-1 float-left" title="شروع کار {{$or->task->title}}" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>
                                @endif
                            </form>
                        </div>

                        @endforeach
                            <a href="/tasks?sort=routine" class="dropdown-footer"><small>همه</small></a>

                    </div>

                </div>
            </div>
            @endif
                @if(!empty($myOrderCurrent) || count($orderCurrent) > 0)

                <div class="col-sm-6 col-md-4 col-xl-2 col-lg-3 animated zoomIn">
                <div class="card bg-dark">
                    <div class="card-header" data-toggle="collapse" data-target=".tasks" style="cursor: pointer">
                        کارهای جاری
                    </div>
                    <div class="list-group collapse list-group-flush bg-dark tasks">
                        @if(!empty($myOrderCurrent))
                            <div class="list-group-item bg-success">


                                {{--<form  class="" method="post" action="{{ route('status.store') }}" onsubmit="return confirm('در صورت تایید، این کار از لیست کارهای جاری شما خارج خواهد شد. از پایان پروژه اطمینان دارید؟');">--}}
                                    {{--@csrf--}}
                                    {{--<input type="hidden" name="user_id" value="{{Auth::id()}}">--}}
                                    {{--<input type="hidden" name="task_id" value="{{$myOrderCurrent->task->id}}">--}}
                                    {{--<input type="hidden" name="status" value="end">--}}
                                    {{--<input type="hidden" name="content" value="پایان کار {{$myOrderCurrent->task->id}} - {{$myOrderCurrent->task->title}}">--}}
                                    <a href="/tasks/{{$myOrderCurrent->task->id}}">
                                        <small>{{$myOrderCurrent->task->title}}</small>
                                    </a>
                                    {{--<button class="btn btn-link text-light p-0 mx-1 float-left" title="پایان کار {{$myOrderCurrent->task->title}}" type="submit" data-toggle="tooltip"><i class="fa fa-stop"></i></button>--}}

                                {{--</form>--}}
                            </div>
                        @endif

                    @if(count($orderCurrent) > 0)

                        @foreach($orderCurrent as $or)
                                    <div class="list-group-item bg-dark">
                                        <form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                            <input type="hidden" name="task_id" value="{{$or->task->id}}">
                                            <input type="hidden" name="status" value="start">
                                            <input type="hidden" name="content" value="شروع کار {{$or->task->id}} - {{$or->task->title}}">
                                            <a href="/tasks/{{$or->task->id}}" >
                                                <small>{{$or->task->title}}</small>
                                            </a>
                                            <button class="btn btn-link text-light p-0 mx-1 float-left" title="شروع کار {{$or->task->title}}" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>

                                        </form>

                                    </div>
                            @endforeach

                        <a href="/tasks" class="dropdown-footer"><small>همه</small></a>
                        @endif

                    </div>

                </div>
            </div>
                @endif
                @if(count($orderFuture) > 0)
            <div class="col-sm-6 col-md-4 col-xl-2 col-lg-3 animated zoomIn">
                <div class="card bg-dark">
                    <div class="card-header" data-toggle="collapse" data-target=".tasks" style="cursor: pointer">
                        کارهای آتی
                    </div>
                    <div class="list-group collapse list-group-flush bg-dark tasks">
                        @foreach($orderFuture as $or)
                            <div class="list-group-item bg-dark">
                                <form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    <input type="hidden" name="task_id" value="{{$or->task->id}}">
                                    <input type="hidden" name="status" value="start">
                                    <input type="hidden" name="content" value="شروع کار {{$or->task->id}} - {{$or->task->title}}">
                                    <a href="/tasks/{{$or->task->id}}">
                                        <small>{{$or->task->title}}</small>
                                    </a>
                                    <button class="btn btn-link text-light p-0 mx-1 float-left" title="شروع کار {{$or->task->title}}" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>

                                </form>

                            </div>

                        @endforeach
                            <a href="/tasks" class="dropdown-footer"><small>همه</small></a>

                    </div>

                </div>
            </div>
                @endif

        </div>

        <div class="col-12 mt-5 row justify-content-center">

        @role('admin|modir')
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 animated zoomIn">

            <div class="card bg-dark">

            <div class="card-header"  >
            <div class="" data-toggle="collapse" data-target="#lastStatus" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> کارهای باز
            </div>
            </div>

                <div class="list-group collapse show list-group-flush bg-dark" id="lastStatus">

                        @foreach($currentJobs as $c)
                                    <a  href="/tasks/{{$c->task->id}}" target="_blank" class="list-group-item @if($c->user->lastStatus == 'off') bg-info @elseif($c->user->lastStatus == 'lunch-start') bg-warning @elseif($c->user->lastStatus == 'out') bg-secondary @else bg-success @endif py-1 px-2">
                                    <img src="/storage/avatars/{{$c->user->avatar}}" alt="" class="img-circle" style="width: 30px" title="{{$c->user->name}}" data-toggle="tooltip">
                                        <small style="font-size: 75%">{{$c->task->title}}</small>
                                        <div class="float-left"><i class="fa @if($c->user->lastStatus == 'off') fa-clock-o @elseif($c->user->lastStatus == 'lunch-start') fa-cutlery @elseif($c->user->lastStatus == 'out') fa-power-off @endif "></i></div>
                                    </a>
                        @endforeach
                </div>
        </div>
        </div>
        @endrole
        <div class="col-sm-6 col-md-4 animated zoomIn">

            <div class="card bg-dark">

            <div class="card-header"  >
            <div class="float-right" data-toggle="collapse" data-target="#myActivities" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> آخرین پیامها
            </div>
                <div data-target="#crateStatus" data-toggle="modal" style="cursor: pointer" class="float-left" title="ارسال پیام" data-toggle="tooltip"><i class="fa fa-plus-circle"></i></div>

            </div>
{{--                <home-status-me></home-status-me>--}}
                <div class="list-group collapse show list-group-flush bg-dark" id="myActivities">
                    @foreach($messages as $s)

                        <a class="list-group-item bg-dark" data-toggle="collapse" data-target="#reply-form-{{$s->id}}">
                            @if($s->toUser->id != Auth::id())
                                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="ml-3 img-circle " style="width: 45px" title="به {{$s->toUser->name}}">

                            <img src="/storage/avatars/{{$s->toUser->avatar}}" alt=""  style="width: 28px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" title="به {{$s->toUser->name}}">
                            @else
                                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="img-size-50 ml-3 img-circle " title="{{$s->user->name}}">

                            @endif
                            <small>{{$s->content}}</small>
                                <span class="float-left" style="font-size: 85%"><small>{{$s->diff}}</small></span>


                        </a>
                        <a class="list-group-item collapse " id="reply-form-{{$s->id}}">
                            <form  method="post" action="{{ route('status.store') }}">
                                @csrf
                                <input type="hidden" name="to_user" value="{{$s->user->id}}">
                                <input type="hidden" name="user_id" value="{{$s->toUser->id}}">

                                <div class="input-group">
                                    <textarea name="content" class="form-control"></textarea>
                                    <input type="text" class="form-control InputToFocus inputUserStatus" name="content" autocomplete="off" placeholder=".....">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-arrow-circle-left"></i></button>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="status" class="statusStatus">


                            </form>
                        </a>
                    @endforeach
                        <a href="/profile" class="dropdown-item dropdown-footer"><small>همه</small></a>
                </div>
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
        @role('admin|modir')
        <div class="col-sm-6 col-md-4 col-lg-3 animated zoomIn " data-toggle="collapse" data-target="#admin">

            <div class="card bg-info">
                <div class="card-header"  >
                    <div class="" style="cursor: pointer">
                        <i class="fa fa-arrow-circle-down"></i>مشاهده ده نظر اخیر - مدیر

                    </div>
                </div>

                <div class="list-group collapse show list-group-flush bg-dark" id="admin">
                    @foreach($lastComments as $l)
                            <a href="/tasks/{{$l->task->id}}" class="list-group-item bg-dark">
                                <div class="border-bottom mb-2">
                                    <small class="text-muted">
                                        <img src="/storage/avatars/{{$l->user->avatar}}" alt="{{$l->user->name}}" title="{{$l->user->name}}" data-toggle="tooltip" style="width: 30px" class="ml-3 img-circle">
                                        در  {{$l->task->title}} - {{$l->diff}}:</small>
                                </div>

                                <small>{{$l->content}}</small>
                                <i class="fa fa-arrow-left float-left"></i>


                            </a>
                    @endforeach

                </div>
                {{--<a href="/tasks" class="btn-block btn btn-sm btn-link"><small>همه</small></a>--}}
            </div>
        </div>
        @else
        <div class="col-sm-6 col-md-4 animated zoomIn" data-toggle="collapse" data-target="#myComments">
            <div class="card bg-dark">
            <div class="card-header"  >
            <div class="" style="cursor: pointer">
                <i class="fa fa-arrow-circle-down"></i> آخرین نظرات
            </div>
            </div>

                <div class="list-group collapse show list-group-flush bg-dark" id="myComments">
                    @foreach($lastMyComments as $l)
                            <a href="/tasks/{{$l->task->id}}" class="list-group-item bg-dark">
                                <div class="border-bottom mb-2">
                                    <small class="text-muted">
                                        <img src="/storage/avatars/{{$l->user->avatar}}" alt="{{$l->user->name}}" title="{{$l->user->name}}" data-toggle="tooltip" style="width: 30px" class="ml-3 img-circle">
                                        در  {{$l->task->title}} - {{$l->diff}}:</small>
                                </div>

                                <small>{{$l->content}}</small>
                                <i class="fa fa-arrow-left float-left"></i>


                            </a>

                    @endforeach

                </div>
            {{--<a href="/tasks" class="btn-block btn btn-sm btn-link"><small>همه</small></a>--}}
        </div>
        </div>
            @endrole



    </div>

@endsection
@section('JS')
    <script type="text/javascript" src="/js/status.js"></script>
    <script type="text/javascript" src="/js/timer.jquery.min.js"></script>
    <script>
        $(window).on('load',function(){
            $('#offUser').modal('show');

        });
        $(function () {
            $('#offUser').modal({backdrop: 'static', keyboard: false})

        })


$('.Timer').timer({
    format: '%M:%S',
 });
$('.Timer-lunch').timer({
    countdown: true,
    format: '%M:%S',
    duration: '30M',
    callback: function() {
        alert('Time Up! Have a nice day :)');
    },
 });





        updateClock();
        window.setInterval(updateClock, 1000);
        function updateClock() {
            var date = new Date();

            var ampm = date.getHours() < 12
                ? 'AM'
                : 'PM';

            var hours = date.getHours() == 0
                ? 12
                : date.getHours() > 12
                    ? date.getHours() - 12
                    : date.getHours();

            var minutes = date.getMinutes() < 10
                ? '0' + date.getMinutes()
                : date.getMinutes();

            var seconds = date.getSeconds() < 10
                ? '0' + date.getSeconds()
                : date.getSeconds();
            $('.clockH').text(hours);
            $('.clockM').text(minutes);
            $('.clockS').text(seconds);
            $('.clockAmPm').text(ampm);

        }


    </script>

    @endsection

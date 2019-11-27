
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
    @include('helper.onOff')
@endsection
@section('content')
    {{--@if($read == 0)--}}
        {{--<div class="">--}}
            {{--<a href="/posts/16">--}}
                {{--<div class="alert alert-warning"><strong><i class="fa fa-exclamation-triangle"></i></strong> لطفا مشاهده کنید</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--@endif--}}
    <div class="col-md-12 mt-sm-2 d-none d-md-block" style="">
        @role('admin|modir')
        <div class="d-flex flex-wrap justify-content-center mb-4">
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

                           {{--@role('admin')--}}
                               {{--<div style="width: 30px;height: 30px; bottom: -30px; cursor: pointer" class="position-absolute position-relative"  data-toggle="modal" data-target="#userModal{{$u->id}}">--}}
                                   {{--<i class="text-muted fa fa-ellipsis-h"></i>--}}
                               {{--</div>--}}
                            {{--@endrole--}}

                       </div>

                        {{--@role('admin')--}}
                        {{--<div class="modal fade" id="userModal{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                            {{--<div class="modal-dialog modal-lg  modal-dialog-centered" role="document">--}}
                                {{--<div class="modal-content bg-dark">--}}
                                    {{--<div class="modal-header bg-dark">--}}
                                        {{--<button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close">--}}
                                            {{--<span aria-hidden="true">&times;</span>--}}
                                        {{--</button>--}}
                                        {{--<h5 class="modal-title">{{$u->name}}--}}
                                            {{--<img src="/storage/avatars/{{ $u->avatar }}" style="width: 50px" alt="" class="img-circle">--}}
                                        {{--</h5>--}}

                                    {{--</div>--}}
                                    {{--<div class="modal-body">--}}
                                        {{--@if(!empty($u->phone))--}}
                                        {{--<small data-toggle="tooltip" title="تلفن همراه"><i class="fa fa-phone"></i> {{$u->phone}}</small>--}}
                                        {{--<small class="mx-2"></small>--}}
                                        {{--@endif--}}
                                        {{--<small  data-toggle="tooltip" title="عضویت"><i class="fa fa-user-circle"></i> {{$u->diff}}</small>--}}
                                            {{--<small class="mx-2"></small>--}}
                                            {{--<user-status-comments-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="نظرات ثبت شده"></user-status-comments-count>--}}
                                            {{--<user-tasks-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="کارهای ثبت شده توسط {{$u->name}}"></user-tasks-count>--}}
                                            {{--<user-tasks-self :user="{{$u->id}}" class="d-inline"></user-tasks-self>--}}
                                            {{--<user-status-comments-to-user-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="پیامهای ارسالی"></user-status-comments-to-user-count>--}}
                                            {{--<hr>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@endrole--}}

                </div>
            @endforeach

        </div>
        @endrole
        @role('chairman')
        <div class="d-flex flex-wrap justify-content-center mb-4">
            @foreach($users as $u)
                @if($u->id!=2)
                <div class="mx-2 text-center">
                    @if($u->lastStatus == 'off')
                    <span class="badge badge-info position-absolute"><i class="fa fa-clock-o"></i></span>
                    @endif
{{--                        <div class="text-muted text-center" data-toggle="modal" data-target="#userModal{{$u->id}}"  style="cursor: pointer"><span>.</span></div>--}}
                       <div class="position-relative">
                           <a href="/jobs/{{$u->id}}" target="_blank">
                              <img src="/storage/avatars/{{ $u->avatar }}" style="width: 30px" alt="" class="img-circle hvr-pop" title="{{$u->name}}" data-toggle="tooltip">
                           </a>

                           {{--@role('admin')--}}
                               {{--<div style="width: 30px;height: 30px; bottom: -30px; cursor: pointer" class="position-absolute position-relative"  data-toggle="modal" data-target="#userModal{{$u->id}}">--}}
                                   {{--<i class="text-muted fa fa-ellipsis-h"></i>--}}
                               {{--</div>--}}
                            {{--@endrole--}}

                       </div>

                        {{--@role('admin')--}}
                        {{--<div class="modal fade" id="userModal{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                            {{--<div class="modal-dialog modal-lg  modal-dialog-centered" role="document">--}}
                                {{--<div class="modal-content bg-dark">--}}
                                    {{--<div class="modal-header bg-dark">--}}
                                        {{--<button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close">--}}
                                            {{--<span aria-hidden="true">&times;</span>--}}
                                        {{--</button>--}}
                                        {{--<h5 class="modal-title">{{$u->name}}--}}
                                            {{--<img src="/storage/avatars/{{ $u->avatar }}" style="width: 50px" alt="" class="img-circle">--}}
                                        {{--</h5>--}}

                                    {{--</div>--}}
                                    {{--<div class="modal-body">--}}
                                        {{--@if(!empty($u->phone))--}}
                                        {{--<small data-toggle="tooltip" title="تلفن همراه"><i class="fa fa-phone"></i> {{$u->phone}}</small>--}}
                                        {{--<small class="mx-2"></small>--}}
                                        {{--@endif--}}
                                        {{--<small  data-toggle="tooltip" title="عضویت"><i class="fa fa-user-circle"></i> {{$u->diff}}</small>--}}
                                            {{--<small class="mx-2"></small>--}}
                                            {{--<user-status-comments-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="نظرات ثبت شده"></user-status-comments-count>--}}
                                            {{--<user-tasks-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="کارهای ثبت شده توسط {{$u->name}}"></user-tasks-count>--}}
                                            {{--<user-tasks-self :user="{{$u->id}}" class="d-inline"></user-tasks-self>--}}
                                            {{--<user-status-comments-to-user-count :user="{{$u->id}}" class="d-inline" data-toggle="tooltip" title="پیامهای ارسالی"></user-status-comments-to-user-count>--}}
                                            {{--<hr>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@endrole--}}

                </div>
                @endif
            @endforeach

        </div>
        @endrole
{{--        @hasanyrole('admin|modir|finance')--}}
{{--        <div class="col-md-12">--}}
{{--        <div class="row d-flex justify-content-center">--}}

{{--            @can('task-create')--}}
{{--                <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">--}}
{{--                <div class="wrimagecard wrimagecard-topimage">--}}
{{--                    <a href="/tasks/create" class="btn btn-warning btn-block hvr-grow">کار جدید</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endcan--}}
{{--            @hasanyrole('admin')--}}
{{--            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">--}}
{{--                <div class="wrimagecard wrimagecard-topimage">--}}
{{--                    <a href="/statics" class="btn btn-light btn-block hvr-grow">آمار کاربران</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">--}}
{{--                <div class="wrimagecard wrimagecard-topimage">--}}
{{--                    <a href="/finance" class="btn table-danger btn-block hvr-grow" target="_blank">مالی</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endhasanyrole--}}
{{--            @hasanyrole('finance')--}}
{{--            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">--}}
{{--                <div class="wrimagecard wrimagecard-topimage">--}}
{{--                    <a href="/finance-final" class="btn table-danger btn-block hvr-grow" target="_blank">مالی</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endhasanyrole--}}
{{--            @hasanyrole('modir')--}}
{{--            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4">--}}
{{--                <div class="wrimagecard wrimagecard-topimage">--}}
{{--                    <a href="/finance-check" class="btn table-danger btn-block hvr-grow" target="_blank">مالی</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endhasanyrole--}}
{{--        </div>--}}

{{--        </div>--}}
{{--        @endhasanyrole--}}
    </div>

    @hasanyrole('admin|modir|designer')
    <main-home-box v-bind:user="{{Auth::id()}}" :users="{{$users}}"></main-home-box>
{{--    <report-designer v-bind:user="{{Auth::id()}}" :users="{{$users}}"></report-designer>--}}
    <status-comment-form :user="{{Auth::id()}}" :users="{{$users}}"></status-comment-form>

    @endhasanyrole
@role('chairman')
    <div class="col-md-10 col-lg-8 col-xl-6 m-auto mt-sm-5">
        <status :user="{{Auth::id()}}" :users="{{$users}}"></status>
    </div>
    @endrole
    @hasanyrole('reseller')
    <div class="col-12 align-self-center">

        <reseller :brands="{{$brands}}" :user="{{Auth::user()}}" :task="0"></reseller>
    </div>
    @endhasanyrole
{{--    <user-chart></user-chart>--}}

{{--    @role('admin')--}}
{{--        <admin-panel :user="{{Auth::id()}}" :users="{{$users}}" :formAdd="123"></admin-panel>--}}
{{--    @endrole--}}

            <div class="col-12 row justify-content-center">


        <div class="col-xl-9 col-lg-10 row m-auto">
            @hasanyrole('admin|modir')

                <div class="col">

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
            @endhasanyrole
            @hasanyrole('admin|modir|designer')


            @endhasanyrole
            @hasanyrole('admin|modir')
                <div class="col-lg" data-toggle="collapse" data-target="#admin">
                    <div class="card bg-dark">
                        <div class="card-header"  >
                            <div class="" style="cursor: pointer">
                                <i class="fa fa-arrow-circle-down"></i>مشاهده ده نظر اخیر - مدیر
                            </div>
                        </div>
                        <div class="list-group collapse show list-group-flush bg-dark" id="admin">
                            @foreach($lastComments as $l)
                                <div  class="list-group-item bg-dark">
                                    <div class="text-left">
                                        <a href="/tasks/{{$l->task->id}}" title="Go to Task" data-toggle="tooltip"><i class="fa fa-arrow-left mx-1 text-muted hvr-glow"></i></a>
                                    </div>
                                    <div class="border-bottom mb-2">
                                        <small class="text-muted">
                                            <img src="/storage/avatars/{{$l->user->avatar}}" alt="{{$l->user->name}}" title="{{$l->user->name}}" data-toggle="tooltip" style="width: 30px" class="ml-3 img-circle">
                                            در  {{$l->task->title}} - {{$l->diff}}:
                                        </small>
                                    </div>
                                    <small>{{$l->content}}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endhasanyrole

{{--<upload-image></upload-image>--}}


            {{--            @hasanyrole('designer')--}}
{{--                <div class="col-lg " data-toggle="collapse" data-target="#myComments">--}}
{{--                    <div class="card bg-dark">--}}
{{--                        <div class="card-header"  >--}}
{{--                            <div class="" style="cursor: pointer">--}}
{{--                                <i class="fa fa-arrow-circle-down"></i> آخرین نظرات--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="list-group collapse show list-group-flush bg-dark" id="myComments">--}}
{{--                            @foreach($lastMyComments as $l)--}}
{{--                                <a href="/tasks/{{$l->task->id}}" class="list-group-item bg-dark">--}}
{{--                                    <div class="border-bottom mb-2">--}}
{{--                                        <small class="text-muted">--}}
{{--                                            <img src="/storage/avatars/{{$l->user->avatar}}" alt="{{$l->user->name}}" title="{{$l->user->name}}" data-toggle="tooltip" style="width: 30px" class="ml-3 img-circle">--}}
{{--                                            در  {{$l->task->title}} - {{$l->diff}}:</small>--}}
{{--                                    </div>--}}
{{--                                    <small>{{$l->content}}</small>--}}
{{--                                    <i class="fa fa-arrow-left float-left"></i>--}}
{{--                                </a>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endhasanyrole--}}
{{--        </div>--}}
{{--    </div>--}}

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

@extends('admincore.app')
@section('css')
    <style>

        body, .content-wrapper, .main-heade {
            background: #CBCBCB !important;
        }

        .border-bottom {
            border-bottom: none !important;
        }

        .nav-link {
            color: #888 !important;
        }

        input[type=range] {
            -webkit-appearance: none;
            margin: 20px 0;
            width: 100%;
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: #A880BC;
            border-radius: 1.3px;
        }

        input[type=range]::-webkit-slider-thumb {
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            border: 1px solid #000000;
            height: 36px;
            width: 36px;
            border-radius: 50%;
            background: #ffffff;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -14px;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #A880BC;
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: #A880BC;
            border-radius: 1.3px;
        }

        input[type=range]::-moz-range-thumb {
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
        }

        input[type=range]::-ms-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            border-width: 16px 0;
            color: transparent;
        }

        input[type=range]::-ms-fill-lower {
            background: #A880BC;
            border-radius: 2.6px;
        }

        input[type=range]::-ms-fill-upper {
            background: #A880BC;
            border-radius: 2.6px;
        }

        input[type=range]::-ms-thumb {
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: #A880BC;
        }

        input[type=range]:focus::-ms-fill-upper {
            background: #A880BC;
        }

        .bullett {
            width: 30px;
            height: 30px;
            background: #A880BC;
            border-radius: 50%;
            position: absolute;
            top: 9px;
            z-index: 99;


        }

        /*td:first-child{*/
        /*border-radius: 0 30px 30px 0;*/

        /*}*/
        /*td:last-child{*/
        /*border-radius: 30px 0 0 30px;*/
        /*}*/
        /*td{*/
        /*border: 1px solid black;*/
        /*border-right: 0;*/
        /*border-left: 0;*/
        /*}*/


        /*table{*/
        /*border-collapse:separate;*/
        /*border-spacing:0 15px;*/
        /*}*/
        .card-header {
        }

        .card-border {
            border-radius: 30px;
        }


        .comment-wrapper .panel-body {
            max-height: 650px;
            overflow: auto;
        }

        .comment-wrapper .media-list .media img {
            width: 64px;
            height: 64px;
            border: 2px solid #e5e7e8;
        }

        .comment-wrapper .media-list .media {
            border-bottom: 1px dashed #efefef;
            margin-bottom: 25px;
        }


    </style>
@endsection
@section('content')



    <div class="col-sm-12">

        <div class="m-3 p-5 bg-white" style="border-radius: 30px;">
            @if($task->isDone == 1)
            <div class="alert-info alert text-center">این کار توسط کاربر {{$task->done_user_id}} در تاریخ {{$task->done_date}} به اتمام رسیده است</div>
            @endif
            @if(isset($taskMeter) && $taskMeter->end == 0)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>شروع کار</strong> این کار در حال انجام است
                    <a href="/tasks/{{$task->id}}/end"
                       class="btn btn-link my-2 text-dark">توقف زمان کار</a>
                    <strong>{{$taskMeter->created_at}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            <h1 class="text-center">{{$task->title}}</h1>
            <div class="d-md-flex justify-content-center">
                    @if($task->type && $task->type != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="نوع کار"
                                data-placement="bottom">{{ $task->type }}</button> @endif
                    @if($task->type && $task->brand != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="برند"
                                data-placement="bottom">{{ $task->brand }}</button> @endif
                    @if($task->type && $task->forProduct != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="محصول"
                                data-placement="bottom">{{ $task->forProduct }}</button> @endif
                    @if($task->type && $task->material != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="متریال"
                                data-placement="bottom">{{ $task->material }}</button> @endif
                    <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="نظر"
                            data-placement="bottom">{{ $task->commentCount }} <i class="fa fa-lg fa-commenting-o"></i></button>
                    <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="مشاهده"
                            data-placement="bottom">{{ $task->viewCount }} <i class="fa fa-lg fa-eye"></i></button>
                    <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="{{$dead}} روز دیگر"
                            data-placement="bottom">{{$dead}}
                        <i class="fa @if($dead < 0 ) fa-hourglass-end @elseif($dead <= 3) fa-hourglass-half @else fa-hourglass-start @endif "></i>
                    </button>
                    @if($task->reTask === 1)

                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="Clone"
                                data-placement="bottom">
                            <i class="fa fa-clone"></i>
                        </button>
                    @endif

            </div>
<div class="row">
            <div class="text-right col">
                <a href="{{url('/')}}" class="btn btn-link"><i class="fa fa-home"></i></a>
                <a href="/tasks" class="btn btn-link" title="My Tasks"><i class="fa fa-list-ol"></i></a>

            </div>
            <div class="text-left col">

                {{--<a href="/tasks/create" class="btn btn-link" title="New"><i class="fa fa-plus"></i></a>--}}
                <a class="btn btn-link" data-toggle="collapse" href=".collapse"><i class="fa fa-arrows-alt"></i></a>
                @if(isset($taskMeter) && $taskMeter->end == 1)
                    <a href="/tasks/{{$task->id}}/start" class="btn btn-link"><i class="fa fa-play"></i></a>

                @elseif(isset($taskMeter) && $taskMeter->end == 0)
                    <a href="/tasks/{{$task->id}}/end" class="btn btn-link"><i class="fa fa-pause"></i></a>
                    @else
                    <a href="/tasks/{{$task->id}}/start" class="btn btn-link"><i class="fa fa-play"></i></a>

                @endif
            </div>
            </div>

            <div class="row">
                <!------------------------------------------------------------------>
                <div class="col-lg-6 order-12 order-md-1">
                    <div class="card card-border">

                        <div class="

                        @if($dead < 0 )
                                card-danger bg-danger
@elseif($dead <= 3)
                                card-danger bg-warning

@else

                                bg-info

@endif

                                card-header
                                card-border" data-toggle="collapse" href="#desc">
                            <div class="">+ مشخصات</div>


                        </div>
                        <div id="desc" class="collapse show noShow" data-parent="#accordion">
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <img src="/storage/uploads/{{$task->pic}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-sm-12 table-responsive">
                                        <table class="table table-borderless table-striped" style="width: 100%">

                                            <tr>
                                                <td>کد پروژه</td>
                                                <td>{{$task->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>عنوان</td>
                                                <td>{{$task->title}}</td>
                                            </tr>

                                            <tr>
                                                <td>شروع پروژه</td>
                                                <td>{{$task->jStartDate}}</td>
                                            </tr>
                                            <tr>
                                                <td>پایان پروژه</td>
                                                <td>{{$task->jDeadline}}</td>
                                            </tr>
                                            <tr>
                                                <td>فاز پروژه</td>
                                                <td>{{$task->status}}</td>
                                            </tr>
                                            <tr>
                                                <td>تعداد نظرات</td>
                                                <td>{{$task->commentCount}}</td>
                                            </tr>
                                            <tr>
                                                <td>ایجاد کننده</td>
                                                <td>{{$admin->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>تیم کاری</td>
                                                <td>
                                                @foreach($users as $user)
                                                    {{$user->name}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>


                                    </div>

                                   </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-12">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="contentCard" class="card card-border">

                        <div class="bg-light card-header card-border" data-toggle="collapse" href="#content">
                            <div class="">+ توضیحات
                            </div>


                        </div>
                        <div id="content" class="collapse noShow" data-parent="#accordion">
                            <div class="card-body">


                                <div class="col-sm-12">
                                    <p class="text-justify">
                                        {{ $task->content }}

                                    </p>


                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <!------------ Comment ------------------------------------------------------->
                <div class="col-lg-6 order-11 order-md-2">
                    <div id="commentCard" class="card card-border">

                        <div class="bg-secondary card-header card-border" data-toggle="collapse" href="#comments">
                            <div class="row">
                                <div class="">+ نظرات
                                    <div class="badge-light badge badge-pill">{{$task->commentCount}}</div>
                                </div>


                            </div>


                        </div>
                        <div id="comments" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10 m-auto">

                                        <div class="comment-wrapper">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    {{$task->commentCount}} نظر
                                                </div>
                                                <div class="panel-body">

                                                    <form method="post" action="{{ route('comments.store') }}">
                                                        <div class="form-group">
                                                            @csrf
                                                            {{--<textarea class="form-control" name="comment"--}}
                                                                      {{--placeholder="به نظر من..." rows="3"></textarea>--}}
                                                            {{--<input type="text" name="comment" class="form-control" rows="3" placeholder="به نظر من...">--}}
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="comment" class="form-control" rows="3" placeholder="به نظر من..." aria-label="" aria-describedby="basic-addon1">

                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="submit">ثبت نظر</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="user_id"
                                                               value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                        {{--<button type="submit" class="btn btn-link pull-left">--}}
                                                            {{--<i class="fa fa-2x fa-plus-circle"></i>--}}
                                                        {{--</button>--}}
                                                    </form>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <ul class="media-list">


                                                        @foreach($comments as $comment)

                                                            <li class="media">
                                                                <a href="#" class="pull-left ml-3">
                                                                    <img class="img-circle" style=""
                                                                         src="/storage/avatars/{{ $comment->user->avatar }}"/>
                                                                </a>
                                                                <div class="media-body">
                                                                    <span class="text-muted pull-left">
                                                                        <small dir="ltr"
                                                                               class="text-muted" title="{{$comment->jCreated_at}}"  data-toggle="tooltip" data-placement="right">{{$comment->created_at->diffForHumans()}}</small>
                                                                    </span>
                                                                    <strong class="text-success">{{ $comment->user->name }}</strong>
                                                                    <div class="clearfix"></div>
                                                                    <p>{{ $comment->comment }}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>

                    <!------------ setting ------------------------------------------------------->
                    <div id="settingCard" class="card card-border d-none d-md-block">

                        <div class="bg-light card-header card-border" data-toggle="collapse" href="#setting">
                            <div class="">+ تنظیمات
                            </div>


                        </div>
                        <div id="setting" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                            <div class="d-flex justify-content-around">

                                @can('task-delete')

                                        <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger my-2" type="submit">حذف</button>
                                        </form>
                                @endcan
                                @can('task-edit')

                                <a href="/tasks/{{$task->id}}/edit"
                                           class="btn btn-warning my-2">ویرایش</a>

                                @endcan

                                    @role('admin')

                                <form action="{{ route('tasks.done', $task->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" value="0" name="isDone">
                                    <input type="hidden" value="{{$task->id}}" name="id">
                                    <button class="btn btn-warning my-2" type="submit">برگردان به بخش اجرایی</button>
                                </form>
                                    @endrole

                                    <form action="{{ route('tasks.done', $task->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="isDone">
                                        <input type="hidden" value="{{$user->id}}" name="done_user_id">
                                        <input type="hidden" value="{{$task->id}}" name="id">
                                        <button class="btn btn-success my-2" type="submit">اتمام کار</button>
                                    </form>
                            </div>
                            </div>


                        </div>
                    </div>

                    <!------------ timeSheet ------------------------------------------------------->
                    @if(count($taskMeters) > 0)
                    <div id="settingCard" class="card card-border d-none d-md-block">

                        <div class="bg-light card-header card-border" data-toggle="collapse" href="#timing">
                            <div class="">+ زمان کار
                            </div>


                        </div>
                        <div id="timing" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                    <a href="/tasks/{{$task->id}}/start" class="badge table-success"><i class="fa fa-2x fa-play-circle-o text-muted"></i></a>
                                <a href="/tasks/{{$task->id}}/end" class="badge table-secondary"><i class="fa fa-2x fa-pause-circle-o text-muted"></i></a>
                                <table class="table table-hover text-center">
                                    <tr>
                                        <td>تاریخ</td>
                                        <td>ساعت</td>
                                        <td>کارکرد</td>
                                    </tr>
                                    @php
                                    $totalH = 0;
                                    $totalM = 0;
                                    $totalS = 0;
                                    @endphp

                                    @foreach($taskMeters as $tm)
                                        @if($tm->end == 0)
                                            @php
                                            $dateDiff = "-";
                                            @endphp
                                    <tr class="table-success">
                                        @else


                                        @php

                                        //$dateDiff = $tm->diffM;
                                        /*$tmm = $tm->diffM % 60;
                                        $tmmd = floor($tm->diffM / 60);


                                        $tms = $tm->diffS % 60;
                                        $tmsd = floor($tm->diffS / 60);

                                        $tmmf = $tmsd + $tms;
                                        $tmhf = $tm->diffH + $tmmd;*/


                                        $tms = $tm->diffS % 60;
                                        $tmm = floor($tm->diffS / 60) % 60;
                                        $tmh = floor(floor($tm->diffS / 60) / 60);



                                        $dateDiff = $tmh . ":" . $tmm . ":" . $tms;


                                        $totalS += $tm->diffS;





                                            @endphp
                                    <tr class="table-secondary">
                                        @endif
                                        <td>{{$tm->jDate}}</td>
                                        <td>{{date('H:i:s', strtotime($tm->created_at))}}</td>
                                        <td>{{$dateDiff}}</td>
                                    </tr>
                                        @endforeach
                                        @php
                                            $total = floor(floor($totalS / 60) / 60) . ":" . floor($totalS / 60) % 60 . ":" . $totalS % 60;
                                        @endphp
                                            <tr class="table-info">
                                                <td colspan="2">مجموع</td>
                                                <td>{{$total}}</td>
                                            </tr>
                                </table>

                            </div>


                        </div>
                    </div>
                        @endif

                </div>
            </div>
        </div>
    </div>














@endsection

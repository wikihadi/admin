@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')

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
                                                <td>
                                                    <img src="/storage/avatars/{{ $admin->avatar }}" alt="" class="img-circle mx-1" style="object-fit: cover; width: 30px;height: 30px; border: 1px solid #a9a9a9;" title="{{$admin->name}}" data-toggle="tooltip">

                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>تیم کاری</td>
                                                <td class="d-flex">
                                                @foreach($users as $u)
                                                        <div class="mx-1">
                                                            <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 30px;height: 30px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                                                        </div>
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

                    {{--<div id="contentCard" class="card card-border">--}}

                        {{--<div class="bg-light card-header card-border" data-toggle="collapse" href="#content">--}}
                            {{--<div class="">+ توضیحات--}}
                            {{--</div>--}}


                        {{--</div>--}}
                        {{--<div id="content" class="collapse noShow" data-parent="#accordion">--}}
                            {{--<div class="card-body">--}}


                                {{--<div class="col-sm-12">--}}
                                    {{--<p class="text-justify">--}}
                                        {{--{{ $task->content }}--}}

                                    {{--</p>--}}


                                {{--</div>--}}
                            {{--</div>--}}


                        {{--</div>--}}
                    {{--</div>--}}

                </div>
                <!------------ Comment ------------------------------------------------------->
                <div class="col-lg-6 order-11 order-md-2">
                    <div id="commentCard" class="card card-border">

                        <div class="bg-secondary card-header card-border" data-toggle="collapse" href="#comments">
                            <div class="row">
                                <div class="">+ وضعیت
                                </div>


                            </div>


                        </div>
                        <div id="comments" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10 m-auto">

                                        <div class="comment-wrapper">
                                            <div class="panel panel-info">
                                                <div class="d-flex justify-content-center">
                                                @foreach($users as $u)
                                                    <div class="mx-1 text-center">
                                                        <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 40px;height: 40px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                                                    </div>
                                                @endforeach
                                                </div>
                                                <p class="text-justify bg-light-gradient p-2">
                                                    توضیحات:
                                                    {{ $task->content }}

                                                </p>
                                                <div class="panel-heading">
                                                    {{$task->commentCount}} نظر
                                                </div>
                                                <div class="panel-body">
                                                    @include('statuses.taskStatus')

                                                    {{--<form method="post" action="{{ route('comments.store') }}">--}}
                                                        {{--<div class="form-group">--}}
                                                            {{--@csrf--}}
                                                            {{--<textarea class="form-control" name="comment"--}}
                                                                      {{--placeholder="به نظر من..." rows="3"></textarea>--}}
                                                            {{--<input type="text" name="comment" class="form-control" rows="3" placeholder="به نظر من...">--}}
                                                            {{--<div class="input-group mb-3">--}}
                                                                {{--<textarea id="" name="comment" class="form-control" rows="3" placeholder="به نظر من..."></textarea>--}}
                                                                {{--<input type="text" name="comment" class="form-control" rows="3" placeholder="به نظر من..." aria-label="" aria-describedby="basic-addon1">--}}

                                                                {{--<div class="input-group-append">--}}
                                                                    {{--<button class="btn btn-success btn-block" type="submit">ثبت نظر</button>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}

                                                        {{--<input type="hidden" name="user_id"--}}
                                                               {{--value="{{ $user->id }}">--}}
                                                        {{--<input type="hidden" name="task_id" value="{{ $task->id }}">--}}
                                                        {{--<button type="submit" class="btn btn-link pull-left">--}}
                                                            {{--<i class="fa fa-2x fa-plus-circle"></i>--}}
                                                        {{--</button>--}}
                                                    {{--</form>--}}
                                                    {{--<div class="clearfix"></div>--}}
                                                    {{--<hr>--}}
                                                    {{--<ul class="media-list">--}}


                                                        {{--@foreach($comments as $comment)--}}

                                                            {{--<li class="media">--}}
                                                                {{--<a href="#" class="pull-left ml-3">--}}
                                                                    {{--<img class="img-circle" style=""--}}
                                                                         {{--src="/storage/avatars/{{ $comment->user->avatar }}" />--}}
                                                                {{--</a>--}}
                                                                {{--<div class="media-body">--}}
                                                                    {{--<span class="text-muted pull-left">--}}
                                                                        {{--<small dir="ltr" class="text-muted" title="{{$comment->jCreated_at}}"  data-toggle="tooltip" data-placement="right">{{$comment->diff}}</small>--}}

                                                                    {{--</span>--}}
                                                                    {{--<strong class="text-success">{{ $comment->user->name }}</strong>--}}
                                                                    {{--<div class="clearfix"></div>--}}
                                                                    {{--<div style="white-space: pre-wrap;">{{ $comment->comment }}</div>--}}
                                                                    {{--<div class="text-left">--}}
                                                                    {{--@if($comment->diffM < 5)--}}
                                                                        {{--<form class="d-inline" action="{{ route('comments.edit',$comment->id)}}" method="post">--}}

                                                                            {{--<input name="diffM" type="hidden" value="{{$comment->diffM}}">--}}

                                                                            {{--@csrf--}}
                                                                            {{--<input type="hidden" value="{{$user->id}}" name="user_id">--}}
                                                                            {{--<input type="hidden" value="{{$comment->id}}" name="id">--}}
                                                                            {{--<a class="btn btn-link my-2 text-muted" href="/comments/{{$comment->id}}/edit"><i class="fa fa-edit"></i></a>--}}
                                                                        {{--</form>--}}
                                                                        {{--@endif--}}
                                                                    {{--</div>--}}

                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                        {{--@endforeach--}}


                                                    {{--</ul>--}}
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
                                            <input type="hidden" name="urlP" value="{{$urlP}}">

                                            <button class="btn btn-danger my-2" type="submit">حذف</button>
                                        </form>
                                @endcan
                                @can('task-edit')

                                <a href="/tasks/{{$task->id}}/edit"
                                           class="btn btn-warning my-2">ویرایش</a>

                                @endcan
@if($task->isDone == 1)
                                    @role('admin|designer')

                                <form action="{{ route('tasks.done', $task->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" value="0" name="isDone">
                                    <input type="hidden" value="{{$task->id}}" name="id">
                                    <button class="btn btn-warning my-2" type="submit">برگردان به بخش اجرایی</button>
                                </form>
                                    @endrole
@else
                                    @role('modir')
                                    @else

                                    <form action="{{ route('tasks.done', $task->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="isDone">
                                        <input type="hidden" value="{{$user->id}}" name="done_user_id">
                                        <input type="hidden" value="{{$task->id}}" name="id">
                                        <button class="btn btn-success my-2" type="submit">اتمام کار</button>
                                    </form>
                                        @endrole
    @endif
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
@section('JS')

@endsection

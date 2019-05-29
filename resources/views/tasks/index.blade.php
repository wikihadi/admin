        @extends('admincore.app')

        @section('css')
            @include('helper.css.mainTasksCss')
        @endsection
        
        @section('content')

            @include('helper.topNavigateTasks')
            @include('helper.profileTasks')

                <div class="col-sm-12">
                    <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">
                        @include('helper.alarm')
                        <nav class="card-border navbar navbar-expand-sm navbar-light bg-light" data-toggle="affix">
                            <div class="mx-auto d-sm-flex d-block flex-sm-nowrap">
                                <small><a class="navbar-brand" href="#">مرتب سازی:</a></small>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                                    <ul class="navbar-nav">
                                        <li class="nav-item active">
                                            <small><a class="nav-link" href="/tasks">الویتها</a></small>
                                        </li>
                                        <li class="nav-item">
                                            <small><a class="nav-link" href="/tasks?sort=latest">جدیدترین</a></small>
                                        </li>
                                        {{--<li class="nav-item">--}}
                                            {{--<a class="nav-link" href="#">در جریان</a>--}}
                                        {{--</li>--}}
                                        {{--<li class="nav-item">--}}
                                            {{--<small><a class="nav-link" href="/tasks?sort=pending">در انتظار</a></small>--}}
                                        {{--</li>--}}
                                        <li class="nav-item">
                                            <small><a class="nav-link" href="/tasks?sort=done">پایان یافته</a></small>
                                        </li>
                                        {{--<li class="nav-item">--}}
                                            {{--<a class="nav-link" href="#">Link</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        @include('helper.navbarTasks')

                            @if ($order->isEmpty())
                                <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>
                            @else


                                    @include('helper.titleTasks')
                            @endif
                    <!-----------------must to controller------------------------------->
                        @if(count($orderRoutine) > 0 && !isset($_GET['sort']))
<div class="jumbotron ">
    <h1 class="display-6 text-muted text-center animated fadeIn delay-1s">کارهای روتین</h1>
    <hr class="my-4 animated fadeIn delay-1s">

@foreach($orderRoutine as $o)

                            {{--Modal for Task IMGE--}}
                            <div class="modal" id="img{{$o->task->id}}" style="cursor: zoom-out">
                                <div class="text-center animated bounceIn" data-dismiss="modal">
                                    <img src="/storage/uploads/{{$o->task->pic}}"  data-dismiss="modal">
                                </div>
                            </div>

                            <div class="card card-border animated fadeInDown" >

                                <div class="card-header card-border
                                    @if($o->lastStatus == 0)
                                        bg-info
@elseif($o->lastStatus == 1)
                                        bg-light
@elseif($o->lastStatus == 2)
                                        bg-success
@elseif($o->lastStatus == 3)
                                        bg-dark
@endif
                                        ">
                                    <div class="row">

                                        <div class="col-md-9 row" data-toggle="collapse" href="#collapse{{$o->task->id}}">
                                            <div class="col-12 col-md-4 text-center text-md-right">- {{ str_limit($o->task->title, 40) }}</div>
                                            <div class="d-none d-lg-block col-lg-2 text-center">
                                                @if($o->task->type && $o->task->brand != "سایر")
                                                    {{$o->task->brand}}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="d-none d-lg-block col-lg-2 text-center">
                                                @if($o->task->type && $o->task->type != "سایر")
                                                    {{$o->task->type}}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="d-none d-lg-block col-lg-2 text-center">
                                                @if($o->task->type && $o->task->forProduct != "سایر")
                                                    {{$o->task->forProduct}}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            {{--<div dir="ltr" class="d-none d-xl-block col-xl-1 text-center">--}}
                                            {{--@if($task->dx || $task->dy || $task->dz)--}}
                                            {{--{{$task->dx}}|{{$task->dy}}|{{$task->dz}}--}}
                                            {{--@else--}}
                                            {{-----}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            {{--<div class="d-none d-xl-block col-xl-1 text-center">--}}
                                            {{--@if($task->type && $task->material != "سایر")--}}
                                            {{--{{$task->material}}--}}
                                            {{--@else--}}
                                            {{-----}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            <div class="d-none d-lg-block col-lg-2 text-center">

                                            </div>
                                        </div>
                                        <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                                            <div class="flex-grow-1"></div>
                                            @if(isset($usersInTasks))
                                                @foreach($usersInTasks->where('task_id', $o->task->id) as $ut)
                                                    @foreach($users->where('id', $ut->user_id) as $u)
                                                        <div class="mx-1 hvr-pop">
                                                            <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 29px;height: 29px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endif



                                            @if($o->task->pastOr <= 0)

                                                <div class="mx-1" title="مهلت" data-toggle="tooltip">{{$o->task->diffDead}}</div>
                                                <div class="mx-1">
                                                    <i data-toggle="tooltip" title="{{$o->task->diffDead}}" class="fa animated hvr-pop
                                                @if($o->task->rightNow < 0 ) fa-hourglass-end infinite tada
                                                @elseif($o->task->rightNow <= 3) fa-hourglass-half rubberBand
                                                @else fa-hourglass-start rubberBand @endif "></i>
                                                </div>
                                            @else
                                                <i data-toggle="tooltip" title="قبل از شروع مقرر" class="fa fa-hourglass-o"></i>
                                            @endif
                                            @if($o->task->reTask === 1)
                                                <div class="mx-1"><i class="fa fa-clone" data-toggle="tooltip" title="Clone"></i></div>
                                            @endif

                                            @if(!isset($_GET['sort']) && $o->lastStatus != 2)
                                                <form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                    <input type="hidden" name="task_id" value="{{$o->task->id}}">
                                                    <input type="hidden" name="status" value="start">
                                                    <input type="hidden" name="content" value="شروع کار {{$o->task->id}} - {{$o->task->title}}">

                                                    <button class="btn btn-link text-dark p-0 mx-1 hvr-push my-auto" title="شروع" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>

                                                </form>
                                            @endif







                                            @can('task-edit')
                                                <div class="mx-1 hvr-push">
                                                    <a href="/tasks/{{ $o->task->id }}/edit"><i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش {{ $o->task->title }}"></i></a>
                                                </div>
                                            @endcan

                                            <div class="mx-1 hvr-pop">
                                                <a href="/tasks/{{ $o->task->id }}"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو به {{ $o->task->title }}"></i></a>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <div id="collapse{{$o->task->id}}" class="collapse collapseTask">
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-2 d-none d-md-block">
                                                <img src="/storage/uploads/{{$o->task->pic}}" class="img-fluid" alt="" data-toggle="modal" data-target="#img{{$o->task->id}}" style="cursor: zoom-in">




                                            </div>

                                            <div class="col-lg-5 col-xl-5">



                                                <table class="table table-bordered table-hover text-center  " style="width: 100%;min-width: 100%">




                                                    <tr class="d-md-none">
                                                        <td>نوع</td>
                                                        <td>{{$o->task->type}}</td>
                                                    </tr>
                                                    <tr class="d-md-none">
                                                        <td>برند</td>
                                                        <td>{{$o->task->brand}}</td>
                                                    </tr>
                                                    <tr class="d-md-none">
                                                        <td>برای</td>
                                                        <td>{{$o->task->forProduct}}</td>
                                                    </tr>
                                                    @if($o->task->dx || $o->task->dy || $o->task->dz)

                                                        <tr>
                                                            <td>در قطع</td>
                                                            <td><span title="عرض">{{$o->task->dx}}</span>-<span title="طول">{{$o->task->dy}}</span>-<span title="عمق">{{$o->task->dz}}</span>-<span title="واحد">{{$o->task->dDesc}}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if($o->task->material)

                                                        <tr>
                                                            <td>متریال</td>
                                                            <td>{{$o->task->material}}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr class="d-md-none">
                                                        <td>مهلت باقیمانده</td>

                                                        <td>
                                                            {{$o->task->diffDead}}
                                                        </td>
                                                    </tr>


                                                    @if($o->task->reTask === 1)
                                                        <tr>
                                                            <td colspan="2">مشابه این کار قبلا انجام شده</td>


                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2">
                                                            <span class="badge badge-secondary" title="شروع کار">{{$o->task->jStart}}</span>
                                                            <i class="fa fa-arrow-left"></i>
                                                            <span class="badge badge-success" title="ددلاین کار">{{$o->task->jEnd}}</span>
                                                        </td>


                                                    </tr>

                                                </table>

                                                <div class="btn-group text-center">
                                                    @if($o->task->type && $o->task->type != "سایر") <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="نوع کار"  data-placement="bottom">{{ $o->task->type }}</button> @endif
                                                    @if($o->task->type && $o->task->brand != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="برند"  data-placement="bottom">{{ $o->task->brand }}</button> @endif
                                                    @if($o->task->type && $o->task->forProduct != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="محصول"  data-placement="bottom">{{ $o->task->forProduct }}</button> @endif
                                                    @if($o->task->type && $o->task->material != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="متریال"  data-placement="bottom">{{ $o->task->material }}</button> @endif
                                                    <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="نظر"  data-placement="bottom">{{ $o->task->commentCount }}</button>

                                                    @if($o->task->reTask === 1)

                                                        <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="Clone" data-placement="bottom">
                                                            <i class="fa fa-clone"></i>
                                                        </button>
                                                    @endif

                                                </div>

                                            </div>


                                            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">

                                                <form method="post" action="{{ route('status.store') }}">
                                                    @csrf
                                                    <div class="row collapse form-group advanced">

                                                        <div class="col-md-6">
                                                            <input type="hidden" value="{{ $o->task->id }}"  name="task_id">
                                                            <select class="form-control form-control-sm" disabled>
                                                                <option selected>{{ $o->task->title }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="to_user" class="form-control form-control-sm">
                                                                <option selected="selected" value="">به شخص</option>
                                                                @foreach($usersStatus as $user)
                                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                                @endforeach


                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <textarea name="content" id="" rows="2" class="form-control InputToFocus" placeholder=".."></textarea>

                                                        {{--<input type="text" class="form-control InputToFocus" name="content" autocomplete="off" placeholder="..">--}}
                                                        <div class="input-group-append">
                                                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                            <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-check"></i></button>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-link" data-toggle="collapse" data-target=".advanced" type="button"><i class="fa fa-bars"></i></button>
                                                    <input type="hidden" name="status" value="comment">

                                                </form>

                                                <hr>
                                                <div class="comment-wrapper">
                                                    <div class="panel panel-info">
                                                        <div class="panel-body">

                                                            <ul class="media-list">

                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($statuses->where('task_id', $o->task->id)->where('status','comment') as $status)

                                                                    <li class="media">
                                                                        <a href="#" class="pull-left ml-3">
                                                                            <img class="img-circle" style="width: 30px;height: 30px"
                                                                                 src="/storage/avatars/{{ $status->user->avatar }}"/>
                                                                        </a>
                                                                        <div class="media-body">
                                                                    <span class="text-muted pull-left">
                                                                        <small dir="ltr" class="text-muted" title="{{$status->jCreated_at}}"  data-toggle="tooltip" data-placement="right">{{$status->diff}}</small>

                                                                    </span>
                                                                            <small class="text-success">{{ $status->user->name }}</small>
                                                                            <div class="clearfix"></div>
                                                                            <div style="white-space: pre-wrap;" data-toggle="collapse" data-target=".status" aria-expanded="false" aria-controls="status">{{ $status->content }}</div>
                                                                            <div class="text-left collapse status">
                                                                                @if($status->diffM < 5 && $status->user_id == Auth::id())
                                                                                    <form class="d-inline" action="{{ route('status.update',$status->id)}}" method="post">
                                                                                        @method('PATCH')
                                                                                        @csrf
                                                                                        <textarea name="content" class="form-control">{{$status->content}}</textarea>
                                                                                        <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                                                                        <input type="hidden" value="{{$status->task_id}}" name="task_id">
                                                                                        <button class="btn btn-link my-2 text-warning" type="submit">ثبت ویرایش</button>

                                                                                    </form>
                                                                                    {{--<form class="d-inline" action="{{ route('status.edit',$status->id)}}" method="post">--}}

                                                                                    {{--<input name="diffM" type="hidden" value="{{$status->diffM}}">--}}

                                                                                    {{--@csrf--}}
                                                                                    {{--<input type="hidden" value="{{$user->id}}" name="user_id">--}}
                                                                                    {{--<input type="hidden" value="{{$status->id}}" name="id">--}}
                                                                                    {{--<a class="btn btn-link my-2 text-warning" href="/status/{{$status->id}}/edit"><i class="fa fa-edit"></i></a>--}}
                                                                                    {{--</form>--}}

                                                                                    <form class="d-inline"  action="{{ route('status.destroy', $status->id)}}" method="post" onsubmit="confirm('Are You Sure?')">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <input type="hidden" name="url" value="{{$urlP}}">
                                                                                        <input type="hidden" value="{{ $o->task->id }}"  name="task_id">

                                                                                        <button class="btn btn-link text-danger my-2" type="submit"><i class="fa fa-trash"></i> حذف</button>
                                                                                    </form>
                                                                                @else
                                                                                    <small class="text-muted">زمان حذف و یا ویرایش این تسک به پایان رسیده</small>

                                                                                @endif

                                                                            </div>


                                                                        </div>
                                                                    </li>
                                                                    @if(!Request::is('tasks'))
                                                                        @if($i++ >= 5)
                                                                            @break
                                                                        @endif
                                                                    @endif
                                                                @endforeach


                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-12 col-md-12 col-xl-12">


                                                <div class="d-flex justify-content-between"><span class="badge badge-white">{{$o->task->jStart}}</span><span class="badge badge-white">{{$o->task->jEnd}}</span></div>
                                                <div class="progress">
                                                    <div data-toggle="tooltip" title="
                                                            @if( $o->task->prog >100 )زمان مقرر این تسک پایان یافته است
                                                            @elseزمان سپری شده {{$o->task->prog}}%
                                                            @endif"
                                                         data-placement="top" class="progress-bar
                                                            @if( $o->task->prog <= 100 ) progress-bar-striped progress-bar-animated bg-success @else bg-info @endif
                                                            "  role="progressbar" style="width: {{ $o->task->prog }}%" aria-valuenow="{{ $o->task->prog }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>







                                            </div>

                                            <div class="text-left col-12">

                                                <hr>
                                                @if(isset($_GET['sort']) && $_GET['sort'] == 'done' || isset($_GET['sort']) && $_GET['sort'] == 'latest')
                                                @else
                                                    <form  class="form-inline float-right" method="post" action="{{ route('status.store') }}" onsubmit="return confirm('در صورت تایید، این کار از لیست کارهای جاری شما خارج خواهد شد. از پایان پروژه اطمینان دارید؟');">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                        <input type="hidden" name="task_id" value="{{$o->task->id}}">
                                                        <input type="hidden" name="status" value="end">
                                                        <input type="hidden" name="content" value="پایان کار {{$o->task->id}} - {{$o->task->title}}">

                                                        <button class="btn btn-danger hvr-push my-auto" title="پایان کار و خروج از لیسست کارهای من" type="submit" data-toggle="tooltip"><i class="fa fa-stop"></i> پایان کار</button>

                                                    </form>
                                                @endif

                                                <a href="/tasks/{{$o->task->id}}" class="btn btn-link d-sm-none"><i class="fa fa-3x fa-arrow-left"></i></a>
                                            </div>



                                        </div>
                                    </div>

                                </div>



                            </div>


                        @endforeach
</div>
                        @endif

                        <h1 class="display-6 text-muted text-center animated fadeIn delay-1s">کارها</h1>
                        <hr class="my-4 animated fadeIn delay-1s">
                    @foreach($order as $o)

                            {{--Modal for Task IMGE--}}
                            <div class="modal" id="img{{$o->task->id}}" style="cursor: zoom-out">
                                <div class="text-center animated bounceIn" data-dismiss="modal">
                                            <img src="/storage/uploads/{{$o->task->pic}}"  data-dismiss="modal">
                                </div>
                            </div>

                            <div class="card card-border animated fadeInUp" >

                            <div class="card-header card-border
                                    @if($o->lastStatus == 0)
                                    bg-info
                                    @elseif($o->lastStatus == 1)
                                    bg-light
                                    @elseif($o->lastStatus == 2)
                                    bg-success
                                    @elseif($o->lastStatus == 3)
                                    bg-dark
                                    @endif
                            ">
                                <div class="row">

                                    <div class="col-md-9 row" data-toggle="collapse" href="#collapse{{$o->task->id}}">
                                        <div class="col-12 col-md-4 text-center text-md-right">{{$o->order_column}}
                                            .{{ str_limit($o->task->title, 40) }}</div>
                                        <div class="d-none d-lg-block col-lg-2 text-center">
                                            @if($o->task->type && $o->task->brand != "سایر")
                                                {{$o->task->brand}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div class="d-none d-lg-block col-lg-2 text-center">
                                            @if($o->task->type && $o->task->type != "سایر")
                                                {{$o->task->type}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div class="d-none d-lg-block col-lg-2 text-center">
                                            @if($o->task->type && $o->task->forProduct != "سایر")
                                                {{$o->task->forProduct}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        {{--<div dir="ltr" class="d-none d-xl-block col-xl-1 text-center">--}}
                                        {{--@if($task->dx || $task->dy || $task->dz)--}}
                                        {{--{{$task->dx}}|{{$task->dy}}|{{$task->dz}}--}}
                                        {{--@else--}}
                                        {{-----}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        {{--<div class="d-none d-xl-block col-xl-1 text-center">--}}
                                        {{--@if($task->type && $task->material != "سایر")--}}
                                        {{--{{$task->material}}--}}
                                        {{--@else--}}
                                        {{-----}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        <div class="d-none d-lg-block col-lg-2 text-center">

                                        </div>
                                    </div>
                                    <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                                        <div class="flex-grow-1"></div>
                                        @if(isset($usersInTasks))
                                            @foreach($usersInTasks->where('task_id', $o->task->id) as $ut)
                                                @foreach($users->where('id', $ut->user_id) as $u)
                                                    <div class="mx-1 hvr-pop">
                                                        <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 29px;height: 29px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endif



                                        @if($o->task->pastOr <= 0)

                                            <div class="mx-1" title="مهلت" data-toggle="tooltip">{{$o->task->diffDead}}</div>
                                            <div class="mx-1">
                                                <i data-toggle="tooltip" title="{{$o->task->diffDead}}" class="fa animated hvr-pop
                                                @if($o->task->rightNow < 0 ) fa-hourglass-end infinite tada
                                                @elseif($o->task->rightNow <= 3) fa-hourglass-half rubberBand
                                                @else fa-hourglass-start rubberBand @endif "></i>
                                            </div>
                                        @else
                                            <i data-toggle="tooltip" title="قبل از شروع مقرر" class="fa fa-hourglass-o"></i>
                                        @endif
                                        @if($o->task->reTask === 1)
                                            <div class="mx-1"><i class="fa fa-clone" data-toggle="tooltip" title="Clone"></i></div>
                                        @endif

                                        @if(!isset($_GET['sort']) && $o->lastStatus != 2)
                                            <form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                <input type="hidden" name="task_id" value="{{$o->task->id}}">
                                                <input type="hidden" name="status" value="start">
                                                <input type="hidden" name="content" value="شروع کار {{$o->task->id}} - {{$o->task->title}}">

                                                <button class="btn btn-link text-dark p-0 mx-1 hvr-push my-auto" title="شروع" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>

                                            </form>
                                        @endif







                                        @can('task-edit')
                                            <div class="mx-1 hvr-push">
                                                <a href="/tasks/{{ $o->task->id }}/edit"><i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش {{ $o->task->title }}"></i></a>
                                            </div>
                                        @endcan

                                        <div class="mx-1 hvr-pop">
                                            <a href="/tasks/{{ $o->task->id }}"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو به {{ $o->task->title }}"></i></a>
                                        </div>



                                    </div>
                                </div>
                            </div>

                                <div id="collapse{{$o->task->id}}" class="collapse collapseTask">
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-2 d-none d-md-block">
                                                <img src="/storage/uploads/{{$o->task->pic}}" class="img-fluid" alt="" data-toggle="modal" data-target="#img{{$o->task->id}}" style="cursor: zoom-in">




                                                </div>

                                            <div class="col-lg-5 col-xl-5">



                                                <table class="table table-bordered table-hover text-center  " style="width: 100%;min-width: 100%">




                                                    <tr class="d-md-none">
                                                        <td>نوع</td>
                                                        <td>{{$o->task->type}}</td>
                                                    </tr>
                                                    <tr class="d-md-none">
                                                        <td>برند</td>
                                                        <td>{{$o->task->brand}}</td>
                                                    </tr>
                                                    <tr class="d-md-none">
                                                        <td>برای</td>
                                                        <td>{{$o->task->forProduct}}</td>
                                                    </tr>
                                                    @if($o->task->dx || $o->task->dy || $o->task->dz)

                                                        <tr>
                                                            <td>در قطع</td>
                                                            <td><span title="عرض">{{$o->task->dx}}</span>-<span title="طول">{{$o->task->dy}}</span>-<span title="عمق">{{$o->task->dz}}</span>-<span title="واحد">{{$o->task->dDesc}}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if($o->task->material)

                                                        <tr>
                                                            <td>متریال</td>
                                                            <td>{{$o->task->material}}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr class="d-md-none">
                                                        <td>مهلت باقیمانده</td>

                                                        <td>
                                                            {{$o->task->diffDead}}
                                                        </td>
                                                    </tr>


                                                    @if($o->task->reTask === 1)
                                                        <tr>
                                                            <td colspan="2">مشابه این کار قبلا انجام شده</td>


                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2">
                                                            <span class="badge badge-secondary" title="شروع کار">{{$o->task->jStart}}</span>
                                                            <i class="fa fa-arrow-left"></i>
                                                            <span class="badge badge-success" title="ددلاین کار">{{$o->task->jEnd}}</span>
                                                        </td>


                                                    </tr>

                                                </table>

                                                <div class="btn-group text-center">
                                                    @if($o->task->type && $o->task->type != "سایر") <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="نوع کار"  data-placement="bottom">{{ $o->task->type }}</button> @endif
                                                    @if($o->task->type && $o->task->brand != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="برند"  data-placement="bottom">{{ $o->task->brand }}</button> @endif
                                                    @if($o->task->type && $o->task->forProduct != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="محصول"  data-placement="bottom">{{ $o->task->forProduct }}</button> @endif
                                                    @if($o->task->type && $o->task->material != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="متریال"  data-placement="bottom">{{ $o->task->material }}</button> @endif
                                                    <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="نظر"  data-placement="bottom">{{ $o->task->commentCount }}</button>

                                                    @if($o->task->reTask === 1)

                                                        <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="Clone" data-placement="bottom">
                                                            <i class="fa fa-clone"></i>
                                                        </button>
                                                    @endif

                                                </div>

                                            </div>


                                            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">

                                                <form method="post" action="{{ route('status.store') }}">
                                                    @csrf
                                                    <div class="row collapse form-group advanced">

                                                        <div class="col-md-6">
                                                            <input type="hidden" value="{{ $o->task->id }}"  name="task_id">
                                                            <select class="form-control form-control-sm" disabled>
                                                                <option selected>{{ $o->task->title }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="to_user" class="form-control form-control-sm">
                                                                <option selected="selected" value="">به شخص</option>
                                                                @foreach($usersStatus as $user)
                                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                                @endforeach


                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <textarea name="content" id="" rows="2" class="form-control InputToFocus" placeholder=".."></textarea>

                                                        {{--<input type="text" class="form-control InputToFocus" name="content" autocomplete="off" placeholder="..">--}}
                                                        <div class="input-group-append">
                                                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                            <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-check"></i></button>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-link" data-toggle="collapse" data-target=".advanced" type="button"><i class="fa fa-bars"></i></button>
                                                    <input type="hidden" name="status" value="comment">

                                                </form>

                                                <hr>
                                                <div class="comment-wrapper">
                                                    <div class="panel panel-info">
                                                <div class="panel-body">

                                                <ul class="media-list">

                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach($statuses->where('task_id', $o->task->id)->where('status','comment') as $status)

                                                        <li class="media">
                                                            <a href="#" class="pull-left ml-3">
                                                                <img class="img-circle" style="width: 30px;height: 30px"
                                                                     src="/storage/avatars/{{ $status->user->avatar }}"/>
                                                            </a>
                                                            <div class="media-body">
                                                                    <span class="text-muted pull-left">
                                                                        <small dir="ltr" class="text-muted" title="{{$status->jCreated_at}}"  data-toggle="tooltip" data-placement="right">{{$status->diff}}</small>

                                                                    </span>
                                                                <small class="text-success">{{ $status->user->name }}</small>
                                                                <div class="clearfix"></div>
                                                                <div style="white-space: pre-wrap;" data-toggle="collapse" data-target=".status" aria-expanded="false" aria-controls="status">{{ $status->content }}</div>
                                                                <div class="text-left collapse status">
                                                                    @if($status->diffM < 5 && $status->user_id == Auth::id())
                                                                        <form class="d-inline" action="{{ route('status.update',$status->id)}}" method="post">
                                                                            @method('PATCH')
                                                                            @csrf
                                                                            <textarea name="content" class="form-control">{{$status->content}}</textarea>
                                                                            <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                                                            <input type="hidden" value="{{$status->task_id}}" name="task_id">
                                                                            <button class="btn btn-link my-2 text-warning" type="submit">ثبت ویرایش</button>

                                                                        </form>
                                                                        {{--<form class="d-inline" action="{{ route('status.edit',$status->id)}}" method="post">--}}

                                                                        {{--<input name="diffM" type="hidden" value="{{$status->diffM}}">--}}

                                                                        {{--@csrf--}}
                                                                        {{--<input type="hidden" value="{{$user->id}}" name="user_id">--}}
                                                                        {{--<input type="hidden" value="{{$status->id}}" name="id">--}}
                                                                        {{--<a class="btn btn-link my-2 text-warning" href="/status/{{$status->id}}/edit"><i class="fa fa-edit"></i></a>--}}
                                                                        {{--</form>--}}

                                                                        <form class="d-inline"  action="{{ route('status.destroy', $status->id)}}" method="post" onsubmit="confirm('Are You Sure?')">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="url" value="{{$urlP}}">
                                                                            <input type="hidden" value="{{ $o->task->id }}"  name="task_id">

                                                                            <button class="btn btn-link text-danger my-2" type="submit"><i class="fa fa-trash"></i> حذف</button>
                                                                        </form>
                                                                    @else
                                                                        <small class="text-muted">زمان حذف و یا ویرایش این تسک به پایان رسیده</small>

                                                                    @endif

                                                                </div>


                                                            </div>
                                                        </li>
                                                        @if(!Request::is('tasks'))
                                                            @if($i++ >= 5)
                                                                @break
                                                            @endif
                                                        @endif
                                                    @endforeach


                                                </ul>

                                            </div>
                                            </div>
                                            </div>
                                            </div>


                                            <div class="col-sm-12 col-md-12 col-xl-12">


                                                    <div class="d-flex justify-content-between"><span class="badge badge-white">{{$o->task->jStart}}</span><span class="badge badge-white">{{$o->task->jEnd}}</span></div>
                                                    <div class="progress">
                                                        <div data-toggle="tooltip" title="
                                                            @if( $o->task->prog >100 )زمان مقرر این تسک پایان یافته است
                                                            @elseزمان سپری شده {{$o->task->prog}}%
                                                            @endif"
                                                             data-placement="top" class="progress-bar
                                                            @if( $o->task->prog <= 100 ) progress-bar-striped progress-bar-animated bg-success @else bg-info @endif
                                                                "  role="progressbar" style="width: {{ $o->task->prog }}%" aria-valuenow="{{ $o->task->prog }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>







                                            </div>

                                            <div class="text-left col-12">

                                                <hr>
                                                @if(isset($_GET['sort']) && $_GET['sort'] == 'done' || isset($_GET['sort']) && $_GET['sort'] == 'latest')
                                                @else
                                                    <form  class="form-inline float-right" method="post" action="{{ route('status.store') }}" onsubmit="return confirm('در صورت تایید، این کار از لیست کارهای جاری شما خارج خواهد شد. از پایان پروژه اطمینان دارید؟');">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                        <input type="hidden" name="task_id" value="{{$o->task->id}}">
                                                        <input type="hidden" name="status" value="end">
                                                        <input type="hidden" name="content" value="پایان کار {{$o->task->id}} - {{$o->task->title}}">

                                                        <button class="btn btn-danger hvr-push my-auto" title="پایان کار و خروج از لیسست کارهای من" type="submit" data-toggle="tooltip"><i class="fa fa-stop"></i> پایان کار</button>

                                                    </form>
                                                @endif

                                                <a href="/tasks/{{$o->task->id}}" class="btn btn-link d-sm-none"><i class="fa fa-3x fa-arrow-left"></i></a>
                                            </div>



                                        </div>
                                    </div>

                                </div>



                            </div>

                        @endforeach
                        {{--@foreach($tasks as $task)--}}


                                {{--@foreach($task->statusInLine as $t)--}}
                                    {{--@if($t->status == 'end')--}}
                                        {{--@php--}}
                                            {{--$progborder = "bg-secondary";--}}
                                            {{--$progbg = "bg-success";--}}

                                        {{--@endphp--}}
                                    {{--@endif--}}
                                    {{--@break--}}
                                {{--@endforeach--}}

                                {{--@if($userLastStatus->lastStatus == 2)--}}
                                    {{--@php--}}
                                        {{--$progborder = "bg-success";--}}
                                        {{--$progbg = "bg-success";--}}
                                    {{--@endphp--}}
                                {{--@endif--}}

                                {{--@if(isset($_GET['sort']) && $_GET['sort'] == 'done')--}}
                                    {{--@php--}}
                                        {{--$progborder = "bg-success";--}}
                                        {{--$progbg = "bg-success";--}}
                                    {{--@endphp--}}
                                {{--@elseif(isset($_GET['sort']) && $_GET['sort'] == 'latest')--}}
                                    {{--@php--}}
                                        {{--$progborder = "bg-dark";--}}
                                        {{--$progbg = "bg-dark";--}}
                                    {{--@endphp--}}
                                {{--@endif--}}

                            {{--<!------------------------------------------------------------------>--}}
                            {{--<div class="card card-border animated fadeInDown" >--}}

                                {{--@include('helper.mainlineTask')--}}
{{--                                @include('helper.mainCollapseTasks')--}}
                            {{--</div>--}}

                        {{--@endforeach--}}
                        {{ $order->links() }}
                    </div>
                </div>
        @endsection
        @section('JS')

        @endsection

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
                                        <li class="nav-item">
                                            <small><a class="nav-link" href="/tasks?sort=pending">در انتظار</a></small>
                                        </li>
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

                            @if ($tasks->isEmpty())
                                <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>
                            @else

                                @if(isset($taskMeter) && $taskMeter->end == 0)
                                    <div class="alert alert-danger">{{$user->name}}، شما یک پروژه باز دارید. تا زمانی که پروژه متوقف نشده یک پروژه جدید باز نکنید. <a href="/tasks/{{$taskMeter->task_id}}" class="btn btn-link">مشاهده</a></div>
                                @endif
                                    @include('helper.titleTasks')
                            @endif
                    <!-----------------must to controller------------------------------->

                        @foreach($tasks as $task)
                            @if($task->pastOr >= 0)
                                @php
                                    $progborder = "bg-light";
                                    $progbg = "bg-light";
                                @endphp
                            @else
                            @if($task->prog <= 20)
                                @php
                                    $progborder = "bg-light";
                                    $progbg = "bg-info";
                                @endphp
                            @elseif($task->prog > 20 && $task->prog <= 50)
                                @php
                                    $progborder = " bg-light";
                                    $progbg = "bg-success";
                                @endphp
                            @elseif($task->prog > 50 && $task->prog <= 80)
                                @php
                                    $progborder = " bg-light";
                                    $progbg = "bg-warning";
                                @endphp
                            @elseif($task->prog > 80 && $task->prog <= 100)
                                @php
                                    $progborder = "border-danger bg-light";
                                    $progbg = "bg-danger";
                                @endphp
                            @else
                                @php
                                    $progborder = " bg-pink text-dark";
                                    $progbg = "bg-danger";
                                @endphp
                            @endif
                            @endif

                            @if(isset($taskMeter) && ($taskMeter->end == 0) && ($taskMeter->task_id == $task->id) && ($taskMeter->user_id == $user->id))
                            @elseif(isset($taskMeter) && $taskMeter->end == 1)
                            @else
                                @php
                                    $progborder = "border-secondary bg-light";
                                    $progbg = "bg-secondary";
                                @endphp
                            @endif
                            @if($task->pending == 1)
                                    @php
                                        $progborder = "border-info  bg-info";
                                        $progbg = "bg-info";
                                    @endphp
                                @endif

                        @include('helper.logicTasks')
                            <!------------------------------------------------------------------>
                            <div class="card card-border animated fadeInDown" >


                                @include('helper.mainlineTask')
                                @include('helper.mainCollapseTasks')
                            </div>

                        @endforeach
                        {{ $tasks->links() }}
                    </div>
                </div>
        @endsection
        @section('JS')

        @endsection

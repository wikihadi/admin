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

                            @if ($tasks->isEmpty())
                                <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>
                            @else


                                    @include('helper.titleTasks')
                            @endif
                    <!-----------------must to controller------------------------------->

                        @foreach($tasks as $task)


                                {{--@foreach($task->statusInLine as $t)--}}
                                    {{--@if($t->status == 'end')--}}
                                        {{--@php--}}
                                            {{--$progborder = "bg-secondary";--}}
                                            {{--$progbg = "bg-success";--}}

                                        {{--@endphp--}}
                                    {{--@endif--}}
                                    {{--@break--}}
                                {{--@endforeach--}}

                                @if($task->id == $userLastStatus->task_id && $userLastStatus->lastStatus == 2)
                                    @php
                                        $progborder = "bg-success";
                                        $progbg = "bg-success";
                                    @endphp
                                @endif

                                @if(isset($_GET['sort']) && $_GET['sort'] == 'done')
                                    @php
                                        $progborder = "bg-success";
                                        $progbg = "bg-success";
                                    @endphp
                                @elseif(isset($_GET['sort']) && $_GET['sort'] == 'latest')
                                    @php
                                        $progborder = "bg-dark";
                                        $progbg = "bg-dark";
                                    @endphp
                                @endif
                            @php
                                $progborder = "bg-dark";
                                $progbg = "bg-dark";
                            @endphp
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

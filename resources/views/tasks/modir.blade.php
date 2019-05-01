@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')
@endsection

@section('content')
    @include('helper.profileTasks2')

    <div class="col-sm-12">

        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">

            @include('helper.tasksUsers')
            @if ($tasks->isEmpty())
                <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>
            @else
                @include('helper.titleTasks')
            @endif



        <!-----------------must to controller------------------------------->
            @php
                $i = 1;
            @endphp
            @foreach($tasks as $task)


                @if($task->prog <= 20)
                    @php
                        $progborder = "border-info bg-light";
                        $progbg = "bg-info";
                    @endphp
                @elseif($task->prog > 20 && $task->prog <= 50)
                    @php
                        $progborder = "border-success bg-light";
                        $progbg = "bg-success";
                    @endphp
                @elseif($task->prog > 50 && $task->prog <= 80)
                    @php
                        $progborder = "border-warning bg-light";
                        $progbg = "bg-warning";
                    @endphp
                @elseif($task->prog > 80 && $task->prog <= 100)
                    @php
                        $progborder = "border-danger bg-light";
                        $progbg = "bg-danger";
                    @endphp
                @elseif($task->prog <= 0)
                    @php
                        $progborder = "border-secondary bg-light";
                        $progbg = "bg-light";
                    @endphp
                @else
                    @php
                        $progborder = "border-danger bg-dark";
                        $progbg = "bg-danger";
                    @endphp
                @endif
                <!-----------------must to controller------------------------------->
                <div class="card card-border animated fadeInDown">
                    @include('helper.mainlineTask')
                    @include('helper.mainCollapseTasks')
                </div>
            @endforeach

        <!---------------------------------------------------------->

            {{ $tasks->links() }}

        </div>


    </div>
@endsection
@section('JS')

@endsection

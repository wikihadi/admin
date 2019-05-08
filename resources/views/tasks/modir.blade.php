@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <style>

        .upDown:last-child form > button.upKey,.upDown:nth-child(4) form > button.downKey
         {
            visibility: hidden;
        }
    </style>
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

            {{ csrf_field() }}


        <!-----------------must to controller------------------------------->
            @php
                $i = 1;
            @endphp
            @foreach($order as $o)

        @foreach($tasks->where('id', $o->task_id) as $task)


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
                            $progborder = " bg-pink";
                            $progbg = "bg-danger";
                        @endphp
                    @endif
                @endif
                    @if($task->pending == 1)
                        @php
                            $progborder = "border-info  bg-info";
                            $progbg = "bg-info";
                        @endphp
                    @endif
                <!-----------------must to controller------------------------------->
                <div class="upDown">
                <div class="card card-border animated fadeInDown">

                    @include('helper.mainlineTask')
                    @include('helper.mainCollapseTasks')
                </div>
                </div>
                    @php
                        $i += 1;
                    @endphp
            @endforeach

    @endforeach
            <div id='app'>


                <tasks-component :order="{{$order}}" :tasks="{{$tasks}}"></tasks-component>

            </div>
            <!---------------------------------------------------------->
            @if(isset($task->i)){{ $tasks->links() }}@endif

        </div>


    </div>
@endsection
@section('JS')
    <script src="/js/app.js"></script>
@endsection

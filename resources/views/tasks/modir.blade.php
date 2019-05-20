@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')
@endsection


@section('content')


    <div class="col-sm-12">



        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">
            {{--<div class="alert alert-info">{{$user->name}}{{$lastStatus->content}}</div>--}}

            @include('helper.tasksUsers')





            @if(Request::is('jobs/*'))

            {{--@if ($tasks->isEmpty())--}}
                {{--<div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>--}}
            {{--@else--}}
                @include('helper.titleTasks')
            {{--@endif--}}

            {{ csrf_field() }}

            {{--@if(Request::is('jobs') || isset($jobPage) && $jobPage == 'old')--}}
                {{--<a href="/jobs/{{$user->id}}?pageType=new" class="btn btn-warning">New</a>--}}
        {{--<!-----------------must to controller------------------------------->--}}
            {{--@php--}}
                {{--$i = 1;--}}
            {{--@endphp--}}
            {{--@foreach($tasks as $task)--}}



                    {{--@if($task->pastOr >= 0)--}}
                        {{--@php--}}
                            {{--$progborder = "bg-light";--}}
                            {{--$progbg = "bg-light";--}}
                        {{--@endphp--}}
                    {{--@else--}}
                        {{--@if($task->prog <= 20)--}}
                            {{--@php--}}
                                {{--$progborder = "bg-light";--}}
                                {{--$progbg = "bg-info";--}}
                            {{--@endphp--}}
                        {{--@elseif($task->prog > 20 && $task->prog <= 50)--}}
                            {{--@php--}}
                                {{--$progborder = " bg-light";--}}
                                {{--$progbg = "bg-success";--}}
                            {{--@endphp--}}
                        {{--@elseif($task->prog > 50 && $task->prog <= 80)--}}
                            {{--@php--}}
                                {{--$progborder = " bg-light";--}}
                                {{--$progbg = "bg-warning";--}}
                            {{--@endphp--}}
                        {{--@elseif($task->prog > 80 && $task->prog <= 100)--}}
                            {{--@php--}}
                                {{--$progborder = "border-danger bg-light";--}}
                                {{--$progbg = "bg-danger";--}}
                            {{--@endphp--}}
                        {{--@else--}}
                            {{--@php--}}
                                {{--$progborder = " bg-pink";--}}
                                {{--$progbg = "bg-danger";--}}
                            {{--@endphp--}}
                        {{--@endif--}}
                    {{--@endif--}}
                        {{--@if($task->pending == 1)--}}
                            {{--@php--}}
                                {{--$progborder = "border-info  bg-info";--}}
                                {{--$progbg = "bg-info";--}}
                            {{--@endphp--}}
                        {{--@endif--}}



                        {{--@if(isset($userLastStatus) && $userLastStatus->task_id == $task->id && $userLastStatus->status == 'start')--}}
                            {{--@php--}}
                                {{--$progborder = "bg-success";--}}
                                {{--$progbg = "bg-success";--}}
                            {{--@endphp--}}
                        {{--@endif--}}



                {{--<!-----------------must to controller------------------------------->--}}
                {{--<div class="upDown">--}}
                {{--<div class="card card-border animated fadeInDown">--}}

                    {{--@include('helper.mainlineTask')--}}
                    {{--@include('helper.mainCollapseTasks')--}}
                {{--</div>--}}
                {{--</div>--}}
                    {{--@php--}}
                        {{--$i += 1;--}}
                    {{--@endphp--}}
            {{--@endforeach--}}
            {{--@elseif(isset($jobPage) && $jobPage == 'new')--}}
{{--                <a href="/jobs/{{$user->id}}?pageType=old" class="btn btn-warning">Old</a>--}}
                    <div id='app'>

                        <tasks-component :order="{{$order}}" :us="{{$users}}" :uts="{{$usersInTasks}}"></tasks-component>

                    </div>

                <!---------------------------------------------------------->
                {{--@if(isset($task->i)){{ $tasks->links() }}@endif--}}
            @endif
            </div>


        </div>

    @endsection
    @section('JS')

    @endsection

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
            @include('helper.navbarTasks')


            @if ($tasks->isEmpty())
                <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>
                @else
                @include('helper.titleTasks')

            @endif



        <!------------------------------------------------------------------>
            @php
                $i = 1;
            @endphp
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
                            $progborder = " bg-pink";
                            $progbg = "bg-danger";
                        @endphp
                    @endif
                @endif
            <!-----------------must to controller------------------------------->
                <div class="card card-border animated fadeInDown ">
                    @include('helper.mainlineTask')
                    @include('helper.mainCollapseTasks')
                </div>
            @endforeach
        <!---------------------------------------------------------->

            {{ $tasks->links() }}


        </div>


    </div>


    </div>





@endsection
@section('JS')


@endsection


{{-----------------------------------------------------old-------------------------------------}}

{{--@extends('admincore.app')--}}


{{--@section('content')--}}
    {{--<div class="row">--}}
        {{--<div class="col-lg-12 margin-tb">--}}
            {{--<div class="pull-left">--}}
                {{--<h2> Show User</h2>--}}
            {{--</div>--}}
            {{--<div class="pull-right">--}}
                {{--<a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    {{--<div class="row">--}}
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Name:</strong>--}}
                {{--{{ $user->name }}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Email:</strong>--}}
                {{--{{ $user->email }}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Roles:</strong>--}}
                {{--@if(!empty($user->getRoleNames()))--}}
                    {{--@foreach($user->getRoleNames() as $v)--}}
                        {{--<label class="badge badge-success">{{ $v }}</label>--}}
                    {{--@endforeach--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--@endsection--}}

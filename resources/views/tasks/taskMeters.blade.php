@extends('admincore.app')


@section('css')
    <link rel="stylesheet" href="/admin-core/pdate/persian-datepicker.min.css"/>

    <style>

        body, .content-wrapper, .main-heade{
            background: #CBCBCB!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
        .nav-link{
            color: #888!important;
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
            cursor: pointer;
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
            cursor: pointer;
        }
        input[type=range]:focus::-ms-fill-lower {
            background: #A880BC;
        }
        input[type=range]:focus::-ms-fill-upper {
            background: #A880BC;
        }
        .bullett{
            width: 30px;
            height: 30px;
            background: #A880BC;
            border-radius: 50%;
            position: absolute;
            top: 9px;
            z-index: 99;


        }

        .card-header{
            cursor: pointer;
        }
        .card-border{
            border-radius: 30px;
        }
    </style>
@endsection

@section('content')

















    <div class="col-sm-12">

        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">
            <div class="row  animated fadeIn delay-1s">
                <div class="text-right col">
                    <a href="{{url('/')}}" class="btn btn-link"><i class="fa fa-home"></i></a>
                    <a href=".profile" class="btn btn-link" data-toggle="collapse"><i class="fa fa-user"></i></a>
                    @can('task-create')
                        <a href="/tasks/create" class="btn btn-link" ><i class="fa fa-plus"></i></a>

                    @endcan
                </div>
                <div class="text-left mb-3 col">
                    <a class="btn btn-link" data-toggle="collapse" href=".collapseTask"><i class="fa fa-arrows-alt"></i></a>

                    @role('admin')
                    <button data-toggle="collapse" data-target="#demo" class="btn btn-link"><i class="fa fa-filter"></i></button>

                    <a href="/users" class="btn btn-link" ><i class="fa fa-users"></i></a>
                    @endrole
                </div>
            </div>

            {{--@foreach($users as $u)--}}

            {{--<div class="card">--}}
    {{--<div class="card-header">{{$u->name}}</div>--}}
                {{--<div class="card-body">--}}

                    {{--@foreach($taskMeters->where('user_id', $u->id) as $t)--}}
                        {{--{{$t->id}}--}}
                    {{--@endforeach--}}
                {{--</div>--}}
{{--</div>--}}
            {{--@endforeach--}}

<div class="row">
    <div class="col-12 card h2 text-center border-0"><div class="card-header">سوابق عملکرد کاربران</div>
    </div>
    <div class="card-deck">

    @foreach($users as $u)
<div class="col-sm-4 col-md-3 col-lg-2">
<div class="card">
    <div class="card-header">
        <img title="{{$u->name}}" class="card-img-top img-fluid img-thumbnail" src="/storage/avatars/{{$u->avatar}}" alt="image" style="width:100%;height: 100%; object-fit: contain" data-toggle="tooltip">

    </div>
    <div class="card-body">
        <u class="list-group m-0 p-0">
            @php
            $i = 0;
            @endphp
            @foreach($taskMeters->where('user_id', $u->id) as $t)
                <a href="/tasks/{{$t->task_id}}" target="_blank"><li class="p-1 text-center list-group-item @if($t->end == 1) bg-secondary @endif" @if($t->end == 1) title="پایان کار در {{$t->created_at}}" @endif>
                        @foreach($tasks->where('id', $t->task_id) as $task)
                            <small>{{$task->title}}</small>
                            @endforeach
                            @if($t->end == 1) <i class="fa fa-pause"></i> @endif

                    </li></a>
                @php
                    $i++;
                @endphp
@if($i > 5)
                    @break
@endif
                    @endforeach
        </u>
    </div>
    <div class="card-footer"><a href="/users/1" class="btn btn-link btn-block">{{$u->name}}</a></div>
</div>
</div>
                @endforeach
        </div>
        </div>





                            </div>
                        </div>

                    </div>
                </div>




        </div>


    </div>


    </div>





@endsection
@section('JS')

@endsection

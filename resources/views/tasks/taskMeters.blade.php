@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')
@endsection

@section('content')
    <div class="alert-warning alert">این صفحه بعد امکان ثبت ساعت جدید پاک می شود</div>
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
    <div class="card-footer"><a href="/users/{{$u->id}}" class="btn btn-link btn-block">{{$u->name}}</a></div>
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

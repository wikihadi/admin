@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')
@endsection


@section('content')


    <div class="col-sm-12">



        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">
            <div class="text-left">
                <span class="badge">راهنما:</span>
                <span class="badge badge-white border">معلق</span>
                <span class="badge badge-warning">پیگیری</span>
                <span class="badge badge-info">در انتظار</span>
                <span class="badge badge-dark">در لیست کار</span>
                <span class="badge badge-success">در حال انجام (هم اکنون)</span>
                @include('helper.tasksUsers')
                @include('helper.titleTasks')
                    {{ csrf_field() }}
                    <div id='app'>
                        <tasks-all-component :role="0" :us="{{$users}}" :uts="{{$usersInTasks}}" :tasks="{{$tasks}}"></tasks-all-component>
                    </div>
            </div>
        </div>
    </div>
    @endsection
    @section('JS')

    @endsection

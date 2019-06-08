@extends('admincore.appLight')

@section('css')
@endsection

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-white bg-white">
{{--            <a class="navbar-brand" href="#">Navbar</a>--}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/finance">مالی</a>
                    <a class="nav-item nav-link" href="/finance?sort=all">همه</a>
                    <a class="nav-item nav-link" href="/finance?sort=done">کارهای پایان یافته</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>کد</th>
                <th>عنوان</th>
                <th>نوع</th>
                <th>برند</th>
                <th>برای</th>
                <th>قیمت تمام شده</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
{{--            <div id="taskModal{{$task->id}}" class="modal fade" role="dialog">--}}
{{--                <div class="modal-dialog modal-dialog-centered">--}}

{{--                    <!-- Modal content-->--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                            <h6 class="modal-title">{{$task->id}}.{{$task->title}}</h6>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <finance-task-form :id="{{$task->id}}"></finance-task-form>--}}
{{--                            <form id="form{{$task->id}}" method="post" action="{{route('tasks.financeUpdate')}}">--}}
{{--                                @csrf--}}

{{--                                <input type="hidden" name="id" value="{{$task->id}}">--}}
{{--                                <div class="input-group mb-3">--}}
{{--                                    <input type="text" name="cost" class="form-control" required value="{{$task->cost}}">--}}
{{--                                    <div class="input-group-append input-group-prepend">--}}
{{--                                        <span class="input-group-text">ريال</span>--}}
{{--                                    </div>--}}
{{--                                    <button type="submit" class="btn btn-success input-group-append">ثبت</button>--}}
{{--                                </div>--}}
{{--                                <input type="submit">--}}
{{--                            </form>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        <tr class="" data-toggle="modal" data-target="#taskModal{{$task->id}}">--}}
        <tr class="
            @if(!empty($task->cost)) table-info @endif
             ">
            <td><i class="fa fa-close"></i>.{{$task->id}}</td>
            <td><a href="/tasks/{{$task->id}}" target="_blank">{{$task->title}}</a></td>
            <td>{{$task->type}}</td>
            <td>{{$task->brand}}</td>
            <td>{{$task->forProduct}}</td>

            @role('admin')
            <td>
                <form  method="post" action="/financeUpdate/{{$task->id}}">
                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="cost" class="form-control" required value="{{$task->cost}}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">ريال</span>
                                                        </div>
                                                    </div>
                </form>
            </td>
            @endrole
            @role('finance')
            <td>{{$task->cost}} ريال</td>
                @endrole
        </tr>
            @endforeach
        </tbody>
    </table>
        
    </div>
@endsection

@section('JS')
@endsection

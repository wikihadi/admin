@extends('admincore.appLight')

@section('css')
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="container">
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
        </div>
    @endif
    @role('admin')
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-white bg-white">
{{--            <a class="navbar-brand" href="#">Navbar</a>--}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/finance">مالی</a>
                    <a class="nav-item nav-link" href="/finance?status=all&sort=updated_at&order=asc">همه</a>
                    <a class="nav-item nav-link" href="/finance?status=done&sort=updated_at&order=asc">کارهای پایان یافته</a>
                </div>
            </div>
        </nav>
    </div>
    @endrole
    <div class="container-fluid">

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th><a href="?status=done&sort=id&order=asc"><i class="fa fa-caret-down"></i></a>
                                    کد
                    <a href="?status=done&sort=id&order=desc"><i class="fa fa-caret-up"></i></a></th>
                <th><a href="?status=done&sort=title&order=asc"><i class="fa fa-caret-down"></i></a>
                    عنوان
                    <a href="?status=done&sort=title&order=desc"><i class="fa fa-caret-up"></i></a></th></th>
                <th><a href="?status=done&sort=type&order=asc"><i class="fa fa-caret-down"></i></a>
                    نوع
                    <a href="?status=done&sort=type&order=desc"><i class="fa fa-caret-up"></i></a></th></th>
                <th><a href="?status=done&sort=brand&order=asc"><i class="fa fa-caret-down"></i></a>
                    برند
                    <a href="?status=done&sort=brand&order=desc"><i class="fa fa-caret-up"></i></a></th></th>
                <th><a href="?status=done&sort=forProduct&order=asc"><i class="fa fa-caret-down"></i></a>
                    برای
                    <a href="?status=done&sort=forProduct&order=desc"><i class="fa fa-caret-up"></i></a></th></th>
                <th><a href="?status=done&sort=content&order=asc"><i class="fa fa-caret-down"></i></a>
                    توضیحات
                    <a href="?status=done&sort=content&order=desc"><i class="fa fa-caret-up"></i></a></th></th>
                <th><a href="?status=done&sort=cost&order=asc"><i class="fa fa-caret-down"></i></a>
                    قیمت تمام شده
                    <a href="?status=done&sort=cost&order=desc"><i class="fa fa-caret-up"></i></a></th></th>
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
        <tr class=" @if(!empty($task->cost) && $task->paid == 0) table-light @elseif($task->paid == 1) table-success @endif ">
            <td><img src="/storage/uploads/{{$task->pic}}" style="width: 50px"></td>
            <td>
                <div style="min-width: 50px">
                @role('admin')
                <i class="fa @if($task->paid == 0) text-danger fa-close @else text-success fa-check @endif"></i>.
                    @endrole
                @role('finance')
                <a href="/taskPayForm?ID={{$task->id}}">
                    <i class="fa @if($task->paid == 0) text-danger fa-close @else text-success fa-check @endif"></i>
                </a>.
                @endrole
                {{$task->id}}</div></td>
            <td><a href="/tasks/{{$task->id}}" target="_blank">{{$task->title}}</a></td>
            <td>{{$task->type}}</td>
            <td>{{$task->brand}}</td>
            <td>{{$task->forProduct}}</td>
            <td style="max-width: 300px">{{$task->content}}</td>

            @role('admin')
            <td >
                <form  method="post" action="/financeUpdate/{{$task->id}}">
                    @csrf
                                                    <div class="input-group mb-3"  style="min-width: 250px">
                                                        <input type="text" name="cost" class="form-control" required value="{{$task->cost}}">
                                                        <div class="input-group-append input-group-prepend">
                                                            <span class="input-group-text">ريال</span>
                                                        </div>
                                                        @role('modir')
                                                        <button class="btn btn-secondary input-group-append" type="submit" name="payOK" value="1"><i class="fa fa-check"></i></button>
                                                        @endrole
                                                    </div>
                </form>
            </td>
            @endrole
            @role('finance')
            <td>
                {{number_format($task->cost)}}
                 ريال</td>
                @endrole
        </tr>
            @endforeach
        </tbody>
    </table>
        
    </div>
@endsection

@section('JS')
@endsection

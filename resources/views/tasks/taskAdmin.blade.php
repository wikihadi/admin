@extends('admincore.app')
@section('css')
@endsection
@section('content')
    <div class="col-md-10 m-auto mt-sm-5" style="">
        <div class="d-flex justify-content-between">
            <div>
                {{--تعداد {{$taskCount}} کار در سیستم ثبت شده است--}}
            </div>
            <div><span class="badge">{{$dateNow}}</span></div>
        </div>

        {{--وضعیت:--}}
        {{--<div class="btn-group">--}}
            {{--<a href="?" class="btn btn-link">همه</a>--}}
            {{--<a href="?s=end" class="btn btn-link text-dark">پایان</a>--}}
            {{--<a href="?s=print" class="btn btn-link text-warning">چاپ</a>--}}
            {{--<a href="?s=pending" class="btn btn-link">معلق</a>--}}

        {{--</div>--}}
        @hasrole('admin')

        <task-admin :tasks="{{$tasks}}" :user="{{Auth::user()}}" :role="1"></task-admin>
        @else
            @hasrole('finance')
            <task-admin :tasks="{{$tasks}}" :user="{{Auth::user()}}" :role="2"></task-admin>
        @else
                @hasrole('finMan')
                <task-admin :tasks="{{$tasks}}" :user="{{Auth::user()}}" :role="3"></task-admin>

                @endhasrole
                @endhasrole
                @endhasrole

            {{--<table class="table table-sm">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>ID</th>--}}
                {{--<th>عنوان کار</th>--}}
                {{--<th>کاربر</th>--}}
                {{--<th>وضعیت جدید</th>--}}
                {{--<th>هزینه</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach($statuses as $item)--}}
                {{--<tr class="{{$item->bg}}">--}}
                    {{--<td>{{$item->task_id}}</td>--}}
                    {{--<td>{{$item->task->title}}</td>--}}
                    {{--<td>{{$item->user->name}}</td>--}}
                    {{--<td>{{$item->statusFa}}</td>--}}
                    {{--<td>{{$item->cost}}</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
            {{--</tbody>--}}

        {{--</table>--}}
{{--        <div class="mt-5">{{$statuses->links()}}</div>--}}

    </div>
@endsection

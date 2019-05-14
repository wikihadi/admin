<form method="post" action="{{ route('status.store') }}">
    @csrf
    <div class="row collapse form-group advanced">

        <div class="col-md-6">
            <input type="hidden" value="{{ $task->id }}"  name="task_id">
            <select class="form-control form-control-sm" disabled>
                <option selected>{{ $task->title }}</option>
            </select>
        </div>
        <div class="col-md-6">
            <select name="to_user" class="form-control form-control-sm">
                <option selected="selected" value="">به شخص</option>
                @foreach($usersStatus as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>

                @endforeach


            </select>
        </div>
    </div>
    <div class="input-group">
        <input type="text" class="form-control InputToFocus" name="content" autocomplete="off" placeholder="..">
        <div class="input-group-append">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-check"></i></button>
        </div>
    </div>
    <button class="btn btn-link" data-toggle="collapse" data-target=".advanced" type="button"><i class="fa fa-bars"></i></button>
    <input type="hidden" name="status" value="status">

</form>

<hr>
<ul class="media-list">

@php
$i = 1;
@endphp
    @foreach($statuses->where('task_id', $task->id) as $status)

        <li class="media">
            <a href="#" class="pull-left ml-3">
                <img class="img-circle" style="width: 30px;height: 30px"
                     src="/storage/avatars/{{ $status->user->avatar }}"/>
            </a>
            <div class="media-body">
                                                                    <span class="text-muted pull-left">
                                                                        <small dir="ltr" class="text-muted" title="{{$status->jCreated_at}}"  data-toggle="tooltip" data-placement="right">{{$status->diff}}</small>

                                                                    </span>
                <small class="text-success">{{ $status->user->name }}</small>
                <div class="clearfix"></div>
                <div style="white-space: pre-wrap;">{{ $status->content }}</div>
                {{--<div class="text-left">--}}
                {{--@if($status->diffM < 5)--}}
                {{--<form class="d-inline" action="{{ route('comments.edit',$comment->id)}}" method="post">--}}

                {{--<input name="diffM" type="hidden" value="{{$comment->diffM}}">--}}

                {{--@csrf--}}
                {{--<input type="hidden" value="{{$user->id}}" name="user_id">--}}
                {{--<input type="hidden" value="{{$comment->id}}" name="id">--}}
                {{--<a class="btn btn-link my-2 text-muted" href="/comments/{{$status->id}}/edit"><i class="fa fa-edit"></i></a>--}}
                {{--</form>--}}
                {{--@endif--}}
                {{--</div>--}}

            </div>
        </li>
@if(!Request::is('tasks/*'))
        @if($i++ >= 5)
            @break
            @endif
            @endif
    @endforeach


</ul>
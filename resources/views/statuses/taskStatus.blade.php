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
        <textarea name="content" id="" rows="2" class="form-control InputToFocus" placeholder=".."></textarea>
        {{--<input type="text" class="form-control InputToFocus" name="content" autocomplete="off" placeholder="..">--}}
        <div class="input-group-append">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-check"></i></button>
        </div>
    </div>
    <button class="btn btn-link" data-toggle="collapse" data-target=".advanced" type="button"><i class="fa fa-bars"></i></button>
    <input type="hidden" name="status" value="comment">

</form>

<hr>
<ul class="media-list">

@php
$i = 1;
@endphp
    @foreach($statuses->where('task_id', $task->id)->where('status','comment') as $status)

        <li class="media">
            <span class="pull-left ml-3">
                <img class="img-circle" style="width: 30px;height: 30px"
                     src="/storage/avatars/{{ $status->user->avatar }}"/>
            </span>
            <div class="media-body">
                                                                    <span class="text-muted pull-left">
                                                                        <small dir="ltr" class="text-muted" title="{{$status->jCreated_at}}"  data-toggle="tooltip" data-placement="right">{{$status->diff}}</small>

                                                                    </span>
                <small class="text-success">{{ $status->user->name }}</small>
                <div class="clearfix"></div>
                <div style="white-space: pre-wrap;" data-toggle="collapse" data-target=".status" aria-expanded="false" aria-controls="status">{{ $status->content }}</div>
                <div class="text-left collapse status">
                    @if($status->diffM < 5 && $status->user_id == Auth::id())
                        <form class="d-inline" action="{{ route('status.update',$status->id)}}" method="post">
                            @method('PATCH')
                            @csrf
                            <textarea name="content" class="form-control">{{$status->content}}</textarea>
                            <input type="hidden" value="{{Auth::id()}}" name="user_id">
                            <input type="hidden" value="{{$status->task_id}}" name="task_id">
                            <input type="hidden" name="url" value="{{$urlP}}">

                            <button class="btn btn-link my-2 text-warning" type="submit">ثبت ویرایش</button>

                        </form>
                        {{--<form class="d-inline" action="{{ route('status.edit',$status->id)}}" method="post">--}}

                            {{--<input name="diffM" type="hidden" value="{{$status->diffM}}">--}}

                            {{--@csrf--}}
                            {{--<input type="hidden" value="{{$user->id}}" name="user_id">--}}
                            {{--<input type="hidden" value="{{$status->id}}" name="id">--}}
                            {{--<a class="btn btn-link my-2 text-warning" href="/status/{{$status->id}}/edit"><i class="fa fa-edit"></i></a>--}}
                        {{--</form>--}}

                        <form class="d-inline"  action="{{ route('status.destroy', $status->id)}}" method="post" onsubmit="confirm('Are You Sure?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="urlP" value="{{$urlP}}">
                            <input type="hidden" value="{{ $task->id }}"  name="task_id">

                            <button class="btn btn-link text-danger my-2" type="submit"><i class="fa fa-trash"></i> حذف</button>
                            </form>
                        @else
                        <small class="text-muted">زمان حذف و یا ویرایش این تسک به پایان رسیده</small>

                    @endif

                </div>


            </div>
        </li>
@if(!Request::is('tasks/*'))
        @if($i++ >= 5)
            @break
            @endif
            @endif
    @endforeach


</ul>
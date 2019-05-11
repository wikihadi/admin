<div class="card-header card-border @if($task->isDone == 0){{$progborder}}@else bg-success @endif">
    <div class="row">

        <div class="col-md-9 row " data-toggle="collapse" href="#collapse{{$task->id}}">
            {{--<div class="d-none d-lg-block col-lg-1 text-right"></div>--}}
            <div class="col-12 col-md-4 text-center text-md-right ">@if(isset($task->i)){{$task->i}}@else{{$i}}@endif
                .{{ str_limit($task->title, 40) }}</div>
            <div class="d-none d-lg-block col-lg-2 text-center">
                @if($task->type && $task->brand != "سایر")
                    {{$task->brand}}
                @else
                    -
                @endif
            </div>
            <div class="d-none d-lg-block col-lg-2 text-center">
                @if($task->type && $task->type != "سایر")
                    {{$task->type}}
                @else
                    -
                @endif
            </div>
            <div class="d-none d-lg-block col-lg-2 text-center">
                @if($task->type && $task->forProduct != "سایر")
                    {{$task->forProduct}}
                @else
                    -
                @endif
            </div>
            {{--<div dir="ltr" class="d-none d-xl-block col-xl-1 text-center">--}}
            {{--@if($task->dx || $task->dy || $task->dz)--}}
            {{--{{$task->dx}}|{{$task->dy}}|{{$task->dz}}--}}
            {{--@else--}}
            {{-----}}
            {{--@endif--}}
            {{--</div>--}}
            {{--<div class="d-none d-xl-block col-xl-1 text-center">--}}
            {{--@if($task->type && $task->material != "سایر")--}}
            {{--{{$task->material}}--}}
            {{--@else--}}
            {{-----}}
            {{--@endif--}}
            {{--</div>--}}
            <div class="d-none d-lg-block col-lg-2 text-center">

            </div>
        </div>
        <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
            <div class="flex-grow-1"></div>
            @if(isset($usersInTasks))
                @foreach($usersInTasks->where('task_id', $task->id) as $ut)
                    @foreach($users->where('id', $ut->user_id) as $u)
                        <div class="mx-1">
                           <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 29px;height: 29px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                        </div>
                    @endforeach
                @endforeach
            @endif
            @if($task->pending == 0 && $task->isDone == 0)

                @if($task->pastOr <= 0)

            <div class="mx-1" title="مهلت" data-toggle="tooltip">{{$task->diffDead}}</div>
            <div class="mx-1">
                <i data-toggle="tooltip" title="{{$task->diffDead}}" class="fa animated
                                                @if($task->rightNow < 0 ) fa-hourglass-end infinite tada 
                                                @elseif($task->rightNow <= 3) fa-hourglass-half rubberBand 
                                                @else fa-hourglass-start rubberBand @endif "></i>
            </div>
                    @else
                    <i data-toggle="tooltip" title="قبل از شروع مقرر" class="fa fa-hourglass-o"></i>
                @endif
            @if($task->reTask === 1)
                <div class="mx-1"><i class="fa fa-clone" data-toggle="tooltip" title="Clone"></i></div>
            @endif

            @if(isset($taskMeter) && ($taskMeter->end == 0) && ($taskMeter->task_id == $task->id) && ($taskMeter->user_id == $user->id))
                <div class="mx-1"><a href="/tasks/{{$task->id}}/end"><i class="fa fa-pause"></i></a></div>
            @elseif(isset($taskMeter) && $taskMeter->end == 1)
                <div class="mx-1">
                    <a href="/tasks/{{$task->id}}/start"><i class="fa fa-play"></i></a>
                </div>
            @endif

            @else
                <div class="mx-1">در انتظار</div>
            @endif
            @can('task-edit')
                    <div class="mx-1 hvr-grow">
                        <a href="/tasks/{{ $task->id }}/edit"><i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش {{ $task->title }}"></i></a>
                    </div>
                @endcan

                    <div class="mx-1 hvr-backward">
                        <a href="/tasks/{{ $task->id }}"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو به {{ $task->title }}"></i></a>
                    </div>



        </div>
    </div>
</div>
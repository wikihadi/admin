        @extends('admincore.app')


        @section('content')



            @foreach($tasks as $task)

                <div class="col-lg-6 col-md-6 col-sm-12 animated fadeIn">
                    <div class="w-100 hvr-bob card card-outline
        @if($task->rightNow < 0 )
                            card-danger bg-warning
        @elseif($task->rightNow <= 3)
                            card-danger

        @else
                            card-info
        @endif
                            ">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-bold">{{$task->title}}
                                <small class="text-muted">{{$task->rightNow}} روز دیگر</small>
                            </h5>
                            <small class="card-text text-small">{{ str_limit($task->content, $limit = 180, $end = '...') }}</small>
                            <br>
                            <a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>
                            <a href="/tasks/{{$task->id}}/edit" class="card-link mr-2 ">ویرایش</a>
                        </div>
                    </div><!-- /.card -->
                </div>
            @endforeach
            {{ $tasks->links() }}


        @endsection

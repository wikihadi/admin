<form  method="post" action="{{ route('status.store') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
    <input type="hidden" name="task_id" value="{{$task->id}}">
    <input type="hidden" name="status" value="pause">
    <input type="hidden" name="content" value="توقف کار {{$task->id}} - {{$task->title}}">

    <button class="btn btn-link text-dark p-0 mx-1 hvr-push my-auto" title="شروع" type="submit" data-toggle="tooltip"><i class="fa fa-pause"></i></button>

</form>
<form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">
    @csrf
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
    <input type="hidden" name="task_id" value="{{$task->id}}">
    <input type="hidden" name="status" value="start">
    <input type="hidden" name="content" value="شروع کار {{$task->id}} - {{$task->title}}">

    <button class="btn btn-link text-dark p-0 mx-1 hvr-push my-auto" title="شروع" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>

</form>
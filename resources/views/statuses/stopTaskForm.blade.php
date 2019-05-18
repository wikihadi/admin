<form  class="form-inline float-right" method="post" action="{{ route('status.store') }}" onsubmit="return confirm('در صورت تایید، این کار از لیست کارهای جاری شما خارج خواهد شد. از پایان پروژه اطمینان دارید؟');">
    @csrf
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
    <input type="hidden" name="task_id" value="{{$task->id}}">
    <input type="hidden" name="status" value="end">
    <input type="hidden" name="content" value="پایان کار {{$task->id}} - {{$task->title}}">

    <button class="btn btn-danger hvr-push my-auto" title="پایان کار و خروج از لیسست کارهای من" type="submit" data-toggle="tooltip"><i class="fa fa-stop"></i> پایان کار</button>

</form>

@extends('admincore.app')

@section('css')
    @include('helper.css.mainTasksCss')

@endsection

@section('content')

    <div class="modal" id="img{{$task->id}}" style="cursor: zoom-out">
        <div class="text-center animated bounceIn" data-dismiss="modal">
            <img src="/storage/uploads/{{$task->pic}}"  data-dismiss="modal">
        </div>
    </div>

    <div class="col-sm-12">

        <div class="m-3 p-5 bg-white" style="border-radius: 30px;">
            {{--@if($task->isDone == 1)--}}
            {{--<div class="alert-info alert text-center">این کار توسط کاربر {{$task->done_user_id}} در تاریخ {{$task->done_date}} به اتمام رسیده است</div>--}}
            {{--@endif--}}
            {{--@if(isset($taskMeter) && $taskMeter->end == 0)--}}
                {{--<div class="alert alert-success alert-dismissible fade show" role="alert">--}}
                    {{--<strong>شروع کار</strong> این کار در حال انجام است--}}
                    {{--<a href="/tasks/{{$task->id}}/end"--}}
                       {{--class="btn btn-link my-2 text-dark">توقف زمان کار</a>--}}
                    {{--<strong>{{$taskMeter->created_at}}</strong>--}}
                    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--@endif--}}
            <h1 class="text-center">{{$task->title}}</h1>
            <div class="d-md-flex justify-content-center">
                    @if($task->type && $task->type != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="نوع کار"
                                data-placement="bottom">{{ $task->type }}</button> @endif
                    @if($task->type && $task->brand != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="برند"
                                data-placement="bottom">{{ $task->brand }}</button> @endif
                    @if($task->type && $task->forProduct != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="محصول"
                                data-placement="bottom">{{ $task->forProduct }}</button> @endif
                    @if($task->type && $task->material != "سایر")
                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="متریال"
                                data-placement="bottom">{{ $task->material }}</button> @endif
                    <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="نظر"
                            data-placement="bottom">{{ $task->commentCount }} <i class="fa fa-lg fa-commenting-o"></i></button>
                    <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="مشاهده"
                            data-placement="bottom">{{ $task->viewCount }} <i class="fa fa-lg fa-eye"></i></button>
                    <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="{{$dead}} روز دیگر"
                            data-placement="bottom">{{$dead}}
                        <i class="fa @if($dead < 0 ) fa-hourglass-end @elseif($dead <= 3) fa-hourglass-half @else fa-hourglass-start @endif "></i>
                    </button>
                    @if($task->reTask === 1)

                        <button class="btn btn-sm btn-link text-muted" data-toggle="tooltip" title="Clone"
                                data-placement="bottom">
                            <i class="fa fa-clone"></i>
                        </button>
                    @endif

            </div>
<div class="row">
            <div class="text-right col">
                <a href="{{url('/')}}" class="btn btn-link"><i class="fa fa-home"></i></a>
                <a href="/tasks" class="btn btn-link" title="My Tasks"><i class="fa fa-list-ol"></i></a>

            </div>
            <div class="text-left col text-left">

                    <form class=""  action="{{ route('tasks.destroy', $task->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="urlP" value="{{$urlP}}">
                                        @can('task-delete')

                        <button class="btn btn-link text-danger my-2" type="submit"><i class="fa fa-trash"></i></button>
                        @endcan

                    @can('task-edit')

                            <a href="/tasks/{{$task->id}}/edit"
                               class="btn btn-link text-warning my-2"><i class="fa fa-edit"></i></a>

                        @endcan
                    </form>

                {{--<a href="/tasks/create" class="btn btn-link" title="New"><i class="fa fa-plus"></i></a>--}}
                {{--<a class="btn btn-link" data-toggle="collapse" href=".collapse"><i class="fa fa-arrows-alt"></i></a>--}}
                {{--@if(isset($taskMeter) && $taskMeter->end == 1)--}}
                    {{--<a href="/tasks/{{$task->id}}/start" class="btn btn-link"><i class="fa fa-play"></i></a>--}}

                {{--@elseif(isset($taskMeter) && $taskMeter->end == 0)--}}
                    {{--<a href="/tasks/{{$task->id}}/end" class="btn btn-link"><i class="fa fa-pause"></i></a>--}}
                    {{--@else--}}
                    {{--<a href="/tasks/{{$task->id}}/start" class="btn btn-link"><i class="fa fa-play"></i></a>--}}

                {{--@endif--}}
            </div>
            </div>

            <div class="row">
                <!------------------------------------------------------------------>
                <div class="col-lg-6 order-12 order-md-1">
                    <div class="card card-border">

                        <div class="
                        @if($dead < 0 )
                                card-danger bg-danger
                        @elseif($dead <= 3)
                                card-danger bg-warning
                        @else
                                bg-info
                        @endif
                                card-header card-border"
                             data-toggle="collapse" data-target=".desc" aria-expanded="false" aria-controls="desc">
                            <div class="">+ مشخصات</div>


                        </div>
                        {{--<div id="desc" class="collapse show noShow" data-parent="#accordion">--}}
                        <div id="desc" class="collapse show noShow desc">
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <img src="/storage/uploads/{{$task->pic}}" class="img-fluid" alt="" data-toggle="modal" data-target="#img{{$task->id}}"  style="cursor: zoom-in">
                                    </div>
                                    <div class="col-sm-12 table-responsive">

                                        <table class="table table-borderless table-striped" style="width: 100%">

                                            <tr>
                                                <td>کد پروژه</td>
                                                <td>{{$task->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>عنوان</td>
                                                <td>{{$task->title}}</td>
                                            </tr>

                                            <tr>
                                                <td>شروع پروژه</td>
                                                <td>{{$task->jStartDate}}</td>
                                            </tr>
                                            <tr>
                                                <td>پایان پروژه</td>
                                                <td>{{$task->jDeadline}}</td>
                                            </tr>

                                            <tr>
                                                <td>تعداد نظرات</td>
                                                <td>{{$task->commentCount}}</td>
                                            </tr>
                                            <tr>
                                                <td>ایجاد کننده</td>
                                                <td>
                                                    <img src="/storage/avatars/{{ $admin->avatar }}" alt="" class="img-circle mx-1" style="object-fit: cover; width: 30px;height: 30px; border: 1px solid #a9a9a9;" title="{{$admin->name}}" data-toggle="tooltip">

                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>تیم کاری</td>
                                                <td class="d-flex">
                                                @foreach($users as $u)
                                                        <div class="mx-1">
                                                            <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 30px;height: 30px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @role('admin')
                                            <tr>
                                                <td colspan="2">
                                                    <form  method="post" action="/financeUpdate/{{$task->id}}">
                                                        @csrf
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="cost" class="form-control" required value="{{$task->cost}}" placeholder="هزینه پروژه (اگر هزینه ندارد خالی یا صفر باشد)">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">ريال</span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>

                                            </tr>
                                            @endrole
                                        </table>


                                    </div>

                                   </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-12">

                                </div>
                            </div>
                        </div>

                    </div>

                    {{--<div id="contentCard" class="card card-border">--}}

                        {{--<div class="bg-light card-header card-border" data-toggle="collapse" href="#content">--}}
                            {{--<div class="">+ توضیحات--}}
                            {{--</div>--}}


                        {{--</div>--}}
                        {{--<div id="content" class="collapse noShow" data-parent="#accordion">--}}
                            {{--<div class="card-body">--}}


                                {{--<div class="col-sm-12">--}}
                                    {{--<p class="text-justify">--}}
                                        {{--{{ $task->content }}--}}

                                    {{--</p>--}}


                                {{--</div>--}}
                            {{--</div>--}}


                        {{--</div>--}}
                    {{--</div>--}}

                </div>
                <!------------ Comment ------------------------------------------------------->
                <div class="col-lg-6 order-11 order-md-2">
                    <div id="commentCard" class="card card-border">

                        <div class="bg-secondary card-header card-border" data-toggle="collapse" href="#comments">
                            <div class="row">
                                <div class="">+ وضعیت
                                </div>


                            </div>


                        </div>
                        <div id="comments" class="collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10 m-auto">

                                        <div class="comment-wrapper">
                                            <div class="panel panel-info">
                                                <div class="d-flex justify-content-center">
                                                @foreach($users as $u)
                                                    <div class="mx-1 text-center">
                                                        <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 40px;height: 40px; border: 1px solid #a9a9a9;" title="{{$u->name}}" data-toggle="tooltip">
                                                    </div>
                                                @endforeach
                                                </div>
                                                <p class="text-justify bg-light-gradient p-2">
                                                    توضیحات:
                                                    {{ $task->content }}

                                                </p>
                                                <div class="panel-heading">
                                                    {{$task->commentCount}} نظر
                                                </div>
                                                <div class="panel-body">
                                                    @include('statuses.taskStatus')

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>

            </div>
        </div>
    </div>
    </div>



    <!-- Edit Modal HTML -->
    <div class="modal fade" id="editTaskModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frmEditTask">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Task
                        </h4>
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="edit-error-bag">
                            <ul id="edit-task-errors">
                            </ul>
                        </div>
                        <div class="form-group">
                            <label>

                            </label>
                            <input class="form-control" id="content" name="content" required="" type="text">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input id="id" name="id" type="hidden" value="">
                        <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                        <button class="btn btn-info" id="btn-edit" type="button" value="add">
                            Update
                        </button>
                        </input>
                        </input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Task Modal Form HTML -->
    <div class="modal fade" id="deleteTaskModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frmDeleteTask">
                    <div class="modal-header">
                        <h4 class="modal-title" id="delete-title" name="title">
                            Delete Task
                        </h4>
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Are you sure you want to delete this task?
                        </p>
                        <p class="text-warning">
                            <small>
                                This action cannot be undone.
                            </small>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <input id="did" name="did" type="hidden" value="">
                        <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                        <button class="btn btn-danger" id="btn-delete" type="button">
                            Delete Task
                        </button>
                        </input>
                        </input>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('JS')
            <script>
                $(document).ready(function() {

                    $("#btn-add").click(function () {
                        let x = $("#frmAddTask input[name=content]").val();
                        if(x != ''){
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: 'POST',
                                url: '/checklist',
                                data: {
                                    content: $("#frmAddTask input[name=content]").val(),
                                    task_id: $("#frmAddTask input[name=task_id]").val(),
                                    user_id: $("#frmAddTask input[name=user_id]").val(),
                                    type: 'task',
                                    CheckListStatus: 'new'
                                },
                                dataType: 'json',
                                success: function (data) {
                                    $('#frmAddTask').trigger("reset");
                                    $("#frmAddTask .close").click();
                                   // window.location.reload();
                                },
                                error: function (data) {
                                    var errors = $.parseJSON(data.responseText);
                                    $('#add-task-errors').html('');
                                    $.each(errors.messages, function (key, value) {
                                        $('#add-task-errors').append('<li>' + value + '</li>');
                                    });
                                    $("#add-error-bag").show();
                                }
                            });
                            $('#checklist-list').append('<li class="media"><div class="media-body"><div class="clearfix"></div><div style="white-space: pre-wrap;">' + x + '</div></div></li>');
                            // $('#content').val('');
                        }




                    });
                    $("#btn-edit").click(function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'PUT',
                            url: '/checklist/' + $("#id").val(),
                            data: {
                                content: $("#frmEditTask input[name=content]").val(),
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('#frmEditTask').trigger("reset");
                                $("#frmEditTask .close").click();
                                window.location.reload();
                            },
                            error: function(data) {
                                var errors = $.parseJSON(data.responseText);
                                $('#edit-task-errors').html('');
                                $.each(errors.messages, function(key, value) {
                                    $('#edit-task-errors').append('<li>' + value + '</li>');
                                });
                                $("#edit-error-bag").show();
                            }
                        });
                    });
                    $("#btn-delete").click(function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            url: '/checklist/' + $("#did").val(),
                            dataType: 'json',
                            success: function(data) {
                                $("#frmDeleteTask .close").click();
                                window.location.reload();
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                    });
                });
                function editTaskForm(id) {
                    $.ajax({
                        type: 'GET',
                        url: '/checklist/' + id,
                        success: function(data) {
                            $("#edit-error-bag").hide();
                            $("#frmEditTask input[name=content]").val(data.checklist.content);
                            $("#frmEditTask input[name=id]").val(data.checklist.id);
                            $('#editTaskModal').modal('show');
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });

                }
                function deleteTaskForm(id) {
                    $.ajax({
                        type: 'GET',
                        url: '/checklist/' + id,
                        success: function(data) {
                            $("#frmDeleteTask #delete-title").html("Delete (" + data.checklist.content + ")?");
                            $("#frmDeleteTask input[name=id]").val(data.checklist.id);
                            $('#deleteTaskModal').modal('show');
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            </script>
@endsection

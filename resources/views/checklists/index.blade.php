
@extends('admincore.app')



@section('css')

    <style>
        /*body, .content-wrapper, .main-heade, .bg-white ,footer{*/
            /*background: #2b2a2e!important;*/
        /*}*/
        /*.border-bottom{*/
            /*border-bottom: none!important;*/
        /*}*/
        /*.nav-link{*/
            /*color: #888!important;*/
        /*}*/
    </style>
@endsection
@section('content')
    <div class="col-md-10 col-lg-8 col-xl-6 m-auto mt-sm-5" style="">
        <div class="col-md-10 col-lg-8 col-xl-6 m-auto">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            {{--<h2>Manage <b>Tasks</b></h2>--}}
                        </div>
                        <div class="col-sm-6">
                            <a onclick="event.preventDefault();addTaskForm();" href="#" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Task</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($checklists as $task)
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->content}}</td>
                            {{--<td>--}}
                                {{--<a onclick="event.preventDefault();editTaskForm({{$task->id}});" href="#" class="edit open-modal" data-toggle="modal" value="{{$task->id}}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>--}}
                                {{--<a onclick="event.preventDefault();deleteTaskForm({{$task->id}});" href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>{{$checklists->count()}}</b> out of <b></b> entries</div>
                </div>

            </div>
            <!-- Add Task Modal Form HTML -->
            <div class="modal fade" id="addTaskModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="frmAddTask">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    Add New Task
                                </h4>
                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" id="add-error-bag">
                                    <ul id="add-task-errors">
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label>
                                        content
                                    </label>
                                    <input class="form-control" id="content" name="content" required="" type="text">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                                <button class="btn btn-info" id="btn-add" type="button" value="add">
                                    Add New Task
                                </button>
                                </input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addTaskForm()">Add</button>
            {{--<div class="" id="app">--}}
                {{--<checklist></checklist>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection
@section('JS')

    <script>
        $(document).ready(function() {
            $("#btn-add").click(function() {
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
                        task_id: 1,
                        user_id: 1,
                        type: 1,
                        CheckListStatus: 1
                    },
                    dataType: 'json',
                    success: function() {
                        $('#frmAddTask').trigger("reset");
                        $("#frmAddTask .close").click();
                        window.location.reload();
                    },
                    error: function(data) {
                        var errors = $.parseJSON(data.responseText);
                        $('#add-task-errors').html('');
                        $.each(errors.messages, function(key, value) {
                            $('#add-task-errors').append('<li>' + value + '</li>');
                        });
                        $("#add-error-bag").show();
                    }
                });
            });
            // $("#btn-edit").click(function() {
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: 'PUT',
            //         url: '/tasks/' + $("#frmEditTask input[name=task_id]").val(),
            //         data: {
            //             task: $("#frmEditTask input[name=task]").val(),
            //             description: $("#frmEditTask input[name=description]").val(),
            //         },
            //         dataType: 'json',
            //         success: function(data) {
            //             $('#frmEditTask').trigger("reset");
            //             $("#frmEditTask .close").click();
            //             window.location.reload();
            //         },
            //         error: function(data) {
            //             var errors = $.parseJSON(data.responseText);
            //             $('#edit-task-errors').html('');
            //             $.each(errors.messages, function(key, value) {
            //                 $('#edit-task-errors').append('<li>' + value + '</li>');
            //             });
            //             $("#edit-error-bag").show();
            //         }
            //     });
            // });
            // $("#btn-delete").click(function() {
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: 'DELETE',
            //         url: '/tasks/' + $("#frmDeleteTask input[name=task_id]").val(),
            //         dataType: 'json',
            //         success: function(data) {
            //             $("#frmDeleteTask .close").click();
            //             window.location.reload();
            //         },
            //         error: function(data) {
            //             console.log(data);
            //         }
            //     });
            // });
        });

        function addTaskForm() {
            $(document).ready(function() {
                $("#add-error-bag").hide();
                $('#addTaskModal').modal('show');
            });
        }

        // function editTaskForm(task_id) {
        //     $.ajax({
        //         type: 'GET',
        //         url: '/tasks/' + task_id,
        //         success: function(data) {
        //             $("#edit-error-bag").hide();
        //             $("#frmEditTask input[name=task]").val(data.task.task);
        //             $("#frmEditTask input[name=description]").val(data.task.description);
        //             $("#frmEditTask input[name=task_id]").val(data.task.id);
        //             $('#editTaskModal').modal('show');
        //         },
        //         error: function(data) {
        //             console.log(data);
        //         }
        //     });
        // }
        //
        // function deleteTaskForm(task_id) {
        //     $.ajax({
        //         type: 'GET',
        //         url: '/tasks/' + task_id,
        //         success: function(data) {
        //             $("#frmDeleteTask #delete-title").html("Delete Task (" + data.task.task + ")?");
        //             $("#frmDeleteTask input[name=task_id]").val(data.task.id);
        //             $('#deleteTaskModal').modal('show');
        //         },
        //         error: function(data) {
        //             console.log(data);
        //         }
        //     });
        // }
    </script>
    @endsection
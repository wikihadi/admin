
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        @if(!Request::is('/'))<li class="breadcrumb-item"><a href="/">خانه</a></li>@endif

                        @if(Request::is('users'))<li class="breadcrumb-item active">کاربران</li>@endif
                        @if(Request::is('users/*'))<li class="breadcrumb-item"><a href="/users">کاربران</a></li>@endif
                        @if(Request::is('users/create'))<li class="breadcrumb-item active">کاربر جدید</li>@endif
                        @if(Request::is('users/*/edit'))<li class="breadcrumb-item active">ویرایش {{$user->name}}</li>@endif

                        @if(Request::is('tasks'))<li class="breadcrumb-item active">کارها</li>@endif
                        @if(Request::is('tasks/*'))<li class="breadcrumb-item"><a href="/tasks">کارها</a></li>@endif
                        @if(Request::is('tasks/create'))<li class="breadcrumb-item active">کار جدید</li>@endif
                        @if(Request::is('tasks/*/edit'))<li class="breadcrumb-item active">ویرایش {{$task->title}}</li>@endif
                        @if(!Request::is('tasks/*/edit') && Request::is('tasks/*') && !Request::is('tasks/create'))<li class="breadcrumb-item active">{{$task->title}}</li>@endif

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
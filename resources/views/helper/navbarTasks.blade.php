<div class="row  animated fadeIn delay-1s">
    <div class="text-right col">
        {{--<a href="{{url('/')}}" class="btn btn-link"><i class="fa fa-home"></i></a>--}}
        {{--<a href=".profile" class="btn btn-link" data-toggle="collapse"><i class="fa fa-user"></i></a>--}}
        @can('task-create')
            <a href="/tasks/create" class="btn btn-link" ><i class="fa fa-plus"></i></a>

        @endcan
    </div>
    <div class="text-left mb-3 col">
        <a class="btn btn-link" data-toggle="collapse" href=".collapseTask"><i class="fa fa-arrows-alt"></i></a>

        @role('admin')
        <button data-toggle="collapse" data-target="#demo" class="btn btn-link"><i class="fa fa-filter"></i></button>

        <a href="/users" class="btn btn-link" ><i class="fa fa-users"></i></a>
        @endrole
    </div>
</div>
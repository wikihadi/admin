@extends('admincore.app')


@section('content')


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

        <div class="col-md-10 m-auto">
    <table class="table table-striped">
        @can('role-create')
            <a class="btn" href="{{ route('roles.create') }}"><i class="fa fa-2x fa-plus-circle"></i></a>
        @endcan
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td><a class="btn" href="{{ route('roles.show',$role->id) }}">{{ $role->name }}</a></td>
                <td>
                    @can('role-edit')
                        <a class="btn text-muted" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-lg fa-pencil"></i></a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('حذف', ['class' => 'btn text-danger btn-link']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

        </div>
    {!! $roles->render() !!}


@endsection
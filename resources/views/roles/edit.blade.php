@extends('admincore.appLight')

@section('content')
        <div class="col-lg-12 margin-tb">

            <div>
                <a class="btn btn-link" href="{{ route('roles.index') }}"><i class="fa fa-lg fa-arrow-right"></i></a>
            </div>
        </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="col-12">
    <div class="alert alert-warning">فقط به لاتین وارد کنید</div>
    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>عنوان نقش:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                <table class="table table-striped">
                    @foreach($permission as $value)
                        <tr>
                            <td>
                                <label for="role{{$value->id}}">{{ $value->name }}</label>
                            </td>
<td>
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name', 'id'=>'role'.$value->id)) }}
                            </td>
                        </tr>

                    @endforeach
                </table>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}

    </div>
@endsection

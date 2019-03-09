@extends('admincore.app')


@section('content')
<div class="col-12">

                <a class="btn btn-link" href="{{ route('roles.index') }}"><i class="fa fa-lg fa-arrow-right"></i></a>



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
</div>
    <div class="col-12">

    <div class="alert alert-info">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>فقط با نام لاتین</p>

    </div>
</div>


<div class="col-12">
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="col-6">
            <div class="form-group">
                <strong>نام نقش کاربری: </strong>

                {!! Form::text('name', null, array('placeholder' => 'ex: client','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <strong>دسترسی ها:</strong>
                <br/>
                <table class="table table-striped">
                @foreach($permission as $value)
                        <tr>
                            <td>
                    <label for="role{{$value->id}}">{{ $value->name }}</label>
                        </td>
                            <td><input name="permission[]" type="checkbox"  value="{{$value->id}}" id="role{{$value->id}}"></td>
                        </tr>

                @endforeach
                </table>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-2x fa-plus-circle"></i></button>
        </div>
    {!! Form::close() !!}
</div>
</div>

@endsection
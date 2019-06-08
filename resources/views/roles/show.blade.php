@extends('admincore.appLight')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-link" href="{{ route('roles.index') }}"><i class="fa fa-lg fa-arrow-right"></i></a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>عنوان نقش:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>دسترسی ها:</strong>

                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <label class="badge badge-pill badge-dark">{{ $v->name }}</label>
                    @endforeach
                @endif
        </div>
    </div>
@endsection

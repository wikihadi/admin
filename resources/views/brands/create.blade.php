@extends('admincore.app')

@section('content')

    <div class="col-md-8 m-auto">
        <button data-toggle="collapse" data-target="#addbrand" class="btn btn-link"><i class="fa fa-plus"></i></button>
        <div class="card uper collapse" id="addbrand">
            <div class="card-header">
                Add Brand
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('brands.store') }}">
                    <div class="form-group">
                        @csrf
                        <input type="text" class="form-control" name="title" placeholder="Brand Title"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="description" placeholder="Brand Description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>


    </div>
    <div class="col-md-8 m-auto">
        <div class="card uper">
            <div class="card-header">
Brands            </div>
            <div class="card-body">

                <table class="table table-striped">
                    <tr>

                        <th>کد</th>
                        <th>نام برند</th>
                    </tr>

                    @foreach($brands  as $brand)

                        <tr>


                            <td>

{{ $brand->id }}

                            </td>
                            <td>

{{ $brand->title }}

                            </td>

                        </tr>
@endforeach
                </table>

            </div>
        </div>
    </div>



@endsection

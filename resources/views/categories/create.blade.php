@extends('layouts.app')
@section('myNavbar')

    @extends('layouts.navbar')

@endsection
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <main class="py-4" >

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card uper">
                        <div class="card-header">
                            Add Task
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
                            <form method="post" action="{{ route('categories.store') }}">
                                <div class="form-group">
                                    @csrf
                                    <input type="text" class="form-control" name="title" placeholder="نام دسته"/>
                                </div>
                                <div class="form-group">
                                    <label for="">دسته والد</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="0">دسته اصلی</option>
                                        @foreach($categories->where('parent_id', 0) as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>

                                            @endforeach


                                    </select>

                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-md-8">
                    <div class="card uper">
                        <div class="card-header">
                            دسته ها
                        </div>
                        <div class="card-body">

                            <table class="table table-striped">
                                <tr>
                                    <td>کد</td>
                                    <td>نام دسته</td>
                                    <td>والد دسته</td>
                                </tr>
                                @foreach($categories->where('parent_id', 0)  as $category)


                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>

                                        <td>
                                            <table>
                                            @foreach($categories as $child)
                                                <tr>
                                                @if($child->parent_id == $category->id)
                                                    <td>
                                                    {{ $child->title }}
                                                    </td>
                                                @endif
                                                    </tr>
                                                @endforeach
                                            </table>


                                        </td>

                                </tr>

                                    @endforeach
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection

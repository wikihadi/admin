@extends('admincore.app')

@section('content')

            <div class="col-md-8 m-auto">
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
                        <form method="post" action="{{ route('tasks.store') }}">
                            <div class="form-group">
                                @csrf
                                <input type="text" class="form-control" name="title" placeholder="Title"/>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="deadline"/>
                            </div>
                            <div class="form-group">
                                <label for="">دسته والد</label>
                                <select name="categories[]" class="form-control">
                                    <option value="0">بدون دسته</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>

                                    @endforeach


                                </select>

                            </div>
                            <div class="form-group">

                            <textarea class="form-control" name="content" placeholder="Content"></textarea>

                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>


            </div>


@endsection

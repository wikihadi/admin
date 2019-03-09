
@extends('admincore.app')

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
                        Edit Share
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
                        <form method="post" action="{{ route('tasks.update', $task->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value={{ $task->title }} />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content">{{ $task->content }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>



                    </div>
                </div>
            </div>
    </main>
@endsection

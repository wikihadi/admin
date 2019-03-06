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



                <div class="uper">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Task Name</td>
                            <td>Task Content</td>
                            <td colspan="2">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->title}}</td>
                                <td>{{$task->content}}</td>
                                <td><a href="{{ route('tasks.edit',$task->id)}}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{ $tasks->links() }}

                        <div>



            </div>
        </div>
    </div>
        </div>
    </div>
    </main>
@endsection

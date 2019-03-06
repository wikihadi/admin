@extends('layouts.app')
@section('myNavbar')

    @extends('layouts.navbar')

@endsection
@section('content')
    <main class="py-4" >

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">



                <div class="card">
                    <div class="card-header">{{ $task->title }}

                        @if($dead >= 0)
                            <div class="float-right text-small text-muted">{{$dead}} days remaining</div>
                        @else
                            <div class="float-right text-small text-danger">{{abs($dead)}} days passed</div>
                        @endif
                    </div>

                    <div class="card-body">
                        {{ $task->content }}

                    </div>
                    <div class="card-footer">{{$task->viewCount}} <div class="float-right">{{ $task->commentCount }} Comments</div></div>
                </div>
                <div class="card" id="comments">
                    <div class="card-body">


                        @foreach($comments as $comment)
                        <div class="row">
                            <div class="col-md-2">
                                <img class="rounded-circle img img-fluid" src="/storage/avatars/{{ $comment->user->avatar }}" />

                                <p class="text-secondary text-center">{{$comment->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="col-md-10">
                                <p>
                                    <a class="float-left" href="#"><strong>{{ $comment->user->name }}</strong></a>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>

                                </p>
                                <div class="clearfix"></div>
                                <p>{{ $comment->comment }}</p>

                            </div>
                        </div>
                        @endforeach



                    </div>
                    <div class="card">
                        <div class="card-header">Add Comment</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('comments.store') }}">
                            <div class="form-group">
                                @csrf
                                <textarea class="form-control" name="comment" placeholder="comment"></textarea>

                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                    </div>

                    </div>




                    </div>
                </div>
            </div>
    </main>
@endsection

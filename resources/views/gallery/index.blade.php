@extends('admincore.app')
@section('css')
@endsection
@section('afterBody')
@endsection
@section('content')
    <div class="col-12">
        <div class="card-columns">
            @foreach($gallery as $item)
            <div class="card">
                <a href="storage/uploads/gallery/{{$item->pic}}" target="_blank">
                <img src="storage/uploads/gallery/{{$item->pic}}" class="card-img-top" alt="{{$item->content}}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$item->task->title}}</h5>
                    <p class="card-text">{{$item->content}}</p>
                    <small class="card-text pull-left">{{$item->user->name}}</small>
                </div>
            </div>
                @endforeach
        </div>

    </div>
    <div class="offset-md-4 col-md-8 text-center mt-5">{{$gallery->links()}}</div>
@endsection
@section('JS')
@endsection

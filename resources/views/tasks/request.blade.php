@extends('admincore.app')
@section('css')
@endsection
@section('afterBody')
@endsection
@section('content')
        <div class="offset-lg-3 col-lg-6 align-self-center">
            @if(isset($success))
                <request :brands="{{$brands}}" :user="{{Auth::user()}}" :task="{{$task}}"></request>
            @else
                <request :brands="{{$brands}}" :user="{{Auth::user()}}" :task="0"></request>
                @endif
        </div>
@endsection
@section('JS')
@endsection

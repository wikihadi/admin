@extends('admincore.app')
@section('css')
@endsection
@section('afterBody')
@endsection
@section('content')
    <chatbox :user="{{Auth::user()}}"></chatbox>
@endsection
@section('JS')
@endsection

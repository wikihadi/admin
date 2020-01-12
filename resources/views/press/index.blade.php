@extends('admincore.app')

@section('content')
<press :user="{{Auth::user()}}"></press>
@endsection

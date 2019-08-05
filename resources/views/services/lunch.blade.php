@extends('admincore.app')
@section('css')

    <style>
        body, .content-wrapper, .main-heade, .bg-white ,footer{
            background: #2b2a2e!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
        .nav-link{
            color: #888!important;
        }
    </style>
@endsection
{{--@section('afterBody')--}}
{{--    @include('helper.onOff')--}}
{{--@endsection--}}
@section('content')



    <div class="col-12 row justify-content-center">
        @role('lunchMan')
            <lunch-list :user="{{Auth::id()}}" :list="{{$lunchList}}" :role="1"></lunch-list>
        @else
            <lunch-list :user="{{Auth::id()}}" :list="{{$lunchList}}" :role="0"></lunch-list>
        @endrole
    </div>

            @endsection
@section('JS')
@endsection
<script>

</script>

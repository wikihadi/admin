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
        @hasrole('admin')
        <div class="col-12">
            <fin-list :user="{{Auth::id()}}" :role="'admin'"></fin-list>
        </div>
        @endhasrole
        @hasrole('finance')
        <div class="col-12">
            <fin-list :user="{{Auth::id()}}" :role="'finance'"></fin-list>
        </div>
        @endhasrole
        @hasrole('finMan')
        <div class="col-12">
            <fin-list :user="{{Auth::id()}}" :role="'finMan'"></fin-list>
        </div>
        @endhasrole
    </div>

@endsection
@section('JS')
@endsection
<script>

</script>

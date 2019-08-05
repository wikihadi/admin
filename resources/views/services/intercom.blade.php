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

            <intercom :user="{{Auth::id()}}" :intercom="{{$intercom}}"></intercom>
    </div>

            @endsection
@section('JS')
@endsection
<script>
    import Intercom from "../../js/components/services/Intercom";
    export default {
        components: {Intercom}
    }
</script>

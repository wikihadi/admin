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
        <div class="col-12">

            @hasrole('admin')
                <fin-list :users="{{$users}}" :user="{{Auth::id()}}" :role="'admin'"></fin-list>
            @else
                @hasrole('finance')
                    <fin-list :users="{{$users}}"  :user="{{Auth::id()}}" :role="'finance'"></fin-list>
                @else
                    @hasrole('finMan')
                        <fin-list :users="{{$users}}"  :user="{{Auth::id()}}" :role="'finMan'"></fin-list>
                    @else
                        @hasrole('finInd')
                            <fin-list :users="{{$users}}"  :user="{{Auth::id()}}" :role="'finInd'"></fin-list>
                        @else
                            @hasrole('taskMan')
                                <fin-list :users="{{$users}}"  :user="{{Auth::id()}}" :role="'taskMan'"></fin-list>
                            @else
                                @hasrole('designer')
                                    <fin-list :users="{{$users}}"  :user="{{Auth::id()}}" :role="'designer'"></fin-list>
                                @endhasrole
                            @endhasrole
                         @endhasrole
                    @endhasrole
                @endhasrole
            @endhasrole
    </div>
    </div>

@endsection
@section('JS')
@endsection
<script>

</script>

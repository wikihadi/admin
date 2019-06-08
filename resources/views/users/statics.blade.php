@extends('admincore.app')
@section('css')
    <style>
        body, .content-wrapper, .main-heade, .bg-white ,footer{
            background: #cccccc!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
        .nav-link{
            color: #888!important;
        }
li{
    font-size: .8rem;
}

        @media (min-width: 576px){
            .card-columns {
                column-count: 9;
                column-gap: .25rem;
                orphans: 1;
                widows: 1;
            }
            }
    </style>
@endsection
{{--@section('afterBody')--}}
{{--@endsection--}}
@section('content')

        <div class="container-fluid">
            <div class="card-columns">

            @foreach($users as $u)
{{--                    <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6 mx-0 px-1">--}}
                        <div class="card justify-content-center ">
                            <img class="card-img-top img-circle" src="/storage/avatars/{{$u->avatar}}" width="">



                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target=".collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa fa-bar-chart"></i> آمار
                                            </button>
                                        </h5>
                                    </div>

                                    <div class="collapse show collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class=""><user-statics :user="{{$u->id}}"></user-statics></div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target=".collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                               <i class="fa fa-tasks"></i> باکس
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="" class="collapse collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body"><user-statics-boxes :user="{{$u->id}}"></user-statics-boxes></div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target=".collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                تنظیمات
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="" class="collapse collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            بزودی
                                        </div>
                                    </div>
                                </div>
                            </div>




{{--                        </div>--}}
                    </div>
            @endforeach
            </div>
        </div>




@endsection
@section('JS')

@endsection

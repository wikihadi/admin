@extends('admincore.app')


@section('css')
    <link rel="stylesheet" href="/admin-core/pdate/persian-datepicker.min.css"/>

    <style>

        body, .content-wrapper, .main-heade{
            background: #CBCBCB!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
        .nav-link{
            color: #888!important;
        }

        input[type=range] {
            -webkit-appearance: none;
            margin: 20px 0;
            width: 100%;
        }
        input[type=range]:focus {
            outline: none;
        }
        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: #A880BC;
            border-radius: 1.3px;
        }
        input[type=range]::-webkit-slider-thumb {
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            border: 1px solid #000000;
            height: 36px;
            width: 36px;
            border-radius: 50%;
            background: #ffffff;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -14px;
        }
        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #A880BC;
        }
        input[type=range]::-moz-range-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: #A880BC;
            border-radius: 1.3px;
        }
        input[type=range]::-moz-range-thumb {
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
        }
        input[type=range]::-ms-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            border-width: 16px 0;
            color: transparent;
        }
        input[type=range]::-ms-fill-lower {
            background: #A880BC;
            border-radius: 2.6px;
        }
        input[type=range]::-ms-fill-upper {
            background: #A880BC;
            border-radius: 2.6px;
        }
        input[type=range]::-ms-thumb {
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
        }
        input[type=range]:focus::-ms-fill-lower {
            background: #A880BC;
        }
        input[type=range]:focus::-ms-fill-upper {
            background: #A880BC;
        }
        .bullett{
            width: 30px;
            height: 30px;
            background: #A880BC;
            border-radius: 50%;
            position: absolute;
            top: 9px;
            z-index: 99;


        }
        .card-header{
            cursor: pointer;
        }
        .card-border{
            border-radius: 30px;
        }
    </style>
@endsection

@section('content')
















    <div class="col-sm-12">

        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">

            @if ($tasks->isEmpty())
                <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>

            @else

                <div class="row">
                    <div class="col-md-9">
                        <div class="card border-0 d-none d-lg-block animated fadeIn delay-1s" style="box-shadow: none">
                            <div class="card-header" style="border-bottom: 0">
                                <div class="row">
                                    <div class="d-none d-lg-block col-lg-1 text-right">اولویت</div>
                                    <div class="d-none d-lg-block col-12 col-md-3 text-center text-md-right"></div>
                                    <div class="d-none d-lg-block col-lg-2 text-center">برند</div>
                                    <div class="d-none d-lg-block col-lg-2 text-center">نوع</div>
                                    <div class="d-none d-lg-block col-lg-2 text-center">برای</div>
                                    {{--<div class="d-none d-xl-block col-xl-1 text-center">قطع</div>--}}
                                    {{--<div class="d-none d-xl-block col-xl-1 text-center">متریال</div>--}}
                                    <div class="d-none d-lg-block col-lg-2 text-center"></div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @endif



        <!------------------------------------------------------------------>
            @php
                $i = 1;
            @endphp

                @foreach($tasks as $task)


                    @php
                        $progborder = "border-dark bg-light";
                        $progbg = "bg-light";
                    @endphp
                <div class="card card-border
                    animated fadeInDown


                        ">
                    <div class="
                    {{$progborder}}




                            card-header
                            card-border

" >
                        <div class="row">

                            <div class="col-md-9 row " data-toggle="collapse" href="#collapse{{$task->id}}">


                                {{--<div class="d-none d-lg-block col-lg-1 text-right"></div>--}}

                                <div class="col-12 col-md-4 text-center text-md-right ">{{$i++}}.{{ str_limit($task->title, 40) }}</div>
                                <div class="d-none d-lg-block col-lg-2 text-center">
                                    @if($task->type && $task->brand != "سایر")
                                        {{$task->brand}}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="d-none d-lg-block col-lg-2 text-center">
                                    @if($task->type && $task->type != "سایر")
                                        {{$task->type}}
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="d-none d-lg-block col-lg-2 text-center">
                                    @if($task->type && $task->forProduct != "سایر")
                                        {{$task->forProduct}}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="d-none d-lg-block col-lg-2 text-center">


                                </div>
                            </div>
                            <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                                <div class="flex-grow-1" data-toggle="collapse" href="#collapse{{$task->id}}"></div>





                                @if($task->reTask === 1)
                                    <div class="mx-1">

                                        <i class="fa fa-clone" data-toggle="tooltip" title="Clone"></i>
                                    </div>
                                @endif


                                @role('admin')
                                <div class="mx-1 hvr-grow">

                                    <a href="/tasks/{{ $task->id }}/edit"><i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش {{ $task->title }}"></i></a>
                                </div>
                                @endrole

                                @role('modir')
                                @else
                                    <div class="mx-1                     hvr-backward">

                                        <a href="/tasks/{{ $task->id }}"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو به {{ $task->title }}"></i></a>
                                    </div>
                                    @endrole
                            </div>
                        </div>

                    </div>
                    <div id="collapse{{$task->id}}" class="collapse collapseTask" data-parent="#accordion">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-xl-3 d-none d-sm-block">
                                    <img src="/storage/uploads/{{$task->pic}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-sm-12 col-md-8 col-xl-3 table-responsive">

                                    <table class="table table-borderless table-striped table-hover text-center  " style="width: 100%;min-width: 100%">

                                        <tr>
                                            <td><a href="/tasks/{{$task->id}}">کد</a></td>

                                            <td><a class="text-muted" href="/tasks/{{$task->id}}">{{$task->id}}</a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">


                                            </td>


                                        </tr>

                                        <tr class="d-md-none">
                                            <td>نوع</td>
                                            <td>{{$task->type}}</td>
                                        </tr>
                                        <tr class="d-md-none">
                                            <td>برند</td>
                                            <td>{{$task->brand}}</td>
                                        </tr>
                                        <tr class="d-md-none">
                                            <td>برای</td>
                                            <td>{{$task->forProduct}}</td>
                                        </tr>
                                        @if($task->dx || $task->dy || $task->dz || $task->dDesc)

                                            <tr>
                                                <td>در قطع</td>
                                                <td><span title="عرض">{{$task->dx}}</span>-<span title="طول">{{$task->dy}}</span>-<span title="عمق">{{$task->dz}}</span>-<span title="واحد">{{$task->dDesc}}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        @if($task->material)

                                            <tr>
                                                <td>متریال</td>
                                                <td>{{$task->material}}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="d-md-none">
                                            <td>مهلت باقیمانده</td>

                                            <td>
                                                {{$task->diffDead}}
                                            </td>
                                        </tr>

                                        @if($task->reTask === 1)
                                            <tr>
                                                <td colspan="2">مشابه این کار قبلا انجام شده</td>


                                            </tr>
                                        @endif





                                    </table>


                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-6">





                                    <p class="text-justify pt-3">
                                        {{ $task->content }}

                                    </p>


                                </div>

                                @role('admin')

                                <div class="text-left col-12">
                                    <a href="/tasks/{{$task->id}}" class="btn btn-link"><i class="fa fa-3x fa-arrow-left"></i></a>
                                </div>
                                @endrole

                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        <!---------------------------------------------------------->

            {{ $tasks->links() }}

        </div>


    </div>


    </div>





@endsection
@section('JS')

@endsection

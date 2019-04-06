        @extends('admincore.app')


        @section('css')
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
                /*td:first-child{*/
                    /*border-radius: 0 30px 30px 0;*/

                /*}*/
                /*td:last-child{*/
                    /*border-radius: 30px 0 0 30px;*/
                /*}*/
                /*td{*/
                    /*border: 1px solid black;*/
                    /*border-right: 0;*/
                    /*border-left: 0;*/
                /*}*/


                /*table{*/
                    /*border-collapse:separate;*/
                    /*border-spacing:0 15px;*/
                /*}*/
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
<div class="col-3 m-auto m-3 p-5 bg-white collapse fade" style="border-radius: 30px;" id="demo">
    <div class="row">
        <div class="col-3 text-center"><small>طراحی</small></div>
        <div class="col-3 text-center"><small>پیگیری</small></div>
        <div class="col-3 text-center"><small>چاپ</small></div>
        <div class="col-3 text-center"><small>پایان یافته</small></div>

        <div class="col-12 my-4 position-relative">

<div class="bullett" style="left: 0px"></div>
<div class="bullett" style="left: 31%;"></div>
<div class="bullett" style="left: 61%;"></div>
<div class="bullett" style="right: 0;"></div>

            <input id="slider-range" type="range" min="1" max="4" value="3" class="position-absolute" data-rangeslider style="z-index: 100!important; left: 0" disabled="">
        </div>


    </div>

</div>

    {{--<div class="m-3 p-5 bg-white" style="border-radius: 30px;">--}}
        {{--<div class="row">--}}
        {{--<div class="form-group col-4 text-left">--}}
            {{--جامع--}}
        {{--</div>--}}
            {{--<div class="form-group col-4 text-center">--}}

                {{--<label class="switch">--}}
                    {{--<input type="checkbox" name="" id="switchMode" onclick="--}}


                    {{--var checkBoxes = $('#startDate');--}}
                    {{--checkBoxes.prop('checked', !checkBoxes.prop('checked'));--}}
                    {{--" checked>--}}
                    {{--<span class="slider round"></span>--}}

                {{--</label>--}}



            {{--</div>--}}
        {{--<div class="form-group col-4 text-right">--}}
            {{--ساده--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-2 text-left"><input id="startDate" type="checkbox" class="" onclick="--}}
                {{--$('.startDate').toggleClass('d-none');"></div>--}}
            {{--<div class="col-10"><label for="startDate">تاریخ شروع</label></div>--}}
            {{--<div class="col-2 text-left"><input type="checkbox" class=""></div>--}}
            {{--<div class="col-10">تاریخ شروع</div>--}}
            {{--<div class="col-2 text-left"><input type="checkbox" class=""></div>--}}
            {{--<div class="col-10">تاریخ شروع</div>--}}
            {{--<div class="col-2 text-left"><input type="checkbox" class=""></div>--}}
            {{--<div class="col-10">تاریخ شروع</div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
<div class="col-sm-12">

    <div class="m-3 p-5 bg-white" style="border-radius: 30px;">

        <div class="text-left">
            {{--<button data-toggle="collapse" data-target="#demo" class="btn btn-link"><i class="fa fa-filter"></i></button>--}}

            <a href="/tasks/create" class="btn btn-link"><i class="fa fa-plus"></i></a></div>

        @if ($tasks->isEmpty())

            <div class="alert table-success ">تبریک! شما همه الویت های خود را به پایان رسانده اید.</div>

        @endif
        @if (!$tasks->isEmpty())

            <div class="card border-0 d-none d-md-block" style="box-shadow: none">
                <div class="card-header" style="border-bottom: 0">
                    <div class="row">
                        <div class="col-1 text-right">الویت</div>
                        <div class="col-md-3 col-xl-2 text-right">عنوان</div>
                        <div class="col-md-3 col-xl-1 text-center">نوع</div>
                        <div class="col-md-3 col-xl-1 text-center">برند</div>
                        <div class="d-none d-xl-block col-xl-1 text-center">برای</div>
                        <div class="d-none d-xl-block col-xl-1 text-center">قطع</div>
                        <div class="d-none d-xl-block col-xl-1 text-center">متریال</div>
                        <div class="d-none d-xl-block col-xl-1 text-center">مهلت</div>


                        <div class="col-6 col-md-3 text-left">

                        </div>

                    </div>
                </div>

            </div>
        @endif



        <!------------------------------------------------------------------>
        @foreach($tasks as $task)

        <div class="card card-border">
                <div class="
@switch($task->orderTask)
                @case(1)
                        card-danger bg-danger
@break

                @case(2)
                        card-danger bg-danger
@break

                @case(3)
                        card-danger bg-warning
@break





                @default
                        bg-light
@endswitch


                card-header
                card-border" data-toggle="collapse" href="#collapse{{$task->id}}">
                   <div class="row">
                       <div class="d-none d-xl-block col-xl-1 text-right">{{$task->orderTask}}</div>

                       <div class="col-5 col-md-3 col-xl-2 text-right">{{$task->title}}</div>
                       <div class="col-md-3 d-none d-md-block col-xl-1 text-center">{{$task->type}}</div>
                       <div class="col-md-3 d-none d-md-block col-xl-1 text-center">{{$task->brand}}</div>
                       <div class="d-none d-xl-block col-xl-1 text-center">{{$task->forProduct}}</div>
                       <div dir="ltr" class="d-none d-xl-block col-xl-1 text-center">{{$task->dx}}|{{$task->dy}}|{{$task->dz}}</div>
                       <div class="d-none d-xl-block col-xl-1 text-center">{{$task->material}}</div>
                       <div class="d-none d-xl-block col-xl-1 text-center">{{$task->rightNow}} روز</div>
                           <div class="col-6 col-md-3 text-left">
                               <i class="fa
                        @if($task->rightNow < 0 )
                                       fa-hourglass-end
@elseif($task->rightNow <= 3)
                                       fa-hourglass-half

@else
                                       fa-hourglass-start

@endif

" data-toggle="tooltip" title="{{$task->rightNow}} روز دیگر"  data-placement="right"></i>
                                |
                               <i class="fa fa-calendar" data-toggle="tooltip" title="10/01/1398"  data-placement="right"></i>
                               @if($task->reTask === 1)
                                |
                               <i class="fa fa-clone" data-toggle="tooltip" title="Clone"  data-placement="right"></i>
                                   @endif
                               |
                               <a href="/tasks/{{ $task->id }}"><i class="fa fa-link"></i></a>
                           </div>

                   </div>


                </div>
                <div id="collapse{{$task->id}}" class="collapse " data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-3">
                                <img src="/img/login.png" class="img-thumbnail" alt="">
                            </div>
                            <div class="col-sm-12 col-md-8 col-xl-3 table-responsive">
                                 <table class="table table-borderless table-striped" style="width: 100%">

                                     <tr>
                                         <td>کد پروژه</td>
                                         <td><a href="/tasks/{{$task->id}}">{{$task->id}}</a></td>
                                     </tr>
                                     <tr>
                                         <td>عنوان</td>
                                         <td><a href="/tasks/{{$task->id}}">{{$task->title}}</a></td>
                                     </tr>

                                     <tr>
                                         <td>شروع پروژه</td>
                                         <td>{{$task->startDate}}</td>
                                     </tr>
                                     <tr>
                                         <td>پایان پروژه</td>
                                         <td>{{$task->deadline}}</td>
                                     </tr>
                                     <tr>
                                         <td>فاز پروژه</td>
                                         <td>{{$task->status}}</td>
                                     </tr>
                                     <tr>
                                         <td>تعداد نظرات</td>
                                         <td>{{$task->commentCount}}</td>
                                     </tr>
                                     <tr>
                                         <td>کاربر</td>
                                         <td>{{$task->user_id}}</td>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td><a href="/tasks/{{$task->id}}" class="card-link">مشاهده بیشتر...</a></td>
                                     </tr>
                                 </table>


                                </div>
                            <div class="col-sm-12 col-md-12 col-xl-6">
                                <p class="text-justify">
                                    {{ $task->content }}

                                </p>


                            </div>
                            <div class="text-left col-12"><a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>
                                <a href="/tasks/{{$task->id}}/edit" class="card-link mr-2 ">ویرایش</a></div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-12">

                            </div>
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

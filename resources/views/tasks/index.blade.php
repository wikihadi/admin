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
                td:first-child{
                    border-radius: 0 30px 30px 0;

                }
                td:last-child{
                    border-radius: 30px 0 0 30px;
                }
                td{
                    border: 1px solid black;
                    border-right: 0;
                    border-left: 0;
                }


                table{
                    border-collapse:separate;
                    border-spacing:0 15px;
                }
            </style>
        @endsection
        
        @section('content')





<div class="col-sm-3">
<div class="m-3 p-5 bg-white" style="border-radius: 30px;">
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

    <div class="m-3 p-5 bg-white" style="border-radius: 30px;">
        <div class="row">
        <div class="form-group col-4 text-left">
            جامع
        </div>
            <div class="form-group col-4 text-center">

                <label class="switch">
                    <input type="checkbox" name="" id="switchMode" onclick="


                    var checkBoxes = $('#startDate');
                    checkBoxes.prop('checked', !checkBoxes.prop('checked'));
                    " checked>
                    <span class="slider round"></span>

                </label>



            </div>
        <div class="form-group col-4 text-right">
            ساده
        </div>
        </div>
        <div class="row">
            <div class="col-2 text-left"><input id="startDate" type="checkbox" class="" onclick="
                $('.startDate').toggleClass('d-none');"></div>
            <div class="col-10"><label for="startDate">تاریخ شروع</label></div>
            <div class="col-2 text-left"><input type="checkbox" class=""></div>
            <div class="col-10">تاریخ شروع</div>
            <div class="col-2 text-left"><input type="checkbox" class=""></div>
            <div class="col-10">تاریخ شروع</div>
            <div class="col-2 text-left"><input type="checkbox" class=""></div>
            <div class="col-10">تاریخ شروع</div>
        </div>
    </div>
</div>
<div class="col-sm-9">
    <div class="m-3 p-5 bg-white" style="border-radius: 30px;">
        <table class="w-100 text-center table-responsive" style="font-size: .8rem">
            <tr>
                <td>الویت</td>
                <td>نام برند</td>
                <td>نوع خدمت</td>
                <td>برای</td>
                <td>اندازه و قطع</td>
                <td>طراحی مجدد</td>
                <td>متریال</td>
                <td class="startDate">تاریخ شروع</td>
                <td>زمان مورد نیاز</td>
                <td>اصلاح متن</td>
                <td>توضیحات</td>
                <td>ویرایش</td>
            </tr>

            <tr class="table-info">
                <td class="py-3">الویت</td>
                <td>نام برند</td>
                <td>نوع خدمت</td>
                <td>برای</td>
                <td>اندازه و قطع</td>
                <td>طراحی مجدد</td>
                <td>متریال</td>
                <td class="startDate">تاریخ شروع</td>
                <td>زمان مورد نیاز</td>
                <td>اصلاح متن</td>
                <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که</td>
                <td>ویرایش</td>
            </tr>

            <tr class="table-danger">
                <td>الویت</td>
                <td>نام برند</td>
                <td>نوع خدمت</td>
                <td>برای</td>
                <td>اندازه و قطع</td>
                <td>طراحی مجدد</td>
                <td>متریال</td>
                <td class="startDate">تاریخ شروع</td>
                <td>زمان مورد نیاز</td>
                <td>اصلاح متن</td>
                <td>اصلاح متن</td>
                <td>ویرایش</td>
            </tr>
        </table>
    </div>


    </div>


            {{----}}
            {{--@foreach($tasks as $task)--}}

                {{--<div class="col-lg-6 col-md-6 col-sm-12 animated fadeIn">--}}
                    {{--<div class="w-100 hvr-bob card card-outline--}}
        {{--@if($task->rightNow < 0 )--}}
                            {{--card-danger bg-warning--}}
        {{--@elseif($task->rightNow <= 3)--}}
                            {{--card-danger--}}

        {{--@else--}}
                            {{--card-info--}}
        {{--@endif--}}
                            {{--">--}}
                        {{--<div class="card-body">--}}
                            {{--<h5 class="card-title mb-2 text-bold">{{$task->title}}--}}
                                {{--<small class="text-muted">{{$task->rightNow}} روز دیگر</small>--}}
                            {{--</h5>--}}
                            {{--<small class="card-text text-small">{{ str_limit($task->content, $limit = 180, $end = '...') }}</small>--}}
                            {{--<br>--}}
                            {{--<a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>--}}
                            {{--<a href="/tasks/{{$task->id}}/edit" class="card-link mr-2 ">ویرایش</a>--}}
                        {{--</div>--}}
                    {{--</div><!-- /.card -->--}}
                {{--</div>--}}
            {{--@endforeach--}}
            {{--{{ $tasks->links() }}--}}


        @endsection
        @section('JS')


        @endsection

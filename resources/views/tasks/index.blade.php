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

            {{--<script>--}}
                {{--function div(a, b) {--}}
                    {{--return parseInt((a / b));--}}
                {{--}--}}
                {{--function gregorian_to_jalali(g_y, g_m, g_d) {--}}
                    {{--var g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];--}}
                    {{--var j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];--}}
                    {{--var jalali = [];--}}
                    {{--var gy = g_y - 1600;--}}
                    {{--var gm = g_m - 1;--}}
                    {{--var gd = g_d - 1;--}}

                    {{--var g_day_no = 365 * gy + div(gy + 3, 4) - div(gy + 99, 100) + div(gy + 399, 400);--}}

                    {{--for (var i = 0; i < gm; ++i)--}}
                        {{--g_day_no += g_days_in_month[i];--}}
                    {{--if (gm > 1 && ((gy % 4 == 0 && gy % 100 != 0) || (gy % 400 == 0)))--}}
                    {{--/* leap and after Feb */--}}
                        {{--g_day_no++;--}}
                    {{--g_day_no += gd;--}}

                    {{--var j_day_no = g_day_no - 79;--}}

                    {{--var j_np = div(j_day_no, 12053);--}}
                    {{--/* 12053 = 365*33 + 32/4 */--}}
                    {{--j_day_no = j_day_no % 12053;--}}

                    {{--var jy = 979 + 33 * j_np + 4 * div(j_day_no, 1461);--}}
                    {{--/* 1461 = 365*4 + 4/4 */--}}

                    {{--j_day_no %= 1461;--}}

                    {{--if (j_day_no >= 366) {--}}
                        {{--jy += div(j_day_no - 1, 365);--}}
                        {{--j_day_no = (j_day_no - 1) % 365;--}}
                    {{--}--}}
                    {{--for (var i = 0; i < 11 && j_day_no >= j_days_in_month[i]; ++i)--}}
                        {{--j_day_no -= j_days_in_month[i];--}}
                    {{--var jm = i + 1;--}}
                    {{--var jd = j_day_no + 1;--}}
                    {{--jalali[0] = jy;--}}
                    {{--jalali[1] = jm;--}}
                    {{--jalali[2] = jd;--}}
                    {{--return jalali;--}}
                    {{--//return jalali[0] + "_" + jalali[1] + "_" + jalali[2];--}}
                    {{--//return jy + "/" + jm + "/" + jd;--}}
                {{--}--}}
                {{--function get_year_month_day(date) {--}}
                    {{--var convertDate;--}}
                    {{--var y = date.substr(0, 4);--}}
                    {{--var m = date.substr(5, 2);--}}
                    {{--var d = date.substr(8, 2);--}}
                    {{--convertDate = gregorian_to_jalali(y, m, d);--}}
                    {{--return convertDate;--}}
                {{--}--}}
                {{--function get_hour_minute_second(time) {--}}
                    {{--var convertTime = [];--}}
                    {{--convertTime[0] = time.substr(0, 2);--}}
                    {{--convertTime[1] = time.substr(3, 2);--}}
                    {{--convertTime[2] = time.substr(6, 2);--}}
                    {{--return convertTime;--}}
                {{--}--}}
                {{--function convertDate(date) {--}}
                    {{--var convertDateTime = get_year_month_day(date.substr(0, 10));--}}
                    {{--convertDateTime = convertDateTime[0] + "/" + convertDateTime[1] + "/" + convertDateTime[2] + " " + date.substr(10);--}}
                    {{--return convertDateTime;--}}
                {{--}--}}
                {{--function get_persian_month(month) {--}}
                    {{--switch (month) {--}}
                        {{--case 1:--}}
                            {{--return "فروردین";--}}
                            {{--break;--}}
                        {{--case 2:--}}
                            {{--return "اردیبهشت";--}}
                            {{--break;--}}
                        {{--case 3:--}}
                            {{--return "خرداد";--}}
                            {{--break;--}}
                        {{--case 4:--}}
                            {{--return "تیر";--}}
                            {{--break;--}}
                        {{--case 5:--}}
                            {{--return "مرداد";--}}
                            {{--break;--}}
                        {{--case 6:--}}
                            {{--return "شهریور";--}}
                            {{--break;--}}
                        {{--case 7:--}}
                            {{--return "مهر";--}}
                            {{--break;--}}
                        {{--case 8:--}}
                            {{--return "آبان";--}}
                            {{--break;--}}
                        {{--case 9:--}}
                            {{--return "آذر";--}}
                            {{--break;--}}
                        {{--case 10:--}}
                            {{--return "دی";--}}
                            {{--break;--}}
                        {{--case 11:--}}
                            {{--return "بهمن";--}}
                            {{--break;--}}
                        {{--case 12:--}}
                            {{--return "اسفند";--}}
                            {{--break;--}}
                    {{--}--}}
                {{--}--}}
            {{--</script>--}}



<div class="col-sm-12">
<div class="col-3 m-auto m-3 p-5 bg-white collapse fade" style="border-radius: 30px;" id="demo">

    <div class="row">
        <div class="col-3 text-center"><a href="/tasks"><small>طراحی</small></a></div>
        <div class="col-3 text-center"><small>پیگیری</small></div>
        <div class="col-3 text-center"><small>چاپ</small></div>
        <div class="col-3 text-center"><a href="/done"><small>پایان یافته</small></a></div>

        {{--<div class="col-12 my-4 position-relative">--}}

{{--<div class="bullett" style="left: 0px"></div>--}}
{{--<div class="bullett" style="left: 31%;"></div>--}}
{{--<div class="bullett" style="left: 61%;"></div>--}}
{{--<div class="bullett" style="right: 0;"></div>--}}

            {{--<input id="slider-range" type="range" min="1" max="4" value="3" class="position-absolute" data-rangeslider style="z-index: 100!important; left: 0" disabled="">--}}
        {{--</div>--}}


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
{{--</div>--}}


<div class="col-sm-12">
    <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white collapse profile" style="border-radius: 30px;">
        <div class="row ">
            <div class="col-lg-4 col-sm-6 row d-none d-xl-block">
                <div class="col-sm">
                   <center> <img style="object-fit: cover; height: 10rem; width: 10rem;" class="profile-user-img img-fluid img-circle" src="/storage/avatars/{{$user->avatar}}" alt="User profile picture">
                    </center></div>
                <div class="col-sm text-center h4 mt-2">{{$user->name}}
                    <hr>
                    {{$user->experience}}
                </div>

            </div>
            <div class="col-sm-6 col-lg-8 text-left ">
                تعداد تسکهای من: {{count($tasks)}}
            </div>
        </div>


    </div>
</div>









    <div class="col-sm-12">

    <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">
        <div class="row  animated fadeIn delay-1s">
<div class="text-right col">
    <a href="{{url('/')}}" class="btn btn-link"><i class="fa fa-home"></i></a>
    <a href=".profile" class="btn btn-link" data-toggle="collapse"><i class="fa fa-user"></i></a>
    @can('task-create')
        <a href="/tasks/create" class="btn btn-link" ><i class="fa fa-plus"></i></a>

    @endcan
</div>
        <div class="text-left mb-3 col">
            <a class="btn btn-link" data-toggle="collapse" href=".collapseTask"><i class="fa fa-arrows-alt"></i></a>

            @role('admin')
            <button data-toggle="collapse" data-target="#demo" class="btn btn-link"><i class="fa fa-filter"></i></button>

            <a href="/users" class="btn btn-link" ><i class="fa fa-users"></i></a>
        @endrole
        </div>
    </div>
        @if ($tasks->isEmpty())
            <div class="row"><div class="col-sm-6 m-auto m-5"><img class="img-fluid w-100" src="/img/dsp.png" alt=""></div></div>

        @else
            @if(isset($taskMeter) && $taskMeter->end == 0)
                <div class="alert alert-danger">{{$user->name}}، شما یک پروژه باز دارید. تا زمانی که پروژه متوقف نشده یک پروژه جدید باز نکنید. <a href="/tasks/{{$taskMeter->task_id}}" class="btn btn-link">مشاهده</a></div>
                @endif
<div class="row">
    <div class="col-md-9">
        <div class="card border-0 d-none d-lg-block animated fadeIn delay-1s" style="box-shadow: none">
            <div class="card-header" style="border-bottom: 0">
                <div class="row">
                    <div class="d-none d-lg-block col-lg-1 text-right">الویت</div>
                    <div class="d-none d-lg-block col-12 col-md-3 text-center text-md-right">عنوان</div>
                    <div class="d-none d-lg-block col-lg-2 text-center">نوع</div>
                    <div class="d-none d-lg-block col-lg-2 text-center">برند</div>
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
            if($task->rightNow > 0){
                            $timetogo = $task->rightNow . " روز";

            }elseif($task->rightNow == 0){
                            $timetogo = "امروز";

            }
            else{
                            $timetogo = "اتمام زمان";

            }

            @endphp
            @if($task->prog <= 20)
                @php
                    $progborder = "border-info bg-light";
                    $progbg = "bg-info";
                @endphp
            @elseif($task->prog > 20 && $task->prog <= 50)
                @php
                    $progborder = "border-success bg-light";
                    $progbg = "bg-success";
                @endphp
            @elseif($task->prog > 50 && $task->prog <= 80)
                @php
                    $progborder = "border-warning bg-light";
                    $progbg = "bg-warning";
                @endphp
            @elseif($task->prog > 80 && $task->prog <= 100)
                @php
                    $progborder = "border-danger bg-light";
                    $progbg = "bg-danger";
                @endphp
            @else
                @php
                    $progborder = "border-danger bg-dark";
                    $progbg = "bg-danger";
                @endphp
            @endif
            <div class="card card-border
                    animated fadeInDown

@if($task->prog > 100)
@endif
">
                <div class="
                @if($task->isDone == 0)
{{$progborder}}

@else
                        bg-success

@endif

card-header
card-border

" >
                    <div class="row">
                   <div class="col-md-9 row " data-toggle="collapse" href="#collapse{{$task->id}}">
                       <div class="d-none d-lg-block col-lg-1 text-right">{{$i++}}</div>

                       <div class="col-12 col-md-3 text-center text-md-right ">{{$task->title}}</div>
                       <div class="d-none d-lg-block col-lg-2 text-center">
                           @if($task->type && $task->type != "سایر")
                                {{$task->type}}
                               @else
                               -
                           @endif
                       </div>
                       <div class="d-none d-lg-block col-lg-2 text-center">
                       @if($task->type && $task->brand != "سایر")
                       {{$task->brand}}
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


                       {{--<div dir="ltr" class="d-none d-xl-block col-xl-1 text-center">--}}
                           {{--@if($task->dx || $task->dy || $task->dz)--}}
                               {{--{{$task->dx}}|{{$task->dy}}|{{$task->dz}}--}}
                           {{--@else--}}
                               {{-----}}
                       {{--@endif--}}
                       {{--</div>--}}
                       {{--<div class="d-none d-xl-block col-xl-1 text-center">--}}
                       {{--@if($task->type && $task->material != "سایر")--}}
                       {{--{{$task->material}}--}}
                           {{--@else--}}
                               {{-----}}
                       {{--@endif--}}
                   {{--</div>--}}
                       <div class="d-none d-lg-block col-lg-2 text-center"></div>
                   </div>
                    <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                        <div class="flex-grow-1"  data-toggle="collapse" href="#collapse{{$task->id}}"></div>
                        <div class="mx-1" title="مهلت" data-toggle="tooltip">{{$timetogo}}</div>
                        <div class="mx-1">
                               <i class="fa  animated
                        @if($task->rightNow < 0 )
                                       fa-hourglass-end infinite tada
@elseif($task->rightNow <= 3)
                                       fa-hourglass-half rubberBand

@else
                                       fa-hourglass-start rubberBand

@endif

" data-toggle="tooltip" title="{{$task->rightNow}}"></i>
                    </div>
                        <div class="mx-1">
                               <i class="fa fa-calendar" data-toggle="tooltip" title="{{$task->startDate}}"></i>
                                </div>
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
                        <div class="mx-1                     hvr-backward
">

                        <a href="/tasks/{{ $task->id }}"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو به {{ $task->title }}"></i></a>
                        </div>
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
                                             {{$timetogo}}
                                         </td>
                                     </tr>
                                     {{--<tr>--}}
                                         {{--<td><span class="badge badge-info">{{$task->jStart}}</span></td>--}}

                                         {{--<td><span class="badge badge-success">{{$task->jEnd}}</span>--}}
                                         {{--</td>--}}
                                     {{--</tr>--}}
                                     {{--<tr>--}}
                                         {{--<td>تاریخ اتمام کار</td>--}}

                                         {{--<td>--}}
                                             {{--{{$task->jEnd}}--}}
                                         {{--</td>--}}
                                     {{--</tr>--}}
                                     @if($task->reTask === 1)
                                         <tr>
                                             <td colspan="2">مشابه این کار قبلا انجام شده</td>


                                         </tr>
                                     @endif

                                     {{--<tr>--}}
                                         {{--<td></td>--}}
                                         {{--<td>{{$task->commentCount}}</td>--}}
                                     {{--</tr>--}}
                                     {{--<tr>--}}
                                         {{--<td>مشاهده</td>--}}
                                         {{--<td>{{$task->viewCount}}</td>--}}
                                     {{--</tr>--}}

                                 </table>


                                </div>
                            <div class="col-sm-12 col-md-12 col-xl-6">
                                    {{--<h1>--}}
                                        {{--{{ $task->title }}--}}

                                    {{--</h1>--}}
<div class="d-flex justify-content-between"><span class="badge badge-white">{{$task->jStart}}</span><span class="badge badge-white">{{$task->jEnd}}</span></div>
                                <div class="progress">

                                    <div data-toggle="tooltip" title="@if( $task->prog >100 )زمان مقرر این تسک پایان یافته است @elseزمان سپری شده {{$task->prog}}% @endif"  data-placement="top" class="progress-bar progress-bar-striped @if( $task->prog <= 100 ) progress-bar-animated @endif {{$progbg}}"  role="progressbar" style="width: {{ $task->prog }}%" aria-valuenow="{{ $task->prog }}" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                {{--<div class="btn-group">--}}
                                    {{--@if($task->type && $task->type != "سایر") <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="نوع کار"  data-placement="bottom">{{ $task->type }}</button> @endif--}}
                                    {{--@if($task->type && $task->brand != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="برند"  data-placement="bottom">{{ $task->brand }}</button> @endif--}}
                                    {{--@if($task->type && $task->forProduct != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="محصول"  data-placement="bottom">{{ $task->forProduct }}</button> @endif--}}
                                    {{--@if($task->type && $task->material != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="متریال"  data-placement="bottom">{{ $task->material }}</button> @endif--}}
                                    {{--<button class="btn btn-sm btn-link"   data-toggle="tooltip" title="نظر"  data-placement="bottom">{{ $task->commentCount }}</button>--}}
                                    {{--<button class="btn btn-sm btn-link"   data-toggle="tooltip" title="مشاهده"  data-placement="bottom">{{ $task->viewCount }}</button>--}}

                                    {{--@if($task->reTask === 1)--}}

                                        {{--<button class="btn btn-sm btn-link"  data-toggle="tooltip" title="Clone" data-placement="bottom">--}}
                                            {{--<i class="fa fa-clone"></i>--}}
                                        {{--</button>--}}
                                    {{--@endif--}}

                                {{--</div>--}}

                                <p class="text-justify pt-3">
                                    {{ $task->content }}

                                </p>


                            </div>
                            <div class="text-left col-12">
                                {{--<a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>--}}
                                <a href="/tasks/{{$task->id}}" class="btn btn-link"><i class="fa fa-3x fa-arrow-left"></i></a>
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
            {{--<script src="/admin-core/pdate/persian-date.min.js"></script>--}}
            {{--<script src="/admin-core/pdate/persian-datepicker.min.js"></script>--}}
            {{--<script>--}}

                {{--$(function() {--}}
                    {{--var now = new persianDate(1318781876406); // "۱۳۹۰-۰۷-۲۴ ۱۹:۴۷:۵۶ ب ظ"--}}



                    {{--// var day = new Date();--}}
                    {{--// var dayWrapper = new persianDate(day);--}}
                    {{--alert(now);--}}
                    {{--})--}}



            {{--</script>--}}
        @endsection

@extends('admincore.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <link rel="stylesheet" href="/admin-core/persiandatapicker/persianDatepicker-default.css"/>

    <style>
        #selectType{
            display: none;
        }
        #selectType2{
            display: block;
        }

    </style>
@endsection
@section('content')

    <div class="col-md-8 m-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif


        <div class="card uper">
            <div class="card-header">
                <div class="float-right">ویرایش {{ $task->id }}</div>
                <div class="float-left">
                    اجرایی
                    <label class="switch">
                        <input type="checkbox" onchange="formToggle()">
                        <span class="slider"></span>
                    </label>
                    طراحی
                    <span></span>
                </div>

            </div>

            <div class="card-body">

                <form method="post" action="{{ route('tasks.update', $task->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">

                        <div class="form-group col-sm-4 formChange">
                            <label for="">نوع</label>
                            <input type="text" class="form-control" name="isType" value="{{ $task->type }}">

                        </div>

                        <div class="form-group col-sm-2 formChange">
                            <label for="">برند</label>
                            <select name="brand" class="form-control select2">
                                <option selected="selected" value="{{ $task->brand }}">سایر</option>
                                @foreach($brands as $u)
                                    <option value="{{ $u->title }}">{{ $u->title }}</option>

                                @endforeach


                            </select>

                        </div>

                        <div class="form-group col-sm-3 formChange">
                            <label for="">برای</label>
                            <input type="text" class="form-control" name="forProduct" value="{{ $task->forProduct }}">

                        </div>

                        <div class="form-group col-sm-3 formChange">
                            <label for="">متریال</label>
                            <input type="text" name="material" class="form-control" value="{{ $task->material }}">


                        </div>



                        <div class="form-group col-sm-12 formChange" style="display: none">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" id="taskName" name="title" placeholder="عنوان کامل کار" value="{{$task->title}}"/>

                        </div>












                        @role('admin')
                        <div class="form-group col-sm-1">


                            <label for="title">الویت</label>
                            <select class="form-control" name="orderTask">
                                <option value="{{$task->orderTask}}">{{$task->orderTask}}</option>
                                @for($i = 10; $i >= 1; $i--)
                                    @if($i == $task->orderTask)
                                        @continue
                                    @endif
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>

                        </div>


                        <div class="form-group col-sm-1">


                            <label for="title">وزن (ارزش)</label>

                            <select class="form-control" name="weight">
                                <option value="{{$task->weight}}">{{$task->weight}}</option>

                                @for($i = 1; $i <= 10; $i++)
                                    @if($i == $task->weight)
                                        @continue
                                    @endif
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            {{--<input type="number" class="form-control" name="weight" placeholder="From 1 to 10"--}}
                            {{--min="1" max="10" value="10"/>--}}
                        </div>
                        @else
                            <input type="hidden" name="orderTask" value="{{$task->orderTask}}">
                            <input type="hidden" name="weight" value="{{$task->weight}}">
                            @endrole

                            <div class="form-group col-sm">
                                <label for="deadline">شروع</label>
                                <div class="input-group">
                                    <input readonly type="text" class="form-control pdp-data-jdate text-center" id="gStartDate" autocomplete="off"
                                           value="{{$jStart}}"/>
                                    <input type="text"  name="startTime" class="form-control text-center timepicker" value="{{date('H:i', strtotime($task->startDate))}}">

                                </div>
                                <input type="hidden" id="startDate" name="startDate"  value="{{date('d-m-Y', strtotime($task->startDate))}}"/>


                            </div>



                            <div class="form-group col-sm">
                                <label for="deadline">پایان</label>
                                <div class="input-group">
                                    <input readonly type="text" class="form-control pdp-data-jdate text-center" id="gEndDate" name="deadline1"
                                           autocomplete="off" required value="{{$jEnd}}"/>
                                    <input type="text"  name="endTime"  class="form-control timepicker2 text-center"  value="{{date('H:i', strtotime($task->deadline))}}">

                                </div>
                                <input type="hidden"  id="endDate" name="endDate" value="{{date('d-m-Y', strtotime($task->deadline))}}"/>
                                {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                                {{--<input type="date"  class="form-control" name="deadline"/>--}}
                            </div>
                    </div>

                    <div class="p-2 formChange text-left">
                        <label for="check">ثبت اندازه <input id="check" type="checkbox" class="" data-toggle="collapse" href="#xtra"></label>

                    </div>
                    <div id="xtra" class="collapse row fade ">



                        <div class="form-group col-sm-3">
                            <label for="">عرض کار</label>
                            <input type="number" class="form-control" name="dx" placeholder="عرض" value="{{$task->dx}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">طول کار</label>
                            <input type="number" class="form-control" name="dy" placeholder="طول" value="{{$task->dy}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">عمق کار</label>
                            <input type="number" class="form-control" name="dz" placeholder="عمق" value="{{$task->dz}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">واحد</label>
                            <select name="dDesc" class="form-control">
                                <option value="{{$task->dDesc}}">{{$task->dDesc}}</option>
                                <option value="cm">سانتیمتر | cm</option>
                                <option value="mm">میلیمتر | mm</option>
                                <option value="px">پیکسل | px</option>
                            </select>
                        </div>

                    </div>







                    <div class="form-group">
                        <label for="">توضیحات پروژه </label>

                        <textarea class="form-control" name="content"
                                  placeholder="توضیحات کاری که باید انجام شود">{{$task->content}}</textarea>

                    </div>

                    @role('admin')
                    <div class="form-group col-sm-12">
                        <label for="">تیم کاری</label>
                        <select name="users[]" class="form-control select2" multiple>
                            @foreach($users_old as $u)
                                <option value="{{ $u->id }}" selected>{{ $u->name }}</option>

                            @endforeach
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>

                            @endforeach


                        </select>

                    </div>


                        @endrole

                        <div class="row">



                            {{--<div class="form-group col-sm-6">--}}
                                {{--<span>پروژه تکراری</span>--}}

                                {{--<label class="switch">--}}
                                    {{--<input type="checkbox" name="reTask" @if($task->reTask == 1) checked @endif >--}}
                                    {{--<span class="slider"></span>--}}
                                {{--</label>--}}

                            {{--</div>--}}
                            {{--<div class="form-group col-sm-6">--}}
                                {{--<label for="pic" class="file-upload btn btn-info btn-block">تصویر شاخص پروژه--}}

                                    {{--<input type="file" name="pic" id="pic" aria-describedby="fileHelp">--}}

                                {{--</label>--}}
                            {{--</div>--}}
                        </div>

                    <input type="hidden" name="urlP" value="{{$urlP}}">
                        <button type="submit" class="btn btn-success btn-block btn-lg">ثبت ویرایش</button>

                </form>
            </div>
        </div>


    </div>


@endsection



@section('JS')
    <script src="/admin-core/persiandatapicker/persianDatepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>
        $(function () {
            let pd11 = new persianDate();

            $("#gStartDate").persianDatepicker({


                cellWidth: 30,
                cellHeight: 30,
                fontSize: 15,
                onSelect: function () {
                    var start = $("#gStartDate").attr("data-gdate");
                    $("#startDate").val(start);


                },
            });
            $("#gEndDate").persianDatepicker({
                startDate: pd11.now().toString("YYYY/MM/DD"),

                endDate: pd11.now().addYear(1).toString("YYYY/MM/DD"),
                cellWidth: 30,
                cellHeight: 30,
                fontSize: 15,
                onSelect: function () {


                    var end = $("#gEndDate").attr("data-gdate");
                    $("#endDate").val(end);
                },
            });


            // $(".pdp-data-jdate").persianDatepicker({
            //
            // onSelect: function () {
            // var start = $("#gStartDate").attr("data-gdate");
            // $("#startDate").val(start);
            // var end = $("#gEndDate").attr("data-gdate");
            // $("#endDate").val(end);
            // },
            //
            // });


        });
        // $(".custom-file-input").on("change", function() {
        // var fileName = $(this).val().split("\\").pop();
        // $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        // });

        function formToggle() {
            $(".formChange").toggle();
        }

        function selectToggle() {
            $(".selectType").toggle();
        }

        $(function(){
            var d = new Date(),
                h = d.getHours(),
                m = d.getMinutes();
            if(h < 10) h = '0' + h;
            if(m < 10) m = '0' + m;
            $('input[type="time"][value="now"]').each(function(){
                $(this).attr({'value': h + ':' + m});
            });
        });
        $(function () {
            let today = new Date().toISOString().substr(0, 10);
            $('#startDate').val(today);
        })
        $(function () {
            let today = new Date().toISOString().substr(0, 10);
            $('#endDate').val(today);
        })


        function clearContents(element) {
            element.value = '';
        }
        $('.timepicker').timepicker({
            timeFormat: 'H:mm',
            interval: 30,
            minTime: '8',
            maxTime: '7:00pm',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('.timepicker2').timepicker({
            timeFormat: 'H:mm',
            interval: 30,
            minTime: '8',
            maxTime: '7:00pm',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    </script>
@endsection

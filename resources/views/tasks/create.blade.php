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
                <div class="float-right">ثبت کار جدید</div>
                <div class="float-left">
طراحی
                    <label class="switch">
                        <input type="checkbox" onchange="formToggle()">
                        <span class="slider"></span>
                    </label>
                    اجرایی
                    <span></span>
                </div>

            </div>
            <div class="card-body">

                <form enctype="multipart/form-data" method="post" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-12 formChange" style="display: none">

                            <div class="alert alert-warning">شما در حال ساخت یک پروژه در واحد طراحی هستید.</div>

                        </div>
                        <div class="form-group col-sm-12 formChange">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" id="taskName" name="title" placeholder="عنوان کامل کار" value="ندارد"  onfocus="clearContents(this);"/>

                        </div>

                        <div class="form-group col-sm-4">
                            <label for="">نوع</label>
                            <div class="selectType">
                            <select name="isType" class="form-control select2 selectType" id="selectType2">

                            <option  value="سایر" selected>سایر</option>


                            @foreach($types as $type)
                            <option value="{{ $type->title }}">{{ $type->title }}</option>

                            @endforeach


                            </select>
                            </div>
                            <input  id="selectType" type="text" class="form-control selectType" name="isType" placeholder="نوع جدید را در وارد کنید">

                                <input type="checkbox" onchange="selectToggle()">نوع جدید

                        </div>

                        <div class="form-group col-sm-2">
                            <label for="">برند</label>
                            <select name="brand" class="form-control select2">
                                <option selected="selected" value="سایر">سایر</option>
                                @foreach($brands as $u)
                                    <option value="{{ $u->title }}">{{ $u->title }}</option>

                                @endforeach


                            </select>

                        </div>

                        <div class="form-group col-sm-3">
                            <label for="">برای</label>
                            {{--<select name="forProduct" class="form-control select2">--}}
                            {{--<option selected="selected" value="سایر">سایر</option>--}}

                            {{--@foreach($childCategories as $category)--}}
                            {{--<option value="{{ $category->title }}">{{ $category->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}
                            <input type="text" class="form-control" name="forProduct" value="سایر">

                        </div>

                        <div class="form-group col-sm-3">
                            <label for="">متریال</label>
                            <input type="text" name="material" class="form-control" value="سایر">
                            {{--<select name="material" class="form-control select2">--}}
                            {{--<option selected="selected" value="سایر">سایر</option>--}}
                            {{--@foreach($materials as $u)--}}
                            {{--<option value="{{ $u->title }}">{{ $u->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}

                        </div>















@role('admin')
                        <div class="form-group col-sm-2">


                            <label for="title">الویت</label>
<select class="form-control" name="orderTask">
    <option value="10">10</option>
    <option value="9">9</option>
    <option value="8">8</option>
    <option value="7">7</option>
    <option value="6">6</option>
    <option value="5">5</option>
    <option value="4">4</option>
    <option value="3">3</option>
    <option value="2">2</option>
    <option value="1">1</option>
</select>
                            {{--<input type="number" class="form-control" name="orderTask" placeholder="From 1 to 10"--}}
                                   {{--min="1" max="10" value="10"/>--}}
                        </div>
                        <div class="form-group col-sm-2">


                            <label for="title">وزن (ارزش)</label>

                            <select class="form-control" name="weight">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                                <option value="9">9</option>

                                <option value="10">10</option>
                            </select>
                            {{--<input type="number" class="form-control" name="weight" placeholder="From 1 to 10"--}}
                                   {{--min="1" max="10" value="10"/>--}}
                        </div>
                        @else
                            <input type="hidden" name="orderTask" value="10">
                            <input type="hidden" name="weight" value="1">
                            @endrole

                        <div class="form-group col-sm">
                            <label for="deadline">شروع</label>
                            <div class="input-group">
                                    <input readonly type="text" class="form-control pdp-data-jdate text-center" id="gStartDate" autocomplete="off" value="{{$jNow}}"/>
                                                          <input type="text"  name="startTime" class="form-control text-center timepicker">

                            </div>
                            <input type="hidden"  id="startDate" name="startDate" required/>
                            {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                            {{--<input type="date"  class="form-control" name="deadline"/>--}}
                        </div>
                        <div class="form-group col-sm">
                            <label for="deadline">پایان</label>
<div class="input-group">
                            <input readonly type="text" class="form-control pdp-data-jdate text-center" id="gEndDate" name="deadline1"
                                   autocomplete="off" required value="{{$jNow}}"/>
     <input type="text"  name="endTime"  class="form-control timepicker2 text-center">

                        </div>
                            <input type="hidden"  id="endDate" name="endDate"/>
                            {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                            {{--<input type="date"  class="form-control" name="deadline"/>--}}
                        </div>
                    </div>

                    <div class="p-2 formChange text-left">
                        <button data-toggle="collapse" href="#xtra" class="btn btn-sm btn-outline-dark" type="button">اندازه</button>
                        {{--<label for="check">ثبت اندازه <input id="check" type="checkbox" class="" data-toggle="collapse" href="#xtra"></label>--}}

                    {{--<a class="btn btn-info" data-toggle="collapse" href="#xtra">ثبت اندازه</a>--}}
                    </div>
                    <div id="xtra" class="collapse row fade ">


                        {{--<div class="form-group col-sm-6">--}}
                        {{--<label for="">برند</label>--}}
                        {{--<select name="brand" class="form-control select2">--}}
                        {{--<option selected="selected" value="سایر">سایر</option>--}}
                        {{--@foreach($brands as $u)--}}
                        {{--<option value="{{ $u->title }}">{{ $u->title }}</option>--}}

                        {{--@endforeach--}}


                        {{--</select>--}}

                        {{--</div>--}}

                        {{--<div class="form-group col-sm-6">--}}
                        {{--<label for="">متریال</label>--}}
                        {{--<input type="text" name="material" class="form-control">--}}
                        {{--<select name="material" class="form-control select2">--}}
                        {{--<option selected="selected" value="سایر">سایر</option>--}}
                        {{--@foreach($materials as $u)--}}
                        {{--<option value="{{ $u->title }}">{{ $u->title }}</option>--}}

                        {{--@endforeach--}}


                        {{--</select>--}}

                        {{--</div>--}}
                        <div class="form-group col-sm-3">
                            <label for="">عرض کار</label>
                            <input type="number" class="form-control" name="dx" placeholder="عرض">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">طول کار</label>
                            <input type="number" class="form-control" name="dy" placeholder="طول">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">عمق کار</label>
                            <input type="number" class="form-control" name="dz" placeholder="عمق">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">واحد</label>
                            <select name="dDesc" class="form-control">
                                <option>انتخاب واحد</option>
                                <option value="cm">سانتیمتر | cm</option>
                                <option value="mm">میلیمتر | mm</option>
                                <option value="px">پیکسل | px</option>
                            </select>
                            {{--<input type="text" class="form-control" name="dDesc" placeholder="توضیحات  - واحد">--}}
                        </div>
                        <div class="form-group col-sm-6">
                            {{--<label for="">نوع</label>--}}
                            {{--<select name="isType" class="form-control select2">--}}

                            {{--<option selected="selected" value="سایر">سایر</option>--}}
                            {{--@foreach($types as $type)--}}
                            {{--<option value="{{ $type->id }}">{{ $type->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}
                            {{--<input type="text" class="form-control" name="isType" value="سایر">--}}

                            {{--</div>--}}
                            {{--<div class="form-group col-sm-6">--}}
                            {{--<label for="">برای محصول</label>--}}
                            {{--<select name="forProduct" class="form-control select2">--}}
                            {{--<option selected="selected" value="سایر">سایر</option>--}}

                            {{--@foreach($childCategories as $category)--}}
                            {{--<option value="{{ $category->title }}">{{ $category->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}
                            {{--<input type="text" class="form-control" name="forProduct" value="سایر">--}}

                            {{--</div>--}}


                            {{--<div class="form-group col-sm-6">--}}
                            {{--<label for="" class="file-upload btn btn-info btn-block">تصویر شاخص پروژه--}}

                            {{--<input type="file" name="medias[]">--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-6">--}}
                            {{--<div class="custom-file">--}}
                            {{--<input type="file" class="custom-file-input" id="customFile" name="medias[]" multiple>--}}
                            {{--<label class="custom-file-label" for="customFile">Choose file</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}


                        </div>
                    </div>







                    <div class="form-group">
                        <label for="">توضیحات پروژه </label>

                        <textarea class="form-control" name="content"
                                  placeholder="توضیحات کاری که باید انجام شود"  onfocus="clearContents(this);">ندارد</textarea>

                    </div>
@role('admin')
                    <div class="form-group col-sm-12">
                        <label for="">تیم کاری</label>
                        <select name="users[]" class="form-control select2" multiple>

                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>

                            @endforeach


                        </select>

                    </div>
                    @else
                        <input type="hidden" value="{{Auth::user()->id}}" name="users[]">
                    @endrole

<div class="row">



                    <div class="form-group col-sm-6">
                        <span>پروژه تکراری</span>

                        <label class="switch">
                            <input type="checkbox" name="reTask" value="1">
                            <span class="slider"></span>
                        </label>

                    </div>
    <div class="form-group col-sm-6">






        <label for="pic" class="file-upload btn btn-info btn-block">تصویر شاخص پروژه

            <input type="file" name="pic" id="pic" aria-describedby="fileHelp">
            {{--<small id="fileHelp" class="form-text text-muted">تا 2 مگابایت</small>--}}

        </label>
    </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block btn-lg">بفرست به لیست الویت ها</button>
                    <button type="reset" class="btn btn-link">فرم تازه</button>

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
            defaultTime: '8',
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
            defaultTime: '19',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    </script>
@endsection

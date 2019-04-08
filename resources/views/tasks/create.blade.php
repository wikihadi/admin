@extends('admincore.app')

@section('css')
    <style>
    </style>
    @endsection
@section('content')

    <div class="col-md-8 m-auto">
        {{--<div class="alert alert-danger">بخشهایی از فرم متصل نیست:  . فایل</div>--}}
        <div class="card uper">
            <div class="card-header">
                ثبت کار جدید
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form  enctype="multipart/form-data" method="post" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="row">


                        <div class="form-group col-sm-10">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان کامل کار"/>

                        </div>
                        <div class="form-group col-sm-2">


                            <label for="title">الویت</label>

                            <input type="number" class="form-control" name="orderTask" placeholder="From 1 to 10" min="1" max="10" value="10"/>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="deadline">تاریخ شروع</label>

                            <input type="text" class="form-control pdp-data-jdate" id="gStartDate" autocomplete="off"/>
                            <input type="hidden" id="startDate" name="startDate"/>
                            {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                            {{--<input type="date"  class="form-control" name="deadline"/>--}}
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="deadline">تاریخ پایان</label>

                            <input type="text" class="form-control pdp-data-jdate" id="gEndDate" name="deadline1"
                                   autocomplete="off"/>
                            <input type="hidden" id="endDate" name="endDate"/>
                            {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                            {{--<input type="date"  class="form-control" name="deadline"/>--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">توضیحات پروژه </label>

                        <textarea class="form-control" name="content"
                                  placeholder="توضیحات کاری که باید انجام شود"></textarea>

                    </div>

                    <div class="form-group col-sm-12">
                        <label for="">تیم کاری</label>
                        <select name="users[]" class="form-control select2" multiple>

                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>

                            @endforeach


                        </select>

                    </div>

<div class="text-left p-2 border-bottom">
                                    <a class="text-success" data-toggle="collapse" href="#xtra">پیشرفته</a>
</div>
                            <div id="xtra" class="collapse row show fade">


                                    <div class="form-group col-sm-6">
                                        <label for="">برند</label>
                                        <select name="brand" class="form-control select2">
                                            <option selected="selected" value="سایر">سایر</option>
                                            @foreach($brands as $u)
                                                <option value="{{ $u->title }}">{{ $u->title }}</option>

                                            @endforeach


                                        </select>

                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="">متریال</label>
                                        <select name="material" class="form-control select2">
                                            <option selected="selected" value="سایر">سایر</option>
                                            @foreach($materials as $u)
                                                <option value="{{ $u->title }}">{{ $u->title }}</option>

                                            @endforeach


                                        </select>

                                    </div>
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
                                        <label for="">توضیحات قطع کار</label>
                                        <input type="text" class="form-control" name="dDesc" placeholder="واحد">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">نوع</label>
                                        <select name="isType" class="form-control select2">

                                            <option selected="selected" value="سایر">سایر</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->title }}</option>

                                            @endforeach


                                        </select>

                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">برای محصول</label>
                                        <select name="forProduct" class="form-control select2">
                                            <option selected="selected" value="سایر">سایر</option>

                                            @foreach($childCategories as $category)
                                                <option value="{{ $category->title }}">{{ $category->title }}</option>

                                            @endforeach


                                        </select>

                                    </div>


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
                                <div class="form-group col-sm-12">
                                    <span>پروژه تکراری</span>

                                    <label class="switch">
                                        <input type="checkbox" name="reTask" value="1">
                                        <span class="slider"></span>
                                    </label>



                                </div>

                            </div>
                    <button type="submit" class="btn btn-success btn-block btn-lg">بفرست به لیست الویت ها</button>
                </form>
            </div>
        </div>


    </div>


@endsection



@section('JS')
    <script>
    $(function() {
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
    startDate: pd11.now().addDay(0).toString("YYYY/MM/DD"),

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




    </script>
@endsection

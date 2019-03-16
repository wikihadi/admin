@extends('admincore.app')

@section('css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
    @endsection
@section('content')

    <div class="col-md-8 m-auto">
        <div class="alert alert-danger">بخشهایی از فرم متصل نیست:  . پروژه مجدد . فایل</div>
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
                        <div class="form-group col-sm-12">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان کامل کار"/>
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
                        <label for="">برند</label>
                        <select name="brands[]" class="form-control select2">
                            <option selected="selected" value="0">بدون برند</option>
                            @foreach($brands as $u)
                                <option value="{{ $u->id }}">{{ $u->title }}</option>

                            @endforeach


                        </select>

                    </div>
                    <div class="form-group">
                        <label for="">تیم کاری</label>
                        <select name="users[]" class="form-control select2" multiple>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>

                            @endforeach


                        </select>

                    </div>
                    <div class="form-group">
                        <label for="">متریال</label>
                        <select name="materials[]" class="form-control select2">
                            @foreach($materials as $u)
                                <option value="{{ $u->id }}">{{ $u->title }}</option>

                            @endforeach


                        </select>

                    </div>
                    <div class="form-group">
                        <label for="">قطع کار</label>
                        <select name="materials[]" class="form-control select2">
                            @foreach($materials as $u)
                                <option value="{{ $u->id }}">{{ $u->title }}</option>

                            @endforeach


                        </select>

                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">نوع</label>
                            <select name="categories[]" class="form-control select2">
                                <option value="0">بدون موضوع</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>

                                @endforeach


                            </select>

                        </div>
                        <div class="form-group col-6">
                            <label for="">برای محصول</label>
                            <select name="categories[]" class="form-control select2">
                                @foreach($childCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>

                                @endforeach


                            </select>

                        </div>
                        <div class="form-group col-6">
                            <span>آیا مشابه این کار قبلا انجام شده است؟</span>

                            <label class="switch">
                                <input type="checkbox" name="reTask" value="1">
                                <span class="slider"></span>
                            </label>



                        </div>

                        <div class="form-group col-6">
                        <label for="" class="file-upload btn btn-info btn-block">فایل ها

                        <input type="file" name="medias[]">
                            </label>
                        </div>
                        {{--<div class="form-group col-6">--}}
                            {{--<div class="custom-file">--}}
                                {{--<input type="file" class="custom-file-input" id="customFile" name="medias[]" multiple>--}}
                                {{--<label class="custom-file-label" for="customFile">Choose file</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="form-group">

                        <textarea class="form-control" name="content"
                                  placeholder="توضیحات کاری که باید انجام شود"></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary">بفرست به لیست</button>
                </form>
            </div>
        </div>


    </div>


@endsection



@section('JS')
    $(function() {
    let pd11 = new persianDate();

    $("#gStartDate").persianDatepicker({



    cellWidth: 50,
    cellHeight: 50,
    fontSize: 18,
    onSelect: function () {
    var start = $("#gStartDate").attr("data-gdate");
    $("#startDate").val(start);


    },
    });
    $("#gEndDate").persianDatepicker({
    startDate: pd11.now().addDay(0).toString("YYYY/MM/DD"),

    endDate: pd11.now().addYear(1).toString("YYYY/MM/DD"),
    cellWidth: 50,
    cellHeight: 50,
    fontSize: 18,
    onSelect: function () {


    var end = $("#gEndDate").attr("data-gdate");
    $("#endDate").val(end);
    },
    });



    $(".pdp-data-jdate").persianDatepicker({

    onSelect: function () {
    var start = $("#gStartDate").attr("data-gdate");
    $("#startDate").val(start);
    var end = $("#gEndDate").attr("data-gdate");
    $("#endDate").val(end);
    },

    });



    });
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
@endsection

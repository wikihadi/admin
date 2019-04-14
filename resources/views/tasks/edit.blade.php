{{--@extends('admincore.app')--}}

{{--@section('content')--}}
    {{--<style>--}}
        {{--.uper {--}}
            {{--margin-top: 40px;--}}
        {{--}--}}
    {{--</style>--}}
    {{--<main class="py-4">--}}

        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-md-8">--}}


                    {{--<div class="card uper">--}}
                        {{--<div class="card-header">--}}
                            {{--Edit Share--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--@if ($errors->any())--}}
                                {{--<div class="alert alert-danger">--}}
                                    {{--<ul>--}}
                                        {{--@foreach ($errors->all() as $error)--}}
                                            {{--<li>{{ $error }}</li>--}}
                                        {{--@endforeach--}}
                                    {{--</ul>--}}
                                {{--</div><br/>--}}
                            {{--@endif--}}
                            {{--<form method="post" action="{{ route('tasks.update', $task->id) }}">--}}
                                {{--@method('PATCH')--}}
                                {{--@csrf--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="text" class="form-control" name="title" value={{ $task->title }} />--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<textarea class="form-control" name="content">{{ $task->content }}</textarea>--}}
                                {{--</div>--}}

                                {{--<button type="submit" class="btn btn-primary">Update</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</main>--}}
{{--@endsection--}}
@extends('admincore.app')

@section('css')
    <link rel="stylesheet" href="/admin-core/persiandatapicker/persianDatepicker-default.css"/>
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

            <div class="alert alert-warning">
                نمایش تاریخ بصورت میلادی است. در حال تکمیل... با انتخاب تاریخ جدید مشکلی وجود ندارد
            </div>

        <div class="card uper">
            <div class="card-header">
                <div class="float-right">ویرایش {{ $task->id }}</div>
                <div class="float-left">
                    <label class="switch">
                        <input type="checkbox" onchange="formToggle()">
                        <span class="slider"></span>
                    </label>
                    <span></span>
                </div>

            </div>
            <div class="card-body">

                <form method="post" action="{{ route('tasks.update', $task->id) }}">
                @method('PATCH')
                @csrf
                    <div class="row">

                        <div class="form-group col-sm-12 formChange" style="/*display: none">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" id="taskName" name="title" placeholder="عنوان کامل کار" value="{{ $task->title   }}"/>

                        </div>
                        <div class="form-group col-sm-4 formChange">
                            <label for="">نوع</label>
                            {{--<select name="isType" class="form-control select2">--}}

                            {{--<option selected="selected" value="سایر">سایر</option>--}}
                            {{--@foreach($types as $type)--}}
                            {{--<option value="{{ $type->id }}">{{ $type->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}
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
                            <label for="">برای محصول</label>
                            {{--<select name="forProduct" class="form-control select2">--}}
                            {{--<option selected="selected" value="سایر">سایر</option>--}}

                            {{--@foreach($childCategories as $category)--}}
                            {{--<option value="{{ $category->title }}">{{ $category->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}
                            <input type="text" class="form-control" name="forProduct" value="{{ $task->forProduct }}">

                        </div>

                        <div class="form-group col-sm-3 formChange">
                            <label for="">متریال</label>
                            <input type="text" name="material" class="form-control" value="{{ $task->material }}">
                            {{--<select name="material" class="form-control select2">--}}
                            {{--<option selected="selected" value="سایر">سایر</option>--}}
                            {{--@foreach($materials as $u)--}}
                            {{--<option value="{{ $u->title }}">{{ $u->title }}</option>--}}

                            {{--@endforeach--}}


                            {{--</select>--}}

                        </div>
















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
                            {{--<input type="number" class="form-control" name="orderTask" placeholder="From 1 to 10"--}}
                            {{--min="1" max="10" value="10"/>--}}
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
                        <div class="form-group col-sm-5">
                            <label for="deadline">تاریخ شروع</label>

                            <input type="text" class="form-control pdp-data-jdate" id="gStartDate" autocomplete="off" value="{{$task->startDate}}" required/>
                            <input type="hidden" id="startDate" name="startDate"  value="{{$task->startDate}}"/>
                            {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                            {{--<input type="date"  class="form-control" name="deadline"/>--}}
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="deadline">تاریخ پایان</label>

                            <input type="text" class="form-control pdp-data-jdate" id="gEndDate" name="deadline1"
                                   autocomplete="off" value="{{$task->deadline}}" required/>
                            <input type="hidden" id="endDate" name="endDate" value="{{$task->deadline}}"/>
                            {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                            {{--<input type="date"  class="form-control" name="deadline"/>--}}
                        </div>
                    </div>

                    <div class="p-2 border-bottom formChange">
                        <a class="text-success btn btn-link" data-toggle="collapse" href="#xtra">ثبت اندازه</a>
                    </div>
                    <div id="xtra" class="collapse show row fade ">


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
                            <input type="number" class="form-control" name="dx" value="{{$task->dx}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">طول کار</label>
                            <input type="number" class="form-control" name="dy" value="{{$task->dy}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">عمق کار</label>
                            <input type="number" class="form-control" name="dz" value="{{$task->dz}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">واحد</label>

                            <select name="dDesc" class="form-control">
                                <option value="{{$task->dz}}">{{$task->dz}}</option>
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

                        <textarea class="form-control" name="content">{{$task->content}}</textarea>

                    </div>

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
                    <div class="form-group col-sm-12">
                        <span>پروژه تکراری</span>

                        <label class="switch">
                            <input type="checkbox" name="reTask" value="1">
                            <span class="slider"></span>
                        </label>


                    </div>

                    <button type="submit" class="btn btn-success btn-block btn-lg">بفرست به لیست الویت ها</button>
                </form>
            </div>
        </div>


    </div>


@endsection



@section('JS')
    <script src="/admin-core/persiandatapicker/persianDatepicker.min.js"></script>

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
                startDate: pd11.now().addDay(1).toString("YYYY/MM/DD"),

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


    </script>
@endsection

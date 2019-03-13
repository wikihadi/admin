@extends('admincore.app')

@section('content')

    <div class="col-md-8 m-auto">
        <div class="alert alert-danger">بخشهایی از فرم متصل نیست: تاریخ شروع و پایان . پروژه مجدد . فایل</div>
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
                <form method="post" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-6">
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
                        {{--<div class="form-group col-6">--}}
                        {{--<label for="">طراحی مجدد</label>--}}

                        {{--<input type="checkbox">--}}

                        {{--</div>--}}
                        {{--<div class="form-group col-6">--}}
                        {{--<label for="">فایل</label>--}}

                        {{--<input type="file" multiple>--}}

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
    $(".pdp-data-jdate").persianDatepicker({
    onSelect: function () {
    var start = $("#start-jdate").attr("data-gdate");
    $("#startDate").val(start);
    var end = $("#end-jdate").attr("data-gdate");
    $("#endDate").val(end);
    }
    });
@endsection

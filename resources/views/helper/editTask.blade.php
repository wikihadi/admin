<form enctype="multipart/form-data" method="post" action="{{ route('tasks.update', $task->id) }}">
    @method('PATCH')
    @csrf
    <div class="row">
        <div class="form-group col-sm-12 formChange" >
            <label for="title">عنوان</label>
            <input type="text" class="form-control" id="taskName" name="title" placeholder="عنوان کامل کار" value="{{$task->title}}"/>


        </div>
        <div class="form-group col-sm-2">
            <label for="">وضعیت</label>
            <select name="subject" class="form-control select2">
                <option value="{{$task->subject}}" selected>{{$task->subject}}</option>
                <option value="طراحی">طراحی</option>
                <option value="اجرایی">اجرایی</option>
                <option value="دیتا اینتری">دیتا اینتری</option>
                <option value="مذاکرات">مذاکرات</option>
                <option value="نظارتی">نظارتی</option>
                <option value="مشاور">مشاور</option>
                <option value="برنامه نویسی">برنامه نویسی</option>
                <option value="خدماتی">خدماتی</option>
                <option value="پیگیری">پیگیری</option>
            </select>
        </div>
        <div class="form-group col-sm-4 formChange">
            <label for="">نوع</label>
            <input type="text" class="form-control" name="isType" value="{{ $task->type }}">

        </div>
        <div class="form-group col-sm-2 formChange">
            <label for="">برای</label>
            <input type="text" class="form-control" name="forProduct" value="{{ $task->forProduct }}">

        </div>
        <div class="form-group col-sm-2 formChange">
            <label for="">برند</label>
            <select name="brand" class="form-control select2">
                <option selected="selected" value="{{ $task->brand }}">{{ $task->brand }}</option>
                @foreach($brands as $u)
                    <option value="{{ $u->title }}">{{ $u->title }}</option>

                @endforeach


            </select>

        </div>



        <div class="form-group col-sm-2 formChange">
            <label for="">متریال</label>
            <input type="text" name="material" class="form-control" value="{{ $task->material }}">


        </div>
















        @role('admin')
        {{--<div class="form-group col-sm-1">--}}


            {{--<label for="title">الویت</label>--}}
            {{--<select class="form-control" name="orderTask">--}}
                {{--<option value="{{$task->orderTask}}">{{$task->orderTask}}</option>--}}
                {{--@for($i = 10; $i >= 1; $i--)--}}
                    {{--@if($i == $task->orderTask)--}}
                        {{--@continue--}}
                    {{--@endif--}}
                    {{--<option value="{{$i}}">{{$i}}</option>--}}
                {{--@endfor--}}
            {{--</select>--}}

        {{--</div>--}}


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

    {{--@role('admin')--}}
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
    {{--@else--}}
        {{--<input type="hidden" name="isUser" value="1">--}}


        {{--@endrole--}}
        <div class="form-group">

            <label for="list1">در لیست من</label>
            <input id="list1" type="radio" name="pending" onclick="addTeam()" value="0" @if($task->pending == 0) checked @endif>
            {{--<label for="pending">در لیست انتظار خودم</label>--}}
            {{--<input id="pending" type="radio" name="pending" onclick="addTeam()" value="1" @if($task->pending == 1) checked @endif>--}}
            @role('admin|modir')
            <label for="pending2">کارهای آتی</label>
            <input id="pending2" type="radio" name="pending" onclick="clearTeam()" value="2" @if($task->pending == 2) checked @endif>
            @endrole


        </div>

        <div class="row">



            {{--<div class="form-group col-sm-6">--}}
            {{--<span>پروژه تکراری</span>--}}

            {{--<label class="switch">--}}
            {{--<input type="checkbox" name="reTask" @if($task->reTask == 1) checked @endif >--}}
            {{--<span class="slider"></span>--}}
            {{--</label>--}}

            {{--</div>--}}
            <div class="form-group col-sm-12">
                <div>
                <img src="/storage/uploads/{{$task->pic}}" style="width: 100px" data-toggle="modal" data-target="#img" style="cursor: zoom-in" id="img-input">
                <button onclick="$('form').append('<input type=hidden name=pic2 value=dsp.png>');$(this).parent().remove();" class="btn btn-link text-danger" type="button">X</button>

                <div class="modal" id="img" style="cursor: zoom-out">
                    <div class="text-center animated bounceIn" data-dismiss="modal">
                        <img src="/storage/uploads/{{$task->pic}}"  data-dismiss="modal">
                    </div>
                </div>

            <label for="pic" class="file-upload btn btn-light btn-block" id="labelPic">تصویر شاخص پروژه - برای عدم تغییر رها کنید

            <input type="file" name="pic" id="pic" aria-describedby="fileHelp">

            </label>
                </div>
            </div>
        </div>

        <input type="hidden" name="urlP" value="{{$urlP}}">
        <button type="submit" class="btn btn-success btn-block btn-lg">ثبت ویرایش</button>

</form>

<template>
    <div class="col-12 row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card bg-dark">
                <div class="card-header">
                    <span>پنل مدیریت</span>
                </div>
                <div class="card-body">

                    <div class="d-flex justify-content-end m-5">
                        <button type="button" class="btn btn-dark btn-circle btn-xl mx-2" @click="showTabShow(1)"><i class="fa fa-users"></i></button>
<!--                        <button type="button" class="btn btn-dark btn-circle btn-xl mx-2" @click="showTabShow(2)"><i class="fa fa-plus"></i></button>-->
                    </div>
                    <div class="collapse" :class="{show: showTab==1}">
                        <h4 class="no-background text-center mb-3"><span>تعیین الویت کاربران</span></h4>
                        <div class="d-flex justify-content-around mx-5">
                            <a :href="'/jobs/'+u.id" target="_blank" v-for="u in users">
                                <img :src="'/storage/avatars/'+u.avatar" style="width: 40px" alt="" class="img-circle hvr-pop" :title="u.name" data-toggle="tooltip">
                            </a>
                        </div>
                    </div>
                    <div class="collapse" :class="{show: showTab==2}">
                        <h4 class="no-background text-center mb-3"><span>کار جدید</span></h4>

                        <div class="">
                            <form enctype="multipart/form-data" method="post" action="tasks">
                                <input type="hidden" name="_token" :value="csrf">
<!--                                <input name="_method" type="hidden" value="PATCH">-->

                                <div class="row">
                                    <div class="form-group col-sm-12 formChange">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="عنوان کامل کار" value="ندارد" />

                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="subject">وضعیت</label>
                                        <select name="subject" id="subject" class="form-control select2">
                                            <option value="" selected>انتخاب موضوع</option>
                                            <option value="طراحی">طراحی</option>
                                            <option value="اجرایی">اجرایی</option>
                                            <option value="دیتا اینتری">دیتا اینتری</option>
                                            <option value="نظارتی">نظارتی</option>
                                            <option value="مشاور">مشاور</option>
                                            <option value="برنامه نویسی">برنامه نویسی</option>
                                            <option value="پیگیری">پیگیری</option>
                                            <option value="بازطراحی">بازطراحی</option>
                                            <option value="خرید">خرید</option>
                                            <option value="جلسه با">جلسه با</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="isType">نوع</label>
                                        <div class="selectType">
                                            <select name="isType" id="isType" class="form-control select2 selectType">

                                                <option id="type1"  value="سایر" selected>سایر</option>


<!--                                                @foreach($types as $type)-->
<!--                                                <option value="{{ $type->title }}">{{ $type->title }}</option>-->

<!--                                                @endforeach-->


                                            </select>
                                        </div>
                                        <input  type="text" class="form-control selectType" name="isType2" placeholder="نوع جدید را در وارد کنید" style="display: none;">

<!--                                        <input type="checkbox" onchange="selectToggle()">نوع جدید-->

                                    </div>



                                    <div class="form-group col-sm-2">
                                        <label for="forProduct">برای</label>

                                        <input type="text" class="form-control" name="forProduct" id="forProduct" value="سایر">

                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="brand">برند</label>
                                        <select name="brand" id="brand" class="form-control select2">
                                            <option selected="selected" value="سایر">سایر</option>
<!--                                            @foreach($brands as $u)-->
<!--                                            <option value="{{ $u->title }}">{{ $u->title }}</option>-->

<!--                                            @endforeach-->


                                        </select>

                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="material">متریال</label>
                                        <input type="text" name="material" id="material" class="form-control" value="سایر">

                                    </div>














<!--                                    @role('admin')-->

<!--                                    <div class="form-group col-sm-2">-->


<!--                                        <label for="title">وزن (ارزش)</label>-->

<!--                                        <select class="form-control" name="weight">-->
<!--                                            <option value="1">کم</option>-->
<!--                                            <option value="5">متوسط</option>-->
<!--                                            <option value="10">زیاد</option>-->
<!--                                        </select>-->

<!--                                    </div>-->
<!--                                    @else-->
<!--                                    <input type="hidden" name="orderTask" value="10">-->
<!--                                    <input type="hidden" name="weight" value="1">-->
<!--                                    @endrole-->

<!--                                    <div class="form-group col-sm">-->
<!--                                        <label for="deadline">شروع</label>-->
<!--                                        <div class="input-group">-->
<!--                                            <input readonly type="text" class="form-control pdp-data-jdate text-center" id="gStartDate" autocomplete="off" value="{{$jNow}}"/>-->
<!--                                            <input type="text"  name="startTime" class="form-control text-center timepicker">-->

<!--                                        </div>-->
<!--                                        <input type="hidden"  id="startDate" name="startDate" required/>-->

<!--                                    </div>-->
<!--                                    <div class="form-group col-sm">-->
<!--                                        <label for="deadline">پایان</label>-->
<!--                                        <div class="input-group">-->
<!--                                            <input readonly type="text" class="form-control pdp-data-jdate text-center" id="gEndDate" name="deadline1"-->
<!--                                                   autocomplete="off" required value="{{$jNow}}"/>-->
<!--                                            <input type="text"  name="endTime"  class="form-control timepicker2 text-center">-->

<!--                                        </div>-->
<!--                                        <input type="hidden"  id="endDate" name="endDate"/>-->

<!--                                    </div>-->
                                </div>

<!--                                <div class="p-2 formChange text-left">-->
<!--                                    <button data-toggle="collapse" href="#xtra" class="btn btn-sm btn-outline-dark" type="button">اندازه</button>-->

<!--                                </div>-->
<!--                                <div id="xtra" class="collapse row fade ">-->


<!--                                    <div class="form-group col-sm-3">-->
<!--                                        <label for="">عرض کار</label>-->
<!--                                        <input type="number" class="form-control" name="dx" placeholder="عرض">-->
<!--                                    </div>-->
<!--                                    <div class="form-group col-sm-3">-->
<!--                                        <label for="">طول کار</label>-->
<!--                                        <input type="number" class="form-control" name="dy" placeholder="طول">-->
<!--                                    </div>-->
<!--                                    <div class="form-group col-sm-3">-->
<!--                                        <label for="">عمق کار</label>-->
<!--                                        <input type="number" class="form-control" name="dz" placeholder="عمق">-->
<!--                                    </div>-->
<!--                                    <div class="form-group col-sm-3">-->
<!--                                        <label for="">واحد</label>-->
<!--                                        <select name="dDesc" class="form-control">-->
<!--                                            <option>انتخاب واحد</option>-->
<!--                                            <option value="cm">سانتیمتر | cm</option>-->
<!--                                            <option value="mm">میلیمتر | mm</option>-->
<!--                                            <option value="px">پیکسل | px</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                    <div class="form-group col-sm-6">-->

<!--                                    </div>-->
<!--                                </div>-->







<!--                                <div class="form-group">-->
<!--                                    <label for="">توضیحات پروژه </label>-->

<!--                                    <textarea class="form-control" name="content"-->
<!--                                              placeholder="توضیحات کاری که باید انجام شود"  onfocus="clearContents(this);">ندارد</textarea>-->

<!--                                </div>-->
<!--                                <div class="form-group col-sm-12" id="team">-->
<!--                                    <label for="">تیم کاری - مخصوص ادمین</label>-->
<!--                                    <select name="users[]" class="form-control select2" multiple>-->
<!--                                        <option id="meInUsers" value="{{$user->id}}" selected>{{$user->name}}</option>-->

<!--                                        @foreach($users as $u)-->
<!--                                        <option value="{{ $u->id }}">{{ $u->name }}</option>-->

<!--                                        @endforeach-->


<!--                                    </select>-->

<!--                                </div>-->



<!--                                <div class="form-group">-->

<!--                                    @role('modir')-->
<!--                                    <input type="hidden" name="pending" value="2">-->


<!--                                    @else-->
<!--                                    <label for="list1">@role('admin')در لیست @else در لیست خودم@endrole</label>-->
<!--                                    <input id="list1" type="radio" name="pending" value="0" checked onclick="addTeam()">-->
<!--                                    @role('admin')-->
<!--                                    <label for="pending2">کارهای آتی</label>-->
<!--                                    <input id="pending2" type="radio" name="pending" value="2" onclick="clearTeam()">-->
<!--                                    @endrole-->
<!--                                    @endrole-->


<!--                                </div>-->
<!--                                <div class="row">-->



<!--                                    <div class="form-group col-sm-6">-->
<!--                                        <span>پروژه تکراری</span>-->

<!--                                        <label class="switch">-->
<!--                                            <input type="checkbox" name="reTask" value="1">-->
<!--                                            <span class="slider"></span>-->
<!--                                        </label>-->

<!--                                    </div>-->
<!--                                    <div class="form-group col-sm-6">-->






<!--                                        <label for="pic" class="file-upload btn btn-info btn-block">تصویر شاخص پروژه-->

<!--                                            <input type="file" name="pic" id="pic" aria-describedby="fileHelp">-->

<!--                                        </label>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <button type="submit" class="btn btn-success btn-block btn-lg">بفرست به لیست الویت ها</button>
                                <button type="reset" class="btn btn-link">فرم تازه</button>
<!--                                <input type="hidden" name="urlP" value="{{$urlP}}">-->

                            </form>

                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminPanel",
        props:['users','user'],
        data(){
            return{
                showTab:0,
            }
        },
        mounted() {

        },
        methods:{
            showTabShow: function (i) {
                if (this.showTab==i){
                    this.showTab=0;
                }else{
                    this.showTab=i;
                }

            }

        },
    }
</script>

<style scoped>
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}

.no-background {
    position: relative;
    overflow: hidden;
}
.no-background span {
    display: inline-block;
    vertical-align: baseline;
    zoom: 1;
    *display: inline;
    *vertical-align: auto;
    position: relative;
    padding: 0 20px;
}
.no-background span:before,
.no-background span:after {
    content: "";
    display: block;
    width: 1000px;
    position: absolute;
    top: 0.73em;
    border-top: 1px solid red;
}
.no-background span:before {
    right: 100%;
}
.no-background span:after {
    left: 100%;
}
</style>

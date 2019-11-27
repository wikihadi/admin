<template>
    <div>

        <fin :user="this.user" v-if="role=='admin'" class="no-print"></fin>
        <fin :user="this.user" v-if="role=='taskMan'" class="no-print"></fin>
        <fin :user="this.user" v-if="role=='designer'" class="no-print"></fin>
        <div class="position-fixed fixed-bottom bg-warning d-flex justify-content-center no-print" v-if="show&&role=='admin'">
            <div><button class="btn btn-link text-light" @click="show=!show"><i class="fa fa-close"></i></button></div>
            <div class="p-5 col-xl-5">
                <transition name="fade">
                    <div>
                        <h3 v-if="role=='admin'">ویرایش هزینه</h3>
                        <h3 v-if="role=='finance'">پرداخت هزینه</h3>
                        <h3 v-if="role=='finMan'">تایید هزینه</h3>
                        <form  @submit.prevent="update">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="row">
                                <div class="col-md">
                            <div class="form-group">
                                <label for="fi">هزینه</label>
                                <p v-if="role!='admin'">{{addComma(price)}}</p>
                                <input type="number" class="form-control" id="fi" v-model="price" name="price" aria-describedby="fiHelp" placeholder="مثال: 10000 ریال" autocomplete="off" required v-if="role=='admin'">
                                <small id="fiHelp" class="form-text text-muted" v-if="role=='admin'">هزینه را به ریال وارد نمایید</small>
                            </div>                                    </div>

                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="fi">تاریخ پرداخت</label>
                                        <div class="bg-light text-dark">
                                            <date-picker type="date" v-model="date" format="YYYY-MM-DD" display-format="dddd jDD jMMMM jYYYY"></date-picker>

                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="brand">برای برند</label>
                                    <p v-if="role!='admin'">{{branded}}</p>
                                    <select class="form-control" id="brand" v-model="brand" name="brand" @change="hideBranded=true" v-if="role=='admin'">
                                        <option v-for="(brand,index) in brands" :value="brand.id">{{brand.title}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md" >
                                    <label for="brand">موضوع</label>
                                    <p  v-if="role!='admin'">{{subject}}</p>
                                    <input type="text" class="form-control" id="subject" v-model="subject" name="subject" required  v-if="role=='admin'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="brand">مربوط به بخش</label>
                                    <select class="form-control" id="section" v-model="section" name="section" disabled>
                                        <optgroup label="_________ جاری">

                                            <option value="1">تامین ملزومات مثل منگنه و...</option>
                                            <option value="1">مربوط به سفارشاتی که از بیرون از شرکت دریافت شده</option>
                                        </optgroup>
                                        <optgroup label="_________ حسابداری">

                                            <option value="2">برس ونوس</option>
                                            <option value="2">آدامس الدر</option>
                                            <option value="2">آبنیات و قرص روکش خوشبو کننده دهان الدر</option>
                                            <option value="2">تولیدی پوشاک پایا</option>
                                            <option value="2">تولیدی قطره چکان</option>
                                            <option value="2">تولیدی خلال چوبی</option>
                                            <option value="2">تولیدی اسپری اویور</option>
                                            <option value="2">تولیدی مفید دارو</option>
                                            <option value="2">تولیدی خلیلی</option>
                                        </optgroup>
                                        <optgroup label="_________ تولیدی صنعتی">
                                            <option value="3">مرتبط به مایا</option>
                                            <option value="3">گوش پاک کن و خلال با نخ لیو</option>
                                            <option value="3">پوشاک مایا</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md">
                                    <!--<div class="form-group">-->
                                        <!--<label for="image">ثبت تصویر</label>-->
                                        <!--<input type="file" name="image" id="image" class="form-control" v-on:change="onImageChange">-->
                                        <!--<small>با فرمت JPG و حجم زیر 2 مگابایت</small>-->
                                    <!--</div>-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content">توضیحات پرداخت</label>
                                <p v-if="role!='admin'">{{content}}</p>
                                <textarea class="form-control" id="content" rows="3" v-model="content" name="content" required  v-if="role=='admin'"></textarea>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label for="content">وضعیت پرداخت</label>-->
<!--                                <p v-if="role!='admin'">{{content}}</p>-->
<!--                                <textarea class="form-control" id="content" rows="3" v-model="content" name="content" required  v-if="role=='admin'"></textarea>-->
<!--                            </div>-->
                            <div  v-if="role!='admin'">
                            <div class="form-group">
                                <label for="acc_content">توضیحات تایید</label>
                                <textarea class="form-control bg-dark" id="acc_content" rows="3" v-model="acc_content" name="content"></textarea>
                            </div>
                            <div class="form-group" v-if="state==0">
                                <label for="acc">تایید</label>
                                <input type="checkbox" name="acc" id="acc" v-model="acc">
                                <small id="accHelp" class="form-text text-muted" v-if="acc">این هزینه مورد تایید من است</small>

                            </div>
                                <button type="submit" class="btn btn-dark" v-if="role=='finMan'">تایید هزینه</button>
                                <button type="submit" class="btn btn-dark" v-if="role=='finance'">پرداخت هزینه</button>

                            </div>
                            <button type="submit" class="btn btn-dark" v-if="role=='admin'">ویرایش هزینه</button>
                            <button type="button" class="btn btn-outline-danger pull-left" @click.prevent="deleteThis" v-if="role=='admin'"><i class="fa fa-trash"></i> حذف این هزینه</button>

                        </form>
                    </div>
                </transition>
            </div>
        </div>
    <div class="row bg-dark">
<!--<div class="d-flex justify-content-between col-12 no-print px-3 pt-3">-->
    <!--<div>-->

<!--</div>-->
    <!--<div>-->
        <!--<div class="input-group input-group-sm">-->
            <!--<input type="text" class="form-control" placeholder="شماره سند" v-model="finCode">-->
            <!--<div class="input-group-append">-->
                <!--<a :href="'/tools/fin/print/'+finCode" class="btn btn-outline-secondary" role="button" target="_blank"><i class="fa fa-print"></i></a>-->
            <!--</div>-->
        <!--</div>-->

        <!--&lt;!&ndash;<h4 class="text-muted">{{addComma(loop.sum)}}</h4>&ndash;&gt;-->

    <!--</div>-->
<!--</div>-->

<div class="d-flex justify-content-between col-12 no-print px-3 my-3">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">جستجو بر اساس</span>
            </div>
            <!--<input type="text" class="form-control" placeholder="شماره سند" v-model="finCode" disabled>-->
            <select name="" class="form-control" v-model="finStatus" >
                <option value="all">همه وضعیتها</option>
                <option value="0">جدید</option>
                <option value="10">درانتظار بررسی حسابدار</option>
                <option value="20">درانتظار بررسی تولید و صنعتی</option>
                <option value="100">در انتظار تایید مالی</option>
                <option value="101">در انتظار پرداخت جاری</option>
                <option value="11">در انتظار پرداخت حسابداری</option>
                <option value="21">در انتظار پرداخت تولیدی صنعتی</option>
                <option value="102">پرداخت شده</option>
                <option value="200">آرشیو</option>
            </select>
            <select name="" class="form-control" v-model="finSection">
                <option :value="null">همه واحدهای مالی</option>
                <option value="1">واحد مالی جاری</option>
                <option value="2">واحد مالی حسابداری</option>
                <option value="3">واحد مالی تولیدی صنعتی</option>
            </select>
            <select name="" class="form-control" v-model="finUser" v-if="role!='designer'">
                <option :value="null">همه اشخاص</option>
                <option :value="u.id" v-for="u in users">{{u.name}}</option>
            </select>
            <select name="" class="form-control" v-model="finBrands">
                <option :value="null">همه برندها</option>
                <option :value="b.id" v-for="b in brands">{{b.title}}</option>
            </select>
            <!--<input type="text" class="form-control" placeholder="موضوع یا توضیحات" disabled>-->
            <div class="input-group-append">

                <button class="btn btn-outline-secondary" type="button"  @click="changeFinStatus"><i class="fa fa-search"></i></button>
            </div>
        </div>


</div>
<div class="d-flex justify-content-between no-print col-12  mb-3">
    <div class="input-group input-group-sm col-lg-2 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">نمایش
                            <span v-if="title!='همه'">فقط</span>
                <span>{{title}}</span>


            </span>

        </div>
            <input type="number" class="form-control" v-model="end" :max="loop.all.length" min="0">

        <div class="input-group-append">

            <span class="input-group-text" id="">
                <!--<i class="fa fa-minus pointer mx-3" @click="end=end-10" v-if="end>10"></i>-->
                <!--<i class="fa fa-plus pointer mx-3" @click="end=end+10" v-if="end<loop.all.length"></i>-->
                            <span> تا از  </span>
                            <span>{{loop.all.length}}</span>

            </span>
        </div>
    </div>
    <div class="input-group input-group-sm col-lg-2 mb-3">
        <input type="text" class="form-control" placeholder="شماره سند" v-model="finCode">
        <div class="input-group-append">
            <a :href="'/tools/fin/print/'+finCode" class="btn btn-outline-secondary" role="button" target="_blank"><i class="fa fa-print"></i></a>
        </div>
    </div>

    </div>

<div class="d-flex justify-content-between col-12 no-print">
<div></div>
        <div>
            <div class="bg-dark text-left">
                <small :class="{'badge badge-light':title!='همه','text-light':title=='همه'}" class="hvr-pop">همه</small>

                <small :class="{'badge badge-light':title!='جدید','text-light':title=='جدید'}" class="hvr-pop" v-if="role=='admin'">جدید</small>
                <small :class="{'badge badge-light':title!='جدید','text-light':title=='جدید'}" class="hvr-pop" v-if="role=='designer'">جدید</small>
                <small :class="{'badge badge-info':title!='در انتظار تایید مدیر مالی','text-info':title=='در انتظار تایید مدیر مالی'}"
                        v-if="role!='finance'">در انتظار تایید مدیر مالی</small>
                <small :class="{'badge badge-warning':title!='در انتظار پرداخت','text-warning':title=='در انتظار پرداخت'}"
                      >در انتظار پرداخت</small>
                <small :class="{'badge badge-success':title!='پرداخت شده','text-success':title=='پرداخت شده'}"
                       >در انتظار تایید پرداخت - پرداخت شده</small>
                <small :class="{'badge badge-dark':title!='آرشیو شده','text-light':title=='آرشیو شده'}"
                       v-if="role!='finance'">آرشیو شده</small>
                <!--<small @click.prevent="fetch('all'),end=20,title='همه'" :class="{'pointer badge badge-light':title!='همه','text-light':title=='همه'}" class="hvr-pop">همه</small>-->

                <!--<small @click.prevent="fetch('0'),end=20,title='جدید'" :class="{'pointer badge badge-light':title!='جدید','text-light':title=='جدید'}" class="hvr-pop" v-if="role=='admin'">جدید</small>-->
                <!--<small @click.prevent="fetch('0'),end=20,title='جدید'" :class="{'pointer badge badge-light':title!='جدید','text-light':title=='جدید'}" class="hvr-pop" v-if="role=='designer'">جدید</small>-->
                <!--<small :class="{'pointer badge badge-info':title!='در انتظار تایید مدیر مالی','text-info':title=='در انتظار تایید مدیر مالی'}"-->
                        <!--@click.prevent="fetch('100'),end=20,title='در انتظار تایید مدیر مالی'" v-if="role!='finance'">در انتظار تایید مدیر مالی</small>-->
                <!--<small :class="{'pointer badge badge-warning':title!='در انتظار پرداخت','text-warning':title=='در انتظار پرداخت'}"-->
                       <!--@click.prevent="fetch('101'),end=20,title='در انتظار پرداخت'">در انتظار پرداخت</small>-->
                <!--<small :class="{'pointer badge badge-success':title!='پرداخت شده','text-success':title=='پرداخت شده'}"-->
                       <!--@click.prevent="fetch('102'),end=20,title='پرداخت شده'"-->
                       <!---->
                <!--&gt;در انتظار تایید پرداخت - پرداخت شده</small>-->
                <!--<small :class="{'pointer badge badge-dark':title!='آرشیو شده','text-light':title=='آرشیو شده'}"-->
                       <!--@click.prevent="fetch('200'),end=20,title='آرشیو شده'" v-if="role!='finance'">آرشیو شده</small>-->
            <!--<span @click.prevent="end=5" class="pointer badge badge-secondary">5</span>-->
            <!--<span @click.prevent="end=10" class="pointer badge badge-secondary">10</span>-->
            <!--<span @click.prevent="end=20" class="pointer badge badge-secondary">20</span>-->
            <!--<span @click.prevent="end=50" class="pointer badge badge-secondary">50</span>-->
            <!--<span @click.prevent="end=100" class="pointer badge badge-secondary">100</span>-->
            <!--<span @click.prevent="end='1000'" class="pointer badge badge-secondary">1000</span>-->
                <span class="badge badge-secondary px-3">{{addComma(loop.sum)}} ریال</span>

            </div>
        </div>
    </div>


<div class="col-12">
    <transition name="fade">
    <div class="alert alert-success" v-if="showAlert">وضعیت این هزینه تغییر کرد</div>
    </transition>
            <table class="table table-striped table-dark">

                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">کد</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">توسط</th>
                    <th scope="col">مبلغ ریال</th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">برند</th>
                    <th scope="col">موضوع</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">تصویر</th>
<!--                    <th scope="col">وضعیت</th>-->
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody v-if="loop.all.length>0">
                <tr v-for="(item,index) in loop.all.slice(0,end)"
                    :class="{'bg-info':item.state==100,
                    'bg-warning':item.state==101,
                    'bg-success':item.state==102}"
                    :id="'f' + item.id"
                    :ref="'f' + index"
                >

                    <td scope="row">{{index+1}}</td>

                    <td>{{item.id}}</td>
                    <td>
                        <span class="badge badge-light" v-if="item.state==100">در انتظار تایید مالی</span>
                        <span class="badge badge-light" v-if="item.state==101">در انتظار پرداخت</span>
                        <span class="badge badge-light" v-if="item.state==102">پرداخت شده</span>
                        <span class="badge badge-light" v-if="item.state==200">آرشیو</span>
                        <span class="badge badge-light" v-if="item.state==20 || item.state==10">در انتظار بررسی حسابداری</span>
                        <span class="badge badge-light" v-if="item.state==21 || item.state==11">در صف پرداخت</span>
                        <span class="badge badge-light" v-if="item.state==0">هنوز ارسال نشده</span>
                        <span class="badge badge-info" v-if="item.section==1">جاری</span>
                        <span class="badge badge-info" v-if="item.section==2">حسابداری</span>
                        <span class="badge badge-info" v-if="item.section==3">تولیدی صنعتی</span>

                    </td>
                    <td>{{item.user.name}}</td>
                    <td>{{addComma(item.price)}}</td>
                    <td>{{item.jd}}</td>
                    <td>{{item.brand.title}}</td>
                    <td>{{item.subject}}</td>
                    <td>{{item.content}}</td>
                    <td>
                        <a :href="'/storage/uploads/fin/'+item.image" target="_blank" v-if="item.image!=null">
                            <img :src="'/storage/uploads/fin/'+item.image" alt="" style="width: 30px">
                        </a>
                    </td>
<!--                    <td>{{item.state}}</td>-->
                    <td class="no-print" :title="item.state">
                        <!--<a role="button" class="btn btn-link text-white" :href="'/tools/fin/print/'+item.id" target="_blank"><i class="fa fa-print"></i></a>-->
                        <!--<button class="btn btn-link text-white" @click="hideRow(index)"><i class="fa fa-eye-slash"></i></button>-->
                        <div class="btn-group" role="group">

                        <button class="btn btn-outline-primary btn-sm" @click.prevent="edit(item.id,item.price,item.brand.title,item.brand.id,item.subject,item.content,item.acc_content,item.state,item.date,item.section)" v-if="role=='admin' && item.state<102 && item.state!=0"><i class="fa fa-check" v-if="role!='admin'"></i><i class="fa fa-edit" v-if="role=='admin'"></i></button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="edit(item.id,item.price,item.brand.title,item.brand.id,item.subject,item.content,item.acc_content,item.state,item.date,item.section)" v-if="item.state==0"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="check(item.id,item.section,item.state)" v-if="roleOn=='roleA'&&item.state==0">
                            <i class="fa fa-arrow-left"></i> تایید تسلیم سند به حسابداری</button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="check(item.id,item.section,item.state)" v-if="roleOn=='roleA'&&item.state==102 || roleOn=='roleA'&&item.state==110 || roleOn=='roleA'&&item.state==120">
                            <i class="fa fa-archive"></i> تایید پرداخت و آرشیو</button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="check(item.id,item.section,item.state)" v-if="roleOn=='roleA'&&item.state==10 || roleOn=='roleA'&&item.state==20">
                            <i class="fa fa-check"></i> تایید دریافت سند نزد حسابداری</button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="check(item.id,item.section,item.state)" v-if="roleOn=='roleA'&&item.state==11 || roleOn=='roleA'&&item.state==21">
                            <i class="fa fa-check"></i><i class="fa fa-check"></i> تایید پرداخت سند از حسابداری</button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="check(item.id,item.section,item.state)" v-if="roleOn=='roleC'&&item.state==100"><i class="fa fa-check"></i> تایید سند برای پرداخت</button>
                        <button class="btn btn-outline-primary btn-sm" @click.prevent="check(item.id,item.section,item.state)" v-if="roleOn=='roleA'&&item.state==101"><i class="fa fa-check"></i> تایید بعنوان پرداخت شده</button>
                        </div>
                        <!--<small class="badge badge-dark">{{item.state}}</small>-->
                        <!--v-if="role=='admin' && item.state<100 || role=='admin' && item.state==102 || role=='finMan' && item.state==100 || role=='finance' && item.state==101"-->
                    </td>
                </tr>
                </tbody>
            </table>
    <div class="alert alert-secondary"  v-if="loop.all.length==0">

        <i class="fa fa-refresh fa-spin" v-if="!loaded"></i>
        هیچ موردی
        <span v-if="title!='همه'">در {{title}} </span>
        یافت نشد</div>

</div>
        </div>
    </div>
</template>

<script>
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';


    export default {
        components: {
            datePicker: VuePersianDatetimePicker
        },
        name: "FinList",
        props:['user','role','users'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                loop:[],
                brands:[],
                loading:true,
                show:false,
                hideBranded:false,
                date: '',
                price:'',
                content:'',
                acc:'',
                acc_content:'',
                brand:'',
                id:'',
                branded:'',
                selectedItem:'',
                subject:'',
                state:'',
                done:false,
                showAlert:false,
                end:50,
                brandId:'',
                title:'همه',
                loaded:true,
                finCode:null,
                finStatus:'all',
                finSection:null,
                section:null,
                finUser:null,
                finBrands:null,
                roleOn:'',

            }
        },
        mounted: function() {
            let url2 = '/api/allBrands';
            axios.get(url2).then(response => this.brands = response.data);
            this.fetch('all');
            if (this.role=='admin'||this.role=='taskMan'||this.role=='designer') {
                this.roleOn='roleA'
            }else if(this.role=='khanghah'){
                this.roleOn='roleB'
            }else if(this.role=='finMan'){
                this.roleOn=='roleC'
            }else if(this.role=='finance'){
                this.roleOn=='roleD'
            }
        },
        methods:{
            changeFinSection: function(x){

            },
            changeFinStatus: function(){
                this.fetch(this.finStatus);
                this.end=20;
                if(this.finStatus==0){
                    this.title='جدید';
                }else if(this.finStatus==100){
                    this.title='در انتظار تایید مدیر مالی';
                }else if(this.finStatus==101){
                    this.title='در انتظار پرداخت';
                }else if(this.finStatus==102){
                    this.title='پرداخت شده';
                }else if(this.finStatus==200){
                    this.title='آرشیو';
                }else {
                    this.title='همه';
                }
            },
            hideRow(index){
                $(this.$refs['f' + index]).hide();
            },
            edit: function(id,price,brand,brandId,subject,content,acc_content,state,date,section){
                this.id=id;
                this.price=price;
                this.branded=brand;
                this.brand=brandId;
                this.selectedItem=brandId;
                this.subject=subject;
                this.content=content;
                this.acc_content=acc_content;
                this.state=state;
                this.date=date;
                this.section=section;
                //
                // if (state==1){
                //     this.acc=true;
                // }
                this.show=true;
            },
            update: function(){
                let url = '/api/updateFin?' +
                    'role=' + this.role +
                    '&acc_content=' + this.acc_content +
                    '&acc=' + this.acc +
                    '&update=' + this.id +
                    '&user=' + this.user +
                    '&content=' + this.content +
                    '&price=' + this.price +
                    '&date=' + this.date +
                    '&brand=' + this.brand +
                    '&section=' + this.section +
                    '&subject=' + this.subject;
                axios.get(url).then(
                    this.added()
                );
            },
            check: function(id,sec){
                let url = '/api/checkFin?role=' + this.roleOn + '&id=' + id + '&user=' + this.user + '&section=' + sec;
                axios.get(url).then(

                    this.change(id)
                );
            },
            deleteThis: function(){
                let x1 = confirm('آیا از حذف این مورد اطمینان دارید؟');
                if(x1){
                    let url = '/api/delFin?id=' + this.id + '&user=' + this.user;
                    axios.get(url).then(
                    this.added()
                    );
                }

            },
            added: function(){

                this.show=false;

                this.done = true;
                this.price = '';
                this.content = '';
                this.brand = '';
                this.acc='';
                this.acc_content='';
                // this.fetch();
            },
            showAlertFunc: function(){
                this.showAlert=false;
            },
            change: function(id){
                this.showAlert=true;
                this.fetch('all');
                setTimeout(this.showAlertFunc, 2000);
            },
            fetch: function(code,section){
                let url1 = '/api/allFin?role=' + this.role + '&code=' + this.finStatus + '&user=' + this.user + '&finSection=' + this.finSection + '&finUser=' + this.finUser + '&finBrands=' + this.finBrands;
                axios.get(url1).then(response => this.loop = response.data);
                this.loaded=false;
                code=null;
                section=null;
                // this.end=this.loop.all.length;
                setTimeout(this.loading,2000);
            },
            loading: function(){
                this.loaded=true;

            },
            brands: function(){
                let url = '/api/allBrands';
                axios.get(url).then(response => this.brands = response.data);
            },
            addComma: function (x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            }
        }
    }
</script>

<style>
    .pointer{
        cursor:pointer
    }
    .fade-enter-active , .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

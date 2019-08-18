<template>
    <div>

        <fin :user="this.user" v-if="role=='admin'"></fin>
        <div class="position-fixed fixed-bottom bg-warning d-flex justify-content-center" v-if="show&&role=='admin'">
            <div><button class="btn btn-link text-light" @click="show=!show"><i class="fa fa-close"></i></button></div>
            <div class="p-5 col-xl-5">
                <transition name="fade">
                    <div>
                        <h3 v-if="role=='admin'">ویرایش هزینه</h3>
                        <h3 v-if="role=='finance'">پرداخت هزینه</h3>
                        <h3 v-if="role=='finMan'">تایید هزینه</h3>
                        <form  @submit.prevent="update">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label for="fi">هزینه</label>
                                <p v-if="role!='admin'">{{addComma(price)}}</p>
                                <input type="number" class="form-control" id="fi" v-model="price" name="price" aria-describedby="fiHelp" placeholder="مثال: 10000 ریال" autocomplete="off" required v-if="role=='admin'">
                                <small id="fiHelp" class="form-text text-muted" v-if="role=='admin'">هزینه را به ریال وارد نمایید</small>
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
<div class="d-flex justify-content-between col-12">
        <div>
            <small>نمایش</small>
            <small v-if="title!='همه'">فقط</small>
            <small>{{title}}</small>
            <small class="badge badge-light" v-if="end<=loop.all.length">{{end}}</small>
            <small v-if="end<=loop.all.length">از</small>
            <small class="badge badge-light">{{loop.all.length}}</small>
        </div>
        <div>
            <div class="bg-dark text-left">
                <small @click.prevent="fetch('all'),end=20,title='همه'" :class="{'pointer badge badge-light':title!='همه','text-light':title=='همه'}" class="hvr-pop">همه</small>

                <small @click.prevent="fetch('0'),end=20,title='جدید'" :class="{'pointer badge badge-light':title!='جدید','text-light':title=='جدید'}" class="hvr-pop" v-if="role=='admin'">جدید</small>
                <small :class="{'pointer badge badge-info':title!='در انتظار تایید مدیر مالی','text-info':title=='در انتظار تایید مدیر مالی'}"
                        @click.prevent="fetch('100'),end=20,title='در انتظار تایید مدیر مالی'" v-if="role!='finance'">در انتظار تایید مدیر مالی</small>
                <small :class="{'pointer badge badge-warning':title!='در انتظار پرداخت','text-warning':title=='در انتظار پرداخت'}"
                       @click.prevent="fetch('101'),end=20,title='در انتظار پرداخت'">در انتظار پرداخت</small>
                <small :class="{'pointer badge badge-success':title!='پرداخت شده','text-success':title=='پرداخت شده'}"
                       @click.prevent="fetch('102'),end=20,title='پرداخت شده'">در انتظار تایید پرداخت - پرداخت شده</small>
                <small :class="{'pointer badge badge-dark':title!='آرشیو شده','text-light':title=='آرشیو شده'}"
                       @click.prevent="fetch('200'),end=20,title='آرشیو شده'" v-if="role!='finance'">آرشیو شده</small>
            <span @click.prevent="end=5" class="pointer badge badge-secondary">5</span>
            <span @click.prevent="end=10" class="pointer badge badge-secondary">10</span>
            <span @click.prevent="end=20" class="pointer badge badge-secondary">20</span>
            <span @click.prevent="end=50" class="pointer badge badge-secondary">50</span>
            <span @click.prevent="end=100" class="pointer badge badge-secondary">100</span>
            <span @click.prevent="end='1000'" class="pointer badge badge-secondary">1000</span>
                <span class="badge badge-info px-3">{{addComma(loop.sum)}} ریال</span>

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
                    <th scope="col" v-if="title=='همه'">وضعیت</th>
                    <th scope="col">کد</th>
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
                >
                    <td scope="row">{{index+1}}</td>
                    <td v-if="title=='همه'">
                        <span class="badge badge-light" v-if="item.state==100">در انتظار تایید مالی</span>
                        <span class="badge badge-light" v-if="item.state==101">در انتظار پرداخت</span>
                        <span class="badge badge-light" v-if="item.state==102">پرداخت شده</span>
                        <span class="badge badge-light" v-if="item.state==200">آرشیو</span>
                        <span class="badge badge-light" v-if="item.state==0">هنوز ارسال نشده</span>
                    </td>
                    <td>{{item.id}}</td>
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
                    <td>

                        <button class="btn btn-link text-white" @click.prevent="edit(item.id,item.price,item.brand.title,item.brand.id,item.subject,item.content,item.acc_content,item.state)" v-if="role=='admin' && item.state<100"><i class="fa fa-check" v-if="role!='admin'"></i><i class="fa fa-edit" v-if="role=='admin'"></i></button>
                        <button class="btn btn-link text-white" @click.prevent="check(item.id)" v-if="role=='admin' && item.state<100 || role=='admin' && item.state==102 || role=='finMan' && item.state==100 || role=='finance' && item.state==101"><i class="fa fa-check"></i></button>
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
    export default {
        name: "FinList",
        props:['user','role'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                loop:[],
                brands:[],
                loading:true,
                show:false,
                hideBranded:false,
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
                end:20,
                brandId:'',
                title:'همه',
                loaded:true,
            }
        },
        mounted: function() {
            let url2 = '/api/allBrands';
            axios.get(url2).then(response => this.brands = response.data);
            this.fetch('all');
        },
        methods:{

            edit: function(id,price,brand,brandId,subject,content,acc_content,state){
                this.id=id;
                this.price=price;
                this.branded=brand;
                this.brand=brandId;
                this.selectedItem=brandId;
                this.subject=subject;
                this.content=content;
                this.acc_content=acc_content;
                this.state=state;
                //
                // if (state==1){
                //     this.acc=true;
                // }
                this.show=true;
            },
            update: function(){
                let url = '/api/addFin?role=' + this.role + '&acc_content=' + this.acc_content + '&acc=' + this.acc + '&update=' + this.id + '&u=' + this.user + '&c=' + this.content + '&p=' + this.price + '&b=' + this.brand + '&s=' + this.subject;
                axios.get(url).then(
                    // response => this.loop = response.data,
                    this.added()
                );
            },
            check: function(id){
                let url = '/api/checkFin?role=' + this.role + '&id=' + id + '&user=' + this.user;
                axios.get(url).then(

                    this.change(id)
                );
            },
            deleteThis: function(){
                let x = confirm('آیا از حذف این مورد اطمینان دارید؟');
                if(x){
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
                this.fetch();
            },
            showAlertFunc: function(){
                this.showAlert=false;
            },
            change: function(id){
                this.showAlert=true;
                this.fetch('all');
                setTimeout(this.showAlertFunc, 2000);
            },
            fetch: function(code){
                let url1 = '/api/allFin?role=' + this.role + '&code=' + code;
                axios.get(url1).then(response => this.loop = response.data);
                this.loaded=false;
                code=null;
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
</style>

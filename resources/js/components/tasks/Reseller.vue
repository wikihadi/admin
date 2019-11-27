<template>
    <div>
        <!--<div class="jumbotron" v-if="task!=0">-->

            <!--<h2>{{task.id}}.{{task.title}}</h2>-->
            <!--<p>{{task.content}}</p>-->
            <!--<hr class="m-4">-->

            <!--<small class="badge badge-info">وضعیت: در حال بررسی</small>-->
            <!--<small class="badge badge-secondary">ثبت شده در: {{task.jCreated_at}}</small>-->
            <!--<p class="badge badge-secondary">کد {{task.id}}</p>-->
            <!--<small class="badge badge-secondary">توسط {{user.name}}</small>-->




            <!--<a class="btn btn-sm btn-secondary pull-left" href="/request">درخواست جدید</a>-->
        <!--</div>-->
        <div class="jumbotron">
            <transition name="fade">
                <div v-if="loop.selectedTask==0">
                <h4 class="text-center">سامانه پیگیری و مشاهده سفارشات</h4>
                <hr class="m-4">
                <p class="lead text-center"><span>{{user.name}}</span> عزیز خوش آمدید</p>
                <!--<p>شما می توانید سفارش جدیدی ثبت کنید و یا سفارشات پیشین خود را پیگیری نمایید.</p>-->
                    <!--<hr class="m-4">-->
                    <div class="row m-5">
                        <div class="col-md-3 text-center"  @click.prevent="showTab=2">
                            <i class="fa fa-5x fa-tasks text-muted"></i>
                            <div class="m-3 h1 text-muted">{{loop.tasks.length}}</div>
                            <span class="">سفارشات من</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="fa fa-5x fa-flag text-muted "></i>
                            <div class="m-3 h1 text-muted ">{{loop.tasksCount1}}</div>
                            <span class="">سفارشات در جریان</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="fa fa-5x fa-flag-o text-muted "></i>
                            <div class="m-3 h1 text-muted ">{{loop.tasksCount2}}</div>
                            <span class="">سفارشات معلق</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="fa fa-5x fa-flag-checkered text-muted "></i>
                            <div class="m-3 h1 text-muted ">{{loop.tasksCount3}}</div>
                            <span class="">سفارشات پایان یافته</span>
                        </div>
                    </div>
                    <hr class="m-4">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" :class="{'active':showTab==1}" @click.prevent="showTab=1" v-if="showTab!=2"><i class="fa fa-plus"></i> سفارش جدید</button>
                        <button type="button" class="btn btn-primary"  :class="{'active':showTab==2}" @click.prevent="showTab=2" v-if="showTab!=1"><i class="fa fa-tasks"></i> مشاهده سفارشات</button>
                        <button class="btn btn-secondary" @click="resellerFetchTasks" v-if="showTab==2"><i  class="fa fa-spinner" :class=""></i> بارگذاری مجدد</button>
                        <button type="button" class="btn btn-outline-secondary" @click.prevent="showTab=0,loop.selectedTask=0" v-if="showTab!=0"><i class="fa fa-close"></i> برگشت</button>
                    </div>
                </div>

            </transition>
            <transition name="fade">
                <div v-if="showTab==1">

                <h4>فرم ثبت سفارش جدید</h4>

                <hr class="m-4">

                <form method="post" action="/reseller">
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <small class="text-info">{{comment1}}</small>

                                <input name="title" type="text" class="form-control" id="title" placeholder="عنوان" required v-model="title"
                                       @focus="comment1 = 'برای پیگیری های بهتر یک عنوان ضروری است.'"
                                       @blur="comment1 = ''"
                                >
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="brand">مربوط به برند</label>
                                <!--<small>{{comment2}}</small>-->
                                <select name="brand" id="brand" required class="form-control" v-model="brandId">
                                    <!--@focus="comment2 = 'در صورتی که برند مورد نظر در لیست موجود نبود با انتخاب یک برند درخواست خود را ثبت نموده و با واحد انفورماتیک تماس بگیرید.'"-->
                                    <!--@blur="comment2 = ''"-->
                                    <!--&gt;-->
                                    <option v-for="brand in brands" :value="brand.id">{{brand.title}}</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="content">توضیحات کار</label>
                        <small  class="text-info">{{comment3}}</small>

                        <textarea name="content" class="form-control" id="content" v-model="content" placeholder="توضیحات" required
                                  @focus="comment3 = 'نکاتی که می تواند به تسریع کار کمک کند در این قسمت وارد نمایید'"
                                  @blur="comment3 = ''"
                        ></textarea>
                    </div>
                    <!--<div class="form-group">-->
                    <!--<label for="pic">تصویر</label>-->
                    <!--<input type="file" id="pic">-->
                    <!--</div>-->
                    <button type="submit" class="btn btn-success btn-block">ثبت درخواست</button>


                </form>
            </div>
            </transition>
            <transition name="fade">
                <div v-if="showTab==2&&loop.selectedTask==0">

                <h5 v-if="loop.tasks.length>0">سفارشات من</h5>
                <table class="table table-striped" v-if="loop.tasks.length>0">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">زمان ثبت</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="task in loop.tasks">
                        <th scope="row">{{task.id}}</th>
                        <td>{{task.title}}</td>
                        <td :title="task.jd"><small>({{task.diff}})</small></td>
                        <td>
                            <span class="badge badge-light" v-if="task.reseller_state==1">جدید</span>
                            <span class="badge badge-success" v-if="task.reseller_state==2">فاز طراحی</span>
                            <span class="badge badge-danger" v-if="task.reseller_state==3">در انتظار تایید طرح</span>
                            <span class="badge badge-warning" v-if="task.reseller_state==4">در انتظار تایید مالی و پرداخت</span>
                            <span class="badge badge-success" v-if="task.reseller_state==5">فاز چاپ</span>
                            <span class="badge badge-warning" v-if="task.reseller_state==6">آماده تحویل</span>
                            <span class="badge badge-success" v-if="task.reseller_state==7">فاز نصب</span>
                            <span class="badge badge-danger" v-if="task.reseller_state==9">معلق</span>
                            <span class="badge badge-dark" v-if="task.reseller_state==10">تحویل شده</span>
                        </td>
                        <td><button class="btn btn-link btn-sm" @click="resellerFetchTasks(task.id)"><i class="fa fa-eye"></i></button></td>
                    </tr>
                    </tbody>
                </table>
                <div class="h2 text-center text-danger m-5" v-if="loop.tasks.length<1">
                   سفارشی در این قسمت وجود ندارد

                </div>

                <div class="text-center">
                    <span class="badge badge-light">1.جدید</span>
                    <span class="badge badge-success">2.فاز طراحی</span>
                    <span class="badge badge-danger">3.در انتظار تایید طرح</span>
                    <span class="badge badge-warning">4.در انتظار تایید مالی و پرداخت</span>
                    <span class="badge badge-success">5.فاز چاپ</span>
                    <span class="badge badge-warning">6.آماده تحویل</span>
                    <span class="badge badge-success">7.فاز نصب</span>
                    <span class="badge badge-danger">9.معلق</span>
                    <span class="badge badge-dark">10.تحویل شده</span>
                </div>

            </div>
            </transition>
            <transition name="fade">
                <div v-if="loop.selectedTask!=0" class="">

                    <div>
                        <h1 class="text-center">{{loop.selectedTask.title}}</h1>
                        <div class="text-center">
                            <span class="badge badge-info" :title="loop.selectedTask.diff">ثبت شده در {{loop.selectedTask.jd}}</span>

                            <span class="badge badge-light"     v-if="loop.selectedTask.reseller_state==1">جدید</span>
                            <span class="badge badge-success"   v-if="loop.selectedTask.reseller_state==2">فاز طراحی</span>
                            <span class="badge badge-danger"    v-if="loop.selectedTask.reseller_state==3">در انتظار تایید طرح</span>
                            <span class="badge badge-warning"   v-if="loop.selectedTask.reseller_state==4">در انتظار تایید مالی و پرداخت</span>
                            <span class="badge badge-success"   v-if="loop.selectedTask.reseller_state==5">فاز چاپ</span>
                            <span class="badge badge-warning"   v-if="loop.selectedTask.reseller_state==6">آماده تحویل</span>
                            <span class="badge badge-success"   v-if="loop.selectedTask.reseller_state==7">فاز نصب</span>
                            <span class="badge badge-danger"    v-if="loop.selectedTask.reseller_state==9">معلق</span>
                            <span class="badge badge-dark"      v-if="loop.selectedTask.reseller_state==10">تحویل شده</span>

                        </div>

                        <div class="text-center">
                            توضیحات: {{loop.selectedTask.content}}
                        </div>

                        <hr class="mx-5">



                    </div>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-outline-secondary" @click.prevent="showTab=0,loop.selectedTask=0" v-if="showTab!=0"><i class="fa fa-close"></i> برگشت</button>
                    </div>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Reseller",
        props:['user','brands','task'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                title:'',
                brandId:'',
                content:'',
                pic:'',
                showTab:0,
                comment1:'',
                comment2:'',
                comment3:'',
                loop:[],
                cc:''

            }
        },
        mounted: function() {
            this.resellerFetchTasks();
        },
        methods: {
            resellerFetchTasks: function(task=0){
                let url = '/api/resellerFetchTasks?userId=' + this.user.id + '&taskId=' + task;
                axios.get(url).then(response => this.loop = response.data);
            }
        },
    }
</script>

<style scoped>
    .fade-leave-active {
        transition: opacity 0s;
    }
    .fade-enter-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>

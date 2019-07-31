<template>
    <div>
        <fin :user="this.user"></fin>
        <div class="position-fixed fixed-bottom bg-warning d-flex justify-content-center" v-if="show">
            <div><button class="btn btn-link text-light" @click="show=!show"><i class="fa fa-close"></i></button></div>
            <div class="p-5 col-xl-5">
                <transition name="fade">
                    <div>
                        <h3 v-if="role=='admin'">ویرایش هزینه</h3>
                        <h3 v-if="role=='finance'">تایید هزینه</h3>
                        <form  @submit.prevent="update">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label for="fi">هزینه</label>
                                <p v-if="role=='finance'">{{addComma(price)}}</p>
                                <input type="number" class="form-control" id="fi" v-model="price" name="price" aria-describedby="fiHelp" placeholder="مثال: 10000 ریال" autocomplete="off" required v-if="role=='admin'">
                                <small id="fiHelp" class="form-text text-muted" v-if="role=='admin'">هزینه را به ریال وارد نمایید</small>
                            </div>
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="brand">برای برند</label>
                                    <p v-if="role=='finance'">{{branded}}</p>
                                    <select class="form-control" id="brand" v-model="brand" name="brand" @change="hideBranded=true" v-if="role=='admin'">
                                        <option v-for="(brand,index) in brands" :value="brand.id">{{brand.title}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md" >
                                    <label for="brand">موضوع</label>
                                    <p  v-if="role=='finance'">{{subject}}</p>
                                    <input type="text" class="form-control" id="subject" v-model="subject" name="subject" required  v-if="role=='admin'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">توضیحات پرداخت</label>
                                <p v-if="role=='finance'">{{content}}</p>
                                <textarea class="form-control" id="content" rows="3" v-model="content" name="content" required  v-if="role=='admin'"></textarea>
                            </div>
                            <div  v-if="role=='finance'">
                            <div class="form-group">
                                <label for="acc_content">توضیحات تایید</label>
                                <textarea class="form-control bg-dark" id="acc_content" rows="3" v-model="acc_content" name="content"></textarea>
                            </div>
                            <div class="form-group" v-if="state==0">
                                <label for="acc">تایید</label>
                                <input type="checkbox" name="acc" id="acc" v-model="acc">
                                <small id="accHelp" class="form-text text-muted" v-if="acc">این هزینه مورد تایید من است و در لیست بدهکار اضافه کرده ام</small>

                            </div>
                                <button type="submit" class="btn btn-dark" v-if="role=='finance'">تایید هزینه</button>

                            </div>
                            <button type="submit" class="btn btn-dark" v-if="role=='admin'">ویرایش هزینه</button>
                        </form>
                    </div>
                </transition>
            </div>
        </div>
    <div class="row bg-dark">
        <div class="col bg-dark">
<!--            <div class="bg-dark text-center">{{addComma(loop.sum)}} ریال</div>-->
        </div>
        <div class="col">
            <div class="bg-dark text-left">
            <span @click.prevent="fetch,end=5" class="pointer"><i class="fa fa-refresh"></i></span>
            <span @click.prevent="end=5" class="pointer badge badge-secondary">5</span>
            <span @click.prevent="end=10" class="pointer badge badge-secondary">10</span>
            <span @click.prevent="end=20" class="pointer badge badge-secondary">20</span>
            <span @click.prevent="end=50" class="pointer badge badge-secondary">50</span>
            <span @click.prevent="end=100" class="pointer badge badge-secondary">100</span>
            <span @click.prevent="end=10000" class="pointer badge badge-secondary">all</span>
                <span class="badge badge-info px-3">{{addComma(loop.sum)}} ریال</span>

            </div>
        </div>



<div class="col-12">
            <table class="table table-striped table-dark">

                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">کد</th>
                    <th scope="col">توسط</th>
                    <th scope="col">مبلغ ریال</th>
                    <th scope="col">برند</th>
                    <th scope="col">موضوع</th>
                    <th scope="col">توضیحات</th>
<!--                    <th scope="col">وضعیت</th>-->
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in loop.all.slice(0,end)" :class="{'bg-success':item.state==1}">
                    <th scope="row">{{index+1}}</th>
                    <td>{{item.id}}</td>
                    <td>{{item.user.name}}</td>
                    <td>{{addComma(item.price)}}</td>
                    <td>{{item.brand.title}}</td>
                    <td>{{item.subject}}</td>
                    <td>{{item.content}}</td>
<!--                    <td>{{item.state}}</td>-->
                    <td><button class="btn btn-block btn-link text-white" @click.prevent="edit(item.id,item.price,item.brand.title,item.brand.id,item.subject,item.content,item.acc_content,item.state)"><i class="fa fa-check" v-if="role=='finance'"></i><i class="fa fa-edit" v-if="role=='admin'"></i></button></td>
                </tr>
                </tbody>
            </table>
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
                end:5,
                brandId:'',
            }
        },
        mounted: function() {
            let url2 = '/api/allBrands';
            axios.get(url2).then(response => this.brands = response.data);
            this.fetch();
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
            fetch: function(){
                let url1 = '/api/allFin';
                axios.get(url1).then(response => this.loop = response.data);

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

<style scoped>
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

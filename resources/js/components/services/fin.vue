<template>
    <div>
        <div v-if="!show">
        <button class="btn btn-link" @click.prevent="show=!show,done=false"><i class="fa fa-plus"></i> ثبت هزینه</button>
        </div>
<!--        <div style="width: 40px;height: 80px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;top:30vh;left:0" @click.prevent="show=!show" class="position-fixed pointer bg-light d-flex justify-content-center">-->
<!--            FIN-->
<!--            <span style="writing-mode: tb-rl;" class="text-center">FIN</span>-->
<!--        </div>-->

        <div class="position-fixed fixed-bottom bg-info d-flex justify-content-center" v-if="show">
            <div><button class="btn btn-link text-light" @click="show=!show"><i class="fa fa-close"></i></button></div>


            <div class="p-5 col-xl-7">
                <transition name="fade">
                    <div v-if="!done">
                <h3>ثبت هزینه</h3>

                <p>هزینه های انجام شده را با توضیحات وارد نمایید</p>
                        <form @submit="formSubmit" enctype="multipart/form-data">

                        <!--                <form  @submit.prevent="create">-->
<!--                <form action="addFin" method="post">-->

                    <input type="hidden" name="_token" :value="csrf">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="fi">هزینه</label>
                                <input type="number" class="form-control" id="fi" v-model="price" name="price" aria-describedby="fiHelp" placeholder="مثال: 10000 ریال" autocomplete="off" required>
                                <small id="fiHelp" class="form-text text-muted">هزینه را به ریال وارد نمایید</small>
                            </div>
                        </div>
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
                    <select class="form-control" id="brand" v-model="brand" name="brand" required>
                        <option v-for="brand in brands" :value="brand.id">{{brand.title}}</option>
                    </select>



                </div>
                <div class="form-group col-md">
                    <label for="brand">موضوع</label>
                    <input type="text" class="form-control" id="subject" v-model="subject" name="subject" required>
<!--                    <select class="form-control">-->
<!--                        <option selected value="0">بدون موضوع</option>-->
<!--                    </select>-->
                </div>
                    </div>
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="brand">مربوط به بخش</label>
                                    <select class="form-control" id="section" v-model="section" name="section" required>
                                        <optgroup label="_________ جاری علی معاش">

                                        <option value="1">تامین ملزومات مثل منگنه و...</option>
                                        <option value="1">مربوط به سفارشاتی که از بیرون از شرکت دریافت شده</option>
                                        </optgroup>
                                        <optgroup label="_________ حسابداری حیدر خانقاه">

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
                                        <optgroup label="_________ تولیدی صنعتی حیدر خانقاه">
                                            <option value="3">مرتبط به مایا</option>
                                            <option value="3">گوش پاک کن و خلال با نخ لیو</option>
                                            <option value="3">پوشاک مایا</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md">
                                    <div class="form-group">
                                        <label for="image">ثبت تصویر</label>
                                        <input type="file" name="image" id="image" class="form-control" v-on:change="onImageChange">
                                        <small>با فرمت JPG و حجم زیر 2 مگابایت</small>
                                    </div>
                                </div>
                            </div>
                <div class="form-group">
                    <label for="content">توضیحات</label>
                    <textarea class="form-control" id="content" rows="3" v-model="content" name="content" required></textarea>
                </div>
                    <button type="submit" class="btn btn-dark">ثبت هزینه</button>
                </form>
                </div>
                </transition>
                <div class="alert alert-secondary" v-if="done">با موفقیت افزوده شد!
                    <div class="row">
                        <div class="col"><button type="button" class="btn btn-success btn-block" @click.prevent="done=!done" v-if="done"><i class="fa fa-plus"></i> ثبت جدید</button></div>
                        <div class="col"><button type="button" class="btn btn-secondary btn-block" @click.prevent="show=!show" v-if="done"><i class="fa fa-close"></i> بستن</button></div>
                        <div class="col"><a role="button" class="btn btn-primary btn-block" :href="'/tools/fin/print/' + loop.id"><i class="fa fa-print"></i> چاپ</a></div>


                    </div>

                </div>


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
        name: "fin",
        props:['user'],
        data(){
            return{
                image:'',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                loop:[],
                brands:[],
                loading:true,
                show:false,
                price:'',
                content:'',
                date:'',
                brand:'',
                subject:'',
                section:'',
                done:false,
            }
        },
        mounted: function(){
            // this.brands();

            let url = '/api/allBrands';
            axios.get(url).then(response => this.brands = response.data);

        },
        methods:{
            onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let formData = new FormData();
                formData.append('image', this.image);
                formData.append('_token', this.csrf);
                formData.append('price', this.price);
                formData.append('date', this.date);
                formData.append('brand', this.brand);
                formData.append('subject', this.subject);
                formData.append('section', this.section);
                formData.append('contentFin', this.content);
                formData.append('user', this.user);

                axios.post('/api/finFormSubmit', formData, config)
                    // .then(function (response) {
                    //                 console.log(response);
                    //             })
                    .then(
                        response => this.loop = response.data,
                        this.added()
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            create: function(){
                let url = '/api/addFin?u=' + this.user + '&c=' + this.content + '&p=' + this.price + '&b=' + this.brand + '&s=' + this.subject + '&date=' + this.date ;
                axios.get(url).then(
                    // response => this.loop = response.data,
                    this.added()
                );

                // axios.post('/api/addFin',{
                //     content:this.content,
                //     price:this.price,
                //     user_id:this.user,
                //     brand_id:this.brand,
                // }).then(function (response) {
                //         console.log(response);
                //     })
                //     .catch(function (error) {
                //         console.log(error);
                //     });

            },
            added: function(){
                this.done = true;
                this.price = '';
                this.content = '';
                this.brand = '';
            },
            brands: function(){
                let url = '/api/allBrands';
                axios.get(url).then(response => this.brands = response.data);
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

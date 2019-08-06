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


            <div class="p-5 col-xl-5">
                <transition name="fade">
                    <div v-if="!done">
                <h3>ثبت هزینه</h3>

                <p>هزینه های انجام شده را با توضیحات وارد نمایید</p>
                <form  @submit.prevent="create">
<!--                <form action="addFin" method="post">-->

                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                    <label for="fi">هزینه</label>
                    <input type="number" class="form-control" id="fi" v-model="price" name="price" aria-describedby="fiHelp" placeholder="مثال: 10000 ریال" autocomplete="off" required>
                    <small id="fiHelp" class="form-text text-muted">هزینه را به ریال وارد نمایید</small>
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


                    </div>

                </div>


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "fin",
        props:['user'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                loop:[],
                brands:[],
                loading:true,
                show:false,
                price:'',
                content:'',
                brand:'',
                subject:'',
                done:false,
            }
        },
        mounted: function(){
            // this.brands();

            let url = '/api/allBrands';
            axios.get(url).then(response => this.brands = response.data);

        },
        methods:{
            create: function(){
                let url = '/api/addFin?u=' + this.user + '&c=' + this.content + '&p=' + this.price + '&b=' + this.brand + '&s=' + this.subject;
                axios.get(url).then(
                    response => this.loop = response.data,
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

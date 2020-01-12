<template>
    <div class="col-12 row">
        <div class="row col-md-8 offset-md-2">
            <!--<div class="col-12"><span>کاربر: {{user.name}}</span></div>-->

            <div class="col-12 mt-5" v-if="!showFrm">
                <!--<button class="btn btn-sm btn-link" @click="showFrm=true"><i class="fa fa-plus"></i> جدید</button>-->
            </div>
                <div class="col-12 mt-5" v-if="showFrm">
                <h1 class="text-center">فرم ثبت اطلاعات چاپخانه</h1>
                <form @submit="addPress" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-sm" for="name">نام موسسه*</label>
                            <input type="text" class="form-control-sm form-control" id="name" name="name" required v-model="name" placeholder="نام موسسه">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm" for="services">نوع خدمات</label>
                            <div class="input-group" v-if="showInput==='services'">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" @click="showInput=0"><i class="fa fa-close"></i></button>
                                </div>
                                <input v-model="optionPress"  type="text" class="form-control" placeholder="نوع خدمات جدید">
                                <div class="input-group-append" v-if="optionPress!==''">
                                    <button class="btn btn-success" type="button" @click="addOptionPress('service')">اضافه کن</button>
                                </div>
                            </div>
                            <multiselect v-if="showInput!='services'"
                                         v-model="services"
                                         id="services"
                                         :options="selectes.services"
                                         :multiple="true"
                                         :close-on-select="false"
                                         :clear-on-select="false"
                                         :preserve-search="true"
                                         placeholder="خدمات"
                                         label="title"
                                         track-by="id"
                            >
                                <span slot="noResult" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='services',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                                <span slot="noOptions" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='services',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                            </multiselect>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm" for="machines">نوع ماشینها</label>
                            <div class="input-group" v-if="showInput=='machines'">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" @click="showInput=0"><i class="fa fa-close"></i></button>
                                </div>
                                <input v-model="optionPress"  type="text" class="form-control" placeholder="نوع ماشین جدید">
                                <div class="input-group-append" v-if="optionPress!=''">
                                    <button class="btn btn-success" type="button" @click="addOptionPress('machine')">اضافه کن</button>
                                </div>
                            </div>
                            <multiselect v-if="showInput!='machines'"
                                         v-model="machines"
                                         id="machines"
                                         :options="selectes.machines"
                                         :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                         placeholder="ماشینها" label="title" track-by="id">
                                <span slot="noResult" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='machines',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                                <span slot="noOptions" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='machines',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                            </multiselect>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm" for="material">متریال قابل چاپ</label>
                            <div class="input-group" v-if="showInput=='material'">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" @click="showInput=0"><i class="fa fa-close"></i></button>
                                </div>
                                <input v-model="optionPress"  type="text" class="form-control" placeholder="متریال">
                                <div class="input-group-append" v-if="optionPress!=''">
                                    <button class="btn btn-success" type="button" @click="addOptionPress('material')">اضافه کن</button>
                                </div>
                            </div>
                            <multiselect v-if="showInput!='material'" v-model="material" id="material" :options="selectes.material"
                                         :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                         placeholder="متریال قابل چاپ" label="title" track-by="id">
                                <span slot="noResult" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='material',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                                <span slot="noOptions" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='material',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                            </multiselect>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm" for="cases">موارد قابل چاپ</label>
                            <div class="input-group" v-if="showInput=='cases'">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" @click="showInput=0"><i class="fa fa-close"></i></button>
                            </div>
                            <input v-model="optionPress"  type="text" class="form-control" placeholder="مورد قابل چاپ">
                            <div class="input-group-append" v-if="optionPress!=''">
                                <button class="btn btn-success" type="button" @click="addOptionPress('case')">اضافه کن</button>
                            </div>
                        </div>
                            <multiselect v-if="showInput!='cases'" v-model="cases" id="cases" :options="selectes.cases"
                                         :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                         placeholder="موارد قابل چاپ" label="title" track-by="id">
                                <span slot="noResult" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='cases',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                                <span slot="noOptions" class="">
                                    <button type="button" class="btn btn-block btn-outline-secondary" @click="showInput='cases',optionPress=''">یافت نشد؟ اضافه کنید</button>
                                </span>
                            </multiselect>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-sm" for="nameOfContact">نام شخص رابط</label>
                            <input type="text" class="form-control-sm form-control" id="nameOfContact" name="nameOfContact" v-model="nameOfContact">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="text-sm" for="contentOfContact">توضیحات ارتباط با رابط موردی مطرح شود</label>
                            <textarea class="form-control-sm form-control" id="contentOfContact" name="contentOfContact" v-model="contentOfContact"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="text-sm" for="tel">تلفن</label>
                            <input type="tel" class="form-control-sm form-control" id="tel" name="tel" placeholder="02187654321" v-model="tel">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="text-sm" for="mobile">تلفن همراه</label>
                            <input type="tel" class="form-control-sm form-control" id="mobile" name="mobile" placeholder="09121234567" v-model="mobile">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-sm">قبلا با این واحد پروژه ای داشتید؟</label>
                            <label for="partner1">خیر</label>
                            <input type="radio" id="partner1" name="partner" v-model="partner" value="0">
                            <label for="partner2">بله</label>
                            <input type="radio" id="partner2" name="partner" v-model="partner" value="1">
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 text-left" v-if="showLvl==1">
                        <button class="btn btn-sm btn-outline-success" type="submit">ذخیره</button>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" v-if="showLvl==1">
                            <label class="text-sm" for="address">آدرس</label>
                            <textarea class="form-control-sm form-control" id="address" name="address" v-model="address"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" v-if="showLvl==1">
                            <label class="text-sm" for="email">پست الکترونیکی</label>
                            <input dir="ltr" type="email" class="form-control-sm form-control" id="email" name="email" placeholder="name@mail.com" v-model="email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" v-if="showLvl==1">
                            <label class="text-sm" for="web">وبسایت</label>
                            <input type="text" class="form-control-sm form-control" id="web" name="web" dir="ltr" v-model="web">
                        </div>
                    </div>

                        <div class="col-md-4" v-if="showLvl==1">
                            <div class="form-group">
                                <label class="text-sm" for="tel2">تلفن کارخانه</label>
                                <input type="tel" class="form-control-sm form-control" id="tel2" name="tel2" placeholder="02187654321" v-model="tel2">
                            </div>
                        </div>
                        <div class="col-md-4" v-if="showLvl==1">
                            <div class="form-group">
                                <label class="text-sm" for="tel3">تلفن دیگر</label>
                                <input type="tel" class="form-control-sm form-control" id="tel3" name="tel3" placeholder="02187654321" v-model="tel3">
                            </div>
                        </div>
                        <div class="col-md-4" v-if="showLvl==1">
                            <div class="form-group">
                                <label class="text-sm" for="fax">فکس</label>
                                <input type="tel" class="form-control-sm form-control" id="fax" name="fax" placeholder="02187654321" v-model="fax">
                            </div>
                        </div>

                    <div class="col-md-12">

                        <div class="form-group" v-if="showLvl==1">
                            <label class="text-sm">به عملکرد این واحد چه امتیازی می دهید؟</label>
                            <label class="text-sm" for="rate1">
                            <i class="fa fa-star text-warning"></i>
                            </label>
                            <input type="radio" id="rate1" name="rate" v-model="rate" value="1">
                            <label class="text-sm" for="rate2">
                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                            </label>
                            <input type="radio" id="rate2" name="rate" v-model="rate" value="2">
                            <label class="text-sm" for="rate3">

                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                            </label>
                            <input type="radio" id="rate3" name="rate" v-model="rate" value="3">
                                <label class="text-sm" for="rate4">

                                <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                                </label>

                            <input type="radio" id="rate4" name="rate" v-model="rate" value="4">
                                    <label class="text-sm" for="rate5">

                                    <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                                    </label>
                            <input type="radio" id="rate5" name="rate" v-model="rate" value="5">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" v-if="showLvl==1">
                            <label class="text-sm" for="comment">توضیحات تکمیلی</label>
                            <textarea class="form-control-sm form-control" id="comment" name="comment" v-model="comment"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <button class="btn btn-sm btn-link" type="button" @click="down" v-if="showLvl==0"><i class="fa fa-arrow-down"></i></button>
                        <button class="btn btn-sm btn-link" type="button" @click="up" v-if="showLvl==1"><i class="fa fa-arrow-up"></i></button>
                        <button class="btn btn-sm btn-link" type="button" @click="showFrm=false"><i class="fa fa-minus"></i></button>
                    </div>
                    <div class="col-sm-6 mt-3 text-left">
                        <!--<button class="btn btn-sm btn-outline-success" type="button" @click="saveAndClose">ذخیره</button>-->
                        <!--<button class="btn btn-sm btn-success" type="button" @click="saveAndNew">ذخیره + جدید</button>-->
                        <button class="btn btn-sm btn-outline-success" type="submit">ذخیره</button>
                    </div>
                </div>


                </form>
            </div>
            <div class="col-12 mt-5">
                <div class="mb-3 d-flex justify-content-end"><span class="badge-secondary badge pointer" @click="keyword=''">{{loop.length}} واحد ثبت شده</span></div>

                <input name="search" v-model="keyword" type="text" class="form-control form-control-sm" placeholder="جستجوی عنوان">

                <select @change="pe=pq" v-model="pq" class="form-control form-control-sm my-3" v-if="filteredList.length>10">
                    <option value="10">نمایش 10 عدد از <span>{{filteredList.length}}</span></option>
                    <option value="20" v-if="filteredList.length>20">نمایش 20 عدد از <span>{{filteredList.length}}</span></option>
                    <option value="50" v-if="filteredList.length>50">نمایش 50 عدد از <span>{{filteredList.length}}</span></option>
                    <option value="100" v-if="filteredList.length>100">نمایش 100 عدد از <span>{{filteredList.length}}</span></option>
                    <option :value="filteredList.length">نمایش همه <span>{{filteredList.length}}</span></option>
                </select>
            <div class="card card-light card-sm border-dark my-2" v-for="(item,index) in filteredList.slice(ps,pe)">
                <div class="card-header pointer" @click="itemModa(item.id)">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            {{item.name}}
                        </div>
                        <div class="">

                        </div>
                    </div>
                </div>
                <div class="card-body" v-if="itemModal==item.id">
                </div>
                <div class="card-footer" v-if="itemModal==item.id">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <!--<i class="fa fa-edit btn btn-link text-dark btn-sm"></i>-->
                            <i class="fa fa-trash btn btn-link text-danger btn-sm" @click="del(item.id,item.name)"></i>
                        </div>
                        <div class="">
                            <a :href="'tel:' + item.mobile" :title="item.mobile" v-if="item.mobile!=null"><i class="fa fa-mobile btn btn-link btn-sm"></i></a>
                            <a :href="'tel:' + item.tel" :title="item.tel" v-if="item.tel!=null"><i class="fa fa-phone btn btn-link btn-sm"></i></a>
                            <a :href="'tel:' + item.tel2" :title="'تلفن کارخانه' + item.tel2" v-if="item.tel2!=null"><i class="fa fa-phone btn btn-link btn-sm"></i></a>
                            <a :href="'tel:' + item.tel3" :title="item.tel3" v-if="item.tel3!=null"><i class="fa fa-phone btn btn-link btn-sm"></i></a>
                            <a :href="'mailto:' + item.email" target="_blank" :title="item.email" v-if="item.email!=null"><i class="fa fa-envelope btn btn-link btn-sm"></i></a>
                            <a :href="'http://' + item.web" target="_blank" :title="item.web" v-if="item.web!=null"><i class="fa fa-globe btn btn-link btn-sm"></i></a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="callout callout-info my-2" v-if="keyword!=''&&filteredList.length>0">
                    <button class="btn btn-outline-info btn-sm" @click="showFrm=true,name=keyword"><i class="fa fa-plus-circle"></i> جدید</button>
                </div>
                <div class="callout callout-danger my-2" v-if="filteredList.length<1">
                        <span>موردی یافت نشد. اضافه می کنید؟</span>
                            <button class="btn btn-success btn-sm" @click="showFrm=true,name=keyword"><i class="fa fa-plus-circle"></i> جدید</button>
                        <button class="btn btn-outline-light btn-sm" @click="keyword=''">بستن</button>
                </div>


            </div>
        </div>

    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: { Multiselect },
        name: "press",
        props:['user'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                showLvl:0,
                name:'',
                nameOfContact:'',
                contentOfContact:'',
                tel:'',
                tel2:'',
                tel3:'',
                fax:'',
                mobile:'',
                email:'',
                optionPress:'',
                services:'',
                machines:'',
                cases:'',
                material:'',
                comment:'',
                partner:0,
                rate:0,
                web:'',
                address:'',
                showFrm:false,
                loop:[],
                keyword:'',
                ps:0,
                pe:10,
                pq:10,
                itemModal:'',
                xdel:false,
                showInput:0,
                selectes:[],

            }
        },

        mounted: function(){
            this.fetchPress();
        },
        computed: {
            filteredList() {
                return this.loop.filter((p) => {
                    return this.keyword.toLowerCase().split(' ').every(v => p.name.toLowerCase().includes(v));
                });
            },
        },
        methods: {
            addOptionPress: function(t){
                let url = '/api/addOptionPress?t=' + t + '&title=' + this.optionPress;
                axios.get(url).then(response => this.selectes = response.data);
                this.showInput=0;
            },
            del: function(id,name){
              this.xdel=confirm('آیا از حذف ' + name + ' اطمینان دارید؟');
              if (this.xdel){
                  let url = '/api/pressDel?id=' + id + '&userId=' + this.user.id;
                  axios.get(url).then(response =>
                      // console.log('Done')
                      this.loop = response.data
                  );
              }
              this.xdel=false;
            },
            // remove (index) {
            //     this.$delete(this.loop, index)
            // },
            itemModa: function(i){
                if (this.itemModal!=i){
                    this.itemModal=i
                }else if (this.itemModal!=0) {

                    this.itemModal = 0;
                }else {
                    this.itemModal = i;
                }
            },
            up: function () {
                this.showLvl=0
            },
            down: function () {
                this.showLvl=1
            },
            fetchPress: function(){
                let url = '/api/fetchPress';
                axios.get(url).then(response => this.loop = response.data);
                let url2 = '/api/fetchOptions';
                axios.get(url2).then(response => this.selectes = response.data);
            },
            addPress(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let servicesArray = [];
                for (let i = 0; i < this.services.length ; i++){
                    servicesArray.push(this.services[i].id);
                }
                let machinesArray = [];
                for (let i = 0; i < this.machines.length ; i++){
                    machinesArray.push(this.machines[i].id);
                }
                let casesArray = [];
                for (let i = 0; i < this.cases.length ; i++){
                    casesArray.push(this.cases[i].id);
                }
                let materialArray = [];
                for (let i = 0; i < this.material.length ; i++){
                    materialArray.push(this.material[i].id);
                }

                let formData = new FormData();

                formData.append('name', this.name);
                formData.append('_token', this.csrf);
                formData.append('nameOfContact', this.nameOfContact);
                formData.append('contentOfContact', this.contentOfContact);
                formData.append('tel', this.tel);
                formData.append('tel2', this.tel2);
                formData.append('tel3', this.tel3);
                formData.append('fax', this.fax);
                formData.append('mobile', this.mobile);
                formData.append('email', this.email);
                formData.append('services', servicesArray);
                formData.append('machines', machinesArray);
                formData.append('cases', casesArray);
                formData.append('material', materialArray);
                formData.append('comment', this.comment);
                formData.append('partner', this.partner);
                formData.append('rate', this.rate);
                formData.append('web', this.web);
                formData.append('address', this.address);
                formData.append('user_id', this.user.id);



                axios.post('/api/addPress', formData, config)
                    .then(
                        response => this.loop = response.data,

                this.showLvl=0,
                this.showFrm=false,
                this.reset()

                    )
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            saveAndClose: function () {
                this.addPress();
                this.showFrm=false;
                this.showLvl=0;
                this.reset();
            },
            saveAndNew: function () {
                this.addPress();
                this.showLvl=0;
                this.reset();
            },
            reset: function () {
                this.name='';
                this.nameOfContact='';
                this.contentOfContact='';
                this.tel='';
                this.tel2='';
                this.tel3='';
                this.fax='';
                this.mobile='';
                this.email='';
                this.services='';
                this.machines='';
                this.cases='';
                this.material='';
                this.comment='';
                this.partner=0;
                this.rate=0;
                this.web='';
                this.address='';
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>

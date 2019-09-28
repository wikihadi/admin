<template>
    <div class="position-fixed" style="left:0;top:0; z-index: 555555">
        <div style="width: 140px;height: 40px;border-top-right-radius: 10px;border-top-left-radius: 10px;bottom:0;right:50px" v-if="minimize" @click.prevent="minimize=!minimize" class="position-fixed pointer bg-light d-flex justify-content-center"><div style="" class="text-center mt-2">CHAT</div></div>
        <div class="position-fixed w-100 h-100 bg-fade" v-if="!minimize"  @click.prevent="minimize=!minimize"></div>
        <div class="col-12 row justify-content-center align-self-center mt-5 pt-5" v-if="!minimize" style="min-width: 100vw">
            <div class="col-xl-9 col-lg-10">
                <div class="card bg-dark">
                    <div class="card-header">
                        <div class="row justify-content-between pull-left" v-if="!minimize">
                            <div class="pointer" @click.prevent="minimize=!minimize">
                                <i  class="fa fa-close text-muted"></i>
                            </div>
                        </div>
<!--                        <span v-if="minimize" @click.prevent="minimize=!minimize" class="pointer"></span>-->

                        <div v-if="!minimize">
                            <div @click="refresh" v-if="!minimize" class="pointer">
                                <i class="fa fa-refresh" title="بروزرسانی"></i> <small class="text-sm text-muted">{{dateN}}</small>
                            </div>
                            <div class="d-flex justify-content-center mb-3" v-for="u in users" v-if="u.id == user" >
                                <div class="bg-light d-flex justify-content-between align-items-center w-25 pointer" style="border-radius: 25px"  @click.prevent="selectUser(u.id,u.name)">
                                    <div>
                                        <img :src="'/storage/avatars/'+ u.avatar" class="img-circle user-selected-me" :alt="u.name" :title="u.name">
                                    </div>
                                    <div>
                                        {{u.name}}
                                    </div>
                                    <div></div>
                                </div>

<!--                                <div><span>{{u.name}}</span></div>-->
                            </div>
                            <div class="text-center mb-3 d-flex justify-content-center flex-wrap">

<!--                                <carousel  :perPage="10" :center="true" :rtl="true" :loop="true" :autoplay="false" :speed="1000" :autoplayTimeout="5000" :paginationEnabled="false" :navigationEnabled="false">-->
<!--                                    <slide>-->
                                        <img v-for="u in users"  v-if="u.id != user" :src="'/storage/avatars/'+ u.avatar" :class="{ 'user-selected' : toUserId == u.id , 'user-not-selected' : toUserId != u.id }" class="img-circle mx-1" :alt="u.name" :title="u.name" @click.prevent="selectUser(u.id,u.name)">
<!--                                    </slide>-->
<!--                                </carousel>-->
                            </div>
                            <form @submit.prevent="addStatus()" v-if="showForm">
                                <div class="input-group">
                                    <div class="input-group-prepend" v-if="toUserIdName">
                                        <span class="input-group-text text-sm">به {{toUserIdName}}</span>
                <!--                        <select name="to_user" v-model="toUserId" class="form-control form-control-sm bg-dark" placeholder="asd" required>-->
                <!--                            <option v-for="u in users" :value="u.id" class="bg-dark">{{u.name}}</option>-->
                <!--                        </select>-->
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-dark" name="content" v-model="content" id="content" placeholder="متن پیام" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success btn-sm" type="submit">ارسال</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body" v-if="!minimize">
<!--        <transition name="fade">-->

                        <div class="list-group list-group-flush bg-dark" style="overflow: auto;max-height: 50vh">
                            <zoom-center-transition>
                            <a class="list-group-item bg-dark" style="min-width: 100%" v-if="loop.length==0 && toUserIdName != ''">هنوز مکالمه ای با {{toUserIdName}} انجام نشده است</a>
                            </zoom-center-transition>
                            <a class="list-group-item bg-dark" v-for="item in loop" style="min-width: 100%">
                                <img v-if="item.to_user.id != user" :src="'/storage/avatars/' + item.user.avatar" alt="" class="ml-3 img-circle " style="width: 45px" :title="item.to_user.name">
                                <img v-if="item.to_user.id != user" :src="'/storage/avatars/' + item.to_user.avatar" alt=""  style="width: 28px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" :title="item.to_user.name">
                                <img  v-if="item.to_user.id == user" :src="'/storage/avatars/' + item.user.avatar" alt="" class="img-size-50 ml-3 img-circle " :title="item.user.name">
                                <small>{{item.content}}</small>
                                <span class="float-left" style="font-size: 85%"><small>{{item.diff}}</small></span>
                            </a>
                        </div>

<!--                            <a @click.prevent="commentsToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="commentsToShow > 5"><i class="fa fa-arrow-up"></i></a>-->
<!--                            <a @click.prevent="commentsToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="loop.length > 5"><i class="fa fa-arrow-down"></i></a>-->

<!--        </transition>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {ZoomCenterTransition} from 'vue2-transitions';
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components: {
            Carousel,
            Slide,
            ZoomCenterTransition,
        },

        props:['user','users'],
        data(){
            return{
                content: '',
                toUserId: '',
                loop:[],
                userID: this.user,
                commentsToShow: 5,
                showForm: false,
                toUserIdName:'',
                minimize:true
            }},
        beforeMount(){
            this.dataFetch(this.user,this.user);
            // this.timer = setInterval(this.dataFetch, 60000)

        },

        created(){
            this.visit();
        },
        methods:{
            visit: function(){


                axios.post('/api/addStatusToBox',{
                    content: 'بازدید کاربر',
                    user_id: this.user,
                    status: 'visit',
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            refresh: function(){
                this.dataFetch(this.user,this.user);
                this.dateNew();
            },
            dateNew: function(){
                let d = new Date();
                let h = d.getHours();
                let m = d.getMinutes();
                let s = d.getSeconds();
                if (m < 10){
                    m = '0' + m;
                }
                if (s<10){
                    s = '0' + s;
                }
                this.dateN = h + ':' + m + ':' + s;
            },
            selectUser: function(uId,uName){

                if (this.user != uId){
                    this.toUserId = uId;
                    this.showForm = true;
                    this.toUserIdName = uName;
                } else {
                    this.toUserId = uId;

                    this.showForm = false;
                }
                this.dataFetch(this.user,uId);
            },
            dataFetch: function(id,uid){
                let url = '/api/commentList?ID=' + id + '&toUId=' + uid;
                axios.get(url).then(response => this.loop = response.data)
            },
            addStatus(){
                if (this.content != '') {

                    axios.post('./api/addStatusToBox', {
                        content: this.content,
                        user_id: this.user,
                        status: 'status',
                        to_user: this.toUserId,
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    // Event.$emit('taskCreated',{title:this.title});
                    this.content = '';
                    this.toUserId = '';
                    this.dataFetch()
                    // console.log('Adding');
                }
            }
        }
    }
</script>

<style scoped>
    .user-selected{
        width: 40px;
        height: 40px;
        cursor: pointer;
    }

    .user-not-selected{
        width: 30px;
        height: 30px;
        cursor: pointer;
    }
    .user-selected-me{
        width: 50px;
        height: 50px;
        cursor: pointer;
    }
    .pointer{
        cursor:pointer
    }
    .bg-fade{
        background-color: rgba(0, 0, 0, 0.7);
    }
</style>

<template>
    <div class="position-fixed" style="left:0; z-index: 555555">
        <div style="width: 40px;height: 140px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;" v-if="minimize" @click.prevent="minimize=!minimize" class="pointer bg-light d-flex justify-content-center"><div style="writing-mode: tb-rl;" class="text-center">CHAT</div></div>
        <div class="col-12 row justify-content-center w-100" v-if="!minimize">
            <div class="col-xl-9 col-lg-10">
                <div class="card bg-dark">
                    <div class="card-header">
                        <div class="row justify-content-between pull-left" v-if="!minimize">
                            <div class="pointer" @click.prevent="minimize=!minimize">
                                <i :class="{'fa-window-minimize':!minimize,'fa-window-maximize':minimize}" class="fa text-muted"></i>
                            </div>
                        </div>
<!--                        <span v-if="minimize" @click.prevent="minimize=!minimize" class="pointer"></span>-->

                        <div v-if="!minimize">
                            <div @click="refresh" v-if="!minimize" class="pointer">
                                <i class="fa fa-refresh" title="بروزرسانی"></i> <small class="text-sm text-muted">{{dateN}}</small>
                            </div>
                            <div class="text-center mb-3 d-flex justify-content-center flex-wrap">
                                <div class="d-flex justify-content-between" v-for="u in users" v-if="u.id == user" >
                                    <div><img :src="'/storage/avatars/'+ u.avatar" :class="{ 'user-selected' : toUserId == u.id , 'user-not-selected' : toUserId != u.id }" class="img-circle" :alt="u.name" :title="u.name" @click.prevent="selectUser(u.id,u.name)">
                                </div><div><span>{{u.name}}</span></div>
                                </div>
<!--                                <carousel  :perPage="10" :center="true" :rtl="true" :loop="true" :autoplay="false" :speed="1000" :autoplayTimeout="5000" :paginationEnabled="false" :navigationEnabled="false">-->
<!--                                    <slide>-->
                                        <img v-for="u in users"  v-if="u.id != user" :src="'/storage/avatars/'+ u.avatar" :class="{ 'user-selected' : toUserId == u.id , 'user-not-selected' : toUserId != u.id }" class="img-circle" :alt="u.name" :title="u.name" @click.prevent="selectUser(u.id,u.name)">
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
                        <div class="list-group list-group-flush bg-dark" style="overflow: auto">
                            <a class="list-group-item bg-dark" v-for="item in loop.slice(0, commentsToShow)" >
                                <img v-if="item.to_user.id != user" :src="'/storage/avatars/' + item.user.avatar" alt="" class="ml-3 img-circle " style="width: 45px" :title="item.to_user.name">
                                <img v-if="item.to_user.id != user" :src="'/storage/avatars/' + item.to_user.avatar" alt=""  style="width: 28px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" :title="item.to_user.name">
                                <img  v-if="item.to_user.id == user" :src="'/storage/avatars/' + item.user.avatar" alt="" class="img-size-50 ml-3 img-circle " :title="item.user.name">
                                <small>{{item.content}}</small>
                                <span class="float-left" style="font-size: 85%"><small>{{item.diff}}</small></span>
                            </a>

                            <a @click.prevent="commentsToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="commentsToShow > 5"><i class="fa fa-arrow-up"></i></a>
                            <a @click.prevent="commentsToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="loop.length > 5"><i class="fa fa-arrow-down"></i></a>
                        </div>
<!--        </transition>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components: {
            Carousel,
            Slide
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
        methods:{
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
    .pointer{
        cursor:pointer
    }
</style>

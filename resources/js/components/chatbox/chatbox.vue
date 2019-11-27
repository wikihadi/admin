<template>
    <div class="row col-12">
        <div class="col-12">
            <transition name="slide-fade">
            <a class="nav-link pointer" v-if="tab==='user'" :class="{ 'text-primary': tab==='user' }" @click.prevent="fetchUsersChatbox"><i class="fa fa-arrow-right"></i></a>
            </transition>
            <transition name="slide-fade">

            <nav class="navbar navbar-expand-lg navbar-light bg-white" v-if="tab!=='user'">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pointer" :class="{ 'text-primary': tab==='chat' }" @click.prevent="fetchUsersChatbox"><i class="fa fa-comments"></i> ارتباط داخلی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pointer" :class="{ 'text-primary': tab==='box' }" @click.prevent="tab='box'"><i class="fa fa-tasks"></i> لیست باکس من</a>
                        </li>
                    </ul>
                </div>
            </nav>
            </transition>

        </div>
        <transition name="slide-fade">
        <div class="col-12 m-0" v-if="tab==='chat'">
            <input type="text" v-model="keyword" class="form-control form-control-sm" placeholder="جستجوی نام">
            <ul class="list-group">

            <vue-custom-scrollbar class="scroll-area"  :settings="settings" @ps-scroll-y="scrollHanle">
                <li class="list-group-item d-flex justify-content-between align-items-center pointer" @click.prevent="userChat(item.id)" v-for="item in filteredList">
                    <div class="d-flex justify-content-between">
                        <div>
                    <!--<img src="https://icon-library.net/images/user-icon-png/user-icon-png-25.jpg" class="img-circle w-30" alt="u.name" title="u.name">-->
                    <img :src="'/storage/avatars/'+ item.avatar" class="img-circle user-selected-me w-30" :alt="item.name" :title="item.name">
                    </div>
                        <div class="d-flex flex-column mr-3">
                            <div>{{item.name}}</div>
                            <span class="text-sm text-muted" v-if="item.last_chat">{{item.last_chat.content.substring(0, 40)}} ...</span>
                        </div>
                    </div>
                    <!--<span class="badge badge-primary badge-pill">14</span>-->
                </li>
            </vue-custom-scrollbar>

            </ul>
        </div>
        </transition>
        <transition name="slide-fade">
        <div class="col-12 m-0" v-if="tab==='box'">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                    <input type="checkbox" class="ml-3">کار شماره یک</div>
                    <div>تاریخ ثبت</div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                    <input type="checkbox" class="ml-3">کار شماره یک</div>
                    <div>تاریخ ثبت</div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                    <input type="checkbox" class="ml-3">کار شماره یک</div>
                    <div>تاریخ ثبت</div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                    <input type="checkbox" class="ml-3">کار شماره یک</div>
                    <div>تاریخ ثبت</div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                    کارهای امروز 10</div>
                    <div>کارهای مانده 3</div>
                </li>


            </ul>
        </div>
        </transition>
        <transition name="slide-fade">
        <div class="col-12 m-0" v-if="tab==='user'">
            <div class="card">
                <div class="card-header pointer" @click.prevent="userChat(userChatList.userChating.id)" title="بروزرسانی چت">
                    <img :src="'/storage/avatars/'+ userChatList.userChating.avatar" class="img-circle user-selected-me w-30" :alt="userChatList.userChating.name" :title="userChatList.userChating.name">
                    <span class="ml-3">{{userChatList.userChating.name}}</span>
                    <!--<span class="ml-3 pull-left">{{userChatList.chatbox.length}}</span>-->
                </div>
                <div class="card-body">
                    <vue-custom-scrollbar class="scroll-area"  :settings="settings" @ps-scroll-y="scrollHanle">
                    <div class="pr-4 m-3" v-for="chat in userChatList.chatbox">

                        <div class="" v-if="chat.pic!==null" :class="{ 'text-right': chat.user_id===userChatList.userChating.id,'text-left': chat.user_id===user.id }">
                        <img class="w-25" :src="'/storage/uploads/chatbox/'+ chat.pic">
                        </div>
                        <div class="d-flex" :class="{ 'justify-content-start': chat.user_id===userChatList.userChating.id,'justify-content-end': chat.user_id===user.id }" v-if="chat.status!=='status'">
                            <div class="d-flex flex-column"><img class="img-thumbnail w-25" :src="'/storage/uploads/chatbox/'+ chat.pic" v-if="chat.pic!==null">
                            <div class="px-2 py-1 d-inline-block" :class="{ 'bg-warning': chat.status!=='boxed','bg-dark': chat.status==='boxed','bulb': chat.user_id===userChatList.userChating.id,'bulbme': chat.user_id===user.id }">
                                {{chat.content}}
                            </div></div>
                        </div>
                        <div class="d-flex" :class="{ 'justify-content-start': chat.user_id===userChatList.userChating.id,'justify-content-end': chat.user_id===user.id }" v-if="chat.status==='status'">
                            <div class="px-2 py-1 d-inline-block" :class="{ 'bulb bg-pink': chat.user_id===userChatList.userChating.id,'bulbme bg-secondary': chat.user_id===user.id }">
                                {{chat.content}}
                            </div>
                        </div>
                        <div class="text-muted text-sm px-2" :class="{ 'text-left': chat.user_id===user.id }">
                            {{chat.diff}}<span v-if="chat.status!=='status'"> - باکس</span>
                        </div>
                    </div>
                    <div  class="pr-4 m-3" v-if="userChatList.chatbox.length===0">
                        <div class="d-flex justify-content-center">
                            <div class="px-2 py-1 d-inline-block bulbo bg-dark">
                                هنوز هیچ ارتباطی میان شما و {{userChatList.userChating.name}} شکل نگرفته است
                            </div>
                        </div>
                    </div>

                    </vue-custom-scrollbar>

                </div>
                <!--<small class="text-danger">{{eText}}</small>-->

                <div class="card-footer">

                    <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="collapse" id="form-collapse">

                            <div class="form-group">
                                <label for="image" class="border">ثبت تصویر</label>
                                <input type="file" name="image" id="image" class="form-control form-control-sm" v-on:change="onImageChange" ref="fileupload">
                                <small>با فرمت JPG و حجم زیر 2 مگابایت</small>
                            </div>
                        </div>
                        <div class="input-group  input-group-sm">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" :class="{'active':showFormCollapse}" type="button" data-toggle="collapse" data-target="#form-collapse" @click.prevent="showFormCollapse=!showFormCollapse">
                                    <i class="fa" :class="{'fa-plus-square':showFormCollapse,'fa-plus-square-o':!showFormCollapse}"></i>
                                </button>
                            </div>

                            <input type="text" class="form-control" placeholder="اینجا بنویس..." v-model="content" required>

                            <div class="input-group-append">
                                <button class="btn" :class="{'btn-outline-secondary':status,'btn-warning':!status}" type="submit"><i class="fa fa-paper-plane"></i><span v-if="!status"> ثبت باکس</span><span v-if="status"></span></button>
                                <button class="btn" :class="{'active':!status,'btn-outline-secondary':status,'btn-warning':!status}" @click.prevent="status=!status" title="درخواست باکس"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        </transition>
    </div>
</template>

<script>
    import vueCustomScrollbar from 'vue-custom-scrollbar'

    export default {
        components: {
            vueCustomScrollbar
        },
        name: "chatbox",
        props:['user'],
        data(){
            return{
                image:'',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                settings: {
                    maxScrollbarLength: 60,
                    // suppressScrollX: true
                },
                keyword:'',
                tab:'chat',
                users:[],
                userChatList:[],
                showFormCollapse:false,
                imgSize:'',
                content:'',
                status:true,

            }
        },
        mounted: function () {
            this.fetchUsersChatbox()
        },
        methods:{
            onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
                // this.imgSize=this.image.size;
            },
            fetchUsersChatbox: function(){
                this.tab='chat';
                this.userChatList=[];
                let url = '/api/fetchUsersChatbox?user=' + this.user.id;
                axios.get(url).then(response => this.users = response.data);
            },
            userChat: function (id) {
                this.tab='user';

                let url = '/api/fetchUserChatbox?u=' + this.user.id + '&uc=' + id;
                axios.get(url).then(response => this.userChatList = response.data);
            },
            scrollHanle(evt) {
                console.log(evt)
            },
            clear: function () {
                const input = this.$refs.fileupload;
                input.type = 'text';
                input.type = 'file';
                this.content="";
                this.image='';
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                if (this.status) {
                    this.status='status'
                }else {
                    this.status='box'
                }

                let formData = new FormData();
                formData.append('pic', this.image);
                formData.append('_token', this.csrf);
                formData.append('content', this.content);
                formData.append('status', this.status);
                formData.append('user', this.user.id);
                formData.append('toUser', this.userChatList.userChating.id);

                axios.post('/api/chatboxFrmConfirm', formData, config)
                // .then(function (response) {
                //                 console.log(response);
                //             })
                    .then(
                        // response => this.loop = response.data,
                        // this.added()
                        // console.log('OK'),
                        // fileInput.file = null
                        this.clear
                    )
                    .catch(function (error) {
                        console.log(error)
                    });
                this.userChat(this.userChatList.userChating.id);

            },
        },
        computed: {
            filteredList() {
                return this.users.filter((users) => {
                    return this.keyword.toLowerCase().split(' ').every(v => users.name.toLowerCase().includes(v));
                });
            },
        }
    }
</script>

<style scoped>
.pointer{
    cursor:pointer;
}
    .selected{
        color: #00e676;
    }
    .w-30{
        width:40px;
    }


.scroll-area {
    position: relative;
    margin: auto;
    width: 100%;
    height: 50vh;
}
.slide-fade-enter-active {
    transition: all 1s ease;
}
/*.slide-fade-leave-active {*/
    /*transition: all 0s ease;*/
/*}*/
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
.bulb{
    -webkit-border-radius: 30px;
    -webkit-border-top-right-radius: 0;
    -moz-border-radius: 30px;
    -moz-border-radius-topright: 0;
    border-radius: 30px;
    border-top-right-radius: 0;
}
.bulbme{
    -webkit-border-radius: 30px;
    -webkit-border-top-left-radius: 0;
    -moz-border-radius: 30px;
    -moz-border-radius-topleft: 0;
    border-radius: 30px;
    border-top-left-radius: 0;
}
.bulbo{
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
}
    .bg-pink{
        background:#ffebee
    }
</style>

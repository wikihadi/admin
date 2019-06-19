<template>
        <div class="col-12 row mt-5 justify-content-center">
                <div class="col-xl-9 col-lg-10">
                <div class="card bg-dark">
                    <div class="card-header">
<!--                        TOP MENU---------------------------------------------------------------------------------->
<!--                        <div class="row justify-content-between">-->
<!--                            <div class="pointer" @click.prevent="searchTab()"><i :class="{'text-success':!showMenu}" class="fa fa-search"></i></div>-->
<!--&lt;!&ndash;                            <div class="pointer" @click.prevent="indicator()"><i class="fa fa-tasks"></i></div>&ndash;&gt;-->
<!--                            <div class="pointer" @click.prevent="indicator()"><i :class="{'fa-circle text-success':showMenu,'fa-circle-o':!showMenu}" class="fa"></i></div>-->
<!--                        </div>-->
<!--                        SEARCH BAR-------------------------------------------------------------------------------->
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-8">
                                <form @submit.prevent="searchTasks(),isShow=-1">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="جستجوی کارها..." v-model="searchValue" @keyup.prevent="searchTasks(),isShow=-1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary " type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <transition name="fade">

                                        <small v-if="this.searchValue.length < 3 && this.searchValue.length > 0" class="badge badge-warning mt-n3">حداقل سه حرف وارد کنید</small>
                                    </transition>

                                </form>
                            </div>
                        </div>
<!--                        FILTERS------------------------------------------------------------------------------------->
                        <div class="row justify-content-center">
                            <div class="btn-group">
                                <button type="button" :class="{'active':activeTab === 6}" class="btn btn-outline-info" @click.prevent="tasks='',title='باکس',activeTab=6,isShow=1,boxFetch()"><i :class="{'fa fa-circle':activeTab === 6,'fa fa-circle-o':activeTab !== 6}"></i> باکس</button>
                                <button type="button" :class="{'active':activeTab === 0}" class="btn btn-outline-info" @click.prevent="fetchRoutine()"><i :class="{'fa fa-circle':activeTab === 0,'fa fa-circle-o':activeTab !== 0}"></i> روتین</button>
                            </div>
                            <div class="mx-3"></div>
                            <div class="btn-group">
                                <button type="button" :class="{'text-light':activeTab === 1,'text-muted':activeTab !== 1}" class="btn btn-dark" @click.prevent="tasks='',fetchTasks('lastStatus','=',0,'order_column','asc'),commentFetch(),title='کارهای در انتظار',activeTab=1,isShow=3"><i :class="{'fa fa-circle':activeTab === 1,'fa fa-circle-o':activeTab !== 1}"></i> در انتظار</button>
                                <button class="btn btn-dark" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>
                                <button type="button" :class="{'text-light':activeTab === 2,'text-muted':activeTab !== 2}" class="btn btn-dark" @click.prevent="fetchCurrentTasks()"><i :class="{'fa fa-circle':activeTab === 2,'fa fa-circle-o':activeTab !== 2}"></i> درحال انجام</button>
                                <button class="btn btn-dark" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>
                                <button style="cursor: no-drop" disabled type="button" :class="{'text-light':activeTab === 3,'text-muted':activeTab !== 3}" class="btn btn-dark" @click.prevent="fetchTasks('lastStatus','=',3,'order_column','asc'),commentFetch(),title='پیگیری',activeTab=3,isShow=5"><i :class="{'fa fa-circle':activeTab === 3,'fa fa-circle-o':activeTab !== 3}"></i> پیگیری</button>
                                <button class="btn btn-dark" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>
                                <button style="cursor: no-drop" disabled type="button" :class="{'text-light':activeTab === 4,'text-muted':activeTab !== 4}" class="btn btn-dark" @click.prevent="fetchTasks('lastStatus','=',3,'order_column','asc'),commentFetch(),title='چاپ',activeTab=4,isShow=6"><i :class="{'fa fa-circle':activeTab === 4,'fa fa-circle-o':activeTab !== 4}"></i> چاپ</button>
                                <button class="btn btn-dark" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>
                                <button type="button" :class="{'text-light':activeTab === 5,'text-muted':activeTab !== 5}" class="btn btn-dark" @click.prevent="tasks='',fetchTasks('lastStatus','>=',3,'updated_at','desc'),commentFetch(),title='کارهای پایان یافته',activeTab=5,isShow=7"><i :class="{'fa fa-circle':activeTab === 5,'fa fa-circle-o':activeTab !== 5}"></i> نهایی</button>
                            </div>
                        </div>

                    </div>

<!--                    SEARCH NO RESULT------------------------------------------------------------------------------>
                    <transition name="fade">
                    <div class="card-body" v-if="loop.length <= 0 && noRes">
                        <div class="text-center m-5">
                            هیچ نتیجه ای یافت نشد
                        </div>
                    </div>
                    </transition>
<!--                    BOX------------------------------------------------------------------------------------------->
                    <div class="card-body"   v-if="isShow === 1">
<!--                        <div class="card-header" v-if="title != ''"><h4 class="text-center">{{title}}</h4></div>-->

<!--                        <div class="alert">{{loop.length}} باکس</div>-->
                        <form @submit.prevent="addStatus(user),boxFetch()">
                            <div class="input-group">
                                <input type="text" class="form-control bg-dark" name="content" v-model="newBox" placeholder="اینجا بنویس..." id="content" autocomplete="off" autofocus>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-down"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="list-group-item bg-dark" v-for="box in boxes.slice(0, boxToShow)" :id="'box-' + box.id">
                            <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id)"></i> <small>{{box.content}}</small>
                         </div>
                        <div class="text-center" v-if="boxes.length > 5">
                            <a @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-arrow-up"></i></a>
                            <a @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-arrow-down"></i></a>
                        </div>
                    </div>
<!--                    SEARCH RESULT--------------------------------------------------------------------------------->
                    <div class="card-body"   v-if="loop.length > 0 && isShow === -1">
                        <div class="alert" v-if="loop.length > 0">{{loop.length}} نتیجه یافت شد</div>
                        <table class="table table-hover table-striped table-borderless"  v-if="loop.length > 0">
                            <thead>
                                <tr>
                                    <th>کد کار</th>
                                    <th>عنوان</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tr v-for="(item, index) in loop.slice(0, toShow)">
                                <td>{{item.id}}</td>
                                <td><a v-bind:href="'/tasks/' + item.id">{{item.title}}</a></td>
                                <td class="text-left"><a :href="'/tasks/' + item.id" class="btn btn-link text-success"><i class="fa fa-eye"></i></a></td>
                                <!--                                <td>{{item.content}}</td>-->
                            </tr>
                        </table>
                        <div class="text-center" v-if="loop.length > 5">
                            نمایش {{toShow}} از {{loop.length}} <button class="btn btn-link btn-sm btn-block" type="button" @click.prevent="toShow+=5">بیشتر</button>
                        </div>
                    </div>
<!--                    TASKS----------------------------------------------------------------------------------------->
                    <div class="card-body"   v-if="tasks.length > 0 && isShow > 1">
<!--                        <div class="card-header" v-if="title != ''"><h4 class="text-center">{{title}}</h4></div>-->
                        <div class="list-group bg-dark">
                            <div class="border-danger" v-for="(item , index) in tasks.slice(0, tasksToShow)">
                                <a data-toggle="collapse" :href="'#col'+item.id" role="button" aria-expanded="false" :aria-controls="'#col'+item.id" @click.prevent="commentFetch()" :class="{'bg-secondary':item.lastStatus == 0,'bg-dark': item.lastStatus == 1,'bg-success text-dark': item.lastStatus == 2,'bg-dark text-light': item.lastStatus == 3}" class="list-group-item list-group-item-action flex-column align-items-start pointer">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <span class="badge badge-dark"><i :class="{'fa fa-users text-info': item.users.length > 1,'fa fa-user': item.users.length == 1}"></i></span> <span class="mb-1 h6">{{item.task.title}} <small class="text-muted ml-1">{{item.task.id}}</small></span>
                                        </div>
                                        <div class="">

                                            <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus < 2"></i>


<!--                                            <a :href="'/tasks/' + item.task.id + '/edit'" target="_blank" title="ویرایش"><i class="fa fa-edit ml-1"></i></a>-->
                                        </div>

                                    </div>
                                    <div class="">
                                    <small class="mb-1 text-muted">{{item.task.content.substr(0,150)}}<span v-if="item.task.content.length > 150">...</span></small>
                                    </div>
                                    <div class="d-flex justify-content-start">
<!--                                    <small class="text-muted" v-if="item.task.commentCount > 0">{{item.task.commentCount}} نظر</small>-->
<!--                                    <small class="text-muted" v-else>بدون نظر</small>-->
                                    </div>
                                </a>
                                <div class="collapse" :id="'col'+item.id">

                                    <div class="card card-body">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div class="text-center">
                                                <img :title="u.name" :src="'/storage/avatars/' + u.avatar" alt="" style="width: 25px" class="img-circle mr-1" v-for="u in item.users">
                                            </div>
                                            <div>
                                                <a  class="text-muted" :href="'/tasks/' + item.task.id" target="_blank" title="مشاهده"><i class="fa fa-link ml-1 text-dark" ></i> <span class="text-dark">مشاهده</span></a>
                                                <a  class="text-muted" :href="'/tasks/' + item.task.id + '/edit'" target="_blank" title="ویرایش"><i class="fa fa-edit ml-1 text-dark"></i> <span class="text-dark">ویرایش</span></a>
                                                <span class="bg-secondary bulb mr-3">
                                                    <a title="Share on Whatsapp" data-toggle="tooltip" target="_blank" :href="'https://api.whatsapp.com/send?phone=whatsappphonenumber&text=Please Check this Task on SADIQ: ' + item.task.title + 'http://i.sadiq-co.com/tasks/'+ item.task.id" class="mx-2 "><i class="fa fa-whatsapp text-light"></i></a>
                                                    <a title="Share on Telegram" data-toggle="tooltip" target="_blank" :href="'https://telegram.me/share/url?url=http://i.sadiq-co.com/tasks/' + item.task.id + '&text=Please Check this Task on SADIQ: ' + item.task.title" class="mx-2 "><i class="fa fa-telegram text-light"></i></a>
                                                </span>
<!--                                                <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus < 2"></i>-->
                                        </div></div>
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                 <a :href="'/storage/uploads/' + item.task.pic" target="_blank"><img class="img-fluid   " :src="'/storage/uploads/' + item.task.pic" :alt="item.task.id"></a>
                                            </div>
                                            <div class="col-xl-6 col-lg-8 col-md-6">
                                                <p class="text-dark">توضیحات: {{item.task.content}}</p>
                                                <form @submit.prevent="addComment(item.task.id)" autocomplete="off">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" name="content" v-model="content" class="form-control" placeholder="ثبت نظر...">
                                                            <div class="input-group-append"><button type="submit" class="btn btn-success"><i class="fa fa-arrow-down"></i></button></div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="" style="max-height:500px;overflow:auto">
                                                    <div class="card-footer" v-for="(comment,index) in comments" v-if="comment.task_id === item.task.id">
                                                        <div class="d-flex justify-content-between">
                                                            <div><img :src="'/storage/avatars/' + comment.user.avatar" :alt="comment.user.name" class="img-circle" style="width: 20px;"> <small class="text-dark">{{comment.user.name}}</small></div>

                                                            <div class="">
                                                                <small class="text-muted">{{comment.diff}}</small>
                                                                <i class="fa fa-ellipsis-v text-secondary"></i>
                                                            </div>
                                                        </div>
                                                        <div class="pr-4">
                                                            <div class="bg-secondary px-2 py-1 bulb d-inline-block">{{comment.content}}</div>

                                                        </div>
                                                    </div>
                                                    <a :href="'/tasks/' + item.task.id" class="text-dark" v-if="item.task.commentCount > 0"><div class="card-footer text-dark text-center">

                                                            <p class="text-dark">  جهت مشاهده تمام نظرات این کار، اینجا کلیک کنید</p>
                                                        <i class="fa fa-comments fa-3x text-dark"></i>
                                                    </div></a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                            </div>
                                        </div>
                                        <div class="d-flex w-100 justify-content-end">
                                            <div class="">
<!--                                                <i class="fa fa-stop text-secondary mx-2 pointer"></i>-->
<!--                                                <i class="fa fa-edit text-secondary mx-2 pointer"></i>-->
<!--                                                <i class="fa fa-trash text-secondary mx-2 pointer"></i>-->

<!--                                                    <a :href="'/tasks/' + item.task.id" target="_blank" title="مشاهده"><i class="fa fa-link text-dark mx-2"></i></a>-->
<!--                                                    <a :href="'/tasks/' + item.task.id + '/edit'" target="_blank" title="ویرایش"><i class="fa fa-edit text-dark mx-2"></i></a>-->
                                            </div>


                                            <div class="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3" v-if="tasks.length > 5">
                            <small>نمایش {{tasksToShow}} از {{tasks.length}} <button class="btn btn-link btn-sm btn-block" type="button" @click.prevent="addTasksToShow(tasks.length)">بیشتر</button></small>
<!--                        <i class="fa fa-circle ml-1" v-for="index in tasksToShow/5" :key="index" @click.prevent="addTasksToShow(tasks.length)"></i>-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                isShow: 0,
                newBox:'',
                boxes:[],
                boxToShow:5,
                showBox:false,
                activeTab: 2,
                title: '',
                test: true,
                content: '',
                tasksToShow: 5,
                toShow: 5,
                noRes: false,
                showMenu: false,
                showTasks: false,
                searchValue:'',
                loop:[],
                tasks:[],
                comments:[],
            }
        },
        mounted: function () {
            this.fetchCurrentTasks();
        },
        methods:{
            fetchCurrentTasks: function(){
                this.tasks='';
                this.fetchTasks('lastStatus','<=',2,'order_column','asc');
                this.commentFetch();
                this.title='در حال انجام';
                this.activeTab=2;
                this.isShow=4
            },
            fetchRoutine: function(){
                this.tasks=''
                this.fetchTasks('routine','=',1,'order_column','asc');
                this.commentFetch();
                this.title='کارهای روتین';
                this.activeTab=0;
                this.isShow=2
            },
            CheckItem: function(event,id){
                    axios.post('/api/statusUpdateBox/' + id,{
                        status: 'boxed',
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
            },
            boxFetch: function(){
                let url = '/api/statusListBox?ID=' + this.user;
                axios.get(url).then(response => this.boxes = response.data)
            },
            addStatus(user){
                if (this.newBox != ''){


                    axios.post('/api/addStatusToBox',{
                        content:this.newBox,
                        user_id: user,
                        status: 'box'
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    // Event.$emit('taskCreated',{title:this.title});
                    // this.boxes.splice(0, 0, {content: this.newBox});

                    this.newBox = '';

                    // console.log('Adding');
                }
            },
            newStatus: function(content,status,task_id,routine){
                    axios.post('/api/addStatusToBox',{
                        content: content,
                        user_id: this.user,
                        status: status,
                        task_id: task_id
                    });
                    if(routine === 1){
                        this.fetchRoutine();
                    }else{
                        this.fetchCurrentTasks();
                    }

            },
            addComment: function(task_id){
                if (this.content !== '') {
                    axios.post('/api/addStatusToBox', {
                        content: this.content,
                        user_id: this.user,
                        status: 'comment',
                        task_id: task_id
                    })
                        .then(console.log('response'),this.content = '',this.commentFetch())
                }
            },
            commentFetch: function(){
                let url = '/api/commentFetch';
                axios.get(url).then(response => this.comments = response.data)
            },
            addTasksToShow: function(qty){
                this.tasksToShow+=5;
                if(this.tasksToShow >= qty){
                    this.tasksToShow = qty;
                }
            },
            indicator: function(){
                this.showMenu = true;
                this.noRes = false;
                this.loop = [];
                this.showTasks = true;
            },
            searchTab: function(){
                this.showTasks = false;
                this.showMenu = false;

            },
            fetchTasks: function(el,op,val,ord,ordOp){
                let url = 'api/fetchTasks?u=' + this.user + '&el=' + el + '&op=' + op + '&val=' + val + '&ord=' + ord + '&ordOp=' + ordOp;
                console.log(url);
                axios.get(url).then(response => this.tasks = response.data);
            },
            searchTasks: function () {
                let url = 'api/searchTasks?s=' + this.searchValue;

                axios
                    .get(url)
                    .then(
                        response => this.loop = response.data,
            );


                if(this.loop.length <= 0 && this.searchValue.length >= 3){
                    this.noRes = true;
                }else{
                    this.noRes = false;
                }



            }
        }

    }

</script>

<style scoped>
.pointer{
    cursor:pointer
}
    .bulb{
        -webkit-border-radius: 30px;
        -webkit-border-top-right-radius: 0;
        -moz-border-radius: 30px;
        -moz-border-radius-topright: 0;
        border-radius: 30px;
        border-top-right-radius: 0;
    }
.fade-enter-active , .fade-leave-active {
    transition: opacity .2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>

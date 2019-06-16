<template>
        <div class="col-12 row mt-5 justify-content-center">
                <div class="col-xl-9 col-lg-10">
                <div class="card bg-dark">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="pointer" @click.prevent="searchTab()"><i class="fa fa-search"></i></div>
<!--                            <div class="pointer" @click.prevent="indicator()"><i class="fa fa-tasks"></i></div>-->
                            <div class="pointer" @click.prevent="indicator()"><i class="fa fa-circle-o"></i></div>
                        </div>

                        <div class="row justify-content-center" v-if="showMenu">
                            <div class="btn-group">
                            <a href="" class="btn btn-dark" @click.prevent="this.fetchTasks()" title="جاری"><i class="fa fa-circle-o"></i> جاری</a>
<!--                            <div class=""><i class="fa fa-minus fa-2x text-muted"></i></div>-->
                            <a href="" class="btn btn-dark"><i class="fa fa-circle-o"></i> پیگیری</a>
<!--                            <div class=""><i class="fa fa-minus fa-2x text-muted"></i></div>-->
                            <a href="" class="btn btn-dark"><i class="fa fa-circle-o"></i> نهایی</a>

                        </div>
                    </div>
                        <div class="row justify-content-center" v-else>
                            <div class="col-xl-4 col-lg-6 col-md-8">
                                <form @submit.prevent="searchTasks()">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="جستجوی کارها..." v-model="searchValue" @keyup.prevent="searchTasks()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary " type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <small v-if="this.searchValue.length < 3 && this.searchValue.length > 0" class="badge badge-warning mt-n3">حداقل سه حرف وارد کنید</small>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" v-if="searching && searchValue.length > 3">
                        <div class="text-center m-5">
                            <i class="fa fa-3x fa-spinner fa-pulse"></i>
                        </div>
                    </div>

                    <div class="card-body" v-if="loop.length <= 0 && noRes">
                        <div class="text-center m-5">
                            هیچ نتیجه ای یافت نشد
                        </div>
                    </div>

                    <div class="card-body"   v-if="loop.length > 0">
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

                    <div class="card-body"   v-if="tasks.length > 0 && showTasks">
                        <div class="list-group bg-dark">
                            <div class="" v-for="(item , index) in tasks.slice(0, tasksToShow)">
                                <a class="list-group-item list-group-item-action flex-column align-items-start bg-dark pointer"  data-toggle="collapse" :href="'#col'+item.id" role="button" aria-expanded="false" :aria-controls="'#col'+item.id" @click.prevent="commentFetch()">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{item.task.title}}</h6>
                                        <small class="text-muted">{{item.task.id}}</small>
                                    </div>
                                    <div>
                                    <small class="mb-1">{{item.task.content}}</small>
                                    </div>
                                    <div class="d-flex justify-content-start">
<!--                                    <small class="text-muted" v-if="item.task.commentCount > 0">{{item.task.commentCount}} نظر</small>-->
<!--                                    <small class="text-muted" v-else>بدون نظر</small>-->
                                    </div>
                                </a>
                                <div class="collapse" :id="'col'+item.id">

                                    <div class="card card-body">
                                        <div class="d-flex w-100 justify-content-end">
                                            <div class="">
                                                <i class="fa fa-play text-success mx-2 pointer"></i>
                                                <i class="fa fa-pause text-success mx-2 pointer"></i>
                                                <i class="fa fa-circle-o text-success mx-2 pointer"></i>

                                            <a title="Share on Whatsapp" data-toggle="tooltip" target="_blank" :href="'https://api.whatsapp.com/send?phone=whatsappphonenumber&text=Please Check this Task on SADIQ: ' + item.task.title + 'http://i.sadiq-co.com/tasks/'+ item.task.id" class="mx-2 "><i class="fa fa-whatsapp text-muted"></i></a>
                                            <a title="Share on Telegram" data-toggle="tooltip" target="_blank" :href="'https://telegram.me/share/url?url=http://i.sadiq-co.com/tasks/' + item.task.id + '&text=Please Check this Task on SADIQ: ' + item.task.title" class="mx-2 "><i class="fa fa-telegram text-muted"></i></a>
                                        </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                <a :href="'/storage/uploads/' + item.task.pic" target="_blank"><img class="img-fluid   " :src="'/storage/uploads/' + item.task.pic" :alt="item.task.id"></a>
                                            </div>
                                            <div class="col-xl-6 col-lg-8 col-md-6">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex w-100 justify-content-end">
                                            <div class="">
                                                <i class="fa fa-stop text-secondary mx-2 pointer"></i>
                                                <i class="fa fa-edit text-secondary mx-2 pointer"></i>
                                                <i class="fa fa-trash text-secondary mx-2 pointer"></i>
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
                content: '',
                tasksToShow: 5,
                toShow: 5,
                noRes: false,
                searching: true,
                showMenu: true,
                showTasks: true,
                searchValue:'',
                loop:[],
                tasks:[],
                comments:[]
            }
        },
        mounted: function () {
            this.fetchTasks();
        },
        methods:{
            addComment: function(task_id){
                if (this.content !== ''){
                    axios.post('/api/addStatusToBox',{
                        content: this.content,
                        user_id: this.user,
                        status: 'comment',
                        task_id: task_id
                    })
                        .then(function (response) {

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    this.content = '';
                }
                this.commentFetch();

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
            fetchTasks: function(){
                let url = 'api/fetchTasks?u=' + this.user;
                axios.get(url).then(response => this.tasks = response.data);
            },
            searchTasks: function () {
                this.searching = true;
                let url = 'api/searchTasks?s=' + this.searchValue;

                axios
                    .get(url)
                    .then(
                        response => this.loop = response.data,
                        this.searching = false
            );


                if(this.loop.length <= 0){
                    this.noRes = true;
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
</style>

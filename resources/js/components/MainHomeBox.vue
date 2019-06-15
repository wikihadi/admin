<template>
        <div class="col-12 row mt-5 justify-content-center">
                <div class="col-xl-9 col-lg-10">
                <div class="card bg-dark">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="pointer" @click.prevent="searchTab()"><i class="fa fa-search"></i></div>
                            <div class="pointer" @click.prevent="indicator()"><i class="fa fa-circle-o"></i></div>
                        </div>

                        <div class="row justify-content-center" v-if="showMenu">
                            <div class="mx-3 pointer" @click.prevent="fetchTasks()">کارهای من</div>
<!--                            <div class=""><i class="fa fa-minus fa-3x text-muted"></i></div>-->
                            <div class="mx-3 pointer" data-toggle="tooltip" title="کارهای پیگیری">کارهای پیگیری</div>
<!--                            <div class=""><i class="fa fa-minus fa-3x text-muted"></i></div>-->
                            <div class="mx-3 pointer" data-toggle="tooltip" title="کارهای پایان یافته">کارهای گذشته</div>
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
                        <div class="text-center" v-if="loop.length > 5">نمایش {{toShow}} از {{loop.length}} <button class="btn btn-link btn-sm btn-block" type="button" @click.prevent="toShow+=5">بیشتر</button></div>
                    </div>

                    <div class="card-body"   v-if="tasks.length > 0 && showTasks">
                        <div class="list-group bg-dark">
                            <div class="" v-for="(item , index) in tasks.slice(0, tasksToShow)">
                                <a class="list-group-item list-group-item-action flex-column align-items-start bg-dark pointer"  data-toggle="collapse" :href="'#col'+item.id" role="button" aria-expanded="false" :aria-controls="'#col'+item.id">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{item.task.title}}</h5>
                                        <small class="text-muted">{{item.task.id}}</small>
                                    </div>
                                    <p class="mb-1">{{item.task.content}}</p>

                                    <small class="text-muted" v-if="item.task.commentCount > 0">{{item.task.commentCount}} نظر</small>
                                    <small class="text-muted" v-else>بدون نظر</small>
                                </a>
                                <div class="collapse" :id="'col'+item.id">

                                    <div class="card card-body bg-dark">
                                        <div class="d-flex w-100 justify-content-end">
                                            <div class="">
                                            <a title="Share on Whatsapp" data-toggle="tooltip" target="_blank" :href="'https://api.whatsapp.com/send?phone=whatsappphonenumber&text=Please Check this Task on SADIQ: ' + item.task.title + 'http://i.sadiq-co.com/tasks/'+ item.task.id" class="mx-1 hvr-glow"><i class="fa fa-whatsapp text-muted"></i></a>
                                            <a title="Share on Telegram" data-toggle="tooltip" target="_blank" :href="'https://telegram.me/share/url?url=http://i.sadiq-co.com/tasks/' + item.task.id + '&text=Please Check this Task on SADIQ: ' + item.task.title" class="mx-1 hvr-glow"><i class="fa fa-telegram text-muted"></i></a>
                                        </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                <a :href="'/storage/uploads/' + item.task.pic" target="_blank"><img class="img-fluid   " :src="'/storage/uploads/' + item.task.pic" :alt="item.task.id"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3" v-if="tasks.length > 5"><small>نمایش {{tasksToShow}} از {{tasks.length}} <button class="btn btn-link btn-sm btn-block" type="button" @click.prevent="addTasksToShow(tasks.length)">بیشتر</button></small></div>
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
                tasksToShow: 5,
                toShow: 5,
                noRes: false,
                searching: true,
                showMenu: true,
                showTasks: true,
                searchValue:'',
                loop:[],
                tasks:[]
            }
        },
        mounted: function () {
            this.fetchTasks()
        },
        methods:{
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
</style>

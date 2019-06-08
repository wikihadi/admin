<template>
    <div>

        <ul class="list-group list-group-flush ">
            <li class="list-group-item">
                   روزهای کاری
                <span class="pull-left">{{all.userDaysCount}}</span>
            </li>

            <li class="list-group-item">
                  کارها
                <span class="pull-left">{{all.userTasksCount}}</span>
            </li>
            <li class="list-group-item">
                کارهای تمام شده
                <span class="pull-left">{{all.userEndCount}}</span>

            </li>
            <li class="list-group-item">
                کار ایجاد شده توسط کاربر
                <span class="pull-left">{{all.userTasksSelf}}</span>

            </li>
            <li class="list-group-item">
                پیامها
                <span class="pull-left">{{all.userStatusCommentsToUserCount}}</span>

            </li>
            <li class="list-group-item">
                نظرات
                <span class="pull-left">{{all.userStatusCommentsCount}}</span>

            </li>
            <li class="list-group-item">
                اطلاعیه های خوانده شده
                <span class="pull-left">{{all.userPostVerified}}</span>

            </li>
            <li class="list-group-item">
                توقف ها
                <span class="pull-left">{{all.userOffCount}}</span>

            </li>
            <li class="list-group-item">
                باکس ها
                <span class="pull-left">{{all.userBoxCount}}</span>

            </li>
            <li class="list-group-item">
                ناهارها
                <span class="pull-left">{{all.userLunchCount}}</span>

            </li>
        </ul>
        <div class="text-center">
            <small data-toggle="tooltip" title="بروزرسانی" @click="dataFetch();isShow = true" style="cursor: pointer" class="ml-3 hvr-grow-rotate">
                <i class="fa fa-refresh"></i>
            </small></div>


    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                isShow : true,
                myTasks: '',
                all:[]
            }
        },
        created: function () {
            this.dataFetch();
            // this.timer = setInterval(this.dataFetch, 1000)
        },
        methods:{
            dataShow: function(){
                this.dataFetch();
            },
            dataFetch: function(){

                axios.get('/api/allStatics?ID=' + this.user).then(response => this.all = response.data);
            },
        }

    }
</script>

<style scoped>
li{

}
.list-group-item{
}
</style>

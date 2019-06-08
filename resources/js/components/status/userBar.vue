<template>
    <div>
        <small data-toggle="tooltip" title="باکس ها">
            <span v-if="isShow" class="ml-3"><i class="fa fa-tasks"></i> {{all.userBoxCount}}</span>
        </small>

        <small data-toggle="tooltip" title="کارها">
            <span v-if="isShow" class="ml-3"><i class="fa fa-stack-overflow"></i> {{all.userTasksCount}}</span>
        </small>
        <small data-toggle="tooltip" title="کارهای تمام شده">
            <span v-if="isShow" class="ml-3"><i class="fa fa-flag-checkered"></i> {{all.userEndCount}}</span>
        </small>
        <small data-toggle="tooltip" title="کار ایجاد شده">
            <span v-if="isShow" class="ml-3"><i class="fa fa-tasks"></i> {{all.userTasksSelf}}</span>
        </small>
        <span class="mx-4"></span>
        <small data-toggle="tooltip" title="نظرات">
            <span v-if="isShow" class="ml-3"><i class="fa fa-comments"></i> {{all.userStatusCommentsCount}}</span>
        </small>
        <small data-toggle="tooltip" title="پیامها">
            <span v-if="isShow" class="ml-3"><i class="fa fa-comment"></i> {{all.userStatusCommentsToUserCount}}</span>
        </small>

        <small data-toggle="tooltip" title="اطلاعیه های خوانده شده">
            <span v-if="isShow" class="ml-3"><i class="fa fa-check"></i> {{all.userPostVerified}}</span>
        </small>
        <span class="mx-4"></span>
        <small data-toggle="tooltip" title="روزهای کاری">
            <span v-if="isShow" class="ml-3 "><i class="fa fa-calendar"></i> {{all.userDaysCount}}</span>
        </small>
<!--        <small data-toggle="tooltip" title="توقف ها">-->
<!--            <span v-if="isShow" class="ml-3"><i class="fa fa-pause-circle-o"></i> {{userOffCount}}</span>-->
<!--        </small>-->

<!--        <small data-toggle="tooltip" title="ناهارها">-->
<!--            <span v-if="isShow" class="ml-3"><i class="fa fa-cutlery"></i> {{all.userLunchCount}}</span>-->
<!--        </small>-->
        <small data-toggle="tooltip" title="بروزرسانی" @click="dataFetch();isShow = true" style="cursor: pointer" class="ml-3 hvr-grow-rotate">
            <i class="fa fa-refresh"></i>
        </small>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                isShow : false,
                all:[]
                // myTasks: '',
                // tasksCreatedByMe:'',
                // userStatusCommentsToUserCount:'',
                // userStatusCommentsCount: '',
                // userPostVerified: '',
                // userOffCount: '',
                // userBoxCount: '',
                // userLunchCount: '',
                // userDaysCount: '',
                // userEndCount: '',
            }
        },
        mounted: function () {
            this.dataFetch();
            // this.timer = setInterval(this.dataFetch, 1000)
        },
        methods:{
            dataShow: function(){
                this.dataFetch();
            },
            dataFetch: function(){
                axios.get('/api/allStatics?ID=' + this.user).then(response => this.all = response.data);

                // axios.get('/api/userBoxCount?ID=' + this.user).then(response => this.userBoxCount = response.data);
                //
                // axios.get('/api/userTasksSelf?ID=' + this.user).then(response => this.myTasks = response.data);
                // axios.get('/api/userEndCount?ID=' + this.user).then(response => this.userEndCount = response.data);
                // axios.get('/api/userTasksCount?ID=' + this.user).then(response => this.tasksCreatedByMe = response.data);
                // axios.get('/api/userStatusCommentsCount?ID=' + this.user).then(response => this.userStatusCommentsCount = response.data);
                // axios.get('/api/userStatusCommentsToUserCount?ID=' + this.user).then(response => this.userStatusCommentsToUserCount = response.data);
                //
                // axios.get('/api/userPostVerified?ID=' + this.user).then(response => this.userPostVerified = response.data);
                // axios.get('/api/userOffCount?ID=' + this.user).then(response => this.userOffCount = response.data);
                // axios.get('/api/userDaysCount?ID=' + this.user).then(response => this.userDaysCount = response.data);
                //
                // axios.get('/api/userLunchCount?ID=' + this.user).then(response => this.userLunchCount = response.data);
            },
        }

    }
</script>

<style scoped>

</style>

<template>
    <div>
        <small><i class="fa fa-stack-overflow" data-toggle="tooltip" title="کارهای ایجاد شده"></i> {{myTasks}}</small>
        <small class="mx-2"></small>
        <small><i class="fa fa-tasks" data-toggle="tooltip" title="کارها"></i> {{tasksCreatedByMe}}</small>
        <small class="mx-2"></small>
        <small><i class="fa fa-comment" data-toggle="tooltip" title="پیامها"></i> {{userStatusCommentsToUserCount}}</small>
        <small class="mx-2"></small>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                user: '',
                myTasks: '',
                tasksCreatedByMe:'',
                userStatusCommentsToUserCount:''
            }
        },
        created: function () {
            this.dataFetch();
            // this.timer = setInterval(this.dataFetch, 1000)
        },
        methods:{
            dataFetch: function(){
                axios.get('/api/userTasksSelf?ID=' + this.user).then(response => this.myTasks = response.data);
                axios.get('/api/userTasksCount?ID=' + this.user).then(response => this.tasksCreatedByMe = response.data);
                axios.get('/api/userStatusCommentsToUserCount?ID=' + this.user).then(response => this.userStatusCommentsToUserCount = response.data);
            },
        }

    }
</script>

<style scoped>

</style>

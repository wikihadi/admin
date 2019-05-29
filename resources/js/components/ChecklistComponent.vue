<template>
        <div class='row'>
            <h1>My Tasks</h1>
            <h4>New Task</h4>
            <form action="#" @submit.prevent="createTask()">
                <div class="input-group">
                    <input v-model="checklist.content" type="text" name="body" class="form-control" autofocus>
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Task</button>
                </span>
                </div>
            </form>
            <h4>All Tasks</h4>
            <!--<ul class="list-group">-->
                <!--<li v-if='list.length === 0'>There are no tasks yet!</li>-->
                <!--<li class="list-group-item" v-for="(task, index) in list">-->
                    <!--{{ task.body }}-->
                    <!--<button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">Delete</button>-->
                <!--</li>-->
            <!--</ul>-->
        </div>
</template>

<script>
    export default {
        data() {
            return {
                list: [],
                checklist: {
                    id: '',
                    content: '',
                    user_id: 1,
                    task_id: 58,
                    type: 1,
                    CheckListStatus: 1
                }
            };
        },

        created() {
            this.fetchCheckList();
        },

        methods: {
            fetchCheckList() {
                axios.get('api/checklist').then((res) => {
                    this.list = res.data;
                });
            },

            createTask() {
                axios.post('api/checklist', this.checklist)
                    .then((res) => {
                        this.checklist.content = '';
                        this.edit = false;
                        this.fetchCheckList();
                    })
                    .catch((err) => console.error(err));
            },

            // deleteTask(id) {
            //     axios.delete('api/tasks/' + id)
            //         .then((res) => {
            //             this.fetchCheckList()
            //         })
            //         .catch((err) => console.error(err));
            // },
        }
    }
</script>

<style scoped>

</style>
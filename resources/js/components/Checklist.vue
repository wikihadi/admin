<template>
    <div class="d-flex flex-column justify-content-between">
        <p class="text-dark p-3" data-toggle="collapse" :data-target="'#chk'+task">چک لیست</p>

        <div class="collapse" :id="'chk'+task">
            <div class="alert alert-warning">این بخش در حال تکمیل است</div>
        <form @submit.prevent="addChecklist()" autocomplete="off">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="content" v-model="content" class="form-control form-control-sm" placeholder="چک لیست">
                    <div class="input-group-append"><button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-check-circle"></i></button></div>
                </div>
            </div>
        </form>

        <ul>
            <li class="mr-3" v-for="item in loop">{{item.content}}</li>
        </ul>
    </div></div>
</template>

<script>
    export default {
        name: "Checklist",
        props:['user','task'],
        data(){
            return{
                loop:[]
            }
        },
        mounted() {
            this.fetchChecklist()
        },
        methods:{
            addChecklist: function(){
                if (this.content !== '') {
                    axios.post('/api/addStatusToBox', {
                        content: this.content,
                        user_id: this.user,
                        status: 'checklist',
                        task_id: this.task
                    })
                        .then(console.log('response'),this.content = '')
                }
            },
            fetchChecklist: function () {
                let url = '/api/fetchChecklist?u=' + this.user + '&task=' + this.task;
                axios.get(url).then(response => this.loop = response.data);
            }
        }

    }
</script>

<style scoped>

</style>

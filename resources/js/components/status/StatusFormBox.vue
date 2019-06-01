<template>
    <div>
        <form @submit.prevent="addStatus()">
            <input type="text" class="form-control" name="content" v-model="content" id="content" autofocus>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                content: ''
            }},
        methods:{
            addStatus(){
                axios.post('./api/addStatusToBox',{
                    content:this.content,
                    user_id: 1,
                    status: 'box'
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // Event.$emit('taskCreated',{title:this.title});
                this.content = '';

                // console.log('Adding');
            }
        }
    }
</script>

<style scoped>

</style>

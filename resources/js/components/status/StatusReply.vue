<template>
    <div>
        <span @click.prevent="isShow = true" class="" style="cursor: pointer"><i class="fa fa-reply"></i></span>
        <form @submit.prevent="addStatus()" v-if="isShow">
            <input type="text" class="form-control" name="content" v-model="content" id="content" autofocus>
            <input type="hidden" :value="this.reply_id" name="reply_id">
        </form>
    </div>
</template>

<script>
    export default {
        props:['reply_id','user','user_id'],
        data(){
            return{
                content: '',
                isShow: false
            }},
        methods:{

            addStatus(){
                if (this.content != '') {

                    axios.post('./api/addStatusToBox', {
                        content: this.content,
                        user_id: this.user,
                        status: 'status',
                        to_user: this.user_id,
                        reply_id: this.reply_id
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
    }
</script>

<style scoped>

</style>

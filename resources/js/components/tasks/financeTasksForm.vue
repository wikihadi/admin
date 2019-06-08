<template>
    <div>
        <form @submit.prevent="updateCost($event, id)">
            <div class="input-group mb-3">
                <input type="number" name="cost" v-model="taskCost" class="form-control" required>
                <div class="input-group-append input-group-prepend">
                    <span class="input-group-text">ريال</span>
                </div>
                <button type="submit" class="btn btn-success input-group-append">ثبت</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                taskCost: ''
            }
        },
        props:['id'],
        methods:{
            updateCost: function (event,id) {
                axios.post('/api/updateCost/' + id,{
                    cost: this.taskCost,
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // this.dataFetch();
            }
        }
    }
</script>

<style scoped>

</style>

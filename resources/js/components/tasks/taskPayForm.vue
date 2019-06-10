<template>
    <div>
        <i class="fa text-success fa-check" v-if="paid === 1"></i><i class="fa text-danger fa-close" v-if="paid === 0"></i>.{{id}}
    </div>
</template>

<script>
    import {AxiosInstance as axios} from "axios";

    export default {
        props:['id','paid'],
        data(){
            return{
                task:[]
            }
        },
        created: function(){
            let url = '/api/taskPayForm?ID=' + this.id;
            this.axios.get(url).then(response => this.task = response.data)
        },
        methods:{
            dataFetch: function(){
                let url = '/api/taskPayForm?ID=' + this.id;
                this.axios.get(url).then(response => this.task = response.data)
            },
        },
        name: "taskPayForm"
    }
</script>

<style scoped>

</style>

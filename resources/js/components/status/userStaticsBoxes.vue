<template>
    <div>
        <small data-toggle="tooltip" title="بروزرسانی" @click="dataFetch();isShow = true" style="cursor: pointer" class="ml-3 hvr-grow-rotate">
            <i class="fa fa-refresh"></i>
        </small>
        <ul class="list-group list-group-flush ">
            <li class="list-group-item" v-for="item in data">
                {{item.content}}
            </li>
        </ul>



    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                isShow : true,
                all:[],
                data:[]
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
                axios.get('/api/allStaticsBoxes?ID=' + this.user).then(response => this.data = response.data);
            },
        }

    }
</script>

<style scoped>
    li{
        font-size: smaller;

    }
</style>

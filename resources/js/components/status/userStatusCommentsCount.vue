<template>
    <div>
        <small><i class="fa fa-comments"></i> {{data}}</small>
        <small class="mx-2"></small>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                user: '',
                data: ''
            }
        },
        beforeMount: function () {
            this.dataFetch();
            this.timer = setInterval(this.dataFetch, 5000)
        },
        methods:{
            dataFetch: function(){
                let url = '/api/userStatusCommentsCount?ID=' + this.user;
                axios.get(url).then(response => this.data = response.data)
            },
        }

    }
</script>

<style scoped>

</style>

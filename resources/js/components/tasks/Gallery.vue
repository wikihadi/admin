<template>
    <div>
        <div class="row">
            <div class="col-md-6" v-for="item in loop">
                <div class="card">
                    <span class="position-absolute" style="top:5px;left:5px" v-if="item.star==1"><i class="fa fa-star text-warning"></i></span>
                    <a :href="'/storage/uploads/gallery/' + item.pic" target="_blank">
                        <img :title="item.content" :src="'/storage/uploads/gallery/' + item.pic" class="card-img-top" :alt="item.content">
                    </a>
                    <div class="card-body">
                        <p class="card-text text-dark">{{item.content}}</p>
                        <a href="#" class="btn text-danger btn-sm btn-link" v-if="user==item.user_id" @click.prevent="delGallery(item.id)"><i class="fa fa-trash text-danger"></i></a>
                        <a href="#" class="btn text-danger btn-sm btn-link" v-if="user==item.user_id" @click.prevent="starGallery(item.id)"><i class="fa fa-star text-warning"></i></a>

                    </div>
                </div>


                <!--<a :href="'/storage/uploads/gallery/' + item.pic" target="_blank"><img class="img-fluid   " :src="'/storage/uploads/gallery/' + item.pic"></a>-->
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "Gallery",
        props:['task','user'],
        data(){
            return{
                loop:[],
            }
        },
        created: function () {
            this.fetchGallery();
        },
        methods:{
            fetchGallery: function(){
                let url = '/api/fetchGallery?task=' + this.task;
                axios.get(url).then(response => this.loop = response.data);
            },
            delGallery: function(gal){

                if(confirm('Are you Sure?')){

                let url = '/api/delGallery?task=' + this.task + '&gal=' + gal;
                axios.get(url).then(response => this.loop = response.data);
                }
            },
            starGallery: function(gal){
                let url = '/api/starGallery?task=' + this.task + '&gal=' + gal;
                axios.get(url).then(response => this.loop = response.data);
            },
            alertx: function(){
                alert('در حال حاضر این امکان وجود ندارد');
            },
        }
    }
</script>

<style scoped>

</style>

<template>
        <div class="col-12 row d-flex justify-content-center">
            <div class="col-12" v-if="role=='admin'">
            <div class="text-left">
                <a href="/posts/create" class="btn btn-link" ><i class="fa fa-plus"></i></a>
            </div></div>
            <div class="col-xl-3">
                <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">

                    <div class="card card-border" @click="fetchPosts('all'),tab=0">
                        <div class="card-header card-border px-5 hvr-pulse pointer" :class="{'bg-light':tab!=0,'bg-info':tab==0}">
                            همه
                        </div>
                    </div>
                    <div class="card card-border" @click="fetchPosts('عمومی'),tab=1">
                        <div class="card-header card-border px-5 hvr-pulse pointer" :class="{'bg-light':tab!=1,'bg-info':tab==1}">
                            عمومی
                        </div>
                    </div>
                    <div class="card card-border" @click="fetchPosts('طراحی'),tab=2" v-if="role=='admin'||role=='designer'">
                        <div class="card-header card-border px-5 hvr-pulse pointer" :class="{'bg-light':tab!=2,'bg-info':tab==2}">
                            طراحی
                        </div>
                    </div>
                    <div class="card card-border" @click="fetchPosts('مالی'),tab=3" v-if="role=='admin'||role=='finance'">
                        <div class="card-header card-border px-5 hvr-pulse pointer" :class="{'bg-light':tab!=3,'bg-info':tab==3}">
                            مالی
                        </div>
                    </div>
                    <div class="card card-border" @click="fetchPosts('فروش'),tab=4" v-if="role=='admin'||role=='saleman'">
                        <div class="card-header card-border px-5 hvr-pulse pointer" :class="{'bg-light':tab!=4,'bg-info':tab==4}">
                            فروش
                        </div>
                    </div>
                    <div class="card card-border" @click="fetchPosts('draft'),tab=5" v-if="role=='admin'">
                        <div class="card-header card-border px-5 hvr-pulse pointer" :class="{'bg-dark':tab!=5,'bg-info':tab==5}">
                            پیشنویس
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-9">

                <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">



                            <a :href="'/posts/'+ post.id" v-for="post in posts">
                        <div class="card card-border">
                            <div class="card-header card-border px-5" :class="{'bg-info':post.read==0,'bg-secondary':post.read==1}">
                                <div class="badge badge-pill badge-light">{{post.id}}</div>
                                | {{post.title}}
                                <span class="badge badge-warning pull-left" v-if="post.read==0">خوانده نشده</span>
                                <a :href="'/posts/' + post.id + '/edit'" v-if="post.read==0&&role=='admin'"><span class="badge badge-dark pull-left hvr-pop"><i class="fa fa-edit"></i></span></a>
                                <span class="badge badge-light pull-left" v-if="post.read==1"><i class="fa fa-check"></i></span>
                            </div>
                            <div class="panel-footer">

<!--                                {{&#45;&#45;<favorite&#45;&#45;}}-->
<!--                                {{&#45;&#45;:post={{ $post->id }}&#45;&#45;}}-->
<!--                                {{&#45;&#45;:favorited={{ $post->verifyPost() ? 'true' : 'false' }}&#45;&#45;}}-->
<!--                                {{&ndash;&gt;</favorite>&#45;&#45;}}-->
                            </div>
                        </div>
                    </a>
                    <a href="/" class="btn btn-block btn-link">برگشت به خانه</a>


                </div>


            </div>
        </div>

</template>

<script>
    export default {
        name: "Posts",
        props:['role','user'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                posts:[],
                tab:0,
            }
        },
        mounted: function(){
            this.fetchPosts('all');
        },
        methods:{
            fetchPosts: function (rolePost) {
                let url = '/api/fetchPosts?user=' + this.user + '&role=' + this.role + '&rolePost=' + rolePost;
                axios.get(url).then(response => this.posts = response.data);
            }
        }
    }
</script>

<style scoped>

</style>

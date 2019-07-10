<template>
    <div class="col-12 row justify-content-center">
        <div class="col-xl-9 col-lg-10">
    <div class="card bg-dark">
        <div class="card-header">
            <div class="row justify-content-between pull-left">
                <div class="pointer" @click.prevent="minimize=!minimize"><i :class="{'fa-window-minimize':!minimize,'fa-window-maximize':minimize}" class="fa text-muted"></i></div>
            </div>
            <span v-if="minimize">نظرات اخیر</span>
            <div @click="refresh" v-if="!minimize" class="pointer"><i class="fa fa-refresh" title="بروزرسانی"></i> <small class="text-sm text-muted">{{dateN}}</small></div>
        </div>
        <transition name="fade">
            <div class="card-body" v-if="!minimize">
                <carousel :perPage="4" :center="true" :rtl="true" :loop="true" :autoplay="false" :speed="1000" :autoplayTimeout="5000" :paginationEnabled="true" :navigationEnabled="false">
                    <slide v-for="(item, index) in lastMyComments" :key="item.content"
                           data-index="0"
                           data-name="1">
                    <div class="card bg-dark mx-1">
                        <div class="text-sm text-muted card-header">
                            <img :src="'/storage/avatars/' + item.user.avatar" alt="" class="img-circle" style="width: 30px" :title="item.user.name">
                             {{item.task.title}}
                        </div>
                        <div class="card-body">
                            {{item.content}}
                        </div>
                        <div class="card-footer"><small class="pull-left text-sm badge badge-dark text-muted">{{item.diff}}</small></div>
                    </div>
                    </slide>
                </carousel>
            </div>
        </transition>
        <transition name="fade">
            <div class="card-footer" v-if="!minimize">

            </div>
        </transition>
    </div>
    </div>
    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components: {
            Carousel,
            Slide
        },
        name: "ReportDesigner",
        props:['user','users'],
        data(){
            return {
                timer:'',
                minimize:true,
                lastMyComments:[],
                dateN:''
            }
        },
        mounted() {
            this.fetchMyTasksLastComments();
            this.dateNew();
            // this.timer = setInterval(this.fetchMyTasksLastComments, 3000)
        },
        methods:{
            refresh: function(){
                this.fetchMyTasksLastComments();
                this.dateNew();
            },
            dateNew: function(){
                let d = new Date();
                let h = d.getHours();
                let m = d.getMinutes();
                let s = d.getSeconds();
                if (m < 10){
                    m = '0' + m;
                }
                if (s<10){
                    s = '0' + s;
                }
                this.dateN = h + ':' + m + ':' + s;
            },
            fetchMyTasksLastComments: function(){
                let url = '/api/fetchMyTasksLastComments?ID=' + this.user;
                axios.get(url).then(response => this.lastMyComments = response.data)
            },
        }
    }
</script>

<style scoped>
    .fade-enter-active , .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    .pointer{
        cursor:pointer
    }
</style>

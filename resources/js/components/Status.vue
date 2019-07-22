<template>
    <div>
        <div class="card bg-dark">
            <div class="row">
                <div class="col-md-3">
                    <img :src="'/storage/avatars/' + loop.user.avatar" class="w-100">
                </div>
                <div class="col-md-9 px-3">
                    <div class="card-block p-3">
                        <h4 class="card-title">{{loop.user.name}}</h4>
                        <span class="badge badge-secondary">{{loop.user.experience}}</span>
                        <hr>
<!--                        <small>بازدید امروز: {{loop.todayVisit}}</small>-->
<!--                        <br>-->
                        <small>ورود امروز: {{loop.getInToday.date.substr(11, 8)}}</small>
                    </div>
                </div>

            </div>
        </div>
<!--            <div class="card-header">-->
<!--                <img :src="'/storage/avatars/' + loop.user.avatar" class="img-top" alt="">-->
<!--            </div>-->
        <ul class="nav nav-tabs">
            <li class="nav-item pointer">
                <a class="nav-link" :class="{'active':showTab==1}" @click.prevent="fetch(1)">نظرات من</a>
            </li>
            <li class="nav-item pointer">
                <a class="nav-link" :class="{'active':showTab==2}" @click.prevent="fetch(2)">کارهای من</a>
            </li>
            <li class="nav-item pointer">
                <a class="nav-link" :class="{'active':showTab==3}" @click.prevent="fetch(3)">باکس های من</a>
            </li>
            <li class="nav-item pointer">
                <a class="nav-link" :class="{'active':showTab==4}" @click.prevent="fetch(4)">زمانهای کاری من</a>
            </li>
        </ul>
        <div class="p-5 text-center text-light" v-if="loading"><i class="fa fa-refresh fa-spin fa-3x"></i></div>
        <ul class="list-group list-group-flush bg-dark" v-if="listShow">
            <li class="list-group-item d-flex justify-content-between align-items-center bg-dark" v-for="item in loop.status.slice(0,showLoop)">
                <span v-if="showTab==2" class="badge badge-secondary">{{item.content}}</span>
                <span v-else>{{item.content}}</span>
                <div>
                    <span class="badge badge-secondary badge-pill">{{item.diff}}</span>
                <span class="badge badge-success badge-pill">{{item.task_id}}</span>

                </div>
            </li>
        </ul>
        <select v-model="showLoop" class="bg-dark form-control form-control-sm" v-if="listShow && loop.status.length >= 5">
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="1000">1000</option>
        </select>
    </div>

</template>

<script>
    export default {
        name: "Status",
        props:['user','users'],
        data(){
            return{
                showTab:1,
                loop:[],
                showLoop:10,
                loading:true,
                listShow:false
            }
        },
        mounted: function(){
                this.statusesFetch(1)
        },
        methods:{
            fetch: function(code){
                this.showLoop=10;
                this.loading=true;
                this.showTab=code;
                this.statusesFetch(code);
            },
            statusesFetch: function(s){
                this.listShow=false;

                let url = '/api/statusesFetch?u=' + this.user + '&s=' + s;
                axios.get(url).then(response => this.loop = response.data);
                setTimeout(this.loadSpinner, 2000);
            },
            loadSpinner: function(){
                this.loading=false;
                this.listShow=true;

            },
        }

    }
</script>

<style scoped>
    .pointer{
        cursor:pointer
    }
</style>

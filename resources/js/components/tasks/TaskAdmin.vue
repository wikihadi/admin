<template>
    <div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link pointer" @click="updateAll">بروز کردن داده ها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pointer" @click="showCost=!showCost">ستون درآمد</a>
            </li>
            <!--<li class="nav-item">-->
                <!--<a class="nav-link pointer" @click="tasksShow=false">بر اساس فعالیت (50)</a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
                <!--<a class="nav-link pointer" @click="tasksFetch">لیست کلی کارها</a>-->
            <!--</li>-->
        </ul>
        <!--<table class="table table-sm table-responsiv w-100" v-if="!tasksShow">-->
            <!--<thead>-->
            <!--<tr>-->
                <!--<th>ID</th>-->
                <!--<th>عنوان کار</th>-->
                <!--<th>کاربر</th>-->
                <!--<th>وضعیت جدید</th>-->
                <!--<th v-if="showCost">درآمد</th>-->
                <!--<th>عملیات</th>-->
            <!--</tr>-->
            <!--</thead>-->
            <!--<tbody>-->
            <!--<tr v-for="item in loop" :class="item.bg">-->
                <!--<td>{{item.id}}</td>-->
                <!--<td>{{item.task.id}}.{{item.task.title}}</td>-->
                <!--<td>{{item.user.name}}</td>-->
                <!--<td>{{item.statusFa}}</td>-->
                <!--<td v-if="showCost">{{item.task.costc}}</td>-->
                <!--<td>-->
                    <!--<div class="btn-group" role="group" aria-label="Basic example">-->
                        <!--<button class="btn btn-outline-secondary" @click="taEndFetch(item.task.id)" v-if="more">درآمد</button>-->
                        <!--<a :href="'/tasks/'+item.task.id" class="btn btn-outline-success" target="_blank">مشاهده تسک</a>-->
                    <!--</div>-->



                <!--</td>-->
                <!--&lt;!&ndash;<td v-else></td>&ndash;&gt;-->
            <!--</tr>-->
            <!--</tbody>-->

        <!--</table>-->
        <!--<table class="table table-sm table-responsiv w-100" v-if="tasksShow">-->

            <!--<thead>-->
            <!--<tr>-->
                <!--<th></th>-->
                <!--<th>-->
                    <!--<input type="text" v-model="keyword" class="form-control" placeholder="جستجوی عنوان">-->

                <!--</th>-->
                <!--<th colspan="2"></th>-->

            <!--</tr>-->
            <!--<tr>-->
                <!--<th>ID</th>-->
                <!--<th>عنوان کار</th>-->
                <!--<th v-if="showCost">درآمد</th>-->
                <!--<th>عملیات</th>-->
            <!--</tr>-->
            <!--</thead>-->
            <!--<tbody>-->
            <!--<tr v-for="item in filteredList" :class="item.bg">-->
                <!--<td>{{item.id}}</td>-->
                <!--<td>{{item.title}}</td>-->
                <!--<td v-if="showCost">-->
                    <!--<button class="btn btn-outline-secondary btn-sm" @click="taEndFetch(item.id)" v-if="more"><i class="fa fa-cog"></i></button>-->
                    <!--{{item.costc}}</td>-->
                <!--<td>-->
                    <!--<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">-->

                    <!--&lt;!&ndash;<button class="btn btn-outline-secondary" @click="taEndFetch(item.id)" v-if="more"><i class="fa fa-cog"></i></button>&ndash;&gt;-->
                    <!--<a :href="'/tasks/'+item.id" class="btn btn-outline-success" target="_blank"><i class="fa fa-eye"></i></a>-->
                    <!--</div>-->

                <!--</td>-->
            <!--</tr>-->
            <!--</tbody>-->

        <!--</table>-->
        <!--<table class="table table-sm table-responsiv w-100" v-if="tasksShow">-->


        <sorted-table :values="values">
            <thead>
            <tr>
                <th scope="col" style="text-align: left; width: 10rem;">
                    <sort-link name="id">ID</sort-link>
                </th>
                <th scope="col" style="text-align: left; width: 10rem;">
                    <sort-link name="name">Name</sort-link>
                </th>
                <th scope="col" style="text-align: left; width: 10rem;">
                    <sort-link name="hits">Hits</sort-link>
                </th>
            </tr>
            </thead>
            <tbody slot="body" slot-scope="sort">
            <tr v-for="value in sort.values" :key="value.id">
                <td>{{ value.id }}</td>
                <td>{{ value.name }}</td>
                <td>{{ value.hits }}</td>
            </tr>
            </tbody>
        </sorted-table>



        <input type="text" v-model="keyword" class="form-control" placeholder="جستجوی عنوان">

        <sorted-table :values="filteredList">

            <thead>
            <!--<tr>-->
                <!--<th></th>-->
                <!--<th>-->
                    <!--<input type="text" v-model="keyword" class="form-control" placeholder="جستجوی عنوان">-->

                <!--</th>-->
                <!--<th colspan="2"></th>-->

            <!--</tr>-->
            <tr>
                <th scope="col">
                    <sort-link name="id">ID</sort-link>
                </th>
                <th scope="col">
                    <sort-link name="title">
                    عنوان کار
                    </sort-link>
                </th>

                <th v-if="showCost" scope="col">
                    <sort-link name="cost">
                    درآمد
                    </sort-link>
                </th>
                <th scope="col">
                    <!--<sort-link name="title">-->
                    عملیات
                    <!--</sort-link>-->
                </th>
            </tr>
            </thead>

                <tbody slot="body" slot-scope="sort">
            <tr v-for="value in sort.values" :class="value.bg" :key="value.id">
                <td>{{value.id}}</td>
                <td>{{value.title}}</td>
                <td v-if="showCost">
                    <button class="btn btn-outline-secondary btn-sm" @click="taEndFetch(value.id)" v-if="more"><i class="fa fa-cog"></i></button>
                    {{value.costc}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                    <!--<button class="btn btn-outline-secondary" @click="taEndFetch(item.id)" v-if="more"><i class="fa fa-cog"></i></button>-->
                    <a :href="'/tasks/'+value.id" class="btn btn-outline-success" target="_blank"><i class="fa fa-eye"></i></a>
                    </div>

                </td>
            </tr>

            </tbody>
            </sorted-table>

        <!--</table>-->
        <div class="bg-dark p-3 w-100" style="bottom: 0;position: fixed;right: 0" v-if="showBox">
            <div class="card bg-dark">
                <div class="card-header">

                    <button class="btn btn-sm btn-outline-secondary mb-3" @click="showBox=!showBox,more=true,showForm=false"><i class="fa fa-close"></i></button>
                    <h5>{{task.title}}</h5>
                    درآمد فعلی:
                    <span>{{task.cost}}</span> ريال
                </div>

                <div class="card-footer">

                    <div>
                    <button class="btn btn-sm btn-primary" @click="showForm=!showForm" v-if="!showForm">بروزرسانی هزینه</button>
                    <!--<a :href="'/tasks/'+task.id" class="btn btn-outline-success btn-sm" target="_blank">مشاهده تسک</a>-->
                    </div>
                    <form class="form-inline" @submit.prevent="taUpdateCost(task.id)" v-if="showForm">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" placeholder="مبلغ بریال" v-model="costn">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit">بروز رسانی هزینه</button>
                            </div>
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TaskAdmin",
        props:['user','tasks'],
        data(){
            return{
                loop:"",
                task:'',
                showBox:false,
                showForm:false,
                showCost:false,
                tasksShow:true,
                keyword: '',
                more:true,
                costn:'',
                tasksList:this.tasks,
            }
        },
        mounted: function(){
            this.updateAll();
        },
        computed: {
            filteredList() {
                return this.tasksList.filter((task) => {
                    return this.keyword.toLowerCase().split(' ').every(v => task.title.toLowerCase().includes(v));
                });
            },
            // sumCost(){
            //     return this.tasksList.
            // }
        },
        methods: {
            updateAll: function(){
                // this.taFetch();
                this.tasksFetch();

            },
            taUpdateCost: function(task){
                console.log('Start');
                let url = '/api/taskAdminAPI?taskId=' + task + '&cost=' + this.costn + '&userId=' + this.user.id;
                axios.get(url).then(response => this.loop = response.data);
                console.log('Done');
                this.updateAll();
                this.showForm=false;
                this.costn='';
                this.taEndFetch(task);
            },
            taFetch: function(){
                console.log('Start');
                let url = '/api/taskAdminAPI?userId=' + this.user.id;
                axios.get(url).then(response => this.loop = response.data);
                console.log('Done');
            },
            tasksFetch: function(){
                console.log('Start Tasks');
                let url = '/api/taskAdminAPI?tasks=1&userId=' + this.user.id;
                axios.get(url).then(response => this.tasksList = response.data,
                    this.tasksShow=true

            );
                console.log('Done');
            },
            taEndFetch: function(t){
                console.log('Start');
                this.task='';
                let url = '/api/taskEndAdminAPI?task_id=' + t;
                axios.get(url).then(response => this.task = response.data);
                this.showBox=true;
                this.more=false;
                console.log('Done');
            },

        },

    }
</script>

<style scoped>

</style>

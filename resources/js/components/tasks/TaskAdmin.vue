<template>
    <div>
    <div class="d-flex justify-content-between">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link pointer" @click="showCost=!showCost" title="ستون درآمدها"><i class="fa fa-dollar"></i></a>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-item" v-if="role!=2">
                <a class="nav-link pointer text-primary" @click="updateAll" title="کارها"><i class="fa fa-tasks"></i></a>
            </li>
        <li class="nav-item" v-if="role==1">
            <a class="nav-link pointer text-muted" @click="loadMinus" title="کارهایی که درآمد به آنها تعلق نمی گیرد"><i class="fa fa-tasks"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pointer text-warning" @click="loadPayOk" title="کارهایی که تایید شده"><i class="fa fa-tasks"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pointer text-success" @click="loadPaid" title="کارهایی که پرداخت شده"><i class="fa fa-tasks"></i></a>
        </li>
        </ul>
    </div>


        <input type="text" v-model="keyword" class="form-control" placeholder="جستجوی عنوان">

        <sorted-table :values="filteredList">

            <thead>

            <tr>
                <th scope="col">
                    <sort-link name="id">ID</sort-link>
                </th>
                <th scope="col">
                    <sort-link name="title">
                    عنوان پروژه
                    </sort-link>
                </th>
                <th scope="col">
                    <sort-link name="brand">
                    برند
                    </sort-link>
                </th>

                <th v-if="showCost" scope="col">
                    <sort-link name="cost">
                        <i class="fa fa-dollar"></i>
                    </sort-link>
                </th>
            </tr>
            </thead>

                <tbody slot="body" slot-scope="sort">
            <tr v-for="value in sort.values" :key="value.id" :class="{'table-dark':value.cost==-1,'table-success':value.paid==1,'table-warning':value.payOK==1&&value.paid==0}">
                <td>                    <a :href="'/tasks/'+value.id" class="" target="_blank">{{value.id}}</a>
                    </td>
                <td>{{value.title}}</td>
                <td>{{value.brand}}</td>
                <td v-if="showCost">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example"  v-if="role==2 && value.payOK==1 && value.paid==0">
                        <button class="btn btn-outline-warning" @click="paid(value.id)" v-if="more"><i class="fa fa-check"></i></button>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example"  v-if="role==3 && value.payOK==0">
                        <button class="btn btn-outline-success" @click="payOK(value.id)" v-if="more"><i class="fa fa-check"></i></button>
                        <button class="btn btn-outline-warning" @click="taEndFetch(value.id)" v-if="more"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example"  v-if="role==1">
                        <span v-if="value.cost>-1" class="btn btn-outline-danger" @click="costn=-1,taUpdateCostMinus(value.id)"><i class="fa fa-archive"></i></span>
                        <button class="btn btn-outline-warning" @click="taEndFetch(value.id)" v-if="more"><i class="fa fa-edit"></i></button>
                    </div>
                    <span v-if="value.cost>-1">{{value.costc}}</span>
                    <span v-else>درآمدی ثبت نشده</span>
                </td>
            </tr>

            </tbody>
            </sorted-table>

        <div class="bg-dark p-3 w-100" style="bottom: 0;position: fixed;right: 0" v-if="showBox">
            <div class="card bg-dark">
                <div class="card-header">

                    <button class="btn btn-sm btn-outline-secondary mb-3" @click="showBox=!showBox,more=true,showForm=false"><i class="fa fa-close"></i></button>
                    <h5>{{task.title}}</h5>
                    درآمد فعلی:
                    <span v-if="task.cost>-1">{{task.cost}} ريال</span>
                    <span v-else>این کار درآمدی ندارد</span>
                </div>

                <div class="card-footer">

                    <div>

                        <button class="btn btn-sm btn-primary" @click="showForm=!showForm" v-if="!showForm">درج یا ویرایش درآمد</button>
                    </div>
                    <form class="form-inline" @submit.prevent="taUpdateCost(task.id)" v-if="showForm">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" placeholder="مبلغ بریال" v-model="costn">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" >بروز رسانی</button>
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
        props:['user','tasks','role'],
        data(){
            return{
                loop:"",
                task:'',
                showBox:false,
                showForm:false,
                showCost:true,
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
        },
        methods: {

            updateAll: function(){
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
            taUpdateCostMinus: function(task){
                let url = '/api/taskAdminAPI?taskId=' + task + '&cost=' + this.costn + '&userId=' + this.user.id;
                axios.get(url).then(response => this.loop = response.data);
                this.updateAll();
                this.costn='';
            },
            tasksFetch: function(){
                console.log('Start Tasks');
                let url = '/api/taskAdminAPI?tasks=1&userId=' + this.user.id + '&role=' + this.role;
                axios.get(url).then(response => this.tasksList = response.data,

            );
                console.log('Done');
            },
            loadMinus: function(){
                let url = '/api/taskAdminAPI?minus=1&tasks=1&userId=' + this.user.id;
                axios.get(url).then(response => this.tasksList = response.data,);
            },
            loadPayOk: function(){
                let url = '/api/taskAdminAPI?payOk=1&tasks=1&userId=' + this.user.id;
                axios.get(url).then(response => this.tasksList = response.data,);
            },
            loadPaid: function(){
                let url = '/api/taskAdminAPI?paid=1&tasks=1&userId=' + this.user.id;
                axios.get(url).then(response => this.tasksList = response.data,);
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

            paid: function(t){
                let url = '/api/taskAccAdminAPI?acc=2&task_id=' + t + '&userId=' + this.user.id;
                axios.get(url).then(response => this.task = response.data);
                this.updateAll();

            },

            payOK: function(t){
                let url = '/api/taskAccAdminAPI?acc=1&task_id=' + t + '&userId=' + this.user.id;
                axios.get(url).then(response => this.task = response.data);
                this.updateAll();

            },

        },

    }
</script>

<style scoped>

</style>

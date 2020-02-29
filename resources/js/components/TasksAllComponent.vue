<template>
    <div>
        <span class="badge badge-info badge-pill">بدون تیم</span>
        <span class="badge badge-dark badge-pill">{{orderNew.length}} پروژه</span>

        <!--<div class="mx-1 hvr-grow" @click="all">-->
            <!--<i class="fa fa-archive" data-toggle="tooltip" title="کارهای آرشیوی"></i>-->
        <!--</div>-->
    <draggable :list="orderNew" :element="'div'" :options="{animation:300}" handle=".handleTask" @change="update">
        <div v-for="task in orderNew">
            <div class="card card-border">
                <div class="card-header card-border"
                     v-bind:class="{'bg-info' : task.user_order.length<1,'bg-light':task.user_order.length>0}">
                    <div class="row">
                        <div class="col-md-9 row">
                            <div class="col-12 col-md-4 row">
                                <div class="col-2 d-none d-md-block handleTask text-center"><i class="fa fa-arrows-v"></i></div>
                                <div class="col-10 text-right">
                                    <span v-if="task.orderTask!==0" v-text="task.orderTask + ' .'" ></span>
                                    <span v-text="task.title"></span>
                                    <span v-text="task.id" class="badge-dark badge"></span>
                                </div>
                                <div class="col-2 d-md-none handleTask text-left"><i class="fa fa-arrows-v"></i></div>
                            </div>
                            <div class="d-none d-md-block col-lg-2 text-right">
                            <span v-if="task.type && task.brand !== 'سایر'">
                                {{task.brand}}
                            </span>
                                <span v-else>-</span>
                            </div>
                            <div class="d-none d-lg-block col-lg-2 text-right">
                            <span v-if="task.type && task.type !== 'سایر'">
                                {{task.type}}
                            </span>
                                <span v-else>-</span>
                            </div>
                            <div class="d-none d-lg-block col-lg-2 text-right">
                            <span v-if="task.type && task.forProduct !== 'سایر'">
                                {{task.forProduct}}
                            </span>
                                <span v-else>-</span>
                            </div>

                            <div class="d-none d-lg-block col-lg-2 text-right">

                            </div>
                        </div>
                        <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                            <div v-for="u in task.user_order" class="mx-1">
                                    <img :src="'/storage/avatars/' + u.avatar" :alt="u.name" class="img-circle" style="object-fit: cover; width: 29px;height: 29px; border: 1px solid #a9a9a9;" :title="u.name" data-toggle="tooltip">
                            </div>
                            <div class="flex-grow-1"></div>
                            <div class="d-flex">
                                <div class="mx-1 hvr-grow" @click="end(task.id)">
                                        <i class="fa fa-archive" data-toggle="tooltip" title="پایان کار"></i>
                                </div>
                                <div class="mx-1 hvr-grow">
                                    <a :href="'/tasks/' + task.id + '/edit'">
                                        <i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش"></i>
                                    </a>
                                </div>
                                <div class="mx-1 hvr-backward">
                                    <a :href="'/tasks/' + task.id"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </draggable>
    </div>

</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        props: ['tasks','us','uts','role'],
        data(){
            return{
                orderNew: this.tasks,
            }
        },
        methods: {
            // routineToggle(id) {
            //
            //     const url = `/jobs/updateRoutine`;
            //     axios.put(url,id).then((response) => {
            //         //
            //     })
            // },
            // routineToggle(id){
            //     let uri = '/jobs/updateRoutine/' + id;
            //     this.axios.get(uri);
            //
            //
            // },
            update() {
                this.orderNew.map((task, index) => {
                    task.orderTask = index + 1;
                })

                axios.put('/jobs/updateAll',{
                    order: this.orderNew
                }).then((response) => {
                    //success
                })
            },
            end(id){
                let url = '/api/jobs/taskIsDone?id='+ id;
                axios.get(url).then(response => this.orderNew = response.data);
            }
        },

        // mounted() {
        //     console.log('Component mounted.')
        // }
    }
</script>
<style>
    .bg-pink2{
        background: #F8BBD0;
    }
</style>

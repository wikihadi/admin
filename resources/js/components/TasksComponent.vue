<template>
    <draggable :list="orderNew" :element="'div'" :options="{animation:300}" @change="update">

        <div v-for="(ord, index) in orderNew">

    <div v-for="(task, index) in tasks" v-if="task.id == ord.task_id">
        <div class="card card-border">

            <div class="card-header card-border" v-bind:class="{ 'bg-info' : task.pending == 1 , 'bg-dark' : task.pending == 0 }">
                <div class="row">

                    <div class="col-md-9 row">
                        <div class="col-12 col-md-4 text-center text-md-right">{{ord.order_column}}.{{ task.title.substring(0,40)+".."}}</div>
                        <div class="d-none d-lg-block col-lg-2 text-center">
                            <span v-if="task.type && task.brand != 'سایر'">
                                {{task.brand}}
                            </span>
                            <span v-else>-</span>
                        </div>
                        <div class="d-none d-lg-block col-lg-2 text-center">
                            <span v-if="task.type && task.type != 'سایر'">
                                {{task.type}}
                            </span>
                            <span v-else>-</span>
                        </div>
                        <div class="d-none d-lg-block col-lg-2 text-center">
                            <span v-if="task.type && task.forProduct != 'سایر'">
                                {{task.forProduct}}
                            </span>
                            <span v-else>-</span>

                        </div>

                        <div class="d-none d-lg-block col-lg-2 text-center">

                        </div>
                    </div>
                    <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                        <div class="flex-grow-1">


                        </div>

{{users}}



                        <div class="mx-1 hvr-grow">
                            <a :href="'/tasks/' + task.id + '/edit'">
                                <i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش"></i></a>
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
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        props: ['order','tasks'],
        data(){
          return{
              orderNew: this.order,
          }
        },

        methods: {
            update() {
                this.orderNew.map((ord, index) => {
                  ord.order_column = index + 1;
                })

                axios.put('/jobs/updateAll',{
                    order: this.orderNew
                }).then((response) => {
                    //success
                })

            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

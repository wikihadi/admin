<template>
    <draggable :list="orderNew" :element="'div'" :options="{animation:300}" handle=".handleTask" @change="update">

        <div v-for="ord in orderNew">

        <div class="card card-border">
            <div class="card-header card-border" v-bind:class="{ 'bg-info': ord.lastStatus === '0', 'bg-light': ord.lastStatus === '1', 'bg-success': ord.lastStatus === '2', 'bg-dark': ord.lastStatus === '3' }">
                <div class="row">

                    <div class="col-md-9 row">
                        <div class="col-12 col-md-4 row">
                            <div class="col-2 d-none d-md-block handleTask text-center"><i class="fa fa-arrows-v"></i></div>
                            <div class="col-10">
                                <span v-text="ord.order_column"></span>
                                <span>.</span>
                                <span v-text="ord.task.title"></span>
                            </div>
                            <div class="col-2 d-md-none handleTask text-left"><i class="fa fa-arrows-v"></i></div>



                        </div>
                        <div class="d-none d-lg-block col-lg-2 text-center">
                            <span v-if="ord.task.type && ord.task.brand != 'سایر'">
                                {{ord.task.brand}}
                            </span>
                            <span v-else>-</span>
                        </div>
                        <div class="d-none d-lg-block col-lg-2 text-center">
                            <span v-if="ord.task.type && ord.task.type != 'سایر'">
                                {{ord.task.type}}
                            </span>
                            <span v-else>-</span>
                        </div>
                        <div class="d-none d-lg-block col-lg-2 text-center">
                            <span v-if="ord.task.type && ord.task.forProduct != 'سایر'">
                                {{ord.task.forProduct}}
                            </span>
                            <span v-else>-</span>
                        </div>

                        <div class="d-none d-lg-block col-lg-2 text-center">

                        </div>
                    </div>
                    <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">
                        <div class="flex-grow-1">


                        </div>




                        <div v-for="ut in uts" v-if="ut.task_id === ord.task.id">
                            <div class="mx-1 hvr-pop" v-for="u in us" v-if="u.id === ut.user_id">
                                <img :src="'/storage/avatars/' + u.avatar" alt="" class="img-circle" style="object-fit: cover; width: 29px;height: 29px; border: 1px solid #a9a9a9;" :title="u.name" data-toggle="tooltip">
                            </div>

                        </div>





                        <div class="mx-1 hvr-grow">
                                <i class="fa fa-bars" data-toggle="tooltip" title="" v-if="ord.routine == 0"></i>
                                <i class="fa fa-edit" data-toggle="tooltip" title="" v-else></i>
                        </div>
                        <div class="mx-1 hvr-grow">
                            <a :href="'/tasks/' + ord.task.id + '/edit'">
                                <i class="fa fa-edit" data-toggle="tooltip" title=" ویرایش"></i></a>
                        </div>

                        <div class="mx-1 hvr-backward">
                            <a :href="'/tasks/' + ord.task.id"><i class="fa fa-arrow-left" data-toggle="tooltip" title="برو"></i></a>
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
        props: ['order','tasks','us','uts'],
        data(){
          return{
              orderNew: this.order,
          }
        },
        methods: {
            // formSubmit(e) {
            //     e.preventDefault();
            //     let currentObj = this;
            //     this.axios.post('http://localhost:8000/yourPostApi', {
            //         name: this.name,
            //         description: this.description
            //     })
            //         .then(function (response) {
            //             currentObj.output = response.data;
            //         })
            //         .catch(function (error) {
            //             currentObj.output = error;
            //         });
            // },
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

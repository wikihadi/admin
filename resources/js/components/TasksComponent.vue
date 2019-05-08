<template>
    <!--<table>-->
        <!--<tr>-->
            <!--<td>id</td>-->
            <!--<td>task_id</td>-->
            <!--<td>user_id</td>-->
            <!--<td>order</td>-->
            <!--<td></td>-->
        <!--</tr>-->
        <!--<tr v-for="(ord, index) in order">-->
            <!--<td>{{ord.id}}</td>-->
            <!--<td>{{ord.task_id}}</td>-->
            <!--<td>{{ord.user_id}}</td>-->
            <!--<td>{{ord.order_column}}</td>-->
            <!--<td></td>-->
        <!--</tr>-->

    <!--</table>-->
    <draggable :list="orderNew" :element="'div'" :options="{animation:200}" @change="update">
    <div v-for="(ord, index) in orderNew">
    <div v-for="(task, index) in tasks" v-if="task.id == ord.task_id">
    <div class="upDown"  >
        <div class="card card-border">
            <div class="card-header card-border bg-success">
                <div class="row">
                    <div class="col-md-9 row">{{ord.order_column}}</div>
                    <div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">{{task.title}}</div>
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

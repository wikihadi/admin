<template>
    <div class="col-md-8">
        <div v-if="role==1" class="text-light">
            <form action="/lunch/add" class="row" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group col-md">
                    <label for="name">نام غذا:</label>
                    <input type="text" id="name" name="name" v-model="name" class="form-control form-control-sm" placeholder="نام غذا" required>
                </div>
                <div class="form-group col-md">
                    <label for="name">توضیحات غذا:</label>
                    <input  type="text" id="content" name="content" v-model="content" class="form-control form-control-sm" placeholder="توضیحات غذا" required>
                </div>
                <div class="form-group col-md">
                    <label for="name">روز:</label>
                    <input type="date" id="day" name="day" v-model="day" class="form-control form-control-sm" placeholder="روز غذا" required>
                </div>
                <div class="form-group col-12">

                    <button type="submit" class="btn btn-success btn-block btn-sm">افزودن غذا</button>
                </div>
            </form>
        </div>
        <table class="table table-striped table-light w-100">

            <thead>
            <tr>
                <th scope="col" class="text-center">نام غذا</th>
                <th scope="col" class="text-center">توضیحات</th>
                <th scope="col" class="text-center">روز</th>
<!--                <th scope="col" colspan="2">مورد علاقه</th>-->
            </tr>
<!--            <tr>-->
<!--                <th scope="col" colspan="3">-->
<!--                    <input type="text" v-model="keyword" class="form-control" placeholder="جستجوی نام">-->
<!--                </th>-->
<!--            </tr>-->
            </thead>
            <tbody>
            <tr v-for="i in list">
                <td class="text-center">{{i.name}}</td>
                <td class="text-center">{{i.content}}</td>
                <td class="text-center">{{i.jday}}</td>
<!--                <td>{{i.like}}</td>-->
<!--                <td class="text-left hvr-push pointer"><i class="fa fa-heart text-danger"></i></td>-->
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "Lunch",
        props:['user','list','role'],

        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name:'',
                content:'',
                day:'',
             }
        },
        methods:{
          addFood: function(){
              let url = '/api/addFood?role=' + this.role + '&day=' + this.day + '&user=' + this.user + '&name=' + this.name + '&content=' + this.content;
              axios.get(url).then(
                  response => this.list = response.data,
                  // this.name='',
                  // this.content='',
                  // this.day='',
              );
          }
        },

            computed: {
            // filteredList() {
            //     return this.lunchList.filter((lunchList) => {
            //         return this.keyword.toLowerCase().split(' ').every(v => lunchList.name.toLowerCase().includes(v));
            //     });
            // },
        }
    }
</script>

<style scoped>

</style>

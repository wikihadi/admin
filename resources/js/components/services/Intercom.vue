<template>
    <div class="col-md-8">
        <table class="table table-striped table-light w-100">

            <thead>
            <tr>
                <th scope="col">داخلی</th>
                <th scope="col">نام</th>
                <th scope="col">سمت</th>
            </tr>
            <tr>
                <th scope="col" colspan="3">
                    <input type="text" v-model="keyword" class="form-control" placeholder="جستجوی نام">
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="i in filteredList">
                <td>{{i.tel}}</td>
                <td>{{i.name}}</td>
                <td>{{i.post}}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "Intercom",
        props:['user','intercom'],

        data(){
            return{
                keyword: '',
                tel: '',
                post: '',
             }
        },
         computed: {
            filteredList() {
                return this.intercom.filter((intercom) => {
                    return this.keyword.toLowerCase().split(' ').every(v => intercom.name.toLowerCase().includes(v));
                });
            },
        }
    }
</script>

<style scoped>

</style>

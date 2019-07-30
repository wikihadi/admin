<template>
    <div>

        <table class="table">
            <tr v-for="item in loop">
                <td>{{item.content}}</td>
            </tr>
        </table>

    </div>
</template>

<script>
    export default {
        name: "Checklist",
        props:['user','task'],
        data(){
            return{
                loop:[]
            }
        },
        mounted() {
            this.fetchChecklist()
        },
        methods:{
            fetchChecklist: function () {
                let url = '/api/fetchChecklist?u=' + this.user + '&task=' + this.task;
                axios.get(url).then(response => this.loop = response.data);
            }
        }

    }
</script>

<style scoped>

</style>

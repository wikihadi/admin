<template>
    <div>
        <div class="p-3">
        <form @submit.prevent="addStatus()">
            <div class="input-group">
                <div class="input-group-prepend">
                <select name="to_user" v-model="toUserId" class="form-control form-control-sm bg-dark" placeholder="asd" required>
                <option v-for="u in users" :value="u.id" class="bg-dark">{{u.name}}</option>
            </select></div>
            <input type="text" class="form-control form-control-sm bg-dark" name="content" v-model="content" id="content" placeholder="متن پیام" required>
                <div class="input-group-append">
                    <button class="btn btn-success btn-sm" type="submit">ارسال</button>
                </div>


            </div>
        </form>
        </div>
        <div class="list-group collapse show list-group-flush bg-dark" id="myActivities">

            <a class="list-group-item bg-dark" v-for="item in loop.slice(0, commentsToShow)" >
<!--                <div v-if="item.to_user.id !== this.user">-->
                <img v-if="item.to_user.id != user" :src="'/storage/avatars/' + item.user.avatar" alt="" class="ml-3 img-circle " style="width: 45px" :title="item.to_user.name">
                <img v-if="item.to_user.id != user" :src="'/storage/avatars/' + item.to_user.avatar" alt=""  style="width: 28px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" :title="item.to_user.name">
<!--                </div>-->
<!--                <div>-->
                <img  v-if="item.to_user.id == user" :src="'/storage/avatars/' + item.user.avatar" alt="" class="img-size-50 ml-3 img-circle " :title="item.user.name">
<!--                </div>-->
                <small>{{item.content}}</small>
                <span class="float-left" style="font-size: 85%">
                                    <small>{{item.diff}}
                                    </small></span>
<!--                <status-reply class="d-inline" :user="user" :reply_id="item.id" v-bind:user_id="item.user_id"></status-reply>-->



            </a>

            <a @click.prevent="commentsToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="commentsToShow > 5"><i class="fa fa-arrow-up"></i></a>
            <a @click.prevent="commentsToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-arrow-down"></i></a>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user','users'],
        data(){
            return{
                content: '',
                toUserId: '',
                loop:[],
                userID: this.user,
                commentsToShow: 5
            }},
        beforeMount(){
            this.dataFetch();
            this.timer = setInterval(this.dataFetch, 60000)

        },
        methods:{
            dataFetch: function(){
                let url = '/api/commentList?ID=' + this.user;
                axios.get(url).then(response => this.loop = response.data)
            },
            addStatus(){
                if (this.content != '') {

                    axios.post('./api/addStatusToBox', {
                        content: this.content,
                        user_id: this.user,
                        status: 'status',
                        to_user: this.toUserId,
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    // Event.$emit('taskCreated',{title:this.title});
                    this.content = '';
                    this.toUserId = '';
                    this.dataFetch()
                    // console.log('Adding');
                }
            }
        }
    }
</script>

<style scoped>

</style>

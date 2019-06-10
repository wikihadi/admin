<template>
    <div>
        <div class="list-group collapse list-group-flush bg-dark tasks">
            <form @submit.prevent="addStatus(user)">
                <input type="text" class="form-control bg-dark" name="content" v-model="content" placeholder="اینجا بنویس..." id="content" autofocus>
            </form>
            <div class="list-group-item bg-dark" v-for="item in loop.slice(0, commentsToShow)" :id="'box-' + item.id">
<!--                <form  method="post" action="{{ route('status.store') }}" onsubmit="return confirm('شروع پروژه . در صورتی که کاری باز از گذشته داشته باشید، به صورت خودکار زمان کار قبلی متوقف خواهد شد.');">-->
<!--                    @csrf-->
<!--                    <input type="hidden" name="user_id" value="{{Auth::id()}}">-->
<!--                    <input type="hidden" name="task_id" value="{{$or->task->id}}">-->
<!--                    <input type="hidden" name="status" value="start">-->
<!--                    <input type="hidden" name="content" value="شروع کار {{$or->task->id}} - {{$or->task->title}}">-->
<!--                    <a href="/tasks/{{$or->task->id}}">-->
<!--                <button @click.prevent="CheckItem()" class="btn btn-link text-white"><i class="fa fa-check-circle"></i></button>-->
                <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, item.id)"></i> <small>{{item.content}}</small>
<!--                </a>-->
<!--                    @if($or->lastStatus != 2)-->
<!--                    <button class="btn btn-link text-light p-0 mx-1 float-left" title="شروع کار {{$or->task->title}}" type="submit" data-toggle="tooltip"><i class="fa fa-play"></i></button>-->
<!--                    @endif-->
<!--                </form>-->
        </div>
<!--            <a href="/tasks?sort=routine" class="dropdown-footer"><small>همه</small></a>-->
            <a @click.prevent="commentsToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="commentsToShow > 5"><i class="fa fa-arrow-up"></i></a>
            <a @click.prevent="commentsToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-arrow-down"></i></a>

        </div>

    </div>
</template>

<script>
    export default {



        props:['user'],


        data(){
            return{
                loop: [],
                content: '',
                commentsToShow: 5

        }
        },
        mounted: function () {
            this.dataFetch();
            this.timer = setInterval(this.dataFetch, 10000)
        },
        methods:{
            CheckItem: function(event,id){
                {
                    axios.post('/api/statusUpdateBox/' + id,{
                        status: 'boxed',
                        // _method: 'PATCH'
                    })
                        .then(function (response) {
                        console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    this.dataFetch();

                }
            },
            dataFetch: function(){
                let url = '/api/statusListBox?ID=' + this.user;
                axios.get(url).then(response => this.loop = response.data)
            },
            addStatus(user){
                if (this.content != ''){


                axios.post('/api/addStatusToBox',{
                    content:this.content,
                    user_id: user,
                    status: 'box'
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // Event.$emit('taskCreated',{title:this.title});
                    this.loop.splice(0, 0, {content: this.content});

                    this.content = '';

                // console.log('Adding');
                }
            }
        },
    }
</script>

<style scoped>

</style>

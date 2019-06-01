<template>
    <div>
        <div class="list-group collapse show list-group-flush bg-dark" id="myActivities">
<!--            @foreach($messages as $s)-->
<div v-for="item in loop">
            <a class="list-group-item bg-dark" data-toggle="collapse" v-bind:data-target="'#reply-form-' + item.id">
<!--                @if($s->toUser->id != Auth::id())-->
<!--                <img src="/storage/avatars/{{$s->user->avatar}}" alt="" class="ml-3 img-circle " style="width: 45px" title="به {{$s->toUser->name}}">-->

<!--                <img src="/storage/avatars/{{$s->toUser->avatar}}" alt=""  style="width: 28px; top: 10px;right: 5px;" class=" ml-3 img-circle position-absolute" title="به {{$s->toUser->name}}">-->
<!--                @else-->
                <img :src="'/storage/avatars/' + item.user.avatar" alt="" class="img-size-50 ml-3 img-circle " :title="item.user.name">

<!--                @endif-->
                <small>{{ item.content }}</small>
<!--                <span class="float-left" style="font-size: 85%"><small>s.diff</small></span>-->

            </a>
    <a class="list-group-item collapse " :id="'reply-form-' + item.id">
        123
<!--        <form  method="post" action="{{ route('status.store') }}">-->
<!--            @csrf-->
<!--            <input type="hidden" name="to_user" value="{{$s->user->id}}">-->
<!--            <input type="hidden" name="user_id" value="{{$s->toUser->id}}">-->

<!--            <div class="input-group">-->
<!--                <textarea name="content" class="form-control"></textarea>-->
<!--                <input type="text" class="form-control InputToFocus inputUserStatus" name="content" autocomplete="off" placeholder=".....">-->
<!--                <div class="input-group-append">-->
<!--                    <button class="btn btn-dark btn-add" type="submit"><i class="fa fa-arrow-circle-left"></i></button>-->
<!--                </div>-->
<!--            </div>-->
<!--            <input type="hidden" name="status" value="status" class="statusStatus">-->


<!--        </form>-->
            </a>

            </div>
            <a href="/profile" class="dropdown-item dropdown-footer"><small>همه</small></a>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                loop: []
            }
        },
        created: function () {
            this.statusFetch();
            this.timer = setInterval(this.statusFetch, 1500)
        },
        methods:{
            statusFetch: function(){
                axios.get('./api/homeStatusToMe').then(response => this.loop = response.data)
            }
        }
    }
</script>

<style scoped>

</style>

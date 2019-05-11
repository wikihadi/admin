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

    <draggable :list="orderNew" :element="'div'" :options="{animation:300}" @change="update">
    <div v-for="(ord, index) in orderNew">
    <div v-for="(task, index) in tasks" v-if="task.id == ord.task_id">
        <div class="card card-border">
            <!--<div class="card-header card-border bg-success">-->
                <!--<div class="row">-->
                    <!--<div class="col-md-9 row">{{ord.order_column}}</div>-->
                    <!--<div class="col-md-3 row d-none d-md-flex justify-content-end align-items-center">{{task.title}}</div>-->
                <!--</div>-->
            <!--</div>-->
            <div class="card-header card-border bg-dark">
                <div class="row">

                    <div class="col-md-9 row">
                        <div class="col-12 col-md-4 text-center text-md-right ">{{ord.order_column}}.{{ task.title.substring(0,40)+".."}}</div>
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
                        <div class="flex-grow-1"></div>

                        <!--<div v-for="(ut, index) in usersInTasks" v-if="ut.task_id == task.id">-->
                            <!--<div v-for="(u, index) in allUsers" v-if="u.id == ut.user_id">-->
                                <!--<div class="mx-1">-->
                                    <!--<img :src="'/storage/avatars/' + u.avatar"-->
                                         <!--class="img-circle"-->
                                         <!--style="object-fit: cover; width: 29px;height: 29px; border: 1px solid #a9a9a9;"-->
                                         <!--:title="u.name"-->
                                    <!--data-toggle="tooltip">-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->


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




            <!--<div :id="'collapse' + task.id" class="collapse collapseTask" data-parent="#accordion">-->
                <!--<div class="card-body">-->

                    <!--<div class="row">-->
                        <!--<div class="col-sm-12 col-md-4 col-xl-3 d-none d-sm-block">-->
                            <!--<img src="/storage/uploads/{{$task->pic}}" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="col-sm-12 col-md-8 col-xl-3 table-responsive">-->

                            <!--<table class="table table-borderless table-striped table-hover text-center  " style="width: 100%;min-width: 100%">-->

                                <!--<tr>-->
                                    <!--<td><a href="/tasks/{{$task->id}}">کد</a></td>-->

                                    <!--<td><a class="text-muted" href="/tasks/{{$task->id}}">{{$task->id}}</a></td>-->
                                <!--</tr>-->


                                <!--<tr class="d-md-none">-->
                                    <!--<td>نوع</td>-->
                                    <!--<td>{{$task->type}}</td>-->
                                <!--</tr>-->
                                <!--<tr class="d-md-none">-->
                                    <!--<td>برند</td>-->
                                    <!--<td>{{$task->brand}}</td>-->
                                <!--</tr>-->
                                <!--<tr class="d-md-none">-->
                                    <!--<td>برای</td>-->
                                    <!--<td>{{$task->forProduct}}</td>-->
                                <!--</tr>-->
                                <!--@if($task->dx || $task->dy || $task->dz || $task->dDesc)-->

                                <!--<tr>-->
                                    <!--<td>در قطع</td>-->
                                    <!--<td><span title="عرض">{{$task->dx}}</span>-<span title="طول">{{$task->dy}}</span>-<span title="عمق">{{$task->dz}}</span>-<span title="واحد">{{$task->dDesc}}</span>-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--@endif-->
                                <!--@if($task->material)-->

                                <!--<tr>-->
                                    <!--<td>متریال</td>-->
                                    <!--<td>{{$task->material}}-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--@endif-->
                                <!--<tr class="d-md-none">-->
                                    <!--<td>مهلت باقیمانده</td>-->

                                    <!--<td>-->
                                        <!--{{$task->diffDead}}-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--{{&#45;&#45;<tr>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<td><span class="badge badge-info">{{$task->jStart}}</span></td>&#45;&#45;}}-->

                                <!--{{&#45;&#45;<td><span class="badge badge-success">{{$task->jEnd}}</span>&#45;&#45;}}-->
                                    <!--{{&#45;&#45;</td>&#45;&#45;}}-->
                                <!--{{&#45;&#45;</tr>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<tr>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<td>تاریخ اتمام کار</td>&#45;&#45;}}-->

                                <!--{{&#45;&#45;<td>&#45;&#45;}}-->
                                    <!--{{&#45;&#45;{{$task->jEnd}}&#45;&#45;}}-->
                                    <!--{{&#45;&#45;</td>&#45;&#45;}}-->
                                <!--{{&#45;&#45;</tr>&#45;&#45;}}-->
                                <!--@if($task->reTask === 1)-->
                                <!--<tr>-->
                                    <!--<td colspan="2">مشابه این کار قبلا انجام شده</td>-->


                                <!--</tr>-->
                                <!--@endif-->

                                <!--{{&#45;&#45;<tr>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<td></td>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<td>{{$task->commentCount}}</td>&#45;&#45;}}-->
                                <!--{{&#45;&#45;</tr>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<tr>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<td>مشاهده</td>&#45;&#45;}}-->
                                <!--{{&#45;&#45;<td>{{$task->viewCount}}</td>&#45;&#45;}}-->
                                <!--{{&#45;&#45;</tr>&#45;&#45;}}-->

                            <!--</table>-->


                        <!--</div>-->
                        <!--<div class="col-sm-12 col-md-12 col-xl-6">-->
                            <!--{{&#45;&#45;<h1>&#45;&#45;}}-->
                            <!--{{&#45;&#45;{{ $task->title }}&#45;&#45;}}-->

                            <!--{{&#45;&#45;</h1>&#45;&#45;}}-->
                            <!--@if($task->pending == 0)-->

                            <!--<div class="d-flex justify-content-between"><span class="badge badge-white">{{$task->jStart}}</span><span class="badge badge-white">{{$task->jEnd}}</span></div>-->
                            <!--<div class="progress">-->
                                <!--<div data-toggle="tooltip" title="@if( $task->prog >100 )زمان مقرر این تسک پایان یافته است @elseزمان سپری شده {{$task->prog}}% @endif"  data-placement="top" class="progress-bar progress-bar-striped @if( $task->prog <= 100 ) progress-bar-animated @endif {{$progbg}}"  role="progressbar" style="width: {{ $task->prog }}%" aria-valuenow="{{ $task->prog }}" aria-valuemin="0" aria-valuemax="100"></div>-->

                            <!--</div>-->

                            <!--@endif-->

                            <!--{{&#45;&#45;<div class="btn-group">&#45;&#45;}}-->
                            <!--{{&#45;&#45;@if($task->type && $task->type != "سایر") <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="نوع کار"  data-placement="bottom">{{ $task->type }}</button> @endif&#45;&#45;}}-->
                            <!--{{&#45;&#45;@if($task->type && $task->brand != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="برند"  data-placement="bottom">{{ $task->brand }}</button> @endif&#45;&#45;}}-->
                            <!--{{&#45;&#45;@if($task->type && $task->forProduct != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="محصول"  data-placement="bottom">{{ $task->forProduct }}</button> @endif&#45;&#45;}}-->
                            <!--{{&#45;&#45;@if($task->type && $task->material != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="متریال"  data-placement="bottom">{{ $task->material }}</button> @endif&#45;&#45;}}-->
                            <!--{{&#45;&#45;<button class="btn btn-sm btn-link"   data-toggle="tooltip" title="نظر"  data-placement="bottom">{{ $task->commentCount }}</button>&#45;&#45;}}-->
                            <!--{{&#45;&#45;<button class="btn btn-sm btn-link"   data-toggle="tooltip" title="مشاهده"  data-placement="bottom">{{ $task->viewCount }}</button>&#45;&#45;}}-->

                            <!--{{&#45;&#45;@if($task->reTask === 1)&#45;&#45;}}-->

                            <!--{{&#45;&#45;<button class="btn btn-sm btn-link"  data-toggle="tooltip" title="Clone" data-placement="bottom">&#45;&#45;}}-->
                                <!--{{&#45;&#45;<i class="fa fa-clone"></i>&#45;&#45;}}-->
                                <!--{{&#45;&#45;</button>&#45;&#45;}}-->
                            <!--{{&#45;&#45;@endif&#45;&#45;}}-->

                            <!--{{&#45;&#45;</div>&#45;&#45;}}-->

                            <!--<p class="text-justify pt-3">-->
                                <!--{{ $task->content }}-->

                            <!--</p>-->


                        <!--</div>-->
                        <!--<div class="text-left col-12">-->
                            <!--{{&#45;&#45;<a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>&#45;&#45;}}-->
                            <!--<a href="/tasks/{{$task->id}}" class="btn btn-link"><i class="fa fa-3x fa-arrow-left"></i></a>-->
                        <!--</div>-->



                    <!--</div>-->
                <!--</div>-->

            <!--</div>-->





















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

<template>
        <div class="col-12 row mt-5 justify-content-center">
                <div class="col-xl-9 col-lg-10">
                <div class="card bg-dark">
                    <div class="card-header">
                        <span v-if="minimize">پنل کاربری</span>
<!--                        TOP MENU---------------------------------------------------------------------------------->
                        <div class="row justify-content-between pull-left">
                            <div class="pointer" @click.prevent="minimize=!minimize"><i :class="{'fa-window-minimize':!minimize,'fa-window-maximize':minimize}" class="fa text-muted"></i></div>
<!--                            <div class="pointer" @click.prevent="searchTab()"><i :class="{'text-success':!showMenu}" class="fa fa-search"></i></div>-->
<!--                            <div class="pointer" @click.prevent="indicator()"><i class="fa fa-tasks"></i></div>-->
<!--                            <div class="pointer" @click.prevent="indicator()"><i :class="{'fa-circle text-success':showMenu,'fa-circle-o':!showMenu}" class="fa"></i></div>-->
                        </div>


<!--                        SEARCH BAR-------------------------------------------------------------------------------->
                        <transition name="fade">
                        <div  v-if="!minimize" class="row justify-content-center mt-3">
                            <div class="col-md-8">
                                <form @submit.prevent="searchTasks(),isShow=-1">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" placeholder="جستجوی کارها..." v-model="searchValue" @keyup.prevent="searchTasks(),isShow=-1" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-outline-secondary " type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <transition name="fade">

                                        <small v-if="this.searchValue.length < 3 && this.searchValue.length > 0" class="badge badge-warning mt-n3">حداقل سه حرف وارد کنید</small>
                                    </transition>

                                </form>
                            </div>
                        </div>
                        </transition>
<!--                        FILTERS------------------------------------------------------------------------------------->
                            <transition name="fade">
                            <div  v-if="!minimize" class="row justify-content-center">
<!--                            <button type="button"  class="btn btn-sm btn-outline-secondary"-->
<!--                                    :class="{'active':activeTab === 8}"-->
<!--                                    @click.prevent="title='باکس',activeTab=8,isShow=9,fetchmain,fetchRoutineMain,myboxFetchMain(0)">-->
<!--                                <i class="fa fa-tachometer"></i></button>-->
<!--                            <div class="mx-1"></div>-->

                         <div class="d-flex align-items-start">
                                <button type="button" class="btn btn-sm btn-dark"
                                        :class="{'text-light':activeTab === 1,'text-muted':activeTab !== 1}"
                                        @click.prevent="tasks='',fetchTasks('lastStatus','=',0,'order_column','asc'),commentFetch(),title='کارهای در انتظار',activeTab=1,isShow=3,loading=true">
<!--                                    <i :class="{'fa fa-circle':activeTab === 1,'fa fa-circle-o':activeTab !== 1}"></i>-->
                                    در انتظار</button>
<!--                                <button class="btn btn-dark btn-sm d-none d-md-block" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>-->
<!--                                <button type="button"  class="btn btn-sm btn-dark"-->
<!--                                        :class="{'text-light':activeTab === 7,'text-muted':activeTab !== 7}"-->
<!--                                        @click.prevent="fetchTasks('lastStatus','=',4,'order_column','asc'),commentFetch(),title='معلق',activeTab=7,isShow=8">-->
<!--                                    <i :class="{'fa fa-circle':activeTab === 7,'fa fa-circle-o':activeTab !== 7}"></i> معلق</button>-->
<!--                                <button class="btn btn-dark btn-sm d-none d-md-block" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>-->
                                <div class=" border-secondary border d-flex flex-column" style="border-radius:0.25rem">
                                <div class="btn-group flex-wrap">
                                    <button type="button" :class="{'active text-light':activeTab === 0,'text-muted':activeTab !== 0}" class="btn btn-sm btn-dark" @click.prevent="fetchRoutine(),loading=true">
                                        <!--                                    <i :class="{'fa fa-circle':activeTab === 0,'fa fa-circle-o':activeTab !== 0}"></i>-->
                                        روتین</button>


                                <button type="button"  class="btn btn-sm btn-dark"
                                        :class="{'text-light':activeTab === 2,'text-muted':activeTab !== 2}"
                                        @click.prevent="fetchCurrentTasks()">
<!--                                    <i :class="{'fa fa-circle':activeTab === 2,'fa fa-circle-o':activeTab !== 2}"></i>-->
                                    درحال انجام</button>
<!--                                <button class="btn btn-sm btn-dark d-none d-md-block" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>-->
                                    <button type="button" :class="{'active text-light':activeTab === 6,'text-muted':activeTab !== 6}" class="btn btn-sm btn-dark" @click.prevent="tasks='',title='باکس',activeTab=6,isShow=1,boxFetch()">
                                        <!--                                    <i :class="{'fa fa-circle':activeTab === 6,'fa fa-circle-o':activeTab !== 6}"></i>-->
                                        باکس</button>
                                </div>
                                    <button class="btn btn-block btn-outline-success btn-sm"
                                            :class="{'active':activeTab === 8}"
                                            @click.prevent="mainLine">خط زمان</button>
                                </div>

                                <button type="button"  class=" btn-sm btn btn-dark"
                                        :class="{'text-light':activeTab === 3,'text-muted':activeTab !== 3}"
                                        @click.prevent="fetchTasks('lastStatus','=',5,'order_column','asc'),commentFetch(),title='پیگیری',activeTab=3,isShow=5,loading=true">
<!--                                    <i :class="{'fa fa-circle':activeTab === 3,'fa fa-circle-o':activeTab !== 3}"></i>-->
                                    پیگیری</button>
<!--                                <button class="btn  btn-sm  btn-dark d-none d-md-block" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>-->
                                <button type="button"  class=" btn-sm btn btn-dark"
                                        :class="{'text-light':activeTab === 4,'text-muted':activeTab !== 4}"
                                        @click.prevent="fetchTasks('lastStatus','=',6,'order_column','asc'),commentFetch(),title='چاپ',activeTab=4,isShow=6,loading=true">
<!--                                    <i :class="{'fa fa-circle':activeTab === 4,'fa fa-circle-o':activeTab !== 4}"></i>-->
                                    چاپ</button>
<!--                                <button class="btn  btn-sm btn-dark d-none d-md-block" type="button" disabled><i class="fa fa-angle-double-left text-muted"></i></button>-->
<!--                                <button type="button"  class=" btn-sm btn btn-dark"-->
<!--                                        :class="{'text-light':activeTab === 5,'text-muted':activeTab !== 5}"-->
<!--                                        @click.prevent="tasks='',fetchTasks('lastStatus','=',3,'updated_at','desc'),commentFetch(),title='کارهای پایان یافته',activeTab=5,isShow=7">-->
<!--                                    <i :class="{'fa fa-circle':activeTab === 5,'fa fa-circle-o':activeTab !== 5}"></i> نهایی</button>-->
                        </div></div>
                            </transition>

                </div>

                    <transition name="fade">

                    <div v-if="!minimize">
<!--                    SEARCH NO RESULT------------------------------------------------------------------------------>
                    <transition name="fade">
                    <div class="card-body" v-if="loop.length <= 0 && noRes">
                        <div class="text-center m-5">
                            هیچ نتیجه ای یافت نشد
                        </div>
                    </div>
                    </transition>
<!--                    MAIN------------------------------------------------------------------------------------------->
                    <div class="card-body"   v-if="isShow === 9">

                        <div class="row mb-3">
                            <div class="col-12">


                                <div class="alert alert-success" v-if="47.3>timePassed>52.6">ساعت ناهاری</div>

                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">08:30</small>
                                    <small class="text-muted">{{curTime}}</small>
                                    <small class="text-muted">18:00</small>
                                </div>

                                <div class="progress" style="height: 2px;" @click="checkChartData()">
                                    <div :class="{'bg-warning' :timePassed >85 , 'bg-info' :timePassed < 85, 'bg-danger' : timePassed >=100}" class="progress-bar progress-bar-striped progress-bar-animated" :title="curTime" role="progressbar" :aria-valuenow="timePassed" aria-valuemin="0" aria-valuemax="660" :style="'width:' + timePassed + '%'">
                                    </div>
                                </div>
<!--                                <div class="alert alert-info">-->
<!--                                    با استفاده از دو فلش چپ و راست میتوانید بین فعالیتهای روز گذشته رفت و آمد کنید-->
<!--                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                                        <span aria-hidden="true">&times;</span>-->
<!--                                    </button>-->
<!--                                </div>-->
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 justify-content-between d-flex">
                                <i class="fa fa-arrow-circle-right" title="روز قبل" @click.prevent="day--,myboxFetchMain(day),fetchTasksMain('lastStatus','<=',2,'order_column','asc',day),fetchTasksRoutine('routine','=',1,'order_column','asc',day)"></i>
                                <div>
                                    <small class="text-muted" v-if="day == 0">امروز</small>

                                    <small class="text-muted" v-if="day != 0">({{Math.abs(day)}}) روز قبل</small>
                                    <button class="btn btn-link btn-sm" v-if="day != 0" @click="day=0,myboxFetchMain(day),fetchTasksMain('lastStatus','<=',2,'order_column','asc',day),fetchTasksRoutine('routine','=',1,'order_column','asc',day)">برو امروز</button>
<!--                                    <small>دوشنبه</small>-->
                                    <small>
<!--                                        <span>{{ new Date() | moment("dddd, MMMM Do YYYY") }}</span>-->


                                    </small>
                                </div>

                                <i class="fa fa-arrow-circle-left" title="روز بعد" @click.prevent="day++,myboxFetchMain(day),fetchTasksMain('lastStatus','<=',2,'order_column','asc',day),fetchTasksRoutine('routine','=',1,'order_column','asc',day)" v-if="day<0"></i>
                                <i class="fa fa-arrow-circle-left text-muted" v-if="day==0"></i>

                            </div>


                            <div class="col-xl" v-if="ShowMainRoutine">
                                <div class="card-body">
                                    <div class="list-group-item bg-dark text-center text-muted">کارهای روتین <small v-if="day == 0">امروز</small><small v-if="day == -1">دیروز</small><small v-if="day < -1">{{Math.abs(day)}} روز قبل</small> <small class="text-muted">({{mainTasksRoutine.length}})</small></div>
                                    <div class="list-group-item bg-dark text-center" v-if="mainTasksRoutine.length <= 0"><i class="fa fa-minus"></i></div>
<!--                                    <zoom-center-transition group>-->
<!--                                    <zoom-center-transition>-->
                                    <!--                                        :class="{'bg-success':item.lastStatus == 2,'bg-dark':item.lastStatus != 2}"-->

                                    <div
                                        class="list-group-item bg-dark"
                                        v-for="item in mainTasksRoutine.slice(0, 5)" :id="'task-' + item.id">
                                        <small @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()" class="pointer">{{item.task.title}}</small>
                                        <small class="pull-left">
<!--                                            <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus != 3"></i>-->
                                            <span class="badge badge-info pointer" data-toggle="collapse" :data-target="'#comments' + item.id" title="نظر" v-if="item.comments.length > 0">{{item.comments.length}}</span>
                                            <span class="badge badge-secondary" v-if="item.comments.length == 0">بدون نظر</span>

                                        </small>
                                        <div :id="'comments' + item.id" class="collapse">
                                        <a class="text-sm list-group-item bg-dark" v-for="comment in item.comments.slice(0, 5)">{{comment.content.substring(0, 30)}}...</a>
                                        <a class="text-sm list-group-item bg-dark pointer" @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()">همه نظرات</a>
                                        </div>
                                    </div>
<!--                                    </zoom-center-transition>-->
<!--                                    </zoom-center-transition>-->
<!--                                    <div class="text-center d-flex" v-if="tasks.length > 5">-->
<!--                                        <div @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>-->
<!--                                        <div @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="boxToShow < boxes.length"></i></div>-->
<!--                                    </div>-->
                                </div>
                            </div>
<!--                            <div class="col-xl" v-if="ShowMainCurrentTask">-->
<!--                                <div class="card-body">-->
<!--                                    <div class="list-group-item bg-dark text-center text-muted">کارهای <small v-if="day==0">امروز</small><small v-if="day==-1">دیروز</small><small v-if="day<-1">{{Math.abs(day)}} روز قبل</small> <small class="text-muted">({{mainTasks.length}})</small></div>-->
<!--                                    <div class="list-group-item bg-dark text-center" v-if="mainTasks.length <= 0"><i class="fa fa-minus"></i></div>-->
<!--&lt;!&ndash;                                    <zoom-center-transition>&ndash;&gt;-->
<!--                                    &lt;!&ndash;                                            :class="{'bg-success':item.lastStatus == 2,'bg-dark':item.lastStatus != 2}"&ndash;&gt;-->

<!--                                    <div-->
<!--                                            class="list-group-item bg-dark"-->
<!--                                            v-for="item in mainTasks.slice(0, 5)" :id="'task-' + item.id">-->
<!--                                            <small @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()" class="pointer">{{item.task.title}}</small>-->
<!--                                            <small class="pull-left">-->
<!--                                                <span class="badge badge-info pointer" data-toggle="collapse" :data-target="'#comments' + item.id" title="نظر" v-if="item.comments.length > 0">{{item.comments.length}}</span>-->
<!--                                                <span class="badge badge-secondary" v-if="item.comments.length == 0">بدون نظر</span>-->
<!--    &lt;!&ndash;                                            <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus != 3"></i>&ndash;&gt;-->
<!--                                            </small>-->
<!--                                            <div :id="'comments' + item.id" class="collapse">-->
<!--                                                <a class="text-sm list-group-item bg-dark" v-for="comment in item.comments.slice(0, 5)">{{comment.content.substring(0, 30)}}...</a>-->
<!--                                                <a class="text-sm list-group-item bg-dark pointer" @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()">همه نظرات</a>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--&lt;!&ndash;                                    </zoom-center-transition>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <div class="text-center d-flex" v-if="tasks.length > 5">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="boxToShow < boxes.length"></i></div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </div>&ndash;&gt;-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="col-xl" v-if="ShowMainCurrentTask">
                                <div class="card-body">
                                    <div class="list-group-item bg-dark text-center text-muted border" v-if="commentsLoop.lastStart!=''">کار باز از قبل</div>
                                    <div class="list-group-item bg-light text-dark text-center pointer"  @click.prevent="searchValue = commentsLoop.lastStart.task.title,isShow=-1,searchTasks()" v-if="commentsLoop.lastStart!=''">{{commentsLoop.lastStart.task.title}}</div>


                                    <div class="list-group-item bg-dark text-center text-muted">فعالیت <small v-if="day==0">امروز</small><small v-if="day==-1">دیروز</small><small v-if="day<-1">{{Math.abs(day)}} روز قبل</small> <small class="text-muted">({{commentsLoop.dailyComments.length}})</small></div>
                                    <div class="list-group-item bg-dark text-center" v-if="commentsLoop.dailyComments.length <= 0"><i class="fa fa-minus"></i></div>
<!--                                    <zoom-center-transition>-->
                                    <!--                                            :class="{'bg-success':item.lastStatus == 2,'bg-dark':item.lastStatus != 2}"-->


                                    <div class="list-group-item bg-dark" v-for="item in commentsLoop.tasks" :id="'task-' + item.id" data-toggle="collapse" :data-target="'#comments' + item.id">

                                        <small class="pointer">{{item.title}}</small>

                                        <small class="pull-left">
<!--                                            <span class="badge badge-secondary">11</span>-->
                                            <a class="text-sm bg-dark pointer" @click.prevent="searchValue = item.title,isShow=-1,searchTasks()"><i class="fa fa-link"></i></a>

                                        </small>
                                            <div :id="'comments' + item.id" class="collapse">
                                                <a class="text-sm list-group-item bg-dark" v-for="status in commentsLoop.dailyComments" v-if="item.id == status.task_id">

                                                    <span><small class="badge badge-secondary pointer">{{status.diff}}</small> </span>
                                                    <span v-if="status.status=='comment'"><small class="badge badge-info pointer">نظر</small> {{status.content}}</span>
                                                    <span v-if="status.status=='start'"><small class="badge badge-success pointer">شروع</small> </span>
                                                    <span v-if="status.status=='end'"><small class="badge badge-warning pointer">پایان</small> </span>
                                                </a>


                                            </div>
                                    </div>

<!--                                    <div-->
<!--                                            class="list-group-item bg-dark"-->
<!--                                            v-for="item in commentsLoop.dailyComments.slice(0, 5)" :id="'task-' + item.task.id"-->
<!--                                            data-toggle="collapse" :data-target="'#comments' + item.task.id">-->
<!--                                        <span v-if="item.status=='comment'"><small class="badge badge-info pointer">نظر</small> در </span>-->
<!--                                        <span v-if="item.status=='start'"><small class="badge badge-success pointer">شروع</small> </span>-->
<!--                                        <span v-if="item.status=='end'"><small class="badge badge-warning pointer">پایان</small> </span>-->

<!--                                        <small class="pointer">{{item.task.title}}</small>-->
<!--                                            <small class="pull-left">-->
<!--                                        <span class="badge badge-secondary">{{item.diff}}</span>-->
<!--                                                <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus != 3"></i>-->
<!--                                            </small>-->
<!--                                            <div :id="'comments' + item.task.id" class="collapse">-->
<!--                                                <a class="text-sm list-group-item bg-dark">{{item.content}}</a>-->


<!--                                                <a class="text-sm list-group-item bg-dark pointer" @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()"><i class="fa fa-link"></i></a>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    -->



<!--                                    </zoom-center-transition>-->
<!--                                    <div class="text-center d-flex" v-if="tasks.length > 5">-->
<!--                                        <div @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>-->
<!--                                        <div @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="boxToShow < boxes.length"></i></div>-->
<!--                                    </div>-->
                                </div>
                            </div>


                            <div class="col-xl" v-if="ShowMainBox">
                                <div class="card-body">
                                    <div class="list-group-item bg-dark text-center text-muted d-flex justify-content-between">
                                        <div>باکس
                                            <small v-if="day==0">امروز</small><small v-if="day==-1">دیروز</small><small v-if="day<-1">{{Math.abs(day)}} روز قبل</small>
    <!--                                            <small class="text-muted">({{boxes.length}})</small>-->
    <!--                                            <small class="text-muted" v-if="day == 0">امروز</small>-->
    <!--                                            <small class="text-muted" v-if="day != 0"> - ({{Math.abs(day)}}) روز قبل</small>-->
    <!--                                            <button class="btn btn-link btn-sm" v-if="day != 0" @click="day=0,myboxFetchMain(day)">برو امروز</button>-->
                                        </div>
                                    </div>
                                    <div class="list-group-item bg-dark text-center" v-if="boxes.length <= 0"><i class="fa fa-minus"></i></div>
                                    <div :class="{'bg-success':boxStarted.status == 'box-start' && boxStarted.re_id == box.id,'bg-dark':boxStarted.re_id != box.id || boxStarted.status != 'box-start'}" class="list-group-item" v-for="box in boxes.slice(0, boxToShow)" :id="'box-' + box.id">
                                        <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id,box.content)"></i>
                                        <small>{{box.content}}</small>
                                        <small class="pull-left">
                                            <i class="fa fa-play text-success pointer" v-if="boxStarted.status != 'box-start'" @click="newStatus('شروع باکس ' + box.content,'box-start',null,null,box.id,0)"></i>
                                            <i class="fa fa-pause text-warning pointer" v-if="boxStarted.status == 'box-start' && boxStarted.re_id == box.id" @click="newStatus('توقف باکس ' + box.content,'box-pause',null,null,box.id,0)"></i>
                                        </small>
                                    </div>
                                    <div class="text-center d-flex" v-if="boxes.length > 5">
                                        <div @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>
                                        <div @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="boxToShow < boxes.length"></i></div>
                                    </div>
                                </div>

                            </div>

                        </div>
<!--                        <div class="row">-->

<!--                            <div class="col-xl" v-if="ShowMainRoutine">-->
<!--                                <div class="card-body">-->
<!--                                    <div class="list-group-item bg-dark text-center text-muted">کارهای روتین باز</div>-->
<!--                                    <div class="list-group-item bg-dark text-center"><i class="fa fa-minus"></i></div>-->
<!--                                    <div-->
<!--                                        :class="{'bg-success':item.lastStatus == 2,'bg-dark':item.lastStatus != 2}"-->
<!--                                        class="list-group-item"-->
<!--                                        v-for="item in mainTasksRoutine" :id="'task-' + item.id">-->
<!--                                        <small @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()" class="pointer">{{item.task.title}}</small>-->
<!--                                        <small class="pull-left">-->
<!--                                            <span class="badge badge-info pointer" data-toggle="collapse" :data-target="'#comments' + item.id" title="نظر">{{item.comments.length}}</span>-->
<!--                                        </small>-->
<!--                                        <div :id="'comments' + item.id" class="collapse">-->
<!--                                        <a class="text-sm list-group-item bg-dark" v-for="comment in item.comments.slice(0, 5)">{{comment.content.substring(0, 30)}}</a>-->
<!--                                        <a class="text-sm list-group-item bg-dark pointer" v-if="item.comments.length > 5" @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()">بیشتر...</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-xl" v-if="ShowMainCurrentTask">-->
<!--                                <div class="card-body">-->
<!--                                    <div class="list-group-item bg-dark text-center text-muted">کارهای <small v-if="day==0">امروز</small><small v-if="day==-1">دیروز</small><small v-if="day<-1">{{Math.abs(day)}} روز قبل</small> <small class="text-muted">({{mainTasks.length}})</small></div>-->
<!--                                    <div class="list-group-item bg-dark text-center" v-if="mainTasks.length <= 0"><i class="fa fa-minus"></i></div>-->
<!--                                    <div-->
<!--                                        :class="{'bg-success':item.lastStatus == 2,'bg-dark':item.lastStatus != 2}"-->
<!--                                        class="list-group-item"-->
<!--                                        v-for="item in mainTasks.slice(0, 5)" :id="'task-' + item.id">-->
<!--                                        <small @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()" class="pointer">{{item.task.title}}</small>-->
<!--                                        <small class="pull-left">-->
<!--                                            <span class="badge badge-info pointer" data-toggle="collapse" :data-target="'#comments' + item.id" title="نظر" v-if="item.comments.length > 0">{{item.comments.length}}</span>-->
<!--                                            <span class="badge badge-secondary" v-if="item.comments.length == 0">بدون نظر</span>-->
<!--                                        </small>-->
<!--                                        <div :id="'comments' + item.id" class="collapse">-->
<!--                                            <a class="text-sm list-group-item bg-dark" v-for="comment in item.comments.slice(0, 5)">{{comment.content.substring(0, 30)}}</a>-->
<!--                                            <a class="text-sm list-group-item bg-dark pointer" v-if="item.comments.length > 5" @click.prevent="searchValue = item.task.title,isShow=-1,searchTasks()">بیشتر...</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->


<!--                            <div class="col-xl" v-if="ShowMainBox">-->
<!--                                <div class="card-body">-->
<!--                                    <div class="list-group-item bg-dark text-center text-muted d-flex justify-content-between">-->
<!--                                        <div>باکس-->
<!--                                            <small v-if="day==0">امروز</small><small v-if="day==-1">دیروز</small><small v-if="day<-1">{{Math.abs(day)}} روز قبل</small>-->
<!--    &lt;!&ndash;                                            <small class="text-muted">({{boxes.length}})</small>&ndash;&gt;-->
<!--    &lt;!&ndash;                                            <small class="text-muted" v-if="day == 0">امروز</small>&ndash;&gt;-->
<!--    &lt;!&ndash;                                            <small class="text-muted" v-if="day != 0"> - ({{Math.abs(day)}}) روز قبل</small>&ndash;&gt;-->
<!--    &lt;!&ndash;                                            <button class="btn btn-link btn-sm" v-if="day != 0" @click="day=0,myboxFetchMain(day)">برو امروز</button>&ndash;&gt;-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="list-group-item bg-dark text-center" v-if="boxes.length <= 0"><i class="fa fa-minus"></i></div>-->
<!--                                    <div :class="{'bg-success':boxStarted.status == 'box-start' && boxStarted.re_id == box.id,'bg-dark':boxStarted.re_id != box.id || boxStarted.status != 'box-start'}" class="list-group-item" v-for="box in boxes.slice(0, boxToShow)" :id="'box-' + box.id">-->
<!--                                        <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id,box.content)"></i>-->
<!--                                        <small>{{box.content}}</small>-->
<!--                                        <small class="pull-left">-->
<!--                                            <i class="fa fa-play text-success pointer" v-if="boxStarted.status != 'box-start'" @click="newStatus('شروع باکس ' + box.content,'box-start',null,null,box.id,0)"></i>-->
<!--                                            <i class="fa fa-pause text-warning pointer" v-if="boxStarted.status == 'box-start' && boxStarted.re_id == box.id" @click="newStatus('توقف باکس ' + box.content,'box-pause',null,null,box.id,0)"></i>-->
<!--                                        </small>-->
<!--                                    </div>-->
<!--                                    <div class="text-center d-flex" v-if="boxes.length > 5">-->
<!--                                        <div @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>-->
<!--                                        <div @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="boxToShow < boxes.length"></i></div>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--                            </div>-->

<!--                        </div>-->
                        <div class="row">
                            <div class="col-xl">

                            </div>
                        </div>

<!--                        <button class="btn btn-sm btn-outline-info" :class="{'active':ShowMainRoutine}" @click="ShowMainRoutine = !ShowMainRoutine">.</button>-->
<!--                        <button class="btn btn-sm btn-outline-info" :class="{'active':ShowMainCurrentTask}" @click="ShowMainCurrentTask = !ShowMainCurrentTask">.</button>-->
<!--                        <button class="btn btn-sm btn-outline-info" :class="{'active':ShowMainBox}" @click="ShowMainBox = !ShowMainBox">.</button>-->

                    </div>
<!--                    BOX------------------------------------------------------------------------------------------->
                    <div class="card-body"   v-if="isShow === 1">
<!--                        <div class="card-header" v-if="title != ''"><h4 class="text-center">{{title}}</h4></div>-->
<!--                        <div class="row mb-3">-->
<!--                            <div class="col-12">-->


<!--                                <div class="alert alert-success" v-if="47.3>timePassed>52.6">ساعت ناهاری</div>-->

<!--&lt;!&ndash;                                <div class="alert alert-danger" v-if="timePassed>100">ساعت کاری شما پایان یافته است. لطفا جهت محاسبه ساعت اضافه کار، قبل از خروج، ساعت پایان کار را اعلام کنید</div>&ndash;&gt;-->
<!--                                <div class="d-flex justify-content-between">-->
<!--                                    <small class="text-muted">08:30</small>-->
<!--                                    <small class="text-muted">{{curTime}}</small>-->
<!--                                    <small class="text-muted">18:00</small>-->
<!--                                </div>-->

<!--                                <div class="progress" style="height: 2px;" @click="checkChartData()">-->
<!--                                    <div :class="{'bg-warning' :timePassed >85 , 'bg-info' :timePassed < 85, 'bg-danger' : timePassed >=100}" class="progress-bar progress-bar-striped progress-bar-animated" :title="curTime" role="progressbar" :aria-valuenow="timePassed" aria-valuemin="0" aria-valuemax="660" :style="'width:' + timePassed + '%'">-->
<!--                                    </div>-->
<!--                                </div>-->

<!--&lt;!&ndash;                                <div>&ndash;&gt;-->
<!--&lt;!&ndash;&lt;!&ndash;                                    <small class="text-muted">کار جاری</small>&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;                                    <div class="progress" style="height: 15px;">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div :class="{'progress-bar-animated bg-success': chartData.startsToday.length == 0,'bg-secondary': chartData.startsToday.length != 0}" class="progress-bar progress-bar-striped " :title="chartData.lastStartBeforeToday.task.title" :style="'width:' + computeLastStartBeforeToday + '%'">{{chartData.lastStartBeforeToday.task.title}}</div>&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div v-for="(s,index) in chartData.startsToday" class="progress-bar progress-bar-striped progress-bar-animated bg-success" :title="s.task.title" :style="'width:' + computeStartsToday + '%'">{{s.task.title}}</div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                <div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <div class="progress" style="height: 5px;">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="progress-bar" v-if="chartData.inToday"  :style="'width:'+ computeBeforeIn +'%'" ></div>&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="progress-bar progress-bar-striped bg-warning" style="width: 30%"></div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                </div>&ndash;&gt;-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="alert alert-info">-->
<!--                            باکسها کارهای کوچکتری هستند که نیاز به باز کردن یک کار جدید در آن نباشد. شما میتوانید با انتخاب مخاطب یک کار را درخواست کنید-->
<!--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                                <span aria-hidden="true">&times;</span>-->
<!--                            </button>-->
<!--                        </div>-->
                        <div class="row">
<!--                            <div class="text-center col-12"><i :class="{'fa-plus':!showBoxForm,'fa-minus':showBoxForm}" class="fa pointer" @click="toggleBoxForm()"></i></div>-->
                            <transition name="fade">
                            <div class="col-md-8 m-auto">
                                <div class="text-center mb-3">
                                    <img v-for="u in users" :src="'/storage/avatars/'+ u.avatar" :class="{ 'user-selected' : toUserId == u.id , 'user-not-selected' : toUserId != u.id }" class="img-circle" :alt="u.name" :title="u.name" @click.prevent="selectUser(u.id,u.name)">
                                </div>
                                <form @submit.prevent="addStatus(user),boxFetch()" v-if="showBoxForm">
                                    <div class="input-group">
        <!--                                <div class="form-group"  v-for="u in users">-->
        <!--                                    <label :for="'toUserId' + u.id">{{u.name}}</label>-->
        <!--                                    <input type="checkbox" :id="'toUserId' + u.id" :value="u.id" name="toUserId[]" v-model="toUserId">-->
        <!--                                </div>-->
                                        <div class="input-group-prepend"  v-if="boxToUserIdName">
                                            <span class="input-group-text text-sm">درخواست از {{boxToUserIdName}}</span>
<!--                                            <select name="to_user" v-model="toUserId" class="form-control bg-dark" placeholder="asd">-->
<!--                                                <option v-for="u in users" :value="u.id" class="bg-dark" v-if="u.id == user" selected>خودم</option>-->
<!--                                                <option disabled>&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;</option>-->
<!--                                                <option v-for="u in users" :value="u.id" class="bg-dark" v-if="u.id != user">{{u.name}}</option>-->
<!--                                            </select>-->
                                        </div>
                                        <input type="text" class="form-control bg-dark" name="content" v-model="newBox" placeholder="اینجا بنویس..." id="content" autocomplete="off" autofocus>
                                        <div class="input-group-append">

                                            <button type="submit" class="btn btn-success"><i class="fa fa-arrow-down"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </transition>
                        </div>
                        <div class="row">
                            <div class="col">
                        <div class="card-body">
                            <div class="list-group-item bg-dark text-center text-muted">خودم <small class="text-muted">({{boxes.length}})</small></div>
                            <div class="list-group-item bg-dark text-center" v-if="boxes.length <= 0"><i class="fa fa-minus"></i></div>

                            <div :class="{'bg-success':boxStarted.status == 'box-start' && boxStarted.re_id == box.id,'bg-dark':boxStarted.re_id != box.id || boxStarted.status != 'box-start'}" class="list-group-item" v-for="box in boxes.slice(0, boxToShow)" :id="'box-' + box.id">
                                <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id,box.content)"></i>
                                <small>{{box.content}}</small>
<!--                                <small class="pull-left">-->
<!--                                    <i class="fa fa-play text-success pointer" v-if="boxStarted.status != 'box-start'" @click="newStatus('شروع باکس ' + box.content,'box-start',null,null,box.id,0)"></i>-->
<!--                                    <i class="fa fa-pause text-warning pointer" v-if="boxStarted.status == 'box-start' && boxStarted.re_id == box.id" @click="newStatus('توقف باکس ' + box.content,'box-pause',null,null,box.id,0)"></i>-->
<!--                                </small>-->
                            </div>
                            <div class="text-center d-flex" v-if="boxes.length > 5">
                                <div @click.prevent="boxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>
                                <div @click.prevent="boxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="boxToShow < boxes.length"></i></div>
                            </div>
                        </div>
                        </div>
                            <div class="col">
                        <div class="card-body">
                            <div class="list-group-item bg-dark text-center text-muted">همکار <small class="text-muted">({{sentBoxes.length}})</small></div>
                            <div class="list-group-item bg-dark text-center" v-if="sentBoxes.length <= 0"><i class="fa fa-minus"></i></div>
                            <div class="list-group-item bg-dark" v-for="box in sentBoxes.slice(0, boxToShow)" :id="'box-' + box.id">
                                <img :src="'/storage/avatars/' + box.user.avatar" class="img-circle" style="width: 20px" alt="">
                                <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id,box.content)"></i> <small>{{box.content}}</small>
<!--                                <small class="pull-left">-->
<!--                                    <i class="fa fa-play text-success pointer" v-if="boxStarted.status != 'box-start'" @click="newStatus('شروع باکس ' + box.content,'box-start',null,null,box.id,0)"></i>-->
<!--                                    <i class="fa fa-pause text-warning pointer" v-if="boxStarted.status == 'box-start' && boxStarted.re_id == box.id" @click="newStatus('پایان باکس ' + box.content,'box-pause',null,null,box.id,0)"></i>-->
<!--                                </small>-->
                            </div>
                            <div class="text-center d-flex" v-if="sentBoxes.length > 5">
                                <div @click.prevent="sentBoxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-minus"></i></div>
                                <div @click.prevent="sentBoxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow < sentBoxes.length"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                        </div>
                            <div class="col">
                        <div class="card-body">
                            <div class="list-group-item bg-dark text-center text-muted">مدیریت <small class="text-muted">({{forcedBoxes.length}})</small></div>
                            <div class="list-group-item bg-dark text-center" v-if="forcedBoxes.length <= 0"><i class="fa fa-minus"></i></div>
                            <div class="list-group-item bg-dark" v-for="box in forcedBoxes.slice(0, boxToShow)" :id="'box-' + box.id">
                                <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id,box.content)"></i> <small>{{}}</small>
<!--                                <small class="pull-left">-->
<!--                                    <i class="fa fa-play text-success pointer" v-if="boxStarted.status != 'box-start'" @click="newStatus('شروع باکس ' + box.content,'box-start',null,null,box.id,0)"></i>-->
<!--                                    <i class="fa fa-pause text-warning pointer" v-if="boxStarted.status == 'box-start' && boxStarted.re_id == box.id" @click="newStatus('پایان باکس ' + box.content,'box-pause',null,null,box.id,0)"></i>-->
<!--                                </small>-->
                            </div>
                            <div class="text-center" v-if="forcedBoxes.length > 5">
                                <a @click.prevent="forcedBoxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow > 5"><i class="fa fa-arrow-up"></i></a>
                                <a @click.prevent="forcedBoxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="boxToShow < forcedBoxes.length"><i class="fa fa-arrow-down"></i></a>
                            </div>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button :class="{'text-muted':archiveShow !== 0,'text-light':archiveShow === 0}" class="btn btn-sm btn-link" @click="archiveBoxFetch"><i class="fa fa-refresh" v-if="archiveBoxes.length >0 && archiveShow == 0"></i> آرشیو باکس</button>
                                <button :class="{'text-muted':archiveShow !== 1,'text-light':archiveShow === 1}" class="btn btn-sm btn-link" @click="archiveSentBoxFetch"><i class="fa fa-refresh" v-if="archiveBoxes.length >0 && archiveShow == 1"></i> باکس درخواستی</button>
                                <div class="card-body" v-if="archiveBoxes.length >0">
                                    <div class="list-group-item bg-dark text-center text-muted">{{archiveTitle}} <small class="text-muted">({{archiveBoxes.length}})</small></div>
                                    <div class="list-group-item bg-dark text-center" v-if="archiveBoxes.length <= 0"><i class="fa fa-minus"></i></div>
                                    <div class="list-group-item bg-secondary" v-for="box in archiveBoxes.slice(0, archiveBoxToShow)" :id="'box-' + box.id">
<!--                                        <i class="fa fa-check hvr-fade" type="checkbox" @click.prevent="CheckItem($event, box.id,box.content)"></i>-->
                                        <img :src="'/storage/avatars/' + box.to_user.avatar" class="img-circle" style="width: 20px" alt="" v-if="archiveShow == 1">
                                        <i class="fa fa-minus" v-if="archiveShow == 0"></i>
                                        <small>{{box.content}}</small>
                                    </div>
                                    <div class="text-center d-flex" v-if="archiveBoxes.length > 5">
                                        <div @click.prevent="archiveBoxToShow -= 5" class="dropdown-item dropdown-footer" style="cursor: pointer;" v-if="archiveBoxToShow > 5"><i class="fa fa-minus"></i></div>
                                        <div @click.prevent="archiveBoxToShow += 5" class="dropdown-item dropdown-footer" style="cursor: pointer;"><i class="fa fa-plus" v-if="archiveBoxToShow < archiveBoxes.length"></i></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
<!--                    TASKS----------------------------------------------------------------------------------------->
                    <div class="card-body"   v-if="isShow > 1 && isShow != 9 || isShow == -1">
<!--                        <div class="card-header" v-if="title != ''"><h4 class="text-center">{{title}}</h4></div>-->
                        <div class="list-group bg-dark">
<!--                            <div class="alert alert-info">-->
<!--                                برای مدیریت هر کار روی آن کلیک کنید-->
<!--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                                    <span aria-hidden="true">&times;</span>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <div class="alert alert-info">در هر کار شما امکان انتقال آن کار را به مرحله مربوطه دارید-->
<!--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                                    <span aria-hidden="true">&times;</span>-->
<!--                                </button>-->
<!--                            </div>-->


                            <div class="border-danger" v-if="tasks.length < 1">
                                <div class="list-group-item list-group-item-action flex-column align-items-start pointer bg-dark">
                                    <div class="p-5 text-center text-light" v-if="loading"><i class="fa fa-refresh fa-spin fa-3x"></i></div>
                                    <div class="text-center">
                                            <span class="mb-1 h6">چیزی یافت نشد</span>
                                        </div>
                                </div>
                            </div>


                            <div class="border-danger"  v-if="tasks.length > 0" v-for="(item , index) in tasks.slice(0, tasksToShow)">
                                <a data-toggle="collapse" :href="'#col'+item.id" role="button" aria-expanded="false" :aria-controls="'#col'+item.id" @click.prevent="commentFetch()"
                                   :class="{'bg-secondary':item.lastStatus == 0,'bg-dark': item.lastStatus == 1,'bg-success text-dark': item.lastStatus == 2,'bg-dark text-light': item.lastStatus == 3,'bg-warning text-dark': item.lastStatus > 3}"
                                   class="list-group-item list-group-item-action flex-column align-items-start pointer">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <span class="badge badge-dark"><i :class="{'fa fa-users text-info': item.users.length > 1,'fa fa-user': item.users.length == 1}"></i></span> <span class="mb-1 h6"><span class="badge badge-info">{{item.task.subject}}</span> {{item.task.title}} <small class="text-muted ml-1">{{item.task.id}}</small></span>
                                        </div>
<!--                                        <div class="">-->

<!--                                            <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus != 3"></i>-->


<!--                                            <a :href="'/tasks/' + item.task.id + '/edit'" target="_blank" title="ویرایش"><i class="fa fa-edit ml-1"></i></a>-->
<!--                                        </div>-->

                                    </div>
                                    <div class="">
                                    <small class="mb-1 text-muted">{{item.task.content.substr(0,150)}}<span v-if="item.task.content.length > 150">...</span></small>
                                    </div>
                                    <div class="d-flex justify-content-start">
<!--                                    <small class="text-muted" v-if="item.task.commentCount > 0">{{item.task.commentCount}} نظر</small>-->
<!--                                    <small class="text-muted" v-else>بدون نظر</small>-->
                                    </div>
                                </a>
                                <div class="collapse" :id="'col'+item.id">

                                    <div class="card card-body">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div class="text-center">
                                                <img :title="u.name" :src="'/storage/avatars/' + u.avatar" alt="" style="width: 25px" class="img-circle mr-1" v-for="u in item.users">
                                            </div>
                                            <div>
                                                <span class="badge-secondary badge" title="زمان مجموع صرف شده" v-if="item.time>0">{{item.time}} دقیقه</span>
                                                <small title="شروع یا ادامه کار" class="pointer text-dark" @click.prevent="playTask(item.task.id,item.id,item.routine)" v-if="item.lastStatus !== 3 || item.lastStatus !== 2"><i class="fa fa-play text-success mx-2 pointer"></i> شروع کار</small>

                                                <a  class="text-muted" :href="'/tasks/' + item.task.id" target="_blank" title="مشاهده"><i class="fa fa-link ml-1 text-dark" ></i> <small class="text-dark">مشاهده</small></a>
                                                <a  class="text-muted" :href="'/tasks/' + item.task.id + '/edit'" target="_blank" title="ویرایش"><i class="fa fa-edit ml-1 text-dark"></i> <small class="text-dark">ویرایش</small></a>
                                                <span class="bg-secondary bulb mr-3">
                                                    <a title="Share on Whatsapp" data-toggle="tooltip" target="_blank" :href="'https://api.whatsapp.com/send?phone=whatsappphonenumber&text=Please Check this Task on SADIQ: ' + item.task.title + 'http://i.sadiq-co.com/tasks/'+ item.task.id" class="mx-2 "><i class="fa fa-whatsapp text-light"></i></a>
                                                    <a title="Share on Telegram" data-toggle="tooltip" target="_blank" :href="'https://telegram.me/share/url?url=http://i.sadiq-co.com/tasks/' + item.task.id + '&text=Please Check this Task on SADIQ: ' + item.task.title" class="mx-2 "><i class="fa fa-telegram text-light"></i></a>
                                                </span>
<!--                                                <i title="شروع یا ادامه کار" class="fa fa-play text-success mx-2 pointer" @click.prevent="newStatus('شروع کار','start',item.task.id,item.id,item.routine)" v-if="item.lastStatus < 2"></i>-->
                                        </div></div>
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                 <a :href="'/storage/uploads/' + item.task.pic" target="_blank"><img class="img-fluid   " :src="'/storage/uploads/' + item.task.pic" :alt="item.task.id"></a>
                                            </div>
                                            <div class="col-xl-6 col-lg-8 col-md-6">
                                                <p class="text-dark">توضیحات: {{item.task.content}}</p>
                                                <form @submit.prevent="addComment(item.task.id)" autocomplete="off">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" name="content" v-model="content" class="form-control" placeholder="ثبت نظر...">
                                                            <div class="input-group-append"><button type="submit" class="btn btn-success"><i class="fa fa-arrow-down"></i></button></div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="" style="max-height:500px;overflow:auto">
                                                    <div class="card-footer" v-for="(comment,index) in comments" v-if="comment.task_id == item.task_id">
                                                        <div class="d-flex justify-content-between">
                                                            <div><img :src="'/storage/avatars/' + comment.user.avatar" :alt="comment.user.name" class="img-circle" style="width: 20px;"> <small class="text-dark">{{comment.user.name}}</small></div>

                                                            <div class="">
                                                                <small class="text-muted">{{comment.diff}}</small>
                                                                <i class="fa fa-ellipsis-v text-secondary"></i>
                                                            </div>
                                                        </div>
                                                        <div class="pr-4">
                                                            <div class="bg-secondary px-2 py-1 bulb d-inline-block">{{comment.content}}</div>

                                                        </div>
                                                    </div>
                                                    <a :href="'/tasks/' + item.task.id" class="text-dark" v-if="item.task.commentCount > 0"><div class="card-footer text-dark text-center">

                                                            <p class="text-dark">  جهت مشاهده تمام نظرات این کار، اینجا کلیک کنید</p>
                                                        <i class="fa fa-comments fa-3x text-dark"></i>
                                                    </div></a>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 bg-light">
                                                <p class="text-dark p-3">چک لیست</p>
                                                <checklist :user="user" :task="item.task_id"></checklist>

                                            </div>
                                        </div>
                                        <div class="d-flex w-100 justify-content-end">
                                            <div class="">
                                                <transition name="fade"><span class="badge badge-dark" v-if="showTips == item.id">{{showTipsTitle}}</span></transition>

                                                <i class="fa fa-flag-checkered text-secondary mx-2 pointer hvr-bob"
                                                   @mouseover="showTips = item.id,showTipsTitle='انتقال به بخش چاپ'"
                                                   @mouseleave="showTips = false"
                                                   @click.prevent="newStatus('انتقال به بخش چاپ ' + item.task.title,'print',item.task.id,item.routine)"
                                                   v-if="item.lastStatus <= 2 || item.lastStatus == 5"
                                                ></i>
                                                <i class="fa fa-flag-o text-secondary mx-2 pointer hvr-bob"
                                                   @mouseover="showTips = item.id,showTipsTitle='انتقال به بخش پیگیری'"
                                                   @mouseleave="showTips = false"
                                                   @click.prevent="newStatus('انتقال به بخش پیگیری ' + item.task.title,'follow',item.task.id,item.routine)"
                                                   v-if="item.lastStatus <= 2 || item.lastStatus == 6"
                                                ></i>
                                                <i class="fa fa-puzzle-piece text-secondary mx-2 pointer hvr-bob"
                                                   @mouseover="showTips = item.id,showTipsTitle='انتقال به بخش معلق'"
                                                   @mouseleave="showTips = false"
                                                   @click.prevent="newStatus('انتقال به بخش معلق ' + item.task.title,'pending',item.task.id,item.routine)"
                                                   v-if="item.lastStatus <= 2 || item.lastStatus == 6 || item.lastStatus == 5"
                                                ></i>
                                                <i class="fa fa-stop text-secondary mx-2 pointer hvr-bob"
                                                   @mouseover="showTips = item.id,showTipsTitle='اعلام پایان کار'"
                                                   @mouseleave="showTips = false"
                                                   @click.prevent="newStatus('اعلام پایان کار ' + item.task.title,'end',item.task.id,item.routine)"
                                                   v-if="item.lastStatus <= 2 || item.lastStatus == 6 || item.lastStatus == 5"
                                                ></i>
<!--                                                <i class="fa fa-recycle text-secondary mx-2 pointer hvr-bob"-->
<!--                                                   @mouseover="showTips = item.id,showTipsTitle='برگشت از پایان کار'"-->
<!--                                                   @mouseleave="showTips = false"-->
<!--                                                   @click.prevent="newStatus('برگشت از پایان کار ' + item.task.title,'recycle',item.task.id,item.routine)"-->
<!--                                                   v-if="item.lastStatus == 3"-->
<!--                                                ></i>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3" v-if="tasks.length > 5">
                            <small>نمایش {{tasksToShow}} از {{tasks.length}} <button class="btn btn-link btn-sm btn-block" type="button" @click.prevent="addTasksToShow(tasks.length)">بیشتر</button></small>
<!--                        <i class="fa fa-circle ml-1" v-for="index in tasksToShow/5" :key="index" @click.prevent="addTasksToShow(tasks.length)"></i>-->
                        </div>
                    </div>
                </div>
                    </transition>

                    <fin :user="this.user"></fin>

                </div>
            </div>
        </div>
</template>

<script>

    import ZoomCenterTransition from "vue2-transitions/src/Zoom/ZoomCenterTransition";
    import ZoomUpTransition from "vue2-transitions/src/Zoom/ZoomUpTransition";
    export default {
        components: {ZoomUpTransition, ZoomCenterTransition},
        props:['user','users'],
        data(){
            return{
                showfin:false,
                archiveTitle: 'آرشیو',
                archiveShow: '',
                boxStarted: '',
                toUserId: this.user,
                isShow: 0,
                newBox:'',
                boxes:[],
                sentBoxes:[],
                forcedBoxes:[],
                archiveBoxes:[],
                boxToShow:5,
                showBox:false,
                activeTab: 2,
                title: '',
                firstVisit: [],
                test: true,
                content: '',
                tasksToShow: 5,
                toShow: 5,
                archiveBoxToShow: 5,
                played: true,
                noRes: false,
                showMenu: false,
                showTasks: false,
                searchValue:'',
                loop:[],
                tasks:[],
                commentsLoop:[],
                mainTasks:[],
                mainTasksRoutine:[],
                comments:[],
                timePassed: '',
                curTime:'',
                chartData:[],
                d:'',
                taskMeterToday: '',
                taskMeterEnd:'',
                showTips:false,
                showTipsTitle:'',
                boxToUserId:'',
                showBoxForm: true,
                day:0,
                ShowMainRoutine:true,
                ShowMainCurrentTask:true,
                ShowMainBox:true,
                minimize:false,
                loading:true,


            }
        },
        created: function () {
            this.chartFetch();

        },
        mounted: function () {
            // this.visit();


            // this.tasks='';
            // this.title='باکس';
            this.activeTab=8;
            this.isShow=9;
            // this.fetchCurrentTasksMain();
            this.myboxFetchMain(0);
            this.boxStartedCheck();
            this.timing();
            this.fetchRoutineMain();
            this.fetchTasksMain('lastStatus','<=',2,'order_column','asc',0);

            setInterval(this.timing, 1000)
            // this.checkChartData();

        },
        computed: {

            computeBeforeIn: function () {
                    let hh = parseInt(this.chartData.inToday.created_at.substr(11, 2));
                    let mm = parseInt(this.chartData.inToday.created_at.substr(14, 2));
                    return (((((hh*60)+mm)-510)*100)/570);
            },
            computeLastStartBeforeToday: function () {
                if(this.chartData.startsToday.length == 0){
                    return this.timePassed
                }else{
                    let hh = parseInt(this.chartData.startsToday[0].created_at.substr(11, 2));
                    let mm = parseInt(this.chartData.startsToday[0].created_at.substr(14, 2));
                    return (((((hh*60)+mm)-510)*100)/570);
                }
            },
            computeStartsToday: function () {
                if(this.chartData.startsToday.length > 1) {


                }else{
                    let hh = parseInt(this.chartData.startsToday[0].created_at.substr(11, 2));
                    let mm = parseInt(this.chartData.startsToday[0].created_at.substr(14, 2));
                    let xx = (((((hh*60)+mm)-510)*100)/570);
                    return this.timePassed - xx;
                }


            }
        },
        methods:{

            mainLine: function(){
                // this.title='باکس';
                this.activeTab=8;
                this.isShow=9;
                this.fetchmain;
                this.fetchRoutineMain;
                // this.myboxFetchMain(0);
                // this.myboxFetchMain(day);
                // this.fetchTasksMain('lastStatus','<=',2,'order_column','asc',day);
                // this.fetchTasksRoutine('routine','=',1,'order_column','asc',day);
                this.myboxFetchMain(0);
                this.fetchTasksMain('lastStatus','<=',2,'order_column','asc',0);
                this.fetchTasksRoutine('routine','=',1,'order_column','asc',0)
            },
            selectUser: function(uId,uName){

                if (this.user != uId){
                    this.toUserId = uId;
                    this.showBoxForm = true;
                    this.boxToUserIdName = uName;
                } else {
                    this.toUserId = uId;
                    this.boxToUserIdName = false;
                    this.showBoxForm = true;
                }
            },
            timing: function(){
                let d = new Date();
                this.d = d;
                let h = d.getHours();
                let m = d.getMinutes();
                let s = d.getSeconds();
                this.timePassed = (((((h*60)+m)-510)*100)/570);

                h = (h < 10) ? "0" + h : h;
                m = (m < 10) ? "0" + m : m;
                s = (s < 10) ? "0" + s : s;
                this.curTime = h +':'+m+':'+s;
            },
            toggleBoxForm: function(){
                if (this.showBoxForm === false){
                    this.showBoxForm = true
                }else{
                    this.showBoxForm = false
                }
            },
            loadSpinner: function(){
                this.loading=false;
                this.listShow=true;
            },
            fetchCurrentTasks: function(){
                setTimeout(this.loadSpinner, 2000);
                this.tasks='';
                this.fetchTasks('lastStatus','<=',2,'order_column','asc');
                this.commentFetch();
                this.title='در حال انجام';
                this.activeTab=2;
                this.isShow=4
            },
            fetchCurrentTasksMain: function(){
                this.tasks='';
                this.fetchTasks('lastStatus','<=',2,'order_column','asc');
                this.commentFetch();
                this.title='در حال انجام';
                this.activeTab=8;
                this.isShow=9
            },
            fetchRoutine: function(){
                this.tasks=''
                this.fetchTasks('routine','=',1,'order_column','asc');
                this.commentFetch();
                this.title='کارهای روتین';
                this.activeTab=0;
                this.isShow=2
            },
            fetchRoutineMain: function(){
                this.tasks=''
                this.fetchTasksRoutine('routine','=',1,'order_column','asc',0);
            },
            CheckItem: function(event,id,content){
                    axios.post('/api/statusUpdateBox/' + id,{
                        status: 'boxed',
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                this.newStatus('پایان باکس ' + content,'box-end',null,null,id,0);
            },
            boxFetch: function(){
                this.myboxFetch();
                this.othersBoxFetch();
                this.forcedBoxFetch();
                this.boxStartedCheck();
                this.chartFetch();
            },
            fetchmain: function(){
                 this.fetchCurrentTasksMain();

            },
            archiveBoxFetch: function(){
                let url = '/api/statusListBox?archiveBoxUserId=' + this.user;
                axios.get(url).then(response => this.archiveBoxes = response.data);
                this.archiveShow = 0;
                this.archiveTitle = 'آرشیو'

            },
            archiveSentBoxFetch: function(){
                let url = '/api/statusListBox?archiveSentBoxUserId=' + this.user;
                axios.get(url).then(response => this.archiveBoxes = response.data);
                this.archiveShow = 1;
                this.archiveTitle = 'باکسهای درخواستی'

            },
            chartFetch: function(){
                let url = '/api/chartFetch?ID=' + this.user;
                axios.get(url).then(response => this.chartData = response.data);

            },
            checkChartData: function(){
                // let d = new Date();
                // let dd = this.chartData[0].created_at.substr(8, 2);
                // let hh = parseInt(this.chartData[0].created_at.substr(11, 2));
                // let mm = parseInt(this.chartData[0].created_at.substr(14, 2));
                // console.log((hh*60)+mm);
                //
                // if(d.getDate() == dd){
                //     this.taskMeterToday= true;
                // }else{
                //     this.taskMeterToday= false;
                //     this.taskMeterEnd = 10
                // }

            },
            myboxFetch: function(){
                let url = '/api/statusListBox?ID=' + this.user;
                axios.get(url).then(response => this.boxes = response.data)
            },
            myboxFetchMain: function(day){
                let url = '/api/statusListBox?ID=' + this.user + '&day=' + day;
                axios.get(url).then(response => this.boxes = response.data)
            },
            othersBoxFetch: function(){
                let url = '/api/statusListBox?toid=' + this.user;
                axios.get(url).then(response => this.sentBoxes = response.data)
            },
            forcedBoxFetch: function(){
                let url = '/api/statusListBox?fid=' + this.user;
                axios.get(url).then(response => this.forcedBoxes = response.data)
            },
            boxStartedCheck: function(){
                let url = '/api/statusListBox?userPlayId=' + this.user;
                axios.get(url).then(response => this.boxStarted = response.data)
            },
            addStatus(user){
                if (this.newBox != ''){
                        if (this.toUserId == ''){
                            this.toUserId = user
                        }


                    axios.post('/api/addStatusToBox',{
                        content:this.newBox,
                        to_user: this.toUserId,
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
                    // this.boxes.splice(0, 0, {content: this.newBox});

                    this.newBox = '';

                    // console.log('Adding');
                }
            },
            addBoxToUsers(user){
                if (this.newBox != ''){
                    axios.post('/api/addBoxToUsers',{
                        content:this.newBox,
                        to_user: this.toUserId,
                        user_id: user,
                        status: 'box'
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    this.newBox = '';
                }
            },

            // visit: function(){
            //
            //
            //     axios.post('/api/addStatusToBox',{
            //             content: 'بازدید کاربر',
            //             user_id: this.user,
            //             status: 'visit',
            //         })
            //         .then(function (response) {
            //             console.log(response);
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //         });
            //   },
            newStatus: function(content,status,task_id,routine,re_id,forcedBox){


                axios.post('/api/addStatusToBox',{
                        content: content,
                        user_id: this.user,
                        status: status,
                        task_id: task_id,
                        re_id: re_id,
                        forcedBox: forcedBox,
                    })
                    .then(function (response) {
                        this.fetchCurrentTasks
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                if (status == 'box-start' || status == 'box-pause' || status == 'box-end'){
                    this.boxFetch();
                }else if(routine === 1){
                    this.fetchRoutine();
                }else{
                    this.fetchCurrentTasks
                }


            },
            playTask: function(task_id,id,routine){
                let url = 'api/playTask?task=' + task_id + '&user=' + this.user;
                axios.get(url).then(
                    this.fetchCurrentTasks
                    )
                    .catch(function (error) {
                        console.log(error);
                    });

                // if (status == 'box-start' || status == 'box-pause' || status == 'box-end'){
                //     this.boxFetch();
                // }else if(routine === 1){
                //     this.fetchRoutine();
                // }else{
                //     this.fetchCurrentTasks
                // }


            },
            addComment: function(task_id){
                if (this.content !== '') {
                    axios.post('/api/addStatusToBox', {
                        content: this.content,
                        user_id: this.user,
                        status: 'comment',
                        task_id: task_id
                    })
                        .then(console.log('response'),this.content = '',this.commentFetch())
                }
            },
            commentFetch: function(){
                let url = '/api/commentFetch';
                axios.get(url).then(response => this.comments = response.data)
            },
            addTasksToShow: function(qty){
                this.tasksToShow+=5;
                if(this.tasksToShow >= qty){
                    this.tasksToShow = qty;
                }
            },
            indicator: function(){
                this.showMenu = true;
                this.noRes = false;
                this.loop = [];
                this.showTasks = true;
            },
            searchTab: function(){
                this.showTasks = false;
                this.showMenu = false;

            },
            fetchTasks: function(el,op,val,ord,ordOp){
                let url = 'api/fetchTasks?u=' + this.user + '&el=' + el + '&op=' + op + '&val=' + val + '&ord=' + ord + '&ordOp=' + ordOp;
                axios.get(url).then(response => this.tasks = response.data);
            },
            fetchTasksRoutine: function(el,op,val,ord,ordOp,day){
                let url = 'api/fetchTasks?u=' + this.user + '&el=' + el + '&op=' + op + '&val=' + val + '&ord=' + ord + '&ordOp=' + ordOp + '&day=' + day;
                axios.get(url).then(response => this.mainTasksRoutine = response.data);
            },
            fetchTasksMain: function(el,op,val,ord,ordOp,day){
                let url = 'api/fetchTasks?u=' + this.user + '&el=' + el + '&op=' + op + '&val=' + val + '&ord=' + ord + '&ordOp=' + ordOp + '&day=' + day;
                axios.get(url).then(response => this.mainTasks = response.data);
                let url2 = 'api/dayComments?u=' + this.user + '&day=' + day;
                axios.get(url2).then(response => this.commentsLoop = response.data);


            },
            searchTasks: function () {
                this.tasks='';
                this.activeTab='';
                this.isShow=-1;
                let url = 'api/searchTasks?u=' + this.user + '&s=' + this.searchValue;

                axios.get(url).then(
                    response => this.tasks = response.data,
                    );
            },
        }

    }

</script>

<style scoped>
.pointer{
    cursor:pointer
}
    .bulb{
        -webkit-border-radius: 30px;
        -webkit-border-top-right-radius: 0;
        -moz-border-radius: 30px;
        -moz-border-radius-topright: 0;
        border-radius: 30px;
        border-top-right-radius: 0;
    }
.fade-enter-active , .fade-leave-active {
    transition: opacity .2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
.user-selected{
    width: 40px;
    cursor: pointer;
}

.user-not-selected{
    width: 30px;
    cursor: pointer;
}

</style>

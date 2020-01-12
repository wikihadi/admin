<template>
    <div class="row m-0 p-0"  dir="rtl">

        <div class="position-fixed bg-dark h-100 d-flex flex-column justify-content-between align-content-center align-items-center" style="z-index: 1000; min-width: 500px" v-if="menu">

            <div class="mt-3 text-light text-center">
                <div><img  data-placement="top" data-toggle="tooltip" :src="'/storage/avatars/' + user.avatar" class="a-img-100" :alt="user.name" :title="user.name"></div>
                <div class="h3 m-3">{{user.name}}</div>
            </div>
            <div></div>
            <button class="btn btn-block btn-link" @click="menu=false"><i class="fa fa-times text-white fa-2x"></i></button>

        </div>
        <!--<div class="col-sm-2 d-none d-sm-block" dir="rtl">-->
            <!--<div class="text-right m-3" dir="rtl">-->
                <!--<img  data-placement="top" data-toggle="tooltip" :src="'/storage/avatars/' + user.avatar" class="a-img-50" :alt="user.name" :title="user.name">-->
            <!--</div>-->
            <!--<div class="list-group list-group-flush w-100 m-0 p-0">-->

                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>-->
                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>-->
                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>-->
                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>-->
                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>-->
                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>-->
                <!--<a href="#" class="list-group-item list-group-item-action list-group-item-dark">This is a dark list group item</a>-->
            <!--</div>-->

        <!--</div>-->
        <div class="col-12 m-0 p-0">

        <div class="p-3 border-bottom">
            <div class="a-h-50">
                <!--<img  data-placement="top" data-toggle="tooltip" :src="'/storage/avatars/' + user.avatar"-->
                      <!--class="img-circle border border-primary hvr-grow a-img-50" :alt="user.name" :title="user.name">-->
                <button class="btn btn-link hvr-buzz animated bounceIn"><i class="fa fa-bell fa-2x text-info"></i></button>
                <button class="btn btn-link hvr-grow"><i class="fa fa-play-circle fa-2x text-success border a-circle"></i></button>

                <!--<button class="btn btn-link hvr-grow"><i class="fa fa-pause-circle fa-2x text-warning"></i></button>-->
                <!--<button class="btn btn-link hvr-grow"><i class="fa fa-stop-circle fa-2x text-danger"></i></button>-->
                <span class="a-round badge-success p-2">315. برنامه ریزی روی کارهای آتی</span>
                    <button style="width: 50px" class="btn btn-link" @click="menu=true" v-if="!menu"><i class="fa fa-bars fa-2x text-secondary"></i></button>
                    <button style="width: 50px" class="btn btn-link" @click="menu=false" v-if="menu"><i class="fa fa-times fa-2x text-secondary"></i></button>
            </div>

        </div>
            <div class="col-12 row m-0 p-0">
<div class="col-12 mt-5 p-0 m-0">
<div class="m-3">
    <b-badge pill variant="primary">روتین</b-badge>
    <b-badge pill variant="info">در انتظار</b-badge>
    <b-badge pill variant="success">در حال انجام</b-badge>
    <b-badge pill variant="dark">پایان یافته</b-badge>
    <b-badge pill variant="warning">پیگیری</b-badge>
    <b-badge pill variant="secondary">معلق</b-badge>
    <b-badge pill variant="light" v-b-tooltip.hover title="Out Sourced">برون سپاری شده</b-badge>

</div>



    <div class="list-group list list-group-flush" dir="rtl">
        <li class="list-group-item a-pointer">

            <div class="d-flex justify-content-between">

                <div>315. برنامه ریزی روی کارهای آتی

                </div>
                <div>
                    <span class="badge badge-pill badge-dark">Done</span>
                </div>
            </div>

        </li>


        <li class="list-group-item list-group-item-warning a-pointer">
            <div class="d-flex justify-content-between">
                <div>315. برنامه ریزی روی کارهای آتی</div>
                <div>
                    <span class="badge badge-pill badge-warning">Following</span>
                </div>
            </div>

        </li>

        <li class="list-group-item list-group-item-success a-pointer">
            <div class="d-flex justify-content-between">
                <div>315. برنامه ریزی روی کارهای آتی</div>
                <div>
                    <span class="badge badge-pill badge-success animated infinite pulse">Doing</span>
                </div>
            </div>
        </li>
         <li class="list-group-item list-group-item-info a-pointer">
            <div class="d-flex justify-content-between">
                <div>315. برنامه ریزی روی کارهای آتی</div>
                <div>
                    <span>
                                        <img  data-placement="top" data-toggle="tooltip" :src="'/storage/avatars/' + user.avatar" class="img-circle border border-primary hvr-grow" style="width: 25px;border-radius: 50%;object-fit: cover" :alt="user.name" :title="user.name">
                                        <img  data-placement="top" data-toggle="tooltip" :src="'/storage/avatars/' + user.avatar" class="img-circle border border-primary hvr-grow" style="width: 25px;border-radius: 50%;object-fit: cover" :alt="user.name" :title="user.name">
                                        <img  data-placement="top" data-toggle="tooltip" :src="'/storage/avatars/' + user.avatar" class="img-circle border border-primary hvr-grow" style="width: 25px;border-radius: 50%;object-fit: cover" :alt="user.name" :title="user.name">
                    </span>
                    <span class="badge badge-pill badge-light">5days later</span>
                    <span class="badge badge-pill badge-info">ToDo</span>

                </div>
            </div>
        </li>
        <li class="list-group-item list-group-item-dark a-pointer">
            <div class="d-flex justify-content-between">
                <div>315. برنامه ریزی روی کارهای آتی</div>
                <div>
                    <span class="badge badge-pill badge-secondary">Out of Service</span>
                </div>
            </div>
        </li>
        <li class="list-group-item list-group-item-info a-pointer">
            <div class="d-flex justify-content-between">
                <div>315. برنامه ریزی روی کارهای آتی</div>
                <div>
                    <span class="badge badge-pill badge-primary">Routine</span>
                </div>
            </div>
        </li>
     </div>
            </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "home",
        props:['user'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                menu:false,
                isShow:false,
            }
        },
        methods: {

        },

    }
</script>

<style scoped>

</style>

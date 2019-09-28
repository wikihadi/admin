<template>
    <div>
        <div class="jumbotron" v-if="task!=0">

            <h2>{{task.id}}.{{task.title}}</h2>
            <p>{{task.content}}</p>
            <hr class="m-4">

            <small class="badge badge-info">وضعیت: در حال بررسی</small>
            <small class="badge badge-secondary">ثبت شده در: {{task.jCreated_at}}</small>
            <p class="badge badge-secondary">کد {{task.id}}</p>
            <small class="badge badge-secondary">توسط {{user.name}}</small>




            <a class="btn btn-sm btn-secondary pull-left" href="/request">درخواست جدید</a>
        </div>
        <div class="jumbotron" v-if="task==0">
            <h1 class="display-4">فرم درخواست کار</h1>
            <div v-if="!showForm">
            <p class="lead">با تکمیل این فرم درخواست شما در صف بررسی قرار خواهد گرفت و در صورت لزوم به لیست کارها افزوده خواهد شد. دقت کنید که توضیحات دقیق شما، امکان بررسی سریعتر این کار را فراهم خواهد کرد.</p>
                <hr class="m-4">

                <button type="button" class="btn btn-primary" @click.prevent="showForm=!showForm">موافقم</button>
        </div>
            <div v-if="showForm">
            <hr class="m-4">

        <form method="post" action="">
            <input type="hidden" name="_token" :value="csrf">

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="title">عنوان</label>
                        <small class="text-info">{{comment1}}</small>

                        <input name="title" type="text" class="form-control" id="title" placeholder="عنوان" required v-model="title"
                               @focus="comment1 = 'برای پیگیری های بهتر یک عنوان ضروری است.'"
                               @blur="comment1 = ''"
                        >
                    </div>
            </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="brand">مربوط به برند</label>
                        <!--<small>{{comment2}}</small>-->
                        <select name="brand" id="brand" required class="form-control" v-model="brandId">
                                <!--@focus="comment2 = 'در صورتی که برند مورد نظر در لیست موجود نبود با انتخاب یک برند درخواست خود را ثبت نموده و با واحد انفورماتیک تماس بگیرید.'"-->
                                <!--@blur="comment2 = ''"-->
                        <!--&gt;-->
                            <option v-for="brand in brands" :value="brand.id">{{brand.title}}</option>
                        </select>
                    </div>
            </div>
            </div>


            <div class="form-group">
                <label for="content">توضیحات کار</label>
                <small  class="text-info">{{comment3}}</small>

                <textarea name="content" class="form-control" id="content" v-model="content" placeholder="توضیحات" required
                          @focus="comment3 = 'نکاتی که می تواند به تسریع کار کمک کند در این قسمت وارد نمایید'"
                          @blur="comment3 = ''"
                ></textarea>
            </div>
            <!--<div class="form-group">-->
                <!--<label for="pic">تصویر</label>-->
                <!--<input type="file" id="pic">-->
            <!--</div>-->
            <button type="submit" class="btn btn-success btn-block">ثبت درخواست</button>

            <button type="button" class="btn btn-link mt-4" @click.prevent="showForm=!showForm">بستن</button>

        </form>
            </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "Request",
        props:['user','brands','task'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                title:'',
                brandId:'',
                content:'',
                pic:'',
                showForm:false,
                comment1:'',
                comment2:'',
                comment3:'',
            }
        },
    }
</script>

<style scoped>

</style>

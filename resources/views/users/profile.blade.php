@extends('admincore.app')

@section('content')







            <div class="row w-100">




                <div class="col-md-3">
                    @if ($message = Session::get('success'))

                        <div class="alert alert-success alert-block w-100">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>{{ $message }}</strong>

                        </div>

                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img style="object-fit: cover; height: 10rem; width: 10rem;"
                                     class="profile-user-img img-fluid img-circle"
                                     src="/storage/avatars/{{ $user->avatar }}"
                                     alt="User profile picture"
                                     data-toggle="collapse"
                                     data-target="#demo"
                                     title="تغییر تصویر پروفایل"
                                >
                            </div>
                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <p class="text-muted text-center">{{$user->experience}}</p>
                        <div id="demo" class="collapse">

                        @if(Auth::user()->id  == $user->id)

                                <form action="" method="post" enctype="multipart/form-data">

                                    @csrf
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">تا 2 مگابایت</small>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name">نام و نام خانوادگی (فارسی)</label>
                                            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                        </div>

                                        {{--<div class="form-group row">--}}
                                            {{--<label for="phone">تلفن همراه</label>--}}
                                            {{--<input class="form-control" type="tel" max="10" name="phone" value="{{ $user->phone }}">--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row">--}}
                                        {{--<div class="col-2"><label for="email">ایمیل</label></div>--}}
                                        {{--<div class="col-10"><input disabled="disabled" class="form-control" type="email" name="email" value="{{ $user->email }}"></div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row">--}}
                                            {{--<label for="password">رمز</label>--}}
                                            {{--<input class="form-control" type="password" name="password"  autocomplete="off">--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row">--}}
                                            {{--<label for="password-confirm">تکرار رمز</label>--}}
                                            {{--<input class="form-control" type="password" name="password-confirm"  autocomplete="off">--}}
                                        {{--</div>--}}
                                        <div class="form-group row">
                                            <label for="experience">یادداشت</label>
                                            <textarea name="experience" class="form-control">{{ $user->experience }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">ویرایش پروفایل</button>
                                    </form>
                                    @endif
                        </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">درباره من</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-phone mr-1"></i>تلفن</strong>
                            <p class="text-muted">
                                {{ $user->phone }}
                            </p>
                            <strong><i class="fa fa-mail-forward mr-1"></i> ایمیل</strong>

                            <p class="text-muted">
                                {{ $user->email }}
                            </p>

                            {{--<hr>--}}

                            {{--<strong><i class="fa fa-users mr-1"></i> گروه کاری</strong>--}}

                            {{--<p class="text-muted">واحد طراحی</p>--}}

                            {{--<hr>--}}



                            {{--<strong><i class="fa fa-file-text-o mr-1"></i> یادداشت</strong>--}}

                            <p class="text-muted">{{ $user->experience }}</p>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn text-danger btn-link btn-block "
                                    data-toggle="collapse"
                                    data-target="#demo"
                            >ویرایش پروفایل<i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    {{--<div class="card collapse" id="edit">--}}




                        {{--<div class="card-header"><div class="card-title">ویرایش پروفایل</div></div>--}}

                        {{--<div class="card-body">--}}


                                {{--<form method="post" action="">--}}

                                    {{--@csrf--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="name">نام و نام خانوادگی (فارسی)</label>--}}
                                    {{--<input class="form-control" type="text" name="name" value="{{ $user->name }}">--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                {{--<div class="col-2"><label for="email">ایمیل</label></div>--}}
                                {{--<div class="col-10"><input disabled="disabled" class="form-control" type="email" name="email" value="{{ $user->email }}"></div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="password">رمز</label>--}}
                                    {{--<input class="form-control" type="password" name="password"  autocomplete="off">--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="password-confirm">تکرار رمز</label>--}}
                                    {{--<input class="form-control" type="password" name="password-confirm"  autocomplete="off">--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="experience">یادداشت</label>--}}
                                    {{--<textarea name="experience" class="form-control">{{ $user->experience }}</textarea>--}}
                                {{--</div>--}}
                                {{--<div class="alert alert-info">اگر رمز خود را نمی خواهید تغییر دهید فیلدهای رمز و تکرار رمز را خالی رها کنید</div>--}}

                                {{--<button type="submit" class="btn btn-block btn-success">ویرایش پروفایل</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">



                    <div class="card">
                        <div class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="home" aria-selected="true">پیام های من</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="profile" aria-selected="false">فعالیت های من</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="contact" aria-selected="false">پیام های ارسالی</a>
                        </li>
                    </ul>
                        </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active card-body" id="messages" role="tabpanel" aria-labelledby="home-tab">

                            @if(count($myStatuses) == 0)
                                <h5 class="text-center m-3">شما هیچ پیامی ندارید</h5>

                            @else
                                @foreach($myStatuses as $s)
                                    <div class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <img src="/storage/avatars/{{ $s->user->avatar }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                                            <div class="media-body">
                                                <h3 class="dropdown-item-title">

                                                    <span class="float-left text-sm text-muted" title="{{$s->task_id}}"><i class="fa fa-clock-o"></i> {{$s->diff}}</span>
                                                </h3>
                                                <p class="text-sm">{{$s->content}}</p>
                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </div>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                                    {{ $myStatuses->links() }}

                            @endif

                        </div>
                        <div class="tab-pane fade card-body" id="activity" role="tabpanel" aria-labelledby="profile-tab">

                            <h5 class="text-center m-3">بزودی</h5>

                            {{--@if(count($myActivities) == 0)--}}
                                {{--<h5 class="text-center m-3">شما هیچ پیامی ندارید</h5>--}}

                            {{--@else--}}
                                {{--@foreach($myActivities as $s)--}}
                                    {{--<div class="dropdown-item">--}}
                                        {{--<!-- Message Start -->--}}
                                        {{--<div class="media">--}}
                                            {{--<img src="/storage/avatars/{{ $s->user->avatar }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">--}}
                                            {{--<div class="media-body">--}}
                                                {{--<h3 class="dropdown-item-title">--}}

                                                    {{--<span class="float-left text-sm text-muted" title="{{$s->task_id}}"><i class="fa fa-clock-o"></i> {{$s->diff}}</span>--}}
                                                {{--</h3>--}}
                                                {{--<p class="text-sm">{{$s->content}}</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!-- Message End -->--}}
                                    {{--</div>--}}
                                    {{--<div class="dropdown-divider"></div>--}}
                                {{--@endforeach--}}

                            {{--@endif--}}


                        </div>
                        <div class="tab-pane fade card-body" id="sent" role="tabpanel" aria-labelledby="contact-tab">

                            @if(count($my) == 0)
                                <h5 class="text-center m-3">شما هیچ پیامی ارسال نکرده اید</h5>

                            @else
                                @foreach($my as $s)
                                    <div class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <img src="/storage/avatars/{{ $s->user->avatar }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                                            <div class="media-body">
                                                <h3 class="dropdown-item-title">

                                                    <span class="float-left text-sm text-muted" title="{{$s->task_id}}"><i class="fa fa-clock-o"></i> {{$s->diff}}</span>
                                                </h3>
                                                <p class="text-sm">{{$s->content}}</p>
                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </div>
                                    <div class="dropdown-divider"></div>
                                @endforeach

                            @endif

                        </div>
                    </div>
                    </div>

                    {{--<div class="card">--}}
                        {{--<div class="card-header p-2">--}}
                            {{--<ul class="nav nav-pills">--}}
                                {{--<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">فعالیت‌های انجام شده</a></li>--}}
                                {{--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">تایم لاین</a></li>--}}
                                {{--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تنظیمات</a></li>--}}
                            {{--</ul>--}}
                        {{--</div><!-- /.card-header -->--}}
                            {{--<div class="card-header"><div class="card-title">فعالیتهای اخیر من</div></div>--}}
                            {{--<div class="card-body">--}}
                                {{--@foreach($tasks as $task)--}}

                                    {{--<!-- Post -->--}}
                                    {{--<div class="post w-100">--}}
                                        {{--<div class="">--}}
                                            {{--<img class="img-circle img-bordered-sm" src="/storage/avatars/{{ $user->avatar }}" alt="user image">--}}
                                            {{--<span class="username">--}}
                          {{--<a href="/tasks/{{$task->id}}" target="_blank">{{$task->title}}</a>--}}
                          {{--<a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>--}}
                        {{--</span>--}}
                                            {{--<span class="description">آخرین تغییر در {{$task->updated_at}}</span>--}}
                                        {{--</div>--}}


                                        {{--<p>--}}
                                            {{--<a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> اشتراک گذاری</a>--}}
                                            {{--<a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> لایک</a>--}}
                                            {{--<span class=" ">--}}
                          {{--<a href="/tasks/{{$task->id}}" class="link-black text-sm">--}}
                            {{--<i class="fa fa-comments-o mr-1"></i> نظر ({{$task->commentCount}})--}}
                          {{--</a>--}}
                        {{--</span>--}}
                                        {{--</p>--}}

                                    {{--</div>--}}
                                    {{--<!-- /.post -->--}}
                                    {{--@endforeach--}}


                                    {{--<div class="post">--}}


                                        {{--<!-- /.user-block -->--}}
                                        {{--<p>--}}

                                            {{--لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.--}}
                                        {{--</p>--}}



                                    {{--</div>--}}
                                    {{--<!-- /.post -->--}}



                            {{--</div>--}}
                    {{--</div>--}}

                </div>
                </div>


@endsection
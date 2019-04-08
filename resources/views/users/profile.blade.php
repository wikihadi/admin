@extends('admincore.app')

@section('content')






    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    @if ($message = Session::get('success'))

                        <div class="alert alert-success alert-block">

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

                <div class="col-md-3">

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
                                >
                            </div>
                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <p class="text-muted text-center">درباره من</p>
                        <div id="demo" class="collapse">

                        @if(Auth::user()->id  == $user->id)
                                    <form action="/profile" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">تا 2 مگابایت</small>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">تغییر تصویر</button>
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
                            <strong><i class="fa fa-mail-forward mr-1"></i> ایمیل</strong>

                            <p class="text-muted">
                                {{ $user->email }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-users mr-1"></i> گروه کاری</strong>

                            <p class="text-muted">واحد طراحی</p>

                            <hr>



                            <strong><i class="fa fa-file-text-o mr-1"></i> یادداشت</strong>

                            <p class="text-muted">{{ $user->experience }}</p>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn text-danger btn-link btn-block"
                                    data-toggle="collapse"
                                    data-target="#edit"
                            >ویرایش پروفایل<i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card collapse" id="edit">
                        <form action="" autocomplete="off">
                        <div class="card-header"><div class="card-title">ویرایش پروفایل</div></div>
                        <div class="card-body">
                            <div class="alert alert-warning">سرویس به دیتابیس متصل نیست</div>

                            <div class="form-group row">
                                <div class="col-2"><label for="name">نام</label></div>
                                <div class="col-10"><input class="form-control" type="text" name="name" value="{{ $user->name }}"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2"><label for="email">ایمیل</label></div>
                                <div class="col-10"><input disabled="disabled" class="form-control" type="email" name="email" value="{{ $user->email }}"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2"><label for="password">رمز</label></div>
                                <div class="col-10"><input class="form-control" type="password" name="password" placeholder="********" value=""></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2"><label for="password-confirm">رمز دوباره</label></div>
                                <div class="col-10"><input class="form-control" type="password" name="password-confirm" placeholder="********"  ></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2"><label for="experience">یادداشت</label></div>
                                <div class="col-10"><textarea name="experience" class="form-control">{{ $user->experience }}</textarea></div>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                        </form>
                    </div>
                    <div class="card">
                        {{--<div class="card-header p-2">--}}
                            {{--<ul class="nav nav-pills">--}}
                                {{--<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">فعالیت‌های انجام شده</a></li>--}}
                                {{--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">تایم لاین</a></li>--}}
                                {{--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تنظیمات</a></li>--}}
                            {{--</ul>--}}
                        {{--</div><!-- /.card-header -->--}}
                        <div class="card-body">
                            <div class="card-header"><div class="card-title">تاریخچه فعالیت های من</div></div>
                            <div class="card-body">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="/storage/avatars/{{ $user->avatar }}" alt="user image">
                                            <span class="username">
                          <a href="#">عملیات انجام شده</a>
                          {{--<a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>--}}
                        </span>
                                            <span class="description">آخرین تغییر در 25 آذر 1397</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>

                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                        </p>

                                        <p>
                                            {{--<a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> اشتراک گذاری</a>--}}
                                            {{--<a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> لایک</a>--}}
                                            {{--<span class="float-left">--}}
                          {{--<a href="#" class="link-black text-sm">--}}
                            {{--<i class="fa fa-comments-o mr-1"></i> نظر (5)--}}
                          {{--</a>--}}
                        {{--</span>--}}
                                        </p>

                                    </div>
                                    <!-- /.post -->

                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="/storage/avatars/{{ $user->avatar }}" alt="user image">
                                            <span class="username">
                          <a href="#">عملیات انجام شده</a>
                          {{--<a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>--}}
                        </span>
                                            <span class="description">آخرین تغییر در 25 آذر 1397</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>

                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                        </p>

                                        <p>
                                            {{--<a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> اشتراک گذاری</a>--}}
                                            {{--<a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> لایک</a>--}}
                                            {{--<span class="float-left">--}}
                          {{--<a href="#" class="link-black text-sm">--}}
                            {{--<i class="fa fa-comments-o mr-1"></i> نظر (5)--}}
                          {{--</a>--}}
                        {{--</span>--}}
                                        </p>

                                    </div>
                                    <!-- /.post -->

                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="/storage/avatars/{{ $user->avatar }}" alt="user image">
                                            <span class="username">
                          <a href="#">عملیات انجام شده</a>
                          {{--<a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>--}}
                        </span>
                                            <span class="description">آخرین تغییر در 25 آذر 1397</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>

                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                        </p>

                                        <p>
                                            {{--<a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> اشتراک گذاری</a>--}}
                                            {{--<a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> لایک</a>--}}
                                            {{--<span class="float-left">--}}
                          {{--<a href="#" class="link-black text-sm">--}}
                            {{--<i class="fa fa-comments-o mr-1"></i> نظر (5)--}}
                          {{--</a>--}}
                        {{--</span>--}}
                                        </p>

                                    </div>
                                    <!-- /.post -->



                            </div>

                        </div><!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
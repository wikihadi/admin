@extends('layouts.app')

@section('content')
    <main class="py-4" style="height: 100vh;">

        <div class="container h-100">
            <div class="d-flex justify-content-center h-100 row">
                <div class=" col-md-12 user_card">
                    <div class="row p-sm-5 p-lg-0 " style="height: 560px">
                        <div class="col-lg-6 d-none d-lg-block " ><img src="img/login.png" alt="" width="100%" style=""></div>
                        <div class="col-lg-6 align-content-center d-flex flex-column justify-content-center" >
                            <div class="d-flex justify-content-start row">
                                <div class="col-lg-9">

                                    <form class="mr-lg-0 m-auto" method="POST" action="{{ route('register') }}">
                                        @csrf




                                        <div class="form-group position-relative">
                                            <input placeholder="Name" id="name" type="text" class="myInput form-control{{ $errors->has('name') ? ' is-invalid' : '' }} validate" name="name" value="{{ old('name') }}" required autofocus>
                                            <i class="fa  fa-user fa-2x myIcon"></i>

                                        @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif

                                        </div>

                                        <div class="form-group position-relative">
                                            <input placeholder="Email" id="email" type="email" class="myInput form-control{{ $errors->has('email') ? ' is-invalid' : '' }} validate" name="email" value="{{ old('email') }}" required>
                                            <i class="fa fa-at fa-2x myIcon"></i>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group position-relative">
                                            <input placeholder="Phone" id="phone" type="phone" class="myInput form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} validate" name="phone" value="{{ old('phone') }}" required>
                                            <i class="fa fa-phone fa-2x myIcon"></i>

                                            @if ($errors->has('tel'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                            @endif
                                        </div>





                                        <div class="form-group position-relative">
                                            <input placeholder="Password" id="password" type="password" class="myInput form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                            <i class="fa fa-lock fa-2x myIcon"></i>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                            </div>

                                        <div class="form-group position-relative">
                                            <input placeholder="Password Confirmation" id="password-confirm" type="password" class="myInput form-control" name="password_confirmation" required>
                                            <i class="fa fa-lock fa-2x myIcon"></i>


                                            </div>














                                        <div class="d-flex justify-content-center mt-3 login_container pt-3" style="clear: both">




                                                <button type="submit" name="button" class="btn btn-light-green px-3 btn-rounded p-2" ><i class="fa fa-2x fa-lg fa-check-circle pr-3"></i> <span class="h4 font-weight-bold">REGISTER</span></button>


                                        </div></form>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-link btn-rounded" role="button"  href="/login">LOGIN <i class="fa fa-lg fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>

@endsection











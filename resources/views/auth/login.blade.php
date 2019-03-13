@extends('layouts.app')

@section('content')
    <main class="py-4" style="height: 100vh;background-color: #fff ">

    <div class="container h-100">
        <div class="d-flex justify-content-center h-100 row">
            <div class=" col-md-12 user_card">
            <div class="row p-sm-5 p-lg-0 " style="height: 560px">
                <div class="col-lg-6 d-none d-lg-block " ><img src="img/login.png" alt="" width="100%" style=""></div>
                <div class="col-lg-6 align-content-center d-flex flex-column justify-content-center" >
                    <div class="d-flex justify-content-start row">
                        <div class="col-lg-9">
                        <form class="mr-lg-0 m-auto" method="POST" action="{{ route('login') }}">
                            @csrf



                            <div class="form-group position-relative">
                                    <input placeholder="Email" id="email" type="email" class="myInput form-control{{ $errors->has('email') ? ' is-invalid' : '' }} validate" name="email" value="{{ old('email') }}" required autofocus >
                                <i class="fa fa-2x fa-at prefix position-absolute myIcon"></i>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group position-relative">
                                <input placeholder=Password id="password" type="password" class="myInput form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <i class="fa fa-2x fa-lock prefix myIcon"></i>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif</div>
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox float-right">
                                <input name="remember" type="checkbox" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label text-muted" for="remember">Remember me </label>
                            </div>





                            <div class="d-flex justify-content-center mt-3 login_container pt-3" style="clear: both">
                                <button type="submit" name="button" class="btn btn-light-green px-3 btn-rounded p-2" ><i class="fa fa-2x fa-lg fa-check-circle pr-2"></i> <span class="h4 font-weight-bold">SIGN IN</span></button>

                            </div>
                        </form>
                            <div class="d-flex justify-content-center">
                                    <a class="btn btn-link btn-rounded" role="button"  href="/register">REGISTER <i class="fa fa-lg fa-arrow-circle-right"></i></a>
                        </div>
                        </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    </div>
    </main>

@endsection

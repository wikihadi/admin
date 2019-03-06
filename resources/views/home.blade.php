@extends('admincore.app')

{{--@section('myNavbar')--}}

    {{--@extends('layouts.navbar')--}}

{{--@endsection--}}

@section('content')


                <div class="col-lg-6">


                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-bold">عنوان کارت</h5>

                            <p class="card-text">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            </p>
                            <a href="#" class="card-link">لینک کارت</a>
                            <a href="#" class="card-link mr-2">لینک صفحه</a>
                        </div>
                    </div><!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                {{--<div class="col-lg-6">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header">--}}
                            {{--<h5 class="m-0">ویژه</h5>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<h6 class="card-title mb-2 text-bold">عنوان کارت ویژه</h6>--}}

                            {{--<p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است </p>--}}
                            {{--<a href="#" class="btn btn-primary">برو به صفحه ایکس</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="card card-primary card-outline">--}}
                        {{--<div class="card-header">--}}
                            {{--<h5 class="m-0">ویژه</h5>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<h6 class="card-title mb-2 text-bold">عنوان کارت ویژه</h6>--}}

                            {{--<p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>--}}
                            {{--<a href="#" class="btn btn-primary">برو به صفحه ایکس</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

    <!-- /.content -->


    {{--<main class="py-4" >--}}

    {{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">Dashboard</div>--}}

                {{--<div class="card-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                        {{--@role('writer')--}}
                        {{--I'm a writer!--}}
                        {{--@else--}}
                            {{--I'm not a writer...--}}
                            {{--@endrole--}}

                    {{--You are logged in!--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
    {{--</main>--}}
@endsection

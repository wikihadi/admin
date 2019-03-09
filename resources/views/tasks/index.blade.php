@extends('admincore.app')


@section('content')



    @foreach($tasks as $task)

        <div class="col-lg-6 col-md-6 col-sm-12 animated fadeIn">
            <div class="hvr-bob card card-outline
@if($task->rightNow < 0 )
                    card-danger bg-warning
@elseif($task->rightNow <= 3)
                    card-danger

@else
                    card-info
@endif
                    ">
                <div class="card-body">
                    <h5 class="card-title mb-2 text-bold">{{$task->title}} <small class="text-muted">{{$task->rightNow}} روز دیگر</small></h5>
                    <small class="card-text text-small">{{ str_limit($task->content, $limit = 120, $end = '...') }}</small>
                    <br>
                    <a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>
                    <a href="/tasks/{{$task->id}}/edit" class="card-link mr-2 ">ویرایش</a>
                </div>
            </div><!-- /.card -->
        </div>
    @endforeach
    {{ $tasks->links() }}

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

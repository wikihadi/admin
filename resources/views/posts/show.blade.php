@extends('admincore.app')


@section('css')

    <style>

        body, .content-wrapper, .main-heade{
            background: #CBCBCB!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
        .nav-link{
            color: #888!important;
        }

        input[type=range] {
            -webkit-appearance: none;
            margin: 20px 0;
            width: 100%;
        }
        input[type=range]:focus {
            outline: none;
        }
        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: #A880BC;
            border-radius: 1.3px;
        }
        input[type=range]::-webkit-slider-thumb {
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            border: 1px solid #000000;
            height: 36px;
            width: 36px;
            border-radius: 50%;
            background: #ffffff;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -14px;
        }
        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #A880BC;
        }
        input[type=range]::-moz-range-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: #A880BC;
            border-radius: 1.3px;
        }
        input[type=range]::-moz-range-thumb {
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
        }
        input[type=range]::-ms-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            border-width: 16px 0;
            color: transparent;
        }
        input[type=range]::-ms-fill-lower {
            background: #A880BC;
            border-radius: 2.6px;
        }
        input[type=range]::-ms-fill-upper {
            background: #A880BC;
            border-radius: 2.6px;
        }
        input[type=range]::-ms-thumb {
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
        }
        input[type=range]:focus::-ms-fill-lower {
            background: #A880BC;
        }
        input[type=range]:focus::-ms-fill-upper {
            background: #A880BC;
        }
        .bullett{
            width: 30px;
            height: 30px;
            background: #A880BC;
            border-radius: 50%;
            position: absolute;
            top: 9px;
            z-index: 99;


        }


        .card-border{
            border-radius: 30px;
        }
    </style>
@endsection

@section('content')




    <div class="col-12"><div class="row">


            <div class="col-sm-4 m-auto">

                <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white" style="border-radius: 30px;">



                    <div class="text-center h2">{{$post->title}}</div>
                    <center><div class="badge badge-info mx-2">اطلاعیه شماره {{$post->id}}</div><div class="badge badge-secondary mx-2">بخش {{$post->section}}</div><div class="badge badge-light mx-2">{{$post->created_at}}</div></center>


                </div>


            </div>
        </div></div>
    <div class="col-sm-7 m-auto">

        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-light" style="border-radius: 30px;">

<p class="text-justify" style="white-space: pre-wrap;">{{$post->content}}</p>


        </div>


    </div>
    <div class="col-sm-7 m-auto">

        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-light" style="border-radius: 30px;">
            @if($read == 0)

            <form class="d-inline"  method="post" action="{{ route('status.store') }}" onsubmit="confirm('من این اطلاعیه را خوانده و تایید می کنم')">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <input type="hidden" name="status" value="verifyPost">
                <input type="hidden" name="content" value="{{Auth::user()->name}}  اطلاعیه {{$post->title}} را مطالعه و تایید نمود">
                    <button class="nav-link animated pulse infinite btn btn-block btn-link" title="این اطلاعیه توسط اینجانب مطالعه و تایید شد" type="submit"><i class="fa fa-check"></i> تایید</button>
            </form>
            @else
                <div class="alert alert-success"><strong>{{Auth::user()->name}} عزیز</strong> شما این پست را مطالعه و تایید کرده اید</div>
                @endif


            <a href="/" class="btn btn-block btn-link">برگشت به خانه</a>


        </div>


    </div>







@endsection
@section('JS')


@endsection

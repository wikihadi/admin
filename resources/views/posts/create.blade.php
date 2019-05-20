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



                    <div class="text-center">اعلانات و قوانین جدید</div>


                </div>


            </div>
        </div></div>
    <div class="col-sm-6 m-auto">

        <div class="m-0 m-sm-3 p-0 p-sm-5 bg-light" style="border-radius: 30px;">


            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block w-100">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('posts.store') }}">
                @csrf

            {{--            @foreach($posts as $post)--}}
                <div class="card card-border">
                    <div class="card-header bg-white card-border px-5">

                        <input type="text" class="form-control border-0" placeholder="عنوان" name="title">


                    </div>

                </div>
                <div class="card card-border">
                    <div class="card-header bg-white card-border px-5">

                        <textarea class="form-control border-0" placeholder="متن..." rows="8" name="content"></textarea>


                    </div>

                </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-border">
                        <div class="card-header bg-white card-border px-5">

                            <select class="form-control border-0" name="section">
                                <option value="عمومی">عمومی</option>
                                <option value="طراحی">واحد طراحی</option>
                                <option value="مالی">واحد مالی</option>
                            </select>

                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-border">
                        <div class="card-header bg-white card-border px-5 text-center">

                            <label for="emailPost">ایمیل به تمام اعضا</label>
                            <input type="checkbox" name="emailPost" id="emailPost" value="1">

                        </div>

                    </div>
                </div>


            </div>
                <input type="hidden" name="published" value="1">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

            <div class="card card-border">
                <div class="card-header bg-white card-border px-5">

                    <button class="btn btn-block btn-link">ارسال</button>


                </div>

            </div>
            {{--{{ $posts->links() }}--}}
            </form>

        </div>


    </div>






@endsection
@section('JS')


@endsection

@extends('admincore.app')

@section('css')
    @include('helper.css.createTaskCss')
@endsection

@section('content')
    <div class="col-md-8 m-auto">
        @include('helper.error')
        <div class="card uper">
            <div class="card-header">
                <div class="float-right">ویرایش {{ $task->id }}</div>
                <div class="float-left">
                    {{--اجرایی--}}
                    {{--<label class="switch">--}}
                        {{--<input type="checkbox" onchange="formToggle()">--}}
                        {{--<span class="slider"></span>--}}
                    {{--</label>--}}
                    {{--طراحی--}}
                    <span></span>
                </div>
            </div>
            <div class="card-body">
                @include('helper.editTask')


            </div>
        </div>
    </div>
@endsection

@section('JS')
    @include('helper.js.editTaskJs')
@endsection

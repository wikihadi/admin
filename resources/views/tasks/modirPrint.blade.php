@extends('admincore.appNoTopBar')

@section('css')
@endsection


@section('content')
    <div class="row col-12">
        <div class="col-12">
            <div class="jumbotron jumbotron-fluid bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 justify-content-sm-end">
                            <div class="text-left">
                            <img src="/storage/avatars/{{ $user->avatar }}" style="width: 100px" alt="" class="img-circle userJobsImageActive  delay-4s" title="{{$user->name}}" data-toggle="tooltip">
                        </div></div>
                        <div class="col-md-9">
                            <h1 class="display-4">{{$user->name}}</h1>
                            <p>بازرگانی صادق - لیست کارها در <small class="">{{$today}}</small></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">الویت</th>
                    <th scope="col">برند</th>
                    <th scope="col">نوع</th>
                    <th scope="col">برای</th>
                    <th scope="col">عنوان کار</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">تیم اجرا</th>
                </tr>

                @foreach($order as $item)
                <tr>
                    <th scope="row">{{$item->task->id}}</th>
                    @if($item->order_column==999999999)
                    <th scope="row">-</th>
                    @else
                    <th scope="row">{{$item->order_column}}</th>
                    @endif

                    <td>{{$item->task->brand}}</td>
                    <td>{{$item->task->type}}</td>
                    <td>{{$item->task->forProduct}}</td>

                    <td>{{$item->task->title}}
                        @if($item->routine==1)
                    <span class="badge badge-info">روتین</span>
                            @endif
                    </td>
                    <td class="">{{$item->task->content}}</td>
                    <td class="">
                        <div style="white-space: nowrap">
                            @foreach($item->users as $user)
                            <img src="/storage/avatars/{{ $user->user->avatar }}" style="width: 30px" alt="" class="img-circle userJobsImageActive  delay-4s" title="{{$user->user->name}}" data-toggle="tooltip">
                                @endforeach
                        </div>
                    </td>
                </tr>
                    @endforeach
            </table>

        </div>
    </div>
@endsection

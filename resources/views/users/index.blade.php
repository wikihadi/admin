@extends('admincore.app')

@section('content')
    <div class="col">

        <div class="pull-right">
            <a class="btn btn-link" href="{{ route('users.create') }}"><i class="fa fa-user-plus"></i></a>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {{--<div class="col-12">--}}

    {{--<table class="table table-striped">--}}
    {{--<tr>--}}
    {{--<th width="20حط">کد</th>--}}
    {{--<th>نام</th>--}}
    {{--<th>ایمیل</th>--}}
    {{--<th>نقشها</th>--}}
    {{--<th width="280px"></th>--}}
    {{--</tr>--}}
    {{--@foreach ($data as $key => $user)--}}
    {{--<tr>--}}
    {{--<td>{{ $user->id }}</td>--}}
    {{--<td><a class="btn btn-link" href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a></td>--}}
    {{--<td>{{ $user->email }}</td>--}}
    {{--<td>--}}
    {{--@if(!empty($user->getRoleNames()))--}}
    {{--@foreach($user->getRoleNames() as $v)--}}
    {{--<label class="badge badge-success">{{ $v }}</label>--}}
    {{--@endforeach--}}
    {{--@endif--}}
    {{--</td>--}}
    {{--<td>--}}
    {{--<div class="dropdown">--}}
    {{--<button class="btn btn-link text-muted" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>--}}
    {{--<ul class="dropdown-menu">--}}
    {{--<li><a class="btn btn-link text-warning" href="{{ route('users.edit',$user->id) }}">ویرایش کاربر</a></li>--}}
    {{--<li> {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}--}}
    {{--{!! Form::submit('حذف کاذبر', ['class' => 'btn btn-link text-danger']) !!}--}}
    {{--{!! Form::close() !!}</li>--}}
    {{--</ul>--}}
    {{--</div>--}}



    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</table>--}}


    {{--{!! $data->render() !!}--}}
    {{--</div>--}}


    <div class="col-12">
        <div class=" d-flex flex-wrap justify-content-start">

            @foreach ($data as $key => $user)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="card">
                        <div class="dropdown position-absolute">
                            <button class="btn btn-link text-muted" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="btn btn-link text-warning" href="{{ route('users.edit',$user->id) }}">ویرایش کاربر</a></li>
                                <li> {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('حذف کاربر', ['class' => 'btn btn-link text-danger']) !!}
                                    {!! Form::close() !!}</li>
                            </ul>
                        </div>
                        <img class="card-img-top" src="/storage/avatars/{{$user->avatar}}" alt="image" style="width:100%">
                        <div class="card-body pb-3">
                            <table class="table table-borderless table-hover">
                                <tr>
                                    <td>
                                        <a href="/users/{{$user->id}}" ><h4 class="card-text text-center">{{$user->name}}</h4></a>
                                    </td>
                                </tr>
                                @if(!empty($user->experience))
                                    <tr>
                                        <td>
                                            <p class="card-text text-center">{{$user->experience}}</p>
                                        </td>
                                    </tr>
                                @endif


                                @if(!empty($user->getRoleNames()))
                                    <tr>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endif



                            </table>





                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>





@endsection
@extends('admincore.app')



@section('css')

    <style>
        body, .content-wrapper, .main-heade, .bg-white ,footer{
            background: #2b2a2e!important;
        }
        .border-bottom{
            border-bottom: none!important;
        }
        .nav-link{
            color: #888!important;
        }
    </style>
@endsection
@section('content')


    <div class="col-md-10 col-lg-8 col-xl-6 m-auto mt-sm-5" style="">
        <div class="col-md-10 col-lg-8 col-xl-6 m-auto">
            @role('admin')
            <table class="table table-light text-dark table-striped">

                @foreach ($statuses as $s)
                    <tr>
                        <td>
                            <a href="/jobs/{{$s->user_id}}">

                            <img class="img-circle" style="width: 40px" src="/storage/avatars/{{$s->user->avatar}}" title="{{$s->user->name}}"/></a>
                        </td>

                        <td class="text-left"><small dir="ltr"
                                                     class="text-muted">{{$s->created_at->diffForHumans()}}</small><a target="_blank" class="btn btn-link" href="/tasks/{{$s->task_id}}"><i class="fa fa-arrow-left"></i></a></td>
                    </tr>
                    <tr>

                        <td colspan="2">

                            <div class="">{{$s->content}}</div>
                            @if($s->task != null)

                                <div class="text-left border-top">
                                    <a href="/tasks/{{$s->task->id}}" target="_blank">
                                        <small class="text-muted">
                                            {{$s->task->title}}
                                        </small>
                                    </a>

                                </div>
                            @endif
                        </td>

                    </tr>

                @endforeach
            </table>
            {{ $statuses->links() }}
            @else
                <a href="/" class="btn btn-success btn-block">داشبورد</a>
                @endrole
        </div>

    </div>

@endsection

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
            <table class="table table-light text-dark table-striped">

                @foreach ($comments as $comment)
                    <tr>
                        <td><img class="img-circle" style="width: 50px"
                                 src="/storage/avatars/{{ $comment->user->avatar }}" title="{{$comment->user->name}}"/></td>

                        <td class="text-left"><small dir="ltr"
                                    class="text-muted">{{$comment->created_at->diffForHumans()}}</small><a target="_blank" class="btn btn-link" href="/tasks/{{$comment->task_id}}"><i class="fa fa-arrow-left"></i></a></td>
                    </tr>
                    <tr>
                        <td colspan="2">{{$comment->comment}}</td>

                    </tr>

                @endforeach
            </table>

        </div>

    </div>

@endsection

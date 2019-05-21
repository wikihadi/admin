<div class="row  animated fadeIn delay-1s">
    <div class="text-right col">

        @can('task-create')
            <a href="/tasks/create" class="btn btn-link" ><i class="fa fa-plus"></i></a>

        @endcan
        {{--@role('admin|modir')--}}
            {{--@if(Request::is('pending*'))--}}
                {{--<a href="/jobs" class="btn btn-link"><i class="fa fa-list"></i></a>--}}
            {{--@elseif(Request::is('jobs*'))--}}
                {{--<a href="/pending" class="btn btn-link"><i class="fa fa-history"></i></a>--}}
            {{--@endif--}}
        {{--@endrole--}}
        <button data-toggle="collapse" href="#users" class="btn btn-link" ><i class="fa fa-users"></i></button>

            {{--@if(Request::is('jobs') || isset($jobPage) && $jobPage == 'old')--}}
                {{--<a href="/jobs/{{$user->id}}?pageType=new" class="btn btn-link"><i class="fa fa-key"></i></a>--}}
            {{--@elseif(isset($jobPage) && $jobPage == 'new')--}}
                {{--<a href="/jobs/{{$user->id}}?pageType=old" class="btn btn-link"><i class="fa fa-key"></i></a>--}}
            {{--@endif--}}
        <div  id="users" class="collapse show" data-parent="#accordion">
            <div class="d-flex justify-content-center">
                @foreach($users as $u)

                    <div class="mx-2">

                        {{--<span class="badge badge-info position-absolute"><i class="fa fa-clock-o"></i></span>--}}

                    @if(Request::is('*/'.$u->id))

                                <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle userJobsImageActive animated pulse infinite delay-4s" title="{{$u->name}}" data-toggle="tooltip">
                            @else
                            <a href="/{{$linked}}/{{$u->id}}">

                                <img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle userJobsImage hvr-push" title="{{$u->name}}" data-toggle="tooltip">
                            </a>
                            @endif

                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>
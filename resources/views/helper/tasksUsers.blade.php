<div class="row  animated fadeIn delay-1s">
    <div class="text-right col">
        <button data-toggle="collapse" href="#users" class="btn btn-link" ><i class="fa fa-users"></i></button>
        <div  id="users" class="collapse" data-parent="#accordion">
            <div class="d-flex flex-wrap justify-content-center">
                @foreach($users as $u)
                    <div class="mx-2">
                        <a href="/jobs/{{$u->id}}"><img src="/storage/avatars/{{ $u->avatar }}" alt="" class="img-circle" style="object-fit: cover; width: 100px;height: 100px" title="{{$u->name}}" data-toggle="tooltip"></a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>
<!-- Messages Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link animated fadeInUp" data-toggle="dropdown" href="#">
        <i class="fa fa-comments-o"></i>
        <span class="badge badge-danger navbar-badge"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">

        @if(count($statusesToMe) == 0)
            <div href="#" class="dropdown-item dropdown-footer">شما هیچ پیامی ندارید</div>

        @else
            @foreach($statusesToMe as $s)
                    <div href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="/storage/avatars/{{ $s->user->avatar }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">

                                    <span class="float-left text-sm text-muted" title="{{$s->task_id}}"><i class="fa fa-key"></i></span>
                                </h3>
                                <p class="text-sm">{{$s->content}}</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>{{$s->diff}}</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </div>
                    <div class="dropdown-divider"></div>
            @endforeach

            <a href="/profile" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
        @endif
    </div>
</li>
<!-- Notifications Dropdown Menu -->
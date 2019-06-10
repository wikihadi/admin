<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-bell-o"></i>
        <span class="badge badge-warning navbar-badge">{{count(Auth::user()->notifications)}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
{{--        <span class="dropdown-item dropdown-header">1</span>--}}
        <div class="dropdown-divider"></div>
@foreach(Auth::user()->unreadNotifications as $notification)
    @include('admincore.notifications.'.snake_case(class_basename($notification->type)))
{{--        <a href="#" class="dropdown-item">--}}
{{--            <i class="fa fa-envelope ml-2"></i> 15 پیام جدید--}}
{{--            {{snake_case(class_basename($notification->type))}}--}}
{{--            <span class="float-left text-muted text-sm">3 دقیقه</span>--}}
{{--        </a>--}}
        <div class="dropdown-divider"></div>
        @endforeach

        <a href="#" class="dropdown-item dropdown-footer">مشاهده همه</a>
    </div>
</li>

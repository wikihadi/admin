<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview @if(Request::is('tasks*')) menu-open @endif ">
            <a href="#" class="nav-link @if(Request::is('tasks*')) active @endif ">
                <i class="nav-icon fa fa-tasks"></i>

                <p>
                    لیست کارها
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/tasks" class="nav-link @if(Request::is('tasks')) active @endif ">
                        <i class="fa fa-list-ul nav-icon"></i>
                        <p>کارهای من</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/tasks/create" class="nav-link @if(Request::is('tasks/create')) active @endif ">
                        <i class="fa fa-lg fa-plus-square nav-icon"></i>
                        <p>کار جدید</p>
                    </a>
                </li>
            </ul>
        </li>
        {{--@role('admin')--}}
        <li class="nav-item has-treeview @if(Request::is('users*') || Request::is('roles*')) menu-open @endif ">
            <a href="#" class="nav-link @if(Request::is('users*') || Request::is('roles*')) active @endif ">
                <i class="nav-icon fa fa-user"></i>

                <p>
                    مدیریت
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/users" class="nav-link  @if(Request::is('users') || Request::is('users*   ')) active @endif ">
                        <i class="fa fa-list-ul nav-icon"></i>
                        <p>کاربران</p>
                    </a>
                </li>

                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="/roles" class="nav-link  @if(Request::is('roles*')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>نقش ها</p>
                    </a>
                </li>

            </ul>
        </li>
        {{--@endrole--}}

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                    آدرس
                    <span class="right badge badge-danger">جدید</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-key"></i>
                    خروج
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
                {{--<a class="nav-link" href="{{ route('logout') }}">--}}

                {{--<i class="nav-icon fa fa-key"></i>--}}
                {{--<p>--}}
                    {{--خروج--}}
                {{--</p>--}}
            {{--</a>--}}
        </li>
    </ul>
</nav>
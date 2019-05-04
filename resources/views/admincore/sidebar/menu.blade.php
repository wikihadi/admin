<nav class="mt-2 text-light">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/" class="nav-link @if(Request::is('/')) active text-light @endif">
                <i class="nav-icon fa fa-home"></i>
                <p>
                    داشبورد
                </p>
            </a>
        </li>
        @can('task-list')
        <li class="nav-item has-treeview @if(Request::is('tasks*') || Request::is('jobs*')) menu-open @endif ">
            <a href="#" class="nav-link @if(Request::is('tasks*') || Request::is('jobs*')) active @endif ">
                <i class="nav-icon fa fa-tasks"></i>

                <p>
                    لیست کارها
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('task-allTasks')
                    <li class="nav-item">
                        <a href="/jobs" class="nav-link @if(Request::is('jobs*')) active @endif ">
                            <i class="fa fa-list-ul nav-icon"></i>
                            <p>مشاهده کارها</p>
                        </a>
                    </li>
                @endcan
                    @can('task-list')
                <li class="nav-item">
                    <a href="/tasks" class="nav-link @if(Request::is('tasks')) active @endif ">
                        <i class="fa fa-list-ul nav-icon"></i>
                        <p>کارهای من</p>
                    </a>
                </li>
                @endcan

                @can('task-create')

                <li class="nav-item">
                    <a href="/tasks/create" class="nav-link @if(Request::is('tasks/create')) active @endif ">
                        <i class="fa fa-lg fa-plus-square nav-icon"></i>
                        <p>کار جدید</p>
                    </a>
                </li>
                    @endcan
            </ul>
        </li>
        @endcan

        @role('admin')
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

                {{--<li class="nav-item">--}}
                    {{--<a href="/roles" class="nav-link  @if(Request::is('roles*')) active @endif ">--}}
                        {{--<i class="fa fa-users nav-icon"></i>--}}
                        {{--<p>نقش ها</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="/brands" class="nav-link  @if(Request::is('brands*')) active @endif ">
                        <i class="fa fa-500px nav-icon"></i>
                        <p>برند ها</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/types" class="nav-link  @if(Request::is('types*')) active @endif ">
                        <i class="fa fa-tree nav-icon"></i>
                        <p>نوع کار</p>
                    </a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a href="/categories" class="nav-link  @if(Request::is('categories*')) active @endif ">--}}
                        {{--<i class="fa fa-tree nav-icon"></i>--}}
                        {{--<p>دسته بندی ها</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="/materials" class="nav-link  @if(Request::is('materials*')) active @endif ">--}}
                        {{--<i class="fa fa-barcode nav-icon"></i>--}}
                        {{--<p>متریال</p>--}}
                    {{--</a>--}}
                {{--</li>--}}

            </ul>
        </li>
        @endrole

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                    اطلاعیه و قوانین - بزودی
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/tasks/28" class="nav-link">
                <i class="nav-icon fa fa-exclamation-triangle"></i>
                <p>
                    گزارش خطا
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
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-check-square"></i>

                <p>
                    لیست کارها
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fa fa-angle-left nav-icon"></i>
                        <p>کارهای من</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-angle-left nav-icon"></i>
                        <p>کار جدید</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-check-square"></i>

                <p>
                    لیست کارها
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="fa fa-angle-left nav-icon"></i>
                        <p>کارهای من</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/tasks/create" class="nav-link">
                        <i class="fa fa-angle-left nav-icon"></i>
                        <p>کار جدید</p>
                    </a>
                </li>
            </ul>
        </li>
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
                <a class="nav-link" href="{{ route('logout') }}">

                <i class="nav-icon fa fa-key"></i>
                <p>
                    خروج
                </p>
            </a>
        </li>
    </ul>
</nav>
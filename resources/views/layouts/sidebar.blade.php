<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ (\Auth::check() ? \Auth::user()->name : "User") }}</p>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="text-capitalize text-center"><span style="color: white;">Menu</span></li>
            <!-- Optionally, you can add icons to the links -->
            <li {{{ (Request::is('home') ? 'class=active' : '') }}}>
                <a href="{{ url("home") }}">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li {{{ (Request::is('home/admin') ? 'class=active' : '') }}}>
                <a href="{{ url("home/admin") }}">
                    <i class="fa fa-user"></i>
                    <span>Data Admin</span>
                </a>
            </li>
            <li {{{ (Request::is('home/shorturl') ? 'class=active' : '') }}}>
                <a href="{{ url("home/shorturl") }}">
                    <i class="fa fa-table"></i>
                    <span>Data URL Pendek</span>
                </a>
            </li>
            <li {{{ (Request::is('home/customurl') ? 'class=active' : '') }}}>
                <a href="{{ url("home/customurl") }}">
                    <i class="fa fa-gear"></i>
                    <span>Data URL Custom</span>
                </a>
            </li>
            <li>
                <a href="{{ url("home/about") }}">
                    <i class="fa fa-info"></i>
                    <span>About</span>
                </a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
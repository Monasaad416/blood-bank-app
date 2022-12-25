<!DOCTYPE html>
    <html lang="en">

        @include('admin.layout.header')

        <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
            <img src="{{asset('adminlte/dist/img/Icon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Blood Bank App</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                <span class="d-block text-white">Logged as: {{Auth::user()->name}}</span>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @can('setting-edit')
                    <li class="nav-item">
                        <a href="{{route('settings.edit')}}" class="nav-link">
                            <i class="nav-icon fab fa-chrome"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                @endcan


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                        Sliders
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-danger right">{{App\Models\Slider::count()}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{route('sliders.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Of Sliders</p>
                        </a>
                        </li>
                    </ul>
                </li>

                @can('clients-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                            Clients
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\Client::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('clients.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Clients</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('governorates-list')
                    <li class="nav-item">
                        <a hrf="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                            Governorates
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\Governorate::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('governorates.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Governorates</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('cities-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                            Cities
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\City::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('cities.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Cities</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('categories-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\Category::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Categories</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('posts-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                            Posts
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\Post::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('posts.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Posts</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('users-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\User::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Users</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('roles-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Roles
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-danger right">{{Spatie\Permission\Models\Role::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Of Roles</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                @endcan

                @can('messages-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                            Messages
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\Message::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('messages.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Messages</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('donation-requests-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                            Donation Requests
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-danger right">{{App\Models\DonationRequest::count()}}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('donation-requests.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Of Requests</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endcan



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>
                        profile
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @auth
                            <li class="nav-item">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Logout</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('profile.show',auth()->user()->id)}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile Info</p>
                                </a>
                            </li>



                            <style>
                                .modal-backdrop{
                                    z-index:10 !important;
                                }
                                .modal-content{
                                    z-index: 99999 !important;
                                }
                            </style>

                            <!-- Change Admin Password modal start -->
                            <form action="{{route('password.change',auth()->user()->id)}}" method="POST">
                                @csrf

                                <div class="modal" id="change-password-{{auth()->user()->id}}">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">

                                            <input type="password" name="new_password" class="form-control" placeholder="new-password">
                                            <input type="hidden" name="id" value={{auth()->user()->id}}>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Save Password</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        @endauth
                    </ul>
                </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('header-title')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io" style="color:#2d3e50;">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        @include('admin.layout.footer_scripts')

        </body>
    </html>

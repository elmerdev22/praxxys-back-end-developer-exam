<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php
        $account    = Utility::authUserAdmin();
        $photo_link = 'https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png';
    @endphp
    <a href="index3.html" class="brand-link">
        <img src="{{$account->photo ? $account->photo : $photo_link}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>
    <div class="sidebar sayang-sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{$account->photo ? $account->photo : $photo_link}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.dashboard.index')}}" class="d-block">{{ucwords($account->username)}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills sayang-nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard.index')}}" class="nav-link {{Route::is('admin.dashboard.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{Route::is('admin.products.*') ? 'menu-open':''}}">
                    <a href="javascript:void(0);" class="nav-link {{Route::is('admin.products.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Products <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link {{Route::is('admin.products.index') ? 'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.create')}}" class="nav-link {{Route::is('admin.products.create') ? 'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.videos.index')}}" class="nav-link {{Route::is('admin.videos.*') ? 'active':''}}">
                        <i class="nav-icon fas fa-video"></i>
                        <p>Videos</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
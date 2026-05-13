<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    @include('admin.layout.logo')
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto shadow-sm">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="padding-right: 30px;">
                <img src="{{ Auth::user()->avatar_url ?? asset('vendor/brackets/admin-ui/img/avatar.png') }}" class="img-avatar" alt="{{ Auth::user()->email }}">
                <span class="ml-1">{{ Auth::user()->first_name }}</span>
            </a>
            @include('admin.layout.profile-dropdown')
        </li>
    </ul>
</header>
<div class="sidebar" style="background: #272727; font-family: 'Poppins', sans-serif;">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i class="nav-icon icon-people"></i> {{ trans('admin.user.title') }}</a></li>
            
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/categoria') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.categorium.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/palabras') }}"><i class="nav-icon icon-control-play"></i> {{ trans('admin.palabra.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-cup"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-equalizer"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" style="background: #131313;" type="button"></button>
</div>

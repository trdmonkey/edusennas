<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/categoria') }}"><i class="nav-icon icon-settings"></i> {{ __('categoria') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/palabras') }}"><i class="nav-icon icon-settings"></i> {{ __('palabras') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>
<!--             <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li> -->
        </ul>
    </nav>s
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

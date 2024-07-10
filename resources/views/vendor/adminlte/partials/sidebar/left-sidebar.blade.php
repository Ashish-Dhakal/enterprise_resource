<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    <style>
        [class*=sidebar-dark] .brand-link, [class*=sidebar-dark] .brand-link .pushmenu {
            color: #C2699E!important;
            opacity: 80%!important;
            font-weight: bolder!important;
        }
        [class*=sidebar-dark] .brand-link:hover {
            color: #C2699E!important;
            opacity: 100%!important;
            font-weight: bolder!important;
        }

        [class*=sidebar-dark-] .sidebar a {
            color: #979797 !important;
            margin: 6px 0!important;
        }

        [class*=sidebar-dark-]
        {
            /*background: #020024;*/
            /*background: #204430;*/
            /*background: #406a52;*/
            /*background: #132f38;*/
            background: white!important;
            /*border-radius: 0 0.6em 0.6em 0;*/
            /*!important;*/
        }

        [class*=sidebar-dark] .brand-link {
            border-bottom: none!important;
        }

        [class*=sidebar-dark-] .sidebar a:hover , .nav-pills .nav-link.active, .nav-pills .show>.nav-link
        {
            color: #C2699E!important;
            background-color: #D9E8F7 !important;
            elevation: 0!important;
            box-shadow: none!important;
            border-radius: 15px!important;

        }
    </style>

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>

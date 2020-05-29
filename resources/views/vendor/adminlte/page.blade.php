@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop
@section('classes_body',
    (config('adminlte.sidebar_mini', true) === true ?
        'sidebar-mini ' :
        (config('adminlte.sidebar_mini', true) == 'md' ?
         'sidebar-mini sidebar-mini-md ' : '')
    ) .
    (config('adminlte.layout_topnav') || View::getSection('layout_topnav') ? 'layout-top-nav ' : '') .
    (config('adminlte.layout_boxed') ? 'layout-boxed ' : '') .
    (!config('adminlte.layout_topnav') && !View::getSection('layout_topnav') ?
        (config('adminlte.layout_fixed_sidebar') ? 'layout-fixed ' : '') .
        (config('adminlte.layout_fixed_navbar') === true ?
            'layout-navbar-fixed ' :
            (isset(config('adminlte.layout_fixed_navbar')['xs']) ? (config('adminlte.layout_fixed_navbar')['xs'] == true ? 'layout-navbar-fixed ' : 'layout-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['sm']) ? (config('adminlte.layout_fixed_navbar')['sm'] == true ? 'layout-sm-navbar-fixed ' : 'layout-sm-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['md']) ? (config('adminlte.layout_fixed_navbar')['md'] == true ? 'layout-md-navbar-fixed ' : 'layout-md-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['lg']) ? (config('adminlte.layout_fixed_navbar')['lg'] == true ? 'layout-lg-navbar-fixed ' : 'layout-lg-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['xl']) ? (config('adminlte.layout_fixed_navbar')['xl'] == true ? 'layout-xl-navbar-fixed ' : 'layout-xl-navbar-not-fixed ') : '')
        ) .
        (config('adminlte.layout_fixed_footer') === true ?
            'layout-footer-fixed ' :
            (isset(config('adminlte.layout_fixed_footer')['xs']) ? (config('adminlte.layout_fixed_footer')['xs'] == true ? 'layout-footer-fixed ' : 'layout-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['sm']) ? (config('adminlte.layout_fixed_footer')['sm'] == true ? 'layout-sm-footer-fixed ' : 'layout-sm-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['md']) ? (config('adminlte.layout_fixed_footer')['md'] == true ? 'layout-md-footer-fixed ' : 'layout-md-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['lg']) ? (config('adminlte.layout_fixed_footer')['lg'] == true ? 'layout-lg-footer-fixed ' : 'layout-lg-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['xl']) ? (config('adminlte.layout_fixed_footer')['xl'] == true ? 'layout-xl-footer-fixed ' : 'layout-xl-footer-not-fixed ') : '')
        )
        : ''
    ) .
    (config('adminlte.sidebar_collapse') || View::getSection('sidebar_collapse') ? 'sidebar-collapse ' : '') .
    (config('adminlte.right_sidebar') && config('adminlte.right_sidebar_push') ? 'control-sidebar-push ' : '') .
    config('adminlte.classes_body')
)

@section('body_data',
(config('adminlte.sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light' ? 'data-scrollbar-theme=' . config('adminlte.sidebar_scrollbar_theme')  : '') . ' ' . (config('adminlte.sidebar_scrollbar_auto_hide', 'l') != 'l' ? 'data-scrollbar-auto-hide=' . config('adminlte.sidebar_scrollbar_auto_hide')   : ''))

@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'admin.logout') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'admin/home') )

@if (config('adminlte.use_route_url', false))
    @php( $logout_url = route('admin.logout',app()->getLocale()))
    @php( $dashboard_url = route('admin.home',app()->getLocale()) )
@else
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="wrapper">
        @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            <nav
                class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.topnav_color', 'navbar-white navbar-light')}}">
                <div class="{{config('adminlte.classes_topnav_container', 'container')}}">
                    @if(config('adminlte.logo_img_xl'))
                        <a href="{{ $dashboard_url }}" class="navbar-brand logo-switch">
                            <img
                                src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
                                alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}"
                                class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                            <img src="{{ asset(config('adminlte.logo_img_xl')) }}"
                                 alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}"
                                 class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                        </a>
                    @else
                        <a href="{{ $dashboard_url }}" class="navbar-brand {{ config('adminlte.classes_brand') }}">
                            <img
                                src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
                                alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}"
                                class="brand-image img-circle elevation-3" style="opacity: .8">
                            <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </span>
                        </a>
                    @endif

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                            data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    @else
                        <nav
                            class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.classes_topnav', 'navbar-white navbar-light')}}">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" data-widget="pushmenu" href="#"
                                       @if(config('adminlte.sidebar_collapse_remember')) data-enable-remember="true"
                                       @endif @if(!config('adminlte.sidebar_collapse_remember_no_transition')) data-no-transition-after-reload="false"
                                       @endif @if(config('adminlte.sidebar_collapse_auto_size')) data-auto-collapse-size="{{config('adminlte.sidebar_collapse_auto_size')}}" @endif>
                                        <i class="fas fa-bars"></i>
                                        <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
                                    </a>

                                </li>

                                {{--                    @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')--}}
                                @yield('content_top_nav_left')
                            </ul>
                            @endif
                            <ul class="navbar-nav ml-auto @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))order-1 order-md-3 navbar-no-expand @endif">
                                @yield('content_top_nav_right')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">

                            <span class="flag-icon flag-icon-us">

                                    <img
                                        src="{{asset('/img'.'/'.config('app.supported_locales.'.app()->getLocale().'.img'))}}"
                                        alt="image">
                               </span> {{app()->getLocale()}}</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown09">

                                        @foreach(config('app.supported_locales') as $key=>$locale)
                                            <a class="dropdown-item"
                                               href="{{route('setLocale',['admin',app()->getLocale(),'lang'=>$key])}}">
                                                @if(isset($locale['img']))
                                                    <img src="{{asset('/img'.'/'.$locale['img'])}}" alt="image">
                                                @endif {{$locale['name']}}
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                                @if(Auth::user())
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        >
                                            <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
                                        </a>
                                        <form id="logout-form" action="{{ $logout_url }}" method="POST"
                                              style="display: none;">
                                            @if(config('adminlte.logout_method'))
                                                {{ method_field(config('adminlte.logout_method')) }}
                                            @endif
                                            {{ csrf_field() }}
                                        </form>
                                    </li>


                                @else

                                @endif
                                @if(config('adminlte.right_sidebar'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-widget="control-sidebar"
                                           @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false"
                                           @endif @if(config('adminlte.right_sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light') data-scrollbar-theme="{{config('adminlte.right_sidebar_scrollbar_theme')}}"
                                           @endif @if(config('adminlte.right_sidebar_scrollbar_auto_hide', 'l') != 'l') data-scrollbar-auto-hide="{{config('adminlte.right_sidebar_scrollbar_auto_hide')}}" @endif>
                                            <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
                        </nav>
                @endif
            </nav>
            @if(!config('adminlte.layout_topnav') && !View::getSection('layout_topnav'))
                <aside class="main-sidebar {{config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')}}">

                    @if(config('adminlte.logo_img_xl'))
                        <a href="{{ $dashboard_url }}" class="brand-link logo-switch">
                            <img
                                src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
                                alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}"
                                class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                            <img src="{{ asset(config('adminlte.logo_img_xl')) }}"
                                 alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}"
                                 class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                        </a>

                    @else
                        <a href="{{ route('admin.home',app()->getLocale())  }}"
                           class="brand-link {{ config('adminlte.classes_brand') }}">
                            <img
                                src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
                                alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}"
                                class="brand-image img-circle elevation-3" style="opacity: .8">
                            <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                        {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                    </span>
                        </a>
                    @endif
                    <div class="sidebar">
                        <nav class="mt-2">

                            <ul class="nav nav-pills nav-sidebar flex-column {{config('adminlte.classes_sidebar_nav', '')}}"
                                data-widget="treeview" role="menu"
                                @if(config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{config('adminlte.sidebar_nav_animation_speed')}}"
                                @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>

                                <li class="nav-item text-white col-12 text-left">
                                    <a href="{{route('admin.home',app()->getLocale())}}" class="nav-link">
                                        Welcome: {{\Auth::user()->name}}</a></li>
                                {{--                            ADMIN MENU--}}
                                {{--                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')--}}
                                @can('viewAny',\App\Model\Post::class)

                                    <li class="nav-item">
                                        <a href="{{route('post.index',app()->getLocale())}}" class="nav-link">
                                            <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Posts
                                            </p>
                                        </a>
                                    </li>
                                @endcan

                                @can('viewAny',\App\Model\Category::class)

                                    <li class="nav-item">
                                        <a href="{{route('category.index',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Categories
                                            </p>
                                        </a>
                                    </li>
                                @endcan

                                @can('viewAny',\App\Model\Tag::class)

                                    <li class="nav-item">
                                        <a href="{{route('tag.index',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Tags
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('viewAny',\App\Model\Role::class)

                                    <li class="nav-item">
                                        <a href="{{route('role.index',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Roles
                                            </p>
                                        </a>
                                    </li>

                                @endcan

                                @can('viewAny',\App\Model\User::class)
                                    <li class="nav-item">
                                        <a href="{{route('user.index',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Users
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('viewAny',\App\Model\User::class)

                                    <li class="nav-item">
                                        <a href="{{route('blocked.users',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Blocked Users
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('viewAny',\App\Model\Admin::class)
                                    <li class="nav-item">
                                        <a href="{{route('admin.index',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Admins
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('viewAny',\App\Model\Permission::class)
                                    <li class="nav-item">
                                        <a href="{{route('permission.index',app()->getLocale())}}" class="nav-link">
                                            <i class="fas fa-fw fa-user {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                                            <p>
                                                Permissions
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-fw fa-chart-pie"></i>
                                        <p>
                                            Doc
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="/api/doc/index.html" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Api v1</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{--                        <li @if (isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item @if (isset($item['submenu'])){{ $item['submenu_class'] }}@endif">--}}
                                {{--                            <a class="nav-link {{ $item['class'] }}" href="{{ $item['href'] }}"--}}
                                {{--                               @if (isset($item['target'])) target="{{ $item['target'] }}" @endif--}}
                                {{--                            >--}}
                                {{--                                <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>--}}
                                {{--                                <p>--}}
                                {{--                                    {{ $item['text'] }}--}}

                                {{--                                    @if (isset($item['submenu']))--}}
                                {{--                                        <i class="fas fa-angle-left right"></i>--}}
                                {{--                                    @endif--}}
                                {{--                                    @if (isset($item['label']))--}}
                                {{--                                        <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">{{ $item['label'] }}</span>--}}
                                {{--                                    @endif--}}
                                {{--                                </p>--}}
                                {{--                            </a>--}}
                                {{--                            @if (isset($item['submenu']))--}}
                                {{--                                <ul class="nav nav-treeview">--}}
                                {{--                                    @each('adminlte::partials.menu-item', $item['submenu'], 'item')--}}
                                {{--                                </ul>--}}
                                {{--                            @endif--}}
                                {{--                        </li>--}}

                            </ul>
                        </nav>
                    </div>
                </aside>
            @endif

            <div class="content-wrapper">
                @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
                    <div class="container">
                        @endif

                        <div class="content-header">
                            <div class="{{config('adminlte.classes_content_header', 'container-fluid')}}">
                                @yield('content_header')
                            </div>
                        </div>

                        <div class="content">
                            <div class="{{config('adminlte.classes_content', 'container-fluid')}}">
                                @yield('content')
                            </div>
                        </div>
                        @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
                    </div>
                @endif
            </div>

            @hasSection('footer')
                <footer class="main-footer">

                    @yield('footer')
                </footer>
            @endif

            @if(config('adminlte.right_sidebar'))
                <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                    @yield('right-sidebar')
                </aside>
            @endif

    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    @stack('js')
    @yield('js')
@stop

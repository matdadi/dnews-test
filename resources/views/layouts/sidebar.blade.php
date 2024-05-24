@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;

    function routeContains($needle) {
        return Str::contains(Route::current()->getName(), $needle);
    }


    $isActive = [
        'dashboard' => routeContains('cms.dashboard'),
        'category' => routeContains('cms.category.'),
        'subcategory' => routeContains('cms.subcategory.'),
        'tag' => routeContains('cms.tag.'),
        'user_management' => routeContains(['cms.admin.', 'cms.role.', 'cms.permission.'])
    ];

@endphp
<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="{{URL::to('/static/main-logo.jpg')}}" width="110" alt="DNEWS">
            </a>
        </h1>

        @include('layouts.sidebar_mobile')

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ $isActive['dashboard'] ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('cms.dashboard')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>


                {{-- Category --}}
                @can('category-read')
                    <li class="nav-item {{ $isActive['category'] ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('cms.category.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fas fa-icons"></i>
                        </span>
                            <span class="nav-link-title">
                            Category
                        </span>
                        </a>
                    </li>
                @endcan

                @can('subcategory-read')
                    <li class="nav-item {{ $isActive['subcategory'] ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('cms.subcategory.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fas fa-layer-group"></i>
                        </span>
                            <span class="nav-link-title">
                            Subcategory
                        </span>
                        </a>
                    </li>
                @endcan

                @can('tag-read')
                    <li class="nav-item {{ $isActive['tag'] ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('cms.tag.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fas fa-tags"></i>
                        </span>
                            <span class="nav-link-title">
                            Tag
                        </span>
                        </a>
                    </li>
                @endcan

                {{-- User Management Menu --}}
                @canany(['cms.admin-read', 'role-read', 'permission-read'])
                    <li class="nav-item {{ $isActive['user_management']  ? 'active' : '' }}  dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="true">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                            <i class="fas fa-user"></i>
                        </span>
                            <span class="nav-link-title">
                            User Management
                        </span>
                        </a>

                        <div class="dropdown-menu {{  $isActive['user_management']  ? 'show' : '' }}">
                            @can('admin-read')
                                <a class="dropdown-item" href="{{route('cms.admin.index')}}">
                                    Admin User
                                </a>
                            @endcan
                            @can('role-read')
                                <a class="dropdown-item" href="{{route('cms.role.index')}}">
                                    Roles
                                </a>
                            @endcan
                            @can('permission-read')
                                <a class="dropdown-item" href="{{route('cms.permission.index')}}">
                                    Permissions
                                </a>
                            @endcan
                        </div>
                    </li>
                @endcanany
            </ul>
        </div>
    </div>
</aside>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-wine-bottle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DRINK INV. <sup>admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.dashboard.index')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>{{__('admin.menu.home')}}</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        <span>{{__('admin.menu.products')}}</span>
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('admin.approved-products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.approved-products.index')}}">
            <i class="fas fa-fw fa-glass-cheers"></i>
            <span>{{__('admin.menu.approved-products')}}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.unapproved-products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.unapproved-products.index')}}">
            <i class="fas fa-fw fa-glass-cheers"></i>
            <span>{{__('admin.menu.unapproved-products')}}</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        {{__('admin.admin-tools')}}
    </div>

    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.users.index')}}">
            <i class="fa-regular fa-user"></i>
            <span>{{__('admin.menu.users')}}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.potential-customers.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.potential-customers.index')}}">
            <i class="fa-solid fa-users"></i>
            <span>{{__('admin.menu.potential-customers')}}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.partners.index')}}">
            <i class="fa-solid fa-users"></i>
            <span>{{__('admin.menu.partners')}}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.support.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.support.index')}}">
            <i class="fa-regular fa-life-ring"></i>
            <span>{{__('admin.menu.support')}}</span>
        </a>
    </li>

{{--    <li class="nav-item {{ request()->routeIs('newsletter.*') ? 'active' : '' }}">--}}
{{--        <a class="nav-link" href="{{route('newsletter.index')}}">--}}
{{--            <i class="fa-regular fa-paper-plane"></i>--}}
{{--            <span>{{__('admin.menu.newsletter')}}</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <li class="nav-item {{ request()->routeIs('admin.sms.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.sms.index')}}">
            <i class="fas fa-fw fa-comment-sms"></i>
            <span>{{__('admin.menu.sms')}}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.leads.index')}}">
            <i class="fas fa-fw fa-comment-sms"></i>
            <span>{{__('admin.menu.leads')}}</span>
        </a>
    </li>

{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{route('admin.labels.index')}}">--}}
{{--            <i class="fas fa-fw fa-table"></i>--}}
{{--            <span>{{__('admin.menu.labels')}} (nedorobene)</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

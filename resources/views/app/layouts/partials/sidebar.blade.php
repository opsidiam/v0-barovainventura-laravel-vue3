<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard.index')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/V1 - Icon - W.svg')}}" alt="" />
        </div>
        <div class="sidebar-brand-text mx-3">
            <img src="{{asset('img/V1-text.png')}}" alt="" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    @if(session()->has('bar'))
        <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('dashboard.index')}}">
                <i class="fas fa-fw fa-home"></i>
                <span>{{__('menu.home')}}</span>
            </a>
        </li>
    @endif
    <li class="nav-item {{ request()->routeIs('bar.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('bar.index')}}">
            <i class="fas fa-fw fa-glass-cheers"></i>
            <span>{{__('menu.bar_select')}}</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @if(session()->has('bar'))
    <!-- Heading -->


        @if(Auth::user()->permission > 1)
        <li class="nav-item {{ request()->routeIs('staff.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('staff.index')}}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{__('menu.staff')}}</span>
            </a>
        </li>
    <hr class="sidebar-divider my-0">
        @endif
        @if(Auth::user()->permission > 1)
        <div class="sidebar-heading pt-2">
            {{__('menu.warehouse')}}
        </div>
        @endif
        <!-- Nav Item - Pages Collapse Menu -->

        @if(Auth::user()->permission > 1)
{{--            <li class="nav-item {{ request()->routeIs('deadline.*') ? 'active' : '' }}">--}}
{{--                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#deadline"--}}
{{--                   aria-expanded="true" aria-controls="deadline">--}}
{{--                    <i class="fas fa-store-alt-slash"></i>--}}
{{--                    <span>{{__('menu.deadline')}}</span>--}}
{{--                </a>--}}
{{--                <div id="deadline" class="collapse" aria-labelledby="deadline" data-parent="#accordionSidebar">--}}
{{--                    <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                        <a class="collapse-item" href="{{route('deadline.create')}}">{{__('menu.deadline_create')}}</a>--}}
{{--                        <a class="collapse-item" href="{{route('deadline.list')}}">{{__('menu.deadline_list')}}</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
        @endif

        <li class="nav-item {{ request()->routeIs('item.*') ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs('item.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#item"
               aria-expanded="true" aria-controls="item">
                <i class="fas fa-boxes"></i>
                <span>{{__('menu.cargo')}}</span>
            </a>
            <div id="item" class="collapse {{ request()->routeIs('item.*') ? 'show' : '' }}" aria-labelledby="item" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('item.index')}}">{{__('menu.cargo_list')}}</a>
                </div>
            </div>
        </li>
        <li class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs('supplier.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#supplier"
               aria-expanded="true" aria-controls="supplier">
                <i class="fas fa-truck-loading"></i>
                <span>{{__('menu.suppliers')}}</span>
            </a>
            <div id="supplier" class="collapse {{ request()->routeIs('supplier.*') ? 'show' : '' }}" aria-labelledby="supplier" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('supplier.index')}}">{{__('menu.suppliers_list')}} </a>
                </div>
            </div>
        </li>
        <li class="nav-item {{ request()->routeIs('stocktake.*') ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs('stocktake.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#inv"
               aria-expanded="true" aria-controls="item">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>{{__('menu.inventory')}} @if($open_stocktake_count > 0)<span class="badge badge-danger" style="font-size: .65rem;margin-left: 5px">{{$open_stocktake_count}}</span>@endif </span>
            </a>
            <div id="inv" class="collapse {{ request()->routeIs('stocktake.*') ? 'show' : '' }}" aria-labelledby="item" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('stocktake.index')}}">{{__('menu.inventory_list')}}</a>
                    <a class="collapse-item" href="{{route('stocktake.create')}}">
                        {{__('menu.inventory_create')}}
                        @if($open_stocktake_count > 0)<span class="badge badge-danger" style="font-size: .65rem;margin-left: 5px">{{$open_stocktake_count}}</span>@endif
                    </a>
                    {{--                    <a class="collapse-item" href="{{route('stocktake.history')}}">--}}
                    {{--                        História inventúr--}}
                    {{--                    </a>--}}
                </div>
            </div>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
    @endif
    <li class="nav-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('product.index')}}">
            <i class="fas fa-fw fa-shopping-basket"></i>
            <span>{{__('menu.products')}}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('license.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('license.index')}}">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>{{__('menu.license')}}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('tutorial.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('tutorial.index')}}">
            <i class="fas fa-fw fa-eye"></i>
            <span>{{__('menu.tutorial')}}</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

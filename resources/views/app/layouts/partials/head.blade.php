<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



            <p class="podnik_nazov">Vybraný podnik: <b>@if(Session::has('bar')){{ session('bar-name') }}@else --- @endif</b></p>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle
                    @if(now() >= auth()->user()->licence_expire)
                        text-danger
                    @else
                        @if(now()->addDay() >= auth()->user()->licence_expire)
                        text-danger
                        @elseif(now()->addWeek() >= auth()->user()->licence_expire)
                        text-warning
                        @else
                        text-success
                        @endif
                    @endif"
                       href="{{ route('license.index') }}"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false">
                        Licencia:
                        @if(now() >= auth()->user()->licence_expire)
                            expirovala
                        @else
                            {{ auth()->user()->licence_expire->format('d.m.Y') }}
                        @endif
                    </a>
                    <!-- Dropdown - Alerts -->
                </li>
                <!-- Nav Item - Alerts -->
                @if(isset($money))
                <li class="nav-item dropdown no-arrow ">
                    <a class="nav-link dropdown-toggle text-warning" href="{{route('product.cart')}}" role="button"
                       aria-haspopup="true" aria-expanded="false">
                            Košík: {{$money}}€
                        <!-- Counter - Alerts -->
                    </a>
                    <!-- Dropdown - Alerts -->
                </li>
                @else
{{--                    <li class="nav-item dropdown no-arrow ">--}}
{{--                        <a class="nav-link dropdown-toggle text-success" href="#" id="alertsDropdown_percent" role="button"--}}
{{--                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Zľava: {{$zlava}}€--}}
{{--                            <!-- Counter - Alerts -->--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"--}}
{{--                             aria-labelledby="alertsDropdown_percent">--}}
{{--                            <h6 class="dropdown-header">--}}
{{--                                Zľavy--}}
{{--                                --}}{{--                            <a style="padding-left: 20px" href="{{route('notify.all.hide')}}" data-toggle="modal" data-target="#discontCode"><button class="btn btn-success btn-sm">Použiť zľavový kód</button></a>--}}
{{--                            </h6>--}}
{{--                            @if($zlavy)--}}
{{--                                @foreach($zlavy as $zlava)--}}
{{--                                    @if($zlava->code)--}}
{{--                                        <a class="dropdown-item d-flex align-items-center" href="">--}}
{{--                                            @else--}}
{{--                                                <a class="dropdown-item d-flex align-items-center" href="#">--}}
{{--                                                    @endif--}}
{{--                                                    <div class="mr-3">--}}
{{--                                                        @if($zlava->active == 1)--}}
{{--                                                            <div class="icon-circle bg-success">--}}
{{--                                                                <i class="fas fa-euro-sign text-white"></i>--}}
{{--                                                            </div>--}}
{{--                                                        @else--}}
{{--                                                            <div class="icon-circle bg-warning">--}}
{{--                                                                <i class="fas fa-euro-sign text-white"></i>--}}
{{--                                                            </div>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                    <div>--}}
{{--                                                        @if($zlava->active == 0)--}}
{{--                                                            <div class="small text-gray-500">--}}
{{--                                                                <i class="text-danger">Použité</i>--}}
{{--                                                            </div>--}}
{{--                                                        @endif--}}
{{--                                                        Zľavový kód: <span class="font-weight-bold">{{$zlava->code}}</span>--}}
{{--                                                    </div>--}}

{{--                                                    @if($zlava->url)--}}
{{--                                                </a>--}}
{{--                                                @else--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                            --}}{{--                        <a class="dropdown-item text-center small text-gray-500" href="#">Zobraziť všetky zľavy </a>--}}
{{--                        </div>--}}
{{--                        <!-- Dropdown - Alerts -->--}}
{{--                    </li>--}}

                @endif
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="handleNotificationsDropdown()">
                        <i class="fas fa-bell fa-fw"></i>
                        @if($notification_count > 0)
                            <span class="badge badge-danger badge-counter" id="notificationCounter">{{ $notification_count }}</span>
                        @endif
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="alertsDropdown" id="notificationsDropdown">
                        <h6 class="dropdown-header">
                            Centrum hlásení
                        </h6>
                        @forelse($notifications as $notification)
                            <a class="dropdown-item d-flex align-items-center notification-item @if(!$notification->is_read) unread-notification @endif"
                               href="{{ $notification->url ?? '#' }}"
                               data-id="{{ $notification->id }}">
                                <div class="mr-3 position-relative">
                                    <div class="icon-circle bg-{{ $notification->type }}">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="small text-gray-500">
                                            @if($notification->scope === 'bar' && $notification->bar)
                                                Podnik: {{ $notification->bar->name }}
                                            @endif
                                            {{ $notification->created_at->format('d.m.Y H:i') }}
                                        </div>
                                        @if(!$notification->is_read)
                                            <span class="badge bg-primary"> </span>
                                        @endif
                                    </div>
                                    <div class="mt-1">
                                        <span class="@if(!$notification->is_read) font-weight-bold text-dark @else text-muted @endif">
                                            {!! $notification->message !!}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="dropdown-item text-center small text-gray-500">
                                Žiadne nové hlásenia
                            </div>
                        @endforelse

{{--                        @if($notifications->count() > 3)--}}
{{--                            <a class="dropdown-item text-center small text-gray-500" href="{{ route('notifications.index') }}">--}}
{{--                                Zobraziť všetky hlásenia--}}
{{--                            </a>--}}
{{--                        @endif--}}
                    </div>
                </li>
                <li class="nav-item no-arrow ">
                    <a class="nav-link " href="{{route('support.contact.form')}}" role="button" title="Podpora" target="_blank">
                        <i class="far fa-life-ring text-danger"  style="font-size: 30px;"></i>
                    </a>

                </li>

{{--                <!-- Nav Item - Messages -->--}}
{{--                <li class="nav-item dropdown no-arrow mx-1">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"--}}
{{--                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="fas fa-envelope fa-fw"></i>--}}
{{--                        <!-- Counter - Messages -->--}}
{{--                        <span class="badge badge-danger badge-counter">7</span>--}}
{{--                    </a>--}}
{{--                    <!-- Dropdown - Messages -->--}}
{{--                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"--}}
{{--                         aria-labelledby="messagesDropdown">--}}
{{--                        <h6 class="dropdown-header">--}}
{{--                            Message Center--}}
{{--                        </h6>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="#">--}}
{{--                            <div class="dropdown-list-image mr-3">--}}
{{--                                <img class="rounded-circle" src="{{asset('img/undraw_profile_1.svg')}}"--}}
{{--                                     alt="">--}}
{{--                                <div class="status-indicator bg-success"></div>--}}
{{--                            </div>--}}
{{--                            <div class="font-weight-bold">--}}
{{--                                <div class="text-truncate">Hi there! I am wondering if you can help me with a--}}
{{--                                    problem I've been having.</div>--}}
{{--                                <div class="small text-gray-500">Emily Fowler · 58m</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                       --}}
{{--                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                        <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        @if(Auth::user()->permission > 1)
                        <a class="dropdown-item" href="{{route('invoice.index')}}">
                            <i class="fas fa-file-invoice-dollar fa-sm fa-fw mr-2 text-gray-400"></i>
                            Faktúry
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{route('license.index')}}">
                            <i class="fas fa-check-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                            Licencia
                        </a>
                        <a class="dropdown-item" href="{{route('setting.index')}}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Nastavenia
                        </a>
                        <a class="dropdown-item" href="{{route('user.login-history')}}">
                            <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                            {{__('user.login_history')}}
                        </a>
                        <a class="dropdown-item" href="{{route('user.order-history')}}">
                            <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                            {{__('user.order_history')}}
                        </a>
                        @if(Auth::user()->permission > 1)
                        <a class="dropdown-item" href="{{route('admin.dashboard.index')}}">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Admin
                        </a>
                        <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Odhlásiť sa
                        </a>

                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
    @yield('content')
        <!-- Begin Page Content -->
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('app.layouts.partials.footer')
    <!-- End of Footer -->

</div>

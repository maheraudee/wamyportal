<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="{{route('dashboard')}}">
                <img src="{{asset('public/assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{asset('public/assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">

                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Theme-Layout -->
                            <div class="d-flex country">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>


                            <!-- FULL-SCREEN -->

                            <!-- NOTIFICATIONS -->
                            {{-- <div class="dropdown  d-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i>
                                        <span class="{{auth()->user()->unreadNotifications->count() > 0 ? 'pulse-danger': 'pulse' }}"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark hedr-font">التبيهات
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                            @if ($notification->type == 'App\Notifications\Saving\AddOrder')
                                                <div class="dropdown-item d-flex" href="{{ isAdmin() ? route('showsponsor',$notification->data['order_id']) :''}}">
                                                    <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                                        <i class="fe fe-check-circle"></i>
                                                    </div>
                                                    <div class="mt-1 wd-80p">
                                                        <h5 class="notification-label mb-1">
                                                            @if (EmpNo() == $notification->data['sponsor'])
                                                                <a href="{{ route('orders.create') }}">طلب كفالة جديد بالرقم {{$notification->data['order_id']}}</a>
                                                            @else
                                                                <a href="">طلب جديد بصندوق الإدخار بالرقم {{$notification->data['order_id']}}</a>
                                                            @endif
                                                        </h5>
                                                        <span class="notification-subtext">{{$notification->created_at->diffForHumans()}}</span>
                                                    </div>
                                                </div>
                                            @elseif ($notification->type == 'App\Notifications\Saving\Aprovalsponsor')
                                            <a class="dropdown-item d-flex" href="{{ route('orders.edit',$notification->data['order_id']) }}">
                                                    <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                        <i class="fe fe-mail"></i>
                                                    </div>
                                                    <div class="mt-1 wd-80p">
                                                        @if ($notification->data['stuats'] == 2)
                                                            <h5 class="notification-label mb-1">تم قبول طلب الكفالة بالرقم  {{ $notification->data['order_id'] }}</h5>
                                                        @else
                                                            <h5 class="notification-label mb-1">تم رفض طلب الكفالة بالرقم  {{ $notification->data['order_id'] }}</h5>
                                                        @endif

                                                        <span class="notification-subtext">{{$notification->created_at->diffForHumans()}}</span>
                                                    </div>
                                            </a>
                                            @elseif ($notification->type == 'App\Notifications\Saving\Aprovalaccount')
                                            <a class="dropdown-item d-flex" href="">
                                                    <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                        <i class="fe fe-mail"></i>
                                                    </div>
                                                    <div class="mt-1 wd-80p">
                                                        @if ($notification->data['stuats'] == 4)
                                                            <h5 class="notification-label mb-1">تم تحليل الطلب بالرقم  {{ $notification->data['order_id'] }}</h5>
                                                        @endif

                                                        <span class="notification-subtext">{{$notification->created_at->diffForHumans()}}</span>
                                                    </div>
                                            </a>
                                            @elseif ($notification->type == 'App\Notifications\Saving\AddWithdraw')
                                                <a class="dropdown-item d-flex" href="{{ route('withdraws.show',$notification->data['order_id']) }}">
                                                    <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                        <i class="fe fe-mail"></i>
                                                    </div>
                                                    <div class="mt-1 wd-80p">
                                                        <h5 class="notification-label mb-1">طلب سحب/إنسحاب من الصندوق بالرقم {{$notification->data['order_id']}}</h5>
                                                        <span class="notification-subtext">{{$notification->created_at->diffForHumans()}}</span>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div> --}}

                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <img src="{{Avatar() ? getImage('Users/'.Avatar()) : getImage('Users/profile.jpg')}}" alt="profile-user"
                                        class="avatar  profile-user brround cover-image">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">
                                                <a href="{{ route('employees.show',EmpNo())}}">الملف الشخصي</a>
                                            </h5>
                                            <small class="text-muted">{{-- {{UserTyp()}} --}}</small>
                                        </div>
                                    </div>
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{UserName()}}</h5>
                                            <small class="text-muted">{{-- {{UserTyp()}} --}}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon fe fe-alert-circle"></i> تسجيل الخروج
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

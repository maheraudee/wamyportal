<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{route('dashboard')}}">
                <img src="{{asset('public/assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{asset('public/assets/images/brand/logo-1.png')}}" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{asset('public/assets/images/brand/logo-2.png')}}" class="header-brand-img light-logo" alt="logo">
                <img src="{{asset('public/assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        @php
            $m = Carbon\Carbon::now()->format('m');
        @endphp
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{route('dashboard')}}"><i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">الرئيسية</span>
                    </a>
                </li>
                <li class="sub-category">
                    <h3>UI Kit</h3>
                </li>
                @if (isSuperAdmin())
                    {{-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-package"></i>
                            <span class="side-menu__label hedr-font">البيانات الأساسية</span><i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{route('bdindex',1)}}" class="slide-item font-16">المراحل الدراسية</a></li>
                            <li><a href="{{route('bdindex',2)}}" class="slide-item font-16">الحالة الصحية</a></li>
                            <li><a href="{{route('bdindex',3)}}" class="slide-item font-16">العلاقات</a></li>
                            <li><a href="{{route('bdindex',4)}}" class="slide-item font-16">المناطق الجعرافية</a></li>
                            <li><a href="{{route('bdindex',5)}}" class="slide-item font-16">أنواع الدفع</a></li>
                            <li><a href="{{route('bdindex',6)}}" class="slide-item font-16">أنواع المناديب</a></li>
                        </ul>
                    </li> --}}
                @endif
                @can('mm-inventory')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-airplay"></i>
                            <span class="side-menu__label hedr-font">الجرد</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('sm-basicData')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label font-16">البيانات الأساسية</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a href="{{route('stores.index')}}" class="sub-slide-item font-16">المستودعات</a></li>
                                        <li><a href="{{route('hardwares.index')}}" class="sub-slide-item font-16">الأجهزة</a></li>
                                        <li><a href="{{route('manufacturers.index')}}" class="sub-slide-item font-16">الشركات</a></li>
                                    </ul>
                                </li>
                            @endcan
                            @can('sm-custody')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label font-16">العهد</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a href="{{route('inventories.index')}}" class="sub-slide-item font-16">العهد</a></li>
                                        <li><a href="{{route('invtytracks.index')}}" class="sub-slide-item font-16">حركات العهد</a></li>
                                    </ul>
                                </li>
                                @endcan

                            @can('sm-myCustody')
                                <li>
                                    <a href="#" class="sub-slide-item font-16">عهدتي</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan
                @can('mm-box')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i>
                            <span class="side-menu__label hedr-font">صندوق الإدخار</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('sm-slate')
                                <li>
                                    <a href="{{route('getfile', 'slate.pdf')}}" class="sub-slide-item font-16">لائحة صندوق الإدخار</a>
                                </li>
                            @endcan

                            @can('sm-subscriptions')
                                <li class="side-menu-label1"><a href="javascript:void(0)">Apps</a></li>
                                <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                    <span class="sub-side-menu__label">الإشتراكات</span><i class="sub-angle fe fe-chevron-right"></i>
                                </a>
                                <ul class="sub-slide-menu">
                                    @can('sm-newRegistration')
                                        <li>
                                            <a href="{{route('savings.index')}}" class="sub-slide-item font-16">تسجل جديد</a>
                                        </li>
                                    @endcan
                                    @can('sm-updRegistration')
                                        <li>
                                            <a href="{{route('savings.edit',EmpNo())}}" class="sub-slide-item font-16">تعديل الإشتراك</a>
                                        </li>
                                    @endcan
                                    @can('sm-membData')
                                        <li>
                                            <a href="{{route('showAll',$m)}}" class="sub-slide-item font-16">بيانات المشتركين</a>
                                        </li>
                                    @endcan
                                    @can('sm-shholderData')
                                        <li>
                                            <a href="{{route('getcontributors',$m)}}" class="sub-slide-item font-16">بيانات المساهمين</a>
                                        </li>
                                    @endcan
                                </ul>
                            @endcan
                            @can('sm-contracts')
                                <li class="side-menu-label1"><a href="javascript:void(0)">Apps</a></li>
                                <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                    <span class="sub-side-menu__label">العقود</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @can('sm-myContract')
                                        <li>
                                            <a href="{{route('savings.show',EmpNo())}}" class="sub-slide-item font-16">عقد الإشتراك</a>
                                        </li>
                                    @endcan
                                    @can('sm-contract')
                                        <li>
                                            <a href="{{route('getcontractAll',$m)}}" class="sub-slide-item font-16">عقود المشتركين</a>
                                        </li>
                                    @endcan
                                </ul>
                            @endcan

                            @can('sm-orders')
                                <li class="side-menu-label1"><a href="javascript:void(0)">Apps</a></li>
                                <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                    <span class="sub-side-menu__label">طلبات الصندوق</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @can('sm-orderServices')
                                        <li>
                                            <a href="{{route('orders.index')}}" class="sub-slide-item font-16">طلب خدمة</a>
                                        </li>
                                    @endcan
                                    @can('sm-withdraws')
                                        <li>
                                            <a href="{{ route('withdraws.index') }}" class="sub-slide-item font-16">طلب سحب رصيد/إنسحاب</a>
                                        </li>
                                    @endcan
                                    @can('sm-sponsers')
                                        <li>
                                            <a href="{{ route('orders.create') }}" class="sub-slide-item font-16">الكفالة</a>
                                        </li>
                                    @endcan
                                    @can('sm-myorders')
                                        <li>
                                            <a href="{{route('orders.show',1)}}" class="sub-slide-item font-16">طلباتي</a>
                                        </li>
                                    @endcan
                                </ul>
                            @endcan


                            @can('sm-mangtBox')
                                <li class="side-menu-label1"><a href="javascript:void(0)">Apps</a></li>
                                <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                    <span class="sub-side-menu__label">إدارة الصندوق</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @can('sm-analysMenu')
                                    <li>
                                        <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                            <span class="sub-side-menu__label">التحليل المالي</span><i class="sub-angle fe fe-chevron-right"></i>
                                        </a>
                                        <ul class="sub-slide-menu">
                                            @can('sm-analysorder')
                                                <li>
                                                    <a href="{{ route('boanalyses.index') }}" class="sub-slide-item font-16">الخدمات</a>
                                                </li>
                                            @endcan
                                            @can('sm-analyswithdraws')
                                                <li>
                                                    <a href="{{route('withdraws.create')}}" class="sub-slide-item font-16">سحب رصيد/إنسحاب</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                    @endcan
                                    @can('sm-mangtAppBox')
                                        <li>
                                            <a href="{{ route('boanalyses.create') }}" class="sub-slide-item font-16">اللجنة</a>
                                        </li>
                                    @endcan

                                    @can('sm-blances')
                                        <li>
                                            <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                                <span class="sub-side-menu__label">الارصدة</span><i class="sub-angle fe fe-chevron-right"></i>
                                            </a>
                                            <ul class="sub-slide-menu">
                                                @can('sm-opblances')
                                                    <li>
                                                        <a href="{{ route('boxbalances.index') }}" class="sub-slide-item font-16">الارصدة الإفتتاحية</a>
                                                    </li>
                                                @endcan

                                            </ul>
                                        </li>
                                    @endcan
                                </ul>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('mm-setting')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-airplay"></i>
                            <span class="side-menu__label hedr-font">إعدادات</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('sm-tranData')
                                <li>
                                    <a href="{{ route('employees.index') }}" class="sub-slide-item font-16">نقل البيانات</a>
                                </li>
                            @endcan
                            @can('sm-permissions')
                                <li><a href="{{route('transferfromoldData')}}" class="slide-item font-16">نقل البيانات القديمة</a></li>
                                <li>
                                    <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                        <span class="sub-side-menu__label">الصلاحيات</span><i class="sub-angle fe fe-chevron-right"></i>
                                    </a>
                                    <ul class="sub-slide-menu">
                                        <li>
                                            <a href="{{ route('admin.users.index') }}" class="sub-slide-item font-16">المستخدمين</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.roles.index') }}" class="sub-slide-item font-16">الأدوار</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.permissions.index')}}" class="sub-slide-item font-16">الصلاحيات</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan



                {{-- @if (isAdmin() || isEmployee() || isSponsor())
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i>
                            <span class="side-menu__label hedr-font">الشؤون المالية</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Apps</a></li>
                            <li><a href="{{route('dbtreceipts.index')}}" class="slide-item font-16">سندات الإيداع</a></li>
                            @if (isAdmin())
                                <li><a href="{{route('crtreceipts.index')}}" class="slide-item font-16">سندات الصرف</a></li>
                            @endif
                                <a class="sub-side-menu__item font-16" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                    <span class="sub-side-menu__label">كشف حساب</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                <ul class="sub-slide-menu">
                                    <li>
                                        <a href="{{route('AccountStatement')}}" class="sub-slide-item font-16"> كشف حساب </a>
                                        <a class="sub-slide-item font-16 btn" data-bs-toggle="modal" data-bs-target="#displayCumulative">
                                            كشف حساب تجميعي
                                        </a>
                                    </li>

                                    <li>
                                        <form action="{{route('AccStatementRep',5)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="sub-slide-item font-16 btn btn-link">أرصدة الكفلاء</button>
                                        </form>

                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif --}}

                {{--<li class="sub-category">
                    <h3>Pre-build Pages</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Pages</a></li>
                        <li><a href="profile.html" class="slide-item"> Profile</a></li>
                        <li><a href="editprofile.html" class="slide-item"> Edit Profile</a></li>
                        <li><a href="notify-list.html" class="slide-item"> Notifications List</a></li>
                        <li><a href="email-compose.html" class="slide-item"> Mail-Compose</a></li>
                        <li><a href="email-inbox.html" class="slide-item"> Mail-Inbox</a></li>
                        <li><a href="email-read.html" class="slide-item"> Mail-Read</a></li>
                        <li><a href="gallery.html" class="slide-item"> Gallery</a></li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Forms</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a href="form-elements.html" class="sub-slide-item"> Form Elements</a></li>
                                <li><a href="form-layouts.html" class="sub-slide-item"> Form Layouts</a></li>
                                <li><a href="form-advanced.html" class="sub-slide-item"> Form Advanced</a></li>
                                <li><a href="form-editor.html" class="sub-slide-item"> Form Editor</a></li>
                                <li><a href="form-wizard.html" class="sub-slide-item"> Form Wizard</a></li>
                                <li><a href="form-validation.html" class="sub-slide-item"> Form Validation</a></li>
                            </ul>
                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Tables</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a href="tables.html" class="sub-slide-item">Default table</a></li>
                                <li><a href="datatable.html" class="sub-slide-item"> Data Tables</a></li>
                                <li><a href="edit-table.html" class="sub-slide-item"> Edit Tables</a></li>
                                <li><a href="extension-tables.html" class="sub-slide-item"> Extension Tables</a></li>
                            </ul>
                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Extension</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a href="about.html" class="sub-slide-item"> About Company</a></li>
                                <li><a href="services.html" class="sub-slide-item"> Services</a></li>
                                <li><a href="faq.html" class="sub-slide-item"> FAQS</a></li>
                                <li><a href="terms.html" class="sub-slide-item"> Terms</a></li>
                                <li><a href="invoice.html" class="sub-slide-item"> Invoice</a></li>
                                <li><a href="pricing.html" class="sub-slide-item"> Pricing Tables</a></li>
                                <li><a href="settings.html" class="sub-slide-item"> Settings</a></li>
                                <li><a href="blog.html" class="sub-slide-item"> Blog</a></li>
                                <li><a href="blog-details.html" class="sub-slide-item"> Blog Details</a></li>
                                <li><a href="blog-post.html" class="sub-slide-item"> Blog Post</a></li>
                                <li><a href="empty.html" class="sub-slide-item"> Empty Page</a></li>
                                <li><a href="construction.html" class="sub-slide-item"> Under Construction</a></li>
                            </ul>
                        </li>
                        <li><a href="switcher-1.html" class="slide-item"> Switcher</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-shopping-bag"></i><span class="side-menu__label">E-Commerce</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">E-Commerce</a></li>
                        <li><a href="shop.html" class="slide-item"> Shop</a></li>
                        <li><a href="shop-description.html" class="slide-item"> Product Details</a></li>
                        <li><a href="cart.html" class="slide-item"> Shopping Cart</a></li>
                        <li><a href="add-product.html" class="slide-item"> Add Product</a></li>
                        <li><a href="wishlist.html" class="slide-item"> Wishlist</a></li>
                        <li><a href="checkout.html" class="slide-item"> Checkout</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-folder"></i><span class="side-menu__label">File Manager</span><span class="badge bg-pink side-badge">4</span><i class="angle fe fe-chevron-right hor-angle"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">File Manager</a></li>
                        <li><a href="file-manager.html" class="slide-item"> File Manager</a></li>
                        <li><a href="filemanager-list.html" class="slide-item"> File Manager List</a></li>
                        <li><a href="filemanager-details.html" class="slide-item"> File Details</a></li>
                        <li><a href="file-attachments.html" class="slide-item"> File Attachments</a></li>
                    </ul>
                </li>
                <li class="sub-category">
                    <h3>Misc Pages</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Authentication</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Authentication</a></li>
                        <li><a href="login.html" class="slide-item"> Login</a></li>
                        <li><a href="register.html" class="slide-item"> Register</a></li>
                        <li><a href="forgot-password.html" class="slide-item"> Forgot Password</a></li>
                        <li><a href="lockscreen.html" class="slide-item"> Lock screen</a></li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Error Pages</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a href="400.html" class="sub-slide-item"> 400</a></li>
                                <li><a href="401.html" class="sub-slide-item"> 401</a></li>
                                <li><a href="403.html" class="sub-slide-item"> 403</a></li>
                                <li><a href="404.html" class="sub-slide-item"> 404</a></li>
                                <li><a href="500.html" class="sub-slide-item"> 500</a></li>
                                <li><a href="503.html" class="sub-slide-item"> 503</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-cpu"></i>
                        <span class="side-menu__label">Submenu items</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Submenu items</a></li>
                        <li><a href="javascript:void(0)" class="slide-item">Submenu-1</a></li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Submenu-2</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu">
                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.1</a></li>
                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.2</a></li>
                                <li class="sub-slide2">
                                    <a class="sub-side-menu__item2" href="javascript:void(0)" data-bs-toggle="sub-slide2"><span class="sub-side-menu__label2">Submenu-2.3</span><i class="sub-angle2 fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu2">
                                        <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.1</a></li>
                                        <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.2</a></li>
                                        <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.3</a></li>
                                    </ul>
                                </li>
                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.4</a></li>
                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.5</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sub-category">
                    <h3>General</h3>
                </li>
                <li>
                    <a class="side-menu__item" href="widgets.html"><i class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Widgets</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-map-pin"></i><span class="side-menu__label">Maps</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Maps</a></li>
                        <li><a href="maps1.html" class="slide-item">Leaflet Maps</a></li>
                        <li><a href="maps2.html" class="slide-item">Mapel Maps</a></li>
                        <li><a href="maps.html" class="slide-item">Vector Maps</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-bar-chart-2"></i><span class="side-menu__label">Charts</span><span class="badge bg-secondary side-badge">6</span><i class="angle fe fe-chevron-right hor-angle"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Charts</a></li>
                        <li><a href="chart-chartist.html" class="slide-item">Chart Js</a></li>
                        <li><a href="chart-flot.html" class="slide-item"> Flot Charts</a></li>
                        <li><a href="chart-echart.html" class="slide-item"> ECharts</a></li>
                        <li><a href="chart-morris.html" class="slide-item"> Morris Charts</a></li>
                        <li><a href="chart-nvd3.html" class="slide-item"> Nvd3 Charts</a></li>
                        <li><a href="charts.html" class="slide-item"> C3 Bar Charts</a></li>
                        <li><a href="chart-line.html" class="slide-item"> C3 Line Charts</a></li>
                        <li><a href="chart-donut.html" class="slide-item"> C3 Donut Charts</a></li>
                        <li><a href="chart-pie.html" class="slide-item"> C3 Pie charts</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-wind"></i><span class="side-menu__label">Icons</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Icons</a></li>
                        <li><a href="icons.html" class="slide-item"> Font Awesome</a></li>
                        <li><a href="icons2.html" class="slide-item"> Material Design Icons</a></li>
                        <li><a href="icons3.html" class="slide-item"> Simple Line Icons</a></li>
                        <li><a href="icons4.html" class="slide-item"> Feather Icons</a></li>
                        <li><a href="icons5.html" class="slide-item"> Ionic Icons</a></li>
                        <li><a href="icons6.html" class="slide-item"> Flag Icons</a></li>
                        <li><a href="icons7.html" class="slide-item"> pe7 Icons</a></li>
                        <li><a href="icons8.html" class="slide-item"> Themify Icons</a></li>
                        <li><a href="icons9.html" class="slide-item">Typicons Icons</a></li>
                        <li><a href="icons10.html" class="slide-item">Weather Icons</a></li>
                        <li><a href="icons11.html" class="slide-item">Bootstrap Icons</a></li>
                    </ul>
                </li> --}}
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>

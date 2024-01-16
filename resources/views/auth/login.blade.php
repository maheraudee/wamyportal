@extends('layouts.auth')
@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6">

            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                @csrf
                <span class="login100-form-title pb-5">
                    تسجيل الدخول
                </span>
                <div class="panel panel-primary">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                {{-- <li class="mx-0"><a href="#tab5" class="active" data-bs-toggle="tab">البريد الإلكتروني</a></li> --}}
                                {{-- <li class="mx-0"><a href="#tab6" data-bs-toggle="tab">جوال</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab5">
                                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-traffic text-muted" aria-hidden="true"></i>
                                        {{-- <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i> --}}
                                    </a>
                                    {{-- <input class="input100 border-start-0 form-control ms-0" name="email" type="email" placeholder="البريد الإلكتروني"> --}}
                                    <input class="input100 border-start-0 form-control ms-0" name="login" type="text" placeholder="البريد الإلكتروني / الجوال / الإسم">
                                </div>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" name="password" type="password" placeholder="كلمة المرور">
                                </div>
                                <div class="text-end pt-4">
                                    <p class="mb-0"><a href="{{ route('password.request') }}" class="text-primary ms-1">هل نسيت كلمة المرور؟</a></p>
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">دخول</button>
                                    {{-- <a href="index.html" class="login100-form-btn btn-primary">
                                            دخول
                                    </a> --}}
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">إذا كنت غير عضو<a href="{{ route('register') }}" class="text-primary ms-1">تسجيل الدخول</a></p>
                                </div>
                            </div>
                            {{-- <div class="tab-pane" id="tab6">
                                <div id="mobile-num" class="wrap-input100 validate-input input-group mb-4">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <span>966+</span>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" name="mobile" type="text" placeholder="0531234567">

                                </div>
                                <div id="login-otp" class="justify-content-around mb-5">
                                    <input class="form-control text-center w-15" id="txt1" maxlength="1">
                                    <input class="form-control text-center w-15" id="txt2" maxlength="1">
                                    <input class="form-control text-center w-15" id="txt3" maxlength="1">
                                    <input class="form-control text-center w-15" id="txt4" maxlength="1">
                                </div>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" type="password" placeholder="كلمة المرور">
                                </div>
                                <span>Note : Login with registered mobile number to generate OTP.</span>
                                <div class="container-login100-form-btn ">
                                    <button type="submit" class="login100-form-btn btn-primary">دخول</button>
                                    <a href="javascript:void(0)" class="login100-form-btn btn-primary" id="generate-otp">
                                        دخول
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

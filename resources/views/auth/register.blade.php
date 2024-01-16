@extends('layouts.auth')
@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6" style="width: 25%">
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
                <span class="login100-form-title">
                        تسجيل جديد
                    </span>
                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                        <i class="mdi mdi-account" aria-hidden="true"></i>
                    </a>
                    <input class="input100 border-start-0 ms-0 form-control" name="name" type="text" placeholder="الإسم">
                </div>
                @error('name')
                    <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                @enderror
                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                    </a>
                    <input class="input100 border-start-0 ms-0 form-control" name="email" type="email" placeholder="البريد الإلكتروني">
                </div>
                @error('email')
                    <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                @enderror
                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                        <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                    </a>
                    <input class="input100 border-start-0 ms-0 form-control" name="password" type="password" placeholder="كلمة المرور">
                </div>
                @error('password')
                    <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                @enderror
                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                        <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                    </a>
                    <input class="input100 border-start-0 ms-0 form-control" name="password_confirmation" type="password" placeholder="تأكيد كلمة المرور">
                </div>
                @error('password_confirmation')
                    <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                @enderror
                <div class="wrap-input100 validate-input input-group">
                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                        <i class="zmdi zmdi-phone" aria-hidden="true"></i>
                    </a>
                    <input class="input100 border-start-0 ms-0 form-control" name="mobile"  type="text" placeholder="الجوال"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>
                @error('mobile')
                    <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                @enderror
                <div class="wrap-input100 validate-input input-group">
                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                        <i class="zmdi zmdi-assignment-account" aria-hidden="true"></i>
                        {{-- <i class="zmdi zmdi-500px" aria-hidden="true"></i> --}}
                    </a>
                    <input class="input100 border-start-0 ms-0 form-control" name="empno"  type="text" placeholder="الرقم الوظيفي"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>
                @error('empno')
                    <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                @enderror
                {{-- <label class="custom-control custom-checkbox mt-4">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
                    </label> --}}
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn btn-primary">تسجيل</button>
                    {{-- <a href="index.html" >

                    </a> --}}
                </div>
                <div class="text-center pt-3">
                    <p class="text-dark mb-0">لديك حساب بالفعل؟<a href="{{ route('login') }}" class="text-primary ms-1">دخول</a></p>
                </div>
                {{-- <label class="login-social-icon"><span>Register with Social</span></label>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0)">
                        <div class="social-login me-4 text-center">
                            <i class="fa fa-google"></i>
                        </div>
                    </a>
                    <a href="javascript:void(0)">
                        <div class="social-login me-4 text-center">
                            <i class="fa fa-facebook"></i>
                        </div>
                    </a>
                    <a href="javascript:void(0)">
                        <div class="social-login text-center">
                            <i class="fa fa-twitter"></i>
                        </div>
                    </a>
                </div> --}}
            </form>
        </div>
    </div>
@endsection

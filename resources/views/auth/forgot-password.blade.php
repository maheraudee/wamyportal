{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
@extends('layouts.auth')
@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6">

            <div class="mb-4 text-sm text-gray-600">
                <p class="font-16"><strong>نسيت كلمة المرور؟</strong> لا مشكلة. فقط أخبرنا بعنوان بريدك الإلكتروني وسنرسل لك  رابط إعادة تعيين كلمة المرور</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <label for="email" class="font-16">البريد الإلكتروني</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@wamy.org">
                @error('email')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
                <!-- Email Address -->
                {{-- <div>
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <input class="input100 border-start-0 form-control ms-0" name="email" type="email" required autofocus>

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div> --}}
                <div class="container-login100-form-btn ">
                    <button type="submit" class="login100-form-btn btn-primary">إرسال</button>
                </div>
                {{-- <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div> --}}
            </form>
            {{-- <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                @csrf
                <span class="login100-form-title pb-5">
                    تسجيل الدخول
                </span>
                <div class="panel panel-primary">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class="mx-0"><a href="#tab5" class="active" data-bs-toggle="tab">البريد الإلكتروني</a></li>
                                <li class="mx-0"><a href="#tab6" data-bs-toggle="tab">جوال</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab5">
                                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" name="email" type="email" placeholder="البريد الإلكتروني">
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

                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">إذا كنت غير عضو<a href="{{ route('register') }}" class="text-primary ms-1">تسجيل الدخول</a></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab6">
                                <div id="mobile-num" class="wrap-input100 validate-input input-group mb-4">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <span>966+</span>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0">
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
                                <div class="container-login100-form-btn ">
                                    <button type="submit" class="login100-form-btn btn-primary">دخول</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form> --}}
        </div>
    </div>
@endsection

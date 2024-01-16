<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        /* $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','regex:/(.*)@wamy.org/i', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['required','string','max:10','min:10'],
            'empno' =>  ['required','integer','min:5','unique:'.User::class],
        ]); */

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','regex:/(.*)@wamy.org/i', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['required','string','max:10','min:10'],
            'empno' =>  ['required','integer','min:5','unique:'.User::class],
        ], [
            'name.required' => 'عفواً يجب إدخال الأسم',
            'name.max' => 'عفواً يجب الا يزيد الاسم عن 255 حرف',
            'email.required' => 'عفواً لم تقم بادخال البريد الإلكتروني',
            'email.email' => 'عفواً هذا ليس بريد الإلكتروني',
            'email.regex' => 'عفواً يجب إدخال بريد ضمن نطاق الندوة العالمية',
            'email.unique' => 'عفواً هذا البريد الإلكتروني موجود مسبقاً',
            'password.required' => 'عفواً لابد من إدخال كلمة مرور',
            'mobile.required' => 'عفواً يجب كتابة رقم الجوال',
            'mobile.max' => 'عفواً رقم الجوال يجب الا يزيد عن 10 أرقام',
            'mobile.min' => 'عفواً رقم الجوال يجب الا يقل عن 10 أرقام',
            'empno.required' => 'عفواً لابد من إدخال الرقم الوظيفي',
            'empno.unique' => 'عفواً الرقم الوظيفي موجود مسبقاً',
            'empno.min' => 'عفواً الرقم الوظيفي يجب الا يقل عن 5 أرقام',
            /* 'empno.max' => 'عفواً الرقم الوظيفي يجب الا يزيد عن 5 أرقام', */



            /* 'signature.required' => 'لايوجد لديك توقيع الرجاء قم بإرفاقه',
            'signature.mimes' => 'صيغة المرفق يجب ان تكون    jpeg , png , jpg', */
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'empno' => $request->empno,
            'usertypeid'=>3,
        ])->assignRole('User');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

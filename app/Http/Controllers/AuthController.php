<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            // return redirect()->route('home');
            // if((Auth::user()->role == 'isAdmin')) {
                return redirect('/home');
            // }
            // if (Auth::user()->role == 'isCashier') { // true sekalian session field di users nanti bisa dipanggil via Auth
            //     //Login Success
            //     // return redirect()->route('home');
            //     return redirect('/kasir');
            // }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|string',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'      => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            // if(Auth()->user()->role=='isAdmin') {
                return redirect('home');
            // } else if (Auth()->user()->role=='isCashier') {
            //     return redirect('/kasir');
            // } else if (Auth()->user()->role=='isOrdering') {
            //     return redirect('/order');
            // } else {
            //     return redirect()->route('login');
            // }
        } else { // false

            //Login Fail
            // session()->flash('errors', 'Email atau password salah');
            // Session::flash('error', 'Email atau password salah');
            return redirect()->route('login')->with('message', 'Email atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}

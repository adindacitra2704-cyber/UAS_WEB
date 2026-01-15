<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        // 1. Tidak boleh kosong
        if (!$request->username || !$request->password) {
            return back()->withErrors([
                'error' => 'username/password incorrect'
            ]);
        }

        // 2. Validasi username (email + domain)
        if (!filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors([
                'error' => 'username/password incorrect'
            ]);
        }

        // domain validation
        $allowedDomain = 'gmail.com';
        $domain = substr(strrchr($request->username, "@"), 1);

        if ($domain !== $allowedDomain) {
            return back()->withErrors([
                'error' => 'username/password incorrect'
            ]);
        }

        // 3. Password minimal 8 karakter
        if (strlen($request->password) < 8) {
            return back()->withErrors([
                'error' => 'username/password incorrect'
            ]);
        }

        // 4. Jika username & password valid tapi user lupa password
        if ($request->has('forgot')) {
            return redirect()->route('forgot.password');
        }

        // contoh user dummy
        if ($request->username === 'admin@gmail.com' && $request->password === 'password123') {
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'error' => 'username/password incorrect'
        ]);
    }

    public function forgot()
    {
        return view('auth.forgot');
    }
}
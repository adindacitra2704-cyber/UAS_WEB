<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Mengambil input (Pastikan di form login name="username" atau name="email" disesuaikan)
        // Jika di form login Anda name="email", ganti baris bawah jadi: $request->email
        $username = $request->username ?? $request->email; 
        $password = $request->password;

        // 1. Tidak boleh kosong
        if (empty($username) || empty($password)) {
            return back()->with('error', 'username/password incorrect');
        }

        // 2. Harus email valid
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'username/password incorrect');
        }

        // 3. Domain terlarang
        if (str_ends_with($username, '@ganteng.com')) {
            return back()->with('error', 'username/password incorrect');
        }

        // 4. Password minimal 8 karakter
        if (strlen($password) < 8) {
            return back()->with('error', 'username/password incorrect');
        }

        // ✅ LOGIN BERHASIL
        // Kita set session manual agar route dashboard bisa diakses
        session(['login' => true]);
        
        return redirect()->route('dashboard');
    }

    // ================= REGISTER =================
    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // 1. Cek Kosong
        if (empty($username) || empty($password)) {
            return back()->with('error', 'username/password incorrect');
        }

        // 2. Cek Format Email Valid
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'username/password incorrect');
        }

        // 3. WAJIB GMAIL (Pesan error disamakan)
        if (!str_ends_with($username, '@gmail.com')) {
            return back()->with('error', 'username/password incorrect');
        }

        // 4. Domain terlarang (Opsional, karena sudah terfilter oleh poin 3)
        if (str_ends_with($username, '@ganteng.com')) {
            return back()->with('error', 'username/password incorrect');
        }

        // 5. Cek Password minimal 8 karakter
        if (strlen($password) < 8) {
            return back()->with('error', 'username/password incorrect');
        }

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil');
    }

    // ================= FORGOT PASSWORD =================
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendForgotPassword(Request $request)
    {
        $email = $request->email;

        // 1. Email tidak boleh kosong
        if (empty($email)) {
            return back()->with('error', 'Email tidak boleh kosong');
        }

        // 2. Email valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'Email Anda Salah');
        }

        // 3. Harus gmail
        if (!str_ends_with($email, '@gmail.com')) {
            return back()->with('error', 'Email Anda Salah');
        }

        // Simulasi password & OTP
        $password = 'password123';
        $otp = rand(100000, 999999);

        // Kirim email (SMTP)
        // Pastikan konfigurasi .env untuk MAIL sudah benar agar tidak error
        try {
            Mail::raw(
                "Password Anda: $password\nOTP Anda: $otp",
                function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Forgot Password & OTP');
                }
            );
            return back()->with('success', 'Password dan OTP telah dikirim ke email Anda');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Cek konfigurasi SMTP.');
        }
    }

    // ================= LOGOUT =================
    // Wajib ada karena routes/web.php memanggil ini
    public function logout(Request $request)
    {
        session()->flush(); // Hapus session manual
        return redirect()->route('login');
    }
}
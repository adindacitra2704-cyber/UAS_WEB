@extends('auth.layouts.auth')

@section('title', 'Lupa Password - Sleepy Panda')

@section('content')

    <div class="logo">
        <img src="https://i.imgur.com/8Km9tLL.png" alt="Panda">
    </div>

    <div class="title">Lupa password?</div>

    <div class="subtitle" style="margin-bottom: 25px;">
        Instruksi untuk melakukan reset password akan<br>
        dikirim melalui email yang kamu gunakan.
    </div>

    {{-- ERROR BLOCK --}}
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- SUCCESS BLOCK (INI AKAN MUNCUL NANTI) --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- PERBAIKAN: Mengarah ke route 'forgot.send' (POST) --}}
    <form method="POST" action="{{ route('forgot.send') }}"> 
        @csrf
        
        {{-- Masukkan email yang berakhiran @gmail.com (sesuai controller kamu) --}}
        <input type="email" name="email" class="form-input" placeholder="Email (harus @gmail.com)" required>

        <button type="submit" class="btn-masuk">
            Reset Password
        </button>
    </form>

    <div class="bottom-text">
        Kembali ke <a href="{{ route('login') }}">Masuk</a>
    </div>

@endsection
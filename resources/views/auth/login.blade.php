@extends('auth.layouts.auth')

@section('title', 'Login - Sleepy Panda')

@section('content')

    <div class="logo">
        <img src="https://i.imgur.com/8Km9tLL.png" alt="Panda">
    </div>

    <div class="title">
        Sleepy Panda
    </div>

    <div class="subtitle">
        Silakan login untuk melanjutkan
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.auth') }}" method="POST">
        @csrf
        
        <input type="email" name="email" class="form-input" placeholder="Email Address" required>

        <input type="password" name="password" class="form-input" placeholder="Password" required>

        <div class="clearfix">
            <a href="{{ route('forgot.password') }}" class="forgot-link">Lupa Password?</a>
        </div>

        <button type="submit" class="btn-masuk">
            Masuk
        </button>
    </form>
    <div class="bottom-text">
        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>

@endsection
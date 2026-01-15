@extends('auth.layouts.auth')
@section('title', 'Daftar - Sleepy Panda')

@section('content')

    <div class="logo">
        <img src="https://i.imgur.com/8Km9tLL.png" alt="Panda">
    </div>

    <div class="title">
        Buat Akun Baru
    </div>

    <div class="subtitle">
        Daftar menggunakan email yang valid<br>untuk memulai
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        
        <input type="email" name="username" class="form-input" placeholder="Email Address" required>

        <input type="password" name="password" class="form-input" placeholder="Password" required>

        <button type="submit" class="btn-masuk">
            Daftar
        </button>
    </form>

    <div class="bottom-text">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
    </div>

@endsection
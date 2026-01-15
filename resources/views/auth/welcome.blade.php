@extends('auth.layouts.auth')
@section('title','Sleepy Panda')

@section('content')
    <div class="logo">
        <img src="images//panda.png" alt="Panda">
    </div>

    <div class="title">Sleepy Panda</div>

    <div class="subtitle">
        Mulai dengan masuk atau mendaftar untuk melihat analisa tidurmu
    </div>

    <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>

    <a href="{{ route('register') }}" class="btn-daftar">Daftar</a>

@endsection
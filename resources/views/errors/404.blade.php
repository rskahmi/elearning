@extends('layout.guest-no-navbar')
@section('title', 'Error Messages')
@section('content')
    <div class="error-container">
        <h2>Oops!</h2>
        <p>Ini bukan halaman yang ingin saya tuju!</p>
        <a href="{{ route('auth') }}">Kembali</a>
    </div>
@endsection

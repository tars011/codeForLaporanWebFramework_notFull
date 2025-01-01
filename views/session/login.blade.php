@extends('layout/session')

@section('title')
    Login
@endsection

@section('content-css')
@parent
@endsection

@section('content')
    <div class="login-form">
        <form action="{{ route('login.submit') }}" method="post">
            @csrf
            <h1>Login</h1>
            <div class="content">
                <div class="inputbox">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" autocomplete="nope" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" autocomplete="nope" required>
                    </div>
                </div>
                @if (session('gagal'))
                <p class="message">{{ session('error') }}</p>
                @else
                <p class="message"></p>
                @endif
            </div>
            <div class="action">
                <a href="{{ route('registrasi.index') }}" class="button" disabled="disabled">Registrasi</a>
                <button type="submit" class="button" id="enter">Sign in</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                form.submit();
            }
        });
    });
    </script>
@endsection
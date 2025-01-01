@extends('layout/session')

@section('title')
    Registrasi
@endsection

@section('content-link')
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
@endsection

@section('content')
<div class="text-center mt-5">
    <h2>Registrasi</h2>
    <p>Silahkan isi formulir berikut untuk registrasi</p>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-start">
                    <form action="{{ route('registrasi.submit') }}" method="post">
                        @csrf
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="full_name" id="" class="form-control mb-2" required>
                        <label for="">Username</label>
                        <input type="text" name="username" id="" class="form-control mb-2" required>
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control mb-2" required>
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control mb-2" required>
                        <button class="btn btn-primary">Registrasi</buttonclass>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
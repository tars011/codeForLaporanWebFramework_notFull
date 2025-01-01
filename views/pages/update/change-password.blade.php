@extends('layout/mainlayout')

@section('title', 'Ganti Password')

@section('content')
    <h1>Edit Profil</h1>
    <div class="aksi">
        <a href="{{ route('profile.index') }}" class="close-btn" id="backButton">
            <i class="fa-regular fa-circle-left"></i>
            <span class="close-caption">Back</span>
        </a>
        <button class="button button-red" id="resetFormBtn"><i class="fa fa-rotate-left"></i></button>
        <button type="submit" form="inputForm" class="button button-amber"><i class="fa-regular fa-floppy-disk"></i>Simpan</button>
    </div>

    @include('components.error')
    
    <div class="profil-container">
        <div class="profil-image">
            <img src="{{ Auth::user()->photo ? asset('storage/photo/' . Auth::user()->photo) : asset('default-profile.png') }}">
        </div>
        <div class="profil-info">
            <form action="{{ route('password.update') }}" method="post" id="inputForm">
                @method('PUT')
                @csrf
                <table>
                    <tr>
                        <th class="text-start" style="width: 30%;">Password Lama</th>
                        <td class="text-start" style="width: 2%;">:</td>
                        <td class="text-start no-td">
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" minlength="8" required>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start">Password Baru</th>
                        <td class="text-start">:</td>
                        <td class="text-start no-td">
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" minlength="8" required>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start">Konfirmasi Password Baru</th>
                        <td class="text-start">:</td>
                        <td class="text-start no-td">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" minlength="8" required>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

@endsection

@section('content-js')
    @parent
    <script src="{{ asset('js/crud.js') }}"></script>
@endsection
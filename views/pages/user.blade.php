@extends('layout/mainlayout')

@section('title', 'Profil')

@section('content')
    <h1>Profil</h1>
    <div class="aksi">
        <a href="{{ route('profile.edit') }}" class="button button-amber"><i class="fa fa-pen-to-square"></i>Edit Profil</a>
        <a href="{{ route('password.change') }}" class="button button-blue"><i class="fa fa-lock"></i>Ganti Password</a>
        <a href="{{ route('photo.edit') }}" class="button button-green"><i class="fa fa-image"></i>Ganti Foto</a>
    </div>
    <div class="profil-container">
        <div class="profil-image">
            <img src="{{ Auth::user()->photo ? asset('storage/photo/' . Auth::user()->photo) : asset('default-profile.png') }}" alt="Profil">
        </div>
        <div class="profil-info">
            <table>
                <tr>
                    <th class="text-start">Nama Lengkap</th>
                    <td class="text-start">:</td>
                    <td class="text-start">{{ $user->full_name }}</td>
                </tr>
                <tr>
                    <th class="text-start" style="width: 20%;">ID</th>
                    <td class="text-start" style="width: 2%;">:</td>
                    <td class="text-start">{{ $user->id }}</td>
                </tr>
                <tr>
                    <th class="text-start">Username</th>
                    <td class="text-start">:</td>
                    <td class="text-start">{{ $user->username }}</td>
                </tr>
                <tr>
                    <th class="text-start">Email</th>
                    <td class="text-start">:</td>
                    <td class="text-start">{{ $user->email }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
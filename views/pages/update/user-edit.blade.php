@extends('layout/mainlayout')

@section('title', 'Profil | Edit')

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
            <form action="{{ route('profile.update') }}" method="post" id="inputForm">
                @method('PUT')
                @csrf
                <table>
                    <tr>
                        <th class="text-start">Nama Lengkap</th>
                        <td class="text-start">:</td>
                        <td class="text-start no-td">
                            <input type="text" name="full_name" value="{{ $user->full_name }}" maxlength="100" required>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start" style="width: 20%;">ID</th>
                        <td class="text-start" style="width: 2%;">:</td>
                        <td class="text-start">{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Username</th>
                        <td class="text-start">:</td>
                        <td class="text-start no-td">
                            <input type="text" name="username" value="{{ $user->username }}" maxlength="50" required>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start">Email</th>
                        <td class="text-start">:</td>
                        <td class="text-start">{{ $user->email }}</td>
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
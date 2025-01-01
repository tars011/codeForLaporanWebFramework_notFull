@extends('layout/mainlayout')

@section('title', 'Profil | Ganti Foto')

@section('content')
    <h1>Ganti Foto</h1>
    <div class="aksi">
        <a href="{{ route('profile.index') }}" class="close-btn" id="backButton">
            <i class="fa-regular fa-circle-left"></i>
            <span class="close-caption">Back</span>
        </a>
        <form action="{{ route('photo.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="button button-red" type="submit" onclick="return confirm('Yakin ingin menghapus foto?')"><i class="fa fa-trash-can"></i></button>
        </form>
        <button type="submit" form="inputForm" class="button button-amber"><i class="fa-regular fa-floppy-disk"></i>Simpan</button>
    </div>
    
    @include('components.error')

    <div class="profil-container">
        <div class="profil-image">
            <img src="{{ Auth::user()->photo ? asset('storage/photo/' . Auth::user()->photo) : asset('default-profile.png') }}">
        </div>
        <div class="profil-info">
            <form action="{{ route('photo.update') }}" method="post" id="inputForm" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <table>
                    <tr>
                        <th class="text-start">Upload Photo</th>
                    </tr>
                    <tr>
                        <td class="text-start">
                            <input type="file" name="photo" accept="image/*" required>
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
@extends('layout/mainlayout')

@section('title', 'Kelola Toko | Edit')


@section('content')
    <h1>Edit Toko</h1>
    <div class="aksi">
        <a href="{{ route('shop.index') }}" class="close-btn" id="backButton">
            <i class="fa-regular fa-circle-left"></i>
            <span class="close-caption">Back</span>
        </a>
        <button class="button button-red" id="resetFormBtn"><i class="fa fa-rotate-left"></i></button>
        <button type="submit" form="inputForm" class="button button-amber"><i class="fa-regular fa-floppy-disk"></i>Simpan</button>
    </div>

    @include('components.error')
    
    <div class="card-toko">
        <div class="card-toko-body">
            <form action="{{ route('shop.update', $shop->id) }}" method="post" id="inputForm">
                @method('PUT')
                @csrf
                <table class="table-toko">
                    <tbody>
                        <tr>
                            <th class="text-start" style="width: 20%;">Pemilik</th>
                            <td class="text-start" style="width: 2%;">:</td>
                            <td class="text-start no-td">
                                <input type="text" name="owner" value="{{ $shop->owner }}" maxlength="100" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">Nama Toko</th>
                            <td class="text-start">:</td>
                            <td class="text-start no-td">
                                <input type="text" name="name" value="{{ $shop->name }}" maxlength="100" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">Alamat</th>
                            <td class="text-start">:</td>
                            <td class="text-start no-td">
                                <input type="text" name="address" value="{{ $shop->address }}" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">No. HP</th>
                            <td class="text-start">:</td>
                            <td class="text-start no-td">
                                <input type="tel" name="phone" value="{{ $shop->phone }}" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">Email</th>
                            <td class="text-start">:</td>
                            <td class="text-start no-td">
                                <input type="text" name="email" value="{{ $shop->email }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start">Instagram</th>
                            <td class="text-start">:</td>
                            <td class="text-start no-td">
                                <input type="text" name="social_media" value="{{ $shop->social_media }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

@endsection

@section('content-js')
    @parent
    <script src="{{ asset('js/crud.js') }}"></script>
@endsection
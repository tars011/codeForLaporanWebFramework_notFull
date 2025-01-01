@extends('layout/mainlayout')

@section('title', 'Kelola Toko')

@section('content')
    <h1>Kelola Toko</h1>
    <div class="aksi">
        <a href="{{ route('shop.edit', $shop->id) }}" class="button button-amber"><i class="fa fa-pen-to-square"></i>Edit Toko</a>
    </div>
    <div class="card-toko">
        <div class="card-toko-body">
            <table class="table-toko">
                <tbody>
                    <tr>
                        <th class="text-start" style="width: 20%;">Pemilik</th>
                        <td class="text-start" style="width: 2%;">:</td>
                        <td class="text-start">{{ $shop->owner }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Nama Toko</th>
                        <td class="text-start">:</td>
                        <td class="text-start">{{ $shop->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Alamat</th>
                        <td class="text-start">:</td>
                        <td class="text-start">{{ $shop->address }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">No. HP</th>
                        <td class="text-start">:</td>
                        <td class="text-start">{{ $shop->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Email</th>
                        <td class="text-start">:</td>
                        <td class="text-start">{{ $shop->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Instagram</th>
                        <td class="text-start">:</td>
                        <td class="text-start">{{ $shop->social_media ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
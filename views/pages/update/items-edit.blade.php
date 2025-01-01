@extends('layout/crud')

@section('title', 'Data Barang | Edit')

@section('content')

<h1>Edit</h1>

@include('components.error')
    
<div class="form-container">
    <div class="form-content">
        <div class="form-header">
            <h2>Data Barang</h2>
            <a href="{{ route('items.index') }}" class="close-btn" id="backButton">
                <i class="fa-regular fa-circle-left"></i>
                <span class="close-caption">Back</span>
            </a>
        </div>
        <div class="form-body">
            <form action="{{ route('items.update', $item->id) }}" method="post" id="inputForm">
                @method('PUT')
                @csrf
                <label for="code">Kode Barang</label>
                <input type="text" id="code" name="code" value="{{ $item->code }}" readonly maxlength="10">
                <label for="name">Nama Barang</label>
                <input type="text" id="name" name="name" value="{{ $item->name }}" placeholder="Nama Barang" required maxlength="100">
                <label for="price">Harga</label>
                <input type="number" id="price" name="price" min="0" value="{{ $item->price }}" placeholder="Contoh: 50000" required>
                <label for="stock">Stok</label>
                <input type="number" id="stock" name="stock" min="0" value="{{ $item->stock }}" placeholder="Stok" required>
            </form>
        </div>
        <div class="form-footer">
            <button class="btn btn-sm btn-danger" id="resetFormBtn"><i class="fa fa-rotate-left"></i>Restore</button>
            <button type="submit" form="inputForm" class="btn btn-sm btn-secondary"><i class="fa-regular fa-floppy-disk"></i>Simpan</button>
        </div>
    </div>
</div>

@endsection

@section('content-js')
    @parent
@endsection
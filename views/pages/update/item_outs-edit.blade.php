@extends('layout/crud')

@section('title', 'Barang Keluar | Edit')

@section('links')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')

<h1>Edit</h1>

@include('components.error')
    
<div class="form-container">
    <div class="form-content">
        <div class="form-header">
            <h2>Barang Keluar</h2>
            <a href="{{ route('item_outs.index') }}" class="close-btn" id="backButton">
                <i class="fa-regular fa-circle-left"></i>
                <span class="close-caption">Back</span>
            </a>
        </div>
        <div class="form-body">
            <form action="{{ route('item_outs.update', $itemOut->id) }}" method="post" id="inputForm">
                @method('PUT')
                @csrf
                <label for="item_id">Pilih Barang</label>
                <select id="item_id" name="item_id" class="form-control select2">
                    @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ $itemOut->item_id == $item->id ? 'selected' : '' }} readonly>{{ $item->code.' - '.$item->name }}</option>
                    @endforeach
                </select>
                <label for="stock">Jumlah</label>
                <input type="number" id="stock" name="stock" min="1" value="{{ $itemOut->stock }}" placeholder="Contoh: 100" required>
                <label for="date">Tanggal Masuk</label>
                <input type="date" id="date" name="date" value="{{ $itemOut->date }}" required>
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
    <script>
    $(document).ready(function() {
        $('select[name=item_id]').attr("disabled", "disabled");
        $('.select2').select2({
            placeholder: "Pilih Barang",
            allowClear: true,
            width: 'resolve'
        });
    });
</script>
@endsection
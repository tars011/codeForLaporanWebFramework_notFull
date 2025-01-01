@extends('layout/mainlayout')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>

<div class="status-container">
    <div class="card blue">
        <div class="head">
            <div class="kiri">
                <h2>{{ $countItem }}</h2>
                <p>Data Barang</p>
            </div>
            <div class="kanan"><i class="fa fa-table"></i></div>
        </div>
        <a href="{{ route('items.index') }}" class="foot">More Info <i class="fa-regular fa-circle-right"></i></a>
    </div>
    <div class="card green">
        <div class="head">
            <div class="kiri">
                <h2>{{ $countItemIn }}</h2>
                <p>Barang Masuk</p>
            </div>
            <div class="kanan"><i class="fa-solid fa-square-plus"></i></div>
        </div>
        <a href="{{ route('item_ins.index') }}" class="foot">More Info <i class="fa-regular fa-circle-right"></i></a>
    </div>
    <div class="card red">
        <div class="head">
            <div class="kiri">
                <h2>{{ $countItemOut }}</h2>
                <p>Barang Keluar</p>
            </div>
            <div class="kanan"><i class="fa-solid fa-square-minus"></i></div>
        </div>
        <a href="{{ route('item_outs.index') }}" class="foot">More Info <i class="fa-regular fa-circle-right"></i></a>
    </div>
</div>
<div class="judul transaksi">
    <h3>Transaksi Terakhir</h3>
    <table class="tabel-transaksi">
        <thead>
            <th width="4%">#</th>
            <th width="15%">Kode Barang</th>
            <th width="25%">Nama Barang</th>
            <th width="18%">Jenis Transaksi</th>
            <th width="18%">Tanggal</th>
            <th width="20%">Jumlah</th>
        </thead>
        <tbody>
            @if ($dataTransaction->isNotEmpty())
                @foreach ($dataTransaction as $data)
                <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start">{{ $data->item->code ?? '-' }}</td>
                    <td class="text-start">{{ $data->item->name ?? '-' }}</td>
                    <td style="padding: 0 18px;">
                        @if ($data->type == 'in')  
                            <span class="labl labl-sm green">Masuk</span>
                        @else
                            <span class="labl labl-sm red">Keluar</span>
                        @endif
                    </td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->quantity }}</td>
                </tr>
                @endforeach
            @else
            <tr>
                <td colspan="6">No data available in table</td>
            </tr>
            @endif
        </tbody>
        <tfoot>
            <th>#</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jenis Transaksi</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
        </tfoot>
    </table>
</div>

@endsection

@section('content-js')
    @parent
@endsection
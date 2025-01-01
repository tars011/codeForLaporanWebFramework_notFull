@extends('layout/mainlayout')

@section('title', 'Data Barang')

@section('links')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')

<h1>Data Barang</h1>
<div class="aksi">
    <a href="{{ route('items.create') }}" class="button button-blue"><i class="fa-regular fa-square-plus"></i>Tambah Barang</></a>
</div>

@include('components.error')
    
<table id="items-table" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class="foot">#</th>
            <th class="foot">Kode Barang</th>
            <th class="foot">Nama Barang</th>
            <th class="foot">Harga</th>
            <th class="foot">Stok</th>
            <th class="foot">Aksi</th>
        </tr>
    </tfoot>
</table>

@endsection

@section('content-js')
    @parent
    <script>
        $(document).ready(function() {
            $('#items-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("items.index") }}',
                language: 
                {
                    emptyTable: "No data available in table",
                    processing: "<i class='fa fa-refresh fa-spin'></i>",
                },
                columns: [
                    { 
                        data: null, 
                        name: 'index',
                        orderable: false, 
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'stock', name: 'stock'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    { targets: [0], width: '4%'},
                    { targets: [1], width: '15%'},
                    { targets: [2], width: '25%'},
                    { targets: [3, 4], width: '18%'},
                    { targets: [5], width: '20%'},
                    {
                        targets: [0, 4], 
                        className: 'dt-body-center',
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).css('padding', '10px 18px')
                        }
                    },
                    {
                        targets: [1, 2], 
                        className: 'dt-body-left',
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).css('padding', '10px 18px')
                        }
                    },
                    {
                        targets: [3],
                        className: 'dt-body-right',
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).css('padding', '10px 18px')
                        }
                    },
                    {
                        targets: [5],
                        className: 'dt-body-center',
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).css('padding', '0 18px')
                        }
                    }
                ],
                order: [[1, 'asc']],
            }),
            $('.dataTables_wrapper').css({
                'margin': '20px auto',
                'padding': '10px 10px 4px',
                'background-color': '#fff',
                'border': '1px solid #ddd',
                'border-radius': '8px'
            });;
        });
    </script>
@endsection
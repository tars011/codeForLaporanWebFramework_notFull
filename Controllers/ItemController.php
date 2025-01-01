<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    // Mengirim data items untuk ditampilkan di JQuery Datatable
    public function index()
    {
        if (request()->ajax()) {
            $data = Item::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="'.route("items.edit", $row->id).'" class="btn btn-sm btn-secondary btn-40"><i class="fa fa-pen-to-square"></i>Edit</a>
                            <form action="'.route('items.destroy', $row->id).'" method="post" style="display: inline;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus item ini?\');">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger btn-40">
                                    <i class="fa fa-trash-can"></i>Delete
                                </button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.items');
    }

    // Menampilkan form create items
    public function create()
    {
        return view('pages.create.items-create');
    }

    // Menyimpan items
    public function store(StoreItemRequest $request)
    {
        $item = new Item();
        $item->code = $request->code;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();
        
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan data items tertentu (tidak dipakai)
    public function show(Item $item)
    {
        //
    }

    // Menampilkan form edit items tertentu
    public function edit(Item $item)
    {
        return view('pages.update.items-edit', compact('item'));
    }

    // Menyimpan data items hasil edit
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->code = $request->code;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->update();

        return redirect()->route('items.index')->with('success', 'Barang berhasil diedit.');
    }

    // Hapus data items
    public function destroy(Item $item)
    {
        $item->transactions()->delete();
        $item->item_ins()->delete();
        $item->item_outs()->delete();

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}

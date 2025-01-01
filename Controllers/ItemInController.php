<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemIn;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemInController extends Controller
{
    // Mengirim data item ins untuk ditampilkan di JQuery Datatable
    public function index()
    {
        if (request()->ajax()) {
            $data = ItemIn::with('item');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('item_code', function($row) {
                    return $row->item->code ?? '-';
                })
                ->addColumn('item_id', function($row) {
                    return $row->item->name ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route("item_ins.edit", $row->id).'" class="btn btn-sm btn-secondary btn-40"><i class="fa fa-pen-to-square"></i>Edit</a>
                            <form action="'.route('item_ins.destroy', $row->id).'" method="post" style="display: inline;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus item ini?\');">
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
        return view('pages/item_ins');
    }

    // Menampilkan form create item ins
    public function create()
    {
        $items = Item::all();
        return view('pages.create.item_ins-create', compact('items'));
    }

    // Menyimpan item ins
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'stock' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $itemIn = new ItemIn();
        $itemIn->item_id = $request->item_id;
        $itemIn->stock = $request->stock;
        $itemIn->date = $request->date;
        $itemIn->save();

        // Update items
        $item = Item::find($request->item_id);
        if ($item) {
            $item->stock += $request->stock;
            $item->save();
        }
        
        return redirect()->route('item_ins.index')->with('success', 'Barang masuk ditambahkan.');
    }

    // Menampilkan data item ins tertentu (tidak dipakai)
    public function show(ItemIn $item)
    {
        //
    }

    // Menampilkan form edit item ins tertentu
    public function edit(ItemIn $itemIn)
    {
        $items = Item::all();
        return view('pages.update.item_ins-edit', compact('itemIn', 'items'));
    }

    // Menyimpan data item ins hasil edit
    public function update(Request $request, ItemIn $itemIn)
    {
        $request->validate([
            'stock' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);
        
        // Hitung selisih stok
        $oldStock = $itemIn->stock;
        $newStock = $request->stock;
        $stockDifference = $newStock - $oldStock;

        // update item in
        $itemIn->stock = $request->stock;
        $itemIn->date = $request->date;
        $itemIn->update();

        // update items
        $item = Item::find($itemIn->item_id);
        if ($item) {
            $item->stock += $stockDifference;
            $item->save();
        }

        return redirect()->route('item_ins.index')->with('success', 'Barang masuk berhasil diedit.');
    }

    // Hapus data item ins
    public function destroy(ItemIn $itemIn)
    {
        $item = Item::find($itemIn->item_id);
        if ($item) {
            $item->stock -= $itemIn->stock;
            $item->save();
        }

        $itemIn->delete();

        return redirect()->route('item_ins.index')->with('success', 'Barang masuk dihapus.');
    }
}


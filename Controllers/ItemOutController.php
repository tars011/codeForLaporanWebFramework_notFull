<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemOut;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemOutController extends Controller
{
    // Mengirim data item outs untuk ditampilkan di JQuery Datatable
    public function index()
    {
        if (request()->ajax()) {
            $data = ItemOut::with('item');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('item_code', function($row) {
                    return $row->item->code ?? '-';
                })
                ->addColumn('item_id', function($row) {
                    return $row->item->name ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route("item_outs.edit", $row->id).'" class="btn btn-sm btn-secondary btn-40"><i class="fa fa-pen-to-square"></i>Edit</a>
                            <form action="'.route('item_outs.destroy', $row->id).'" method="post" style="display: inline;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus item ini?\');">
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
        return view('pages/item_outs');
    }

    // Menampilkan form create item outs
    public function create()
    {
        $items = Item::all();
        return view('pages.create.item_outs-create', compact('items'));
    }

    // Menyimpan item outs
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'stock' => 'required|integer|min:1|max:' . $this->getMaxStock($request->item_id),
            'date' => 'required|date',
        ], [
            'stock.max' => 'Stok keluar kelebihan',
        ]);

        $itemOut = new ItemOut();
        $itemOut->item_id = $request->item_id;
        $itemOut->stock = $request->stock;
        $itemOut->date = $request->date;
        $itemOut->save();
        
        // update items
        $item = Item::find($request->item_id);
        if ($item) {
            $item->stock -= $request->stock;
            $item->save();
        }

        return redirect()->route('item_outs.index')->with('success', 'Barang keluar ditambahkan.');
    }

    // Menampilkan data item outs tertentu (tidak dipakai)
    public function show(ItemOut $item)
    {
        //
    }

    // Menampilkan form edit item outs tertentu
    public function edit(ItemOut $itemOut)
    {
        $items = Item::all();
        return view('pages.update.item_outs-edit', compact('itemOut', 'items'));
    }

    // Menyimpan data item outs hasil edit
    public function update(Request $request, ItemOut $itemOut)
    {
        $request->validate([
            'stock' => 'required|integer|min:1|max:' . $this->getMaxStock2($itemOut->item_id, $itemOut->stock),
            'date' => 'required|date',
        ], [
            'stock.max' => 'Stok keluar kelebihan',
        ]);

        // Hitung selisih stok
        $oldStock = $itemOut->stock;
        $newStock = $request->stock;
        $stockDifference = $newStock - $oldStock;

        // update item out
        $itemOut->stock = $request->stock;
        $itemOut->date = $request->date;
        $itemOut->update();

        // update items
        $item = Item::find($itemOut->item_id);
        if ($item) {
            $item->stock -= $stockDifference;
            $item->save();
        }

        return redirect()->route('item_outs.index')->with('success', 'Barang keluar berhasil diedit.');
    }
    
    // Hapus data item outs
    public function destroy(ItemOut $itemOut)
    {
        $item = Item::find($itemOut->item_id);
        if ($item) {
            $item->stock += $itemOut->stock;
            $item->save();
        }

        $itemOut->delete();

        return redirect()->route('item_outs.index')->with('success', 'Barang keluar dihapus.');
    }

    // Fungsi mengetahui stok maksimal (untuk create)
    private function getMaxStock($itemId)
    {
        $item = Item::find($itemId);
        return $item ? $item->stock : 0;
    }

    // Fungsi mengetahui stok maksimal (untuk create)
    private function getMaxStock2($itemId, $currentStock)
    {
        $item = Item::find($itemId);
        return $item ? $item->stock + $currentStock : 0;
    }
}

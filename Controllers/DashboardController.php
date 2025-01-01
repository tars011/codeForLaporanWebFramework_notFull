<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemIn;
use App\Models\ItemOut;
use App\Models\Transaction;

class DashboardController extends Controller
{
    // Menampilkan data dari beberapa model
    public function index() 
    {
        $countItem = Item::count();
        $countItemIn = ItemIn::count();
        $countItemOut = ItemOut::count();

        $dataTransaction = Transaction::with('item')
                    ->orderByDesc('date')
                    // ->take(20) // ambil 20 data
                    ->get();
        return view('pages.dashboard', compact(['countItem', 'countItemIn', 'countItemOut', 'dataTransaction']));
    }
}

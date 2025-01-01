<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Menampilkan data toko
    public function index()
    {
        $shop = Shop::first();
        return view('pages.shop', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    // Menampilkan form edit toko
    public function edit(Shop $shop)
    {
        return view('pages.update.shop-edit', compact('shop'));
    }

    // Menyimpan data toko hasil edit
    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'owner' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'nullable|email',
            'social_media' => 'nullable|url',
        ], [
            'phone.regex' => 'No. HP harus berupa angka dengan panjang 10-15 digit dan dapat diawali dengan tanda "+"',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'social_media.url' => 'Media sosial harus berupa URL yang valid.',
        ]);
        
        $shop->owner = $request->owner;
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->email = $request->email;
        $shop->social_media = $request->social_media;
        $shop->update();

        return redirect()->route('shop.index')->with('success', 'Toko berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}

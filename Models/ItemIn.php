<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class ItemIn extends Model
{
    protected $fillable = ['item_id', 'stock', 'date'];

    public static function rules()
    {
        return [
            'item_id' => 'required|exists:items,id',
            'stock' => 'required|integer|min:1',
            'date' => 'required|date',
        ];
    }
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Auto Transaction setiap ada Item In baru
    protected static function booted()
    {
        // Event untuk create
        static::created(function ($itemIn) {
            Transaction::create([
                'item_id' => $itemIn->item_id,
                'type' => 'in',
                'date' => $itemIn->date,
                'quantity' => $itemIn->stock,
            ]);
        });

        // Event untuk update
        static::updated(function ($itemIn) {
            // Cari data transaksi yang sesuai dengan item_in
            $transaction = Transaction::where('item_id', $itemIn->item_id)
                ->where('type', 'in')
                ->where('date', $itemIn->getOriginal('date'))
                ->first();

            if ($transaction) {
                // Perbarui transaksi sesuai perubahan data item_in
                $transaction->update([
                    'date' => $itemIn->date,
                    'quantity' => $itemIn->stock,
                ]);
            }
        });

        // Event untuk delete
        static::deleted(function ($itemIn) {
            // Cari data transaksi yang sesuai dengan item_in
            $transaction = Transaction::where('item_id', $itemIn->item_id)
                ->where('type', 'in')
                ->where('date', $itemIn->getOriginal('date'))
                ->first();

            if ($transaction) {
                // Hapus transaksi
                $transaction->delete();
            }
        });
    }
}

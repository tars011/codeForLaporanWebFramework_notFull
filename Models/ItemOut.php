<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class ItemOut extends Model
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
        static::created(function ($itemOut) {
            Transaction::create([
                'item_id' => $itemOut->item_id,
                'type' => 'out',
                'date' => $itemOut->date,
                'quantity' => $itemOut->stock,
            ]);
        });
        
        // Event untuk update
        static::updated(function ($itemOut) {
            // Cari data transaksi yang sesuai dengan item_out
            $transaction = Transaction::where('item_id', $itemOut->item_id)
                ->where('type', 'out')
                ->where('date', $itemOut->getOriginal('date'))
                ->first();

            if ($transaction) {
                // Perbarui transaksi sesuai perubahan data item_out
                $transaction->update([
                    'date' => $itemOut->date,
                    'quantity' => $itemOut->stock,
                ]);
            }
        });

        // Event untuk delete
        static::deleted(function ($itemOut) {
            // Cari data transaksi yang sesuai dengan item_out
            $transaction = Transaction::where('item_id', $itemOut->item_id)
                ->where('type', 'out')
                ->where('date', $itemOut->getOriginal('date'))
                ->first();

            if ($transaction) {
                // Hapus transaksi
                $transaction->delete();
            }
        });
    }
}

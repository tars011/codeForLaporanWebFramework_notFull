<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['code', 'name', 'price', 'stock'];

    public static function rules()
    {
        return [
            'code' => 'required|string|max:10|unique:items,code',
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0|max:9999999999.99',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function item_ins()
    {
        return $this->hasMany(ItemIn::class);
    }

    public function item_outs()
    {
        return $this->hasMany(ItemOut::class);
    }
}

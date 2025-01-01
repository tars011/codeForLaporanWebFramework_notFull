<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['owner', 'name', 'address', 'phone', 'email', 'social_media'];

    public static function rules()
    {
        return [
            'owner' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'nullable|email',
            'social_media' => 'nullable|url',
        ];
    }
}

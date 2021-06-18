<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'produk';
    protected $fillable = [
        'nama', 'harga', 'warna', 'kondisi', 'deskripsi', 
    ];

    public $timestamps = true;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
}

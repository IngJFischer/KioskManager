<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'barcode',
        'list_price',
        'revenue',
        'price',
        'unit_sale',
        'provider_id',
    ];

    //Relación muchos a uno productos->proveedor.
    public function Provider()
    {
        return $this->belongsTo(Provider::class);
    }
}

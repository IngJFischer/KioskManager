<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
    ];

    //Método para cambiar la key del modelo de 'id' a 'product_id'
    public function getRouteKeyName():string
    {
        return 'product_id';
    }

    //Relación uno a uno inversa Stock->Producto
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation_id',
        'product_id',
        'quantity',
    ];

    //Relación uno a muchos inversa Detalle -> Operación
    public function Operation()
    {
        return $this->belongsTo(Operation::class);
    }

    //Relación uno a uno Detalle -> Producto
    public function Product()
    {
        return $this->hasOne(Product::class);
    }
}

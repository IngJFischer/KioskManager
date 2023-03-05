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

    //Metodo para chequear que el valor disponible de Stock sea mayor al de una modificación
    public function checkStock($quantity)
    {
        //El valor quantity es la cantidad que queremos modificar en el stock
        //Posee signo positivo si se agraga en el stock y negativo si se quita del stock
        if ($this->quantity + $quantity >= 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}


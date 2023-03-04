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
        'unit_sale',
        'provider_id',
    ];

    //Agregamos el item Precio al modelo al obtener los datos del mismo.
    protected $appends = ['price'];

    /** Modelos Entidad-Relación */

    //Relación muchos a uno Productos->Proveedor.
    public function Provider()
    {
        return $this->belongsTo(Provider::class);
    }

    //Relación uno a uno Producto->Stock
    public function Stock()
    {
        return $this->hasOne(Stock::class);
    }

    /** Fin de los Modelos Entidad-Relación */

    //Accesor para obtenerl el precio de un producto.
    public function getPriceAttribute()
    {
        //El precio se calcula como list_price * (100 + revenue)/100)
        return ($this->list_price * (100 + $this->revenue)/100);
    }
}

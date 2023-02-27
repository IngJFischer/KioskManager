<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //Relación uno a muchos proveedor->productos
    public function Products()
    {
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'costs',
        'total',
    ];

    //** Modelos Entidad-Relación */

    // Relacion uno a muchos Operación->Detalles
    public function OperationDetails()
    {
        return $this->hasMany(OperationDetail::class);
    }

    // Relación uno a muchos Operación->Productos a traves de Detalles
    public function Products()
    {
        return $this->hasManyThrough(Products::class, OperationDetails::class);
    }

    /** Fin de los Modelos Entidad-Relación */
}

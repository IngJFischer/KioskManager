<?php

namespace App\Http\Controllers\api;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\PutRequest;

class StockController extends Controller
{
    /** Devuelve el Stock de un determinado producto */
    public function getStock(Stock $stock)
    {
        //Esta función debería devolver el stock de un producto dado el id de producto y no de stock
        return response()->json($stock, 200);
    }

    /** Estableceel Stock de un determinado producto */
    public function setStock(PutRequest $request, Stock $stock)
    {
        
    }

    /** Modifica el Stock de un determinado producto verificando la disponibilidad del mismo*/
    public function modifyStock(Request $request, Stock $stock)
    {
        //Esta función debería llamar a checkAvailability para comprobar la disponibilidad.
    }

    /** Comprueba la disponibilidad de un producto según la cantidad solicitada */
    private function checkAvalability(Stock $stock, $Quantity)
    {
        //Esta función debería comprobar que el Stock del producto sea mayor al stock solicitado
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\PutRequest;
use Illuminate\Foundation\Http\FormRequest;

class StockController extends Controller
{
    /*Debido al enrutamiento y a la estructura de base de datos empleada
    todos los métodos de esta clase devuelven datos según el id de producto.*/

    /** Devuelve el Stock de un determinado producto */
    public function getStock(Stock $stock)
    {
        return response()->json($stock, 200);
    }

    /** Estableceel Stock de un determinado producto */
    public function setStock(PutRequest $request, Stock $stock)
    {
        $stock -> update($request->validated());
        return response()->json($stock, 200);
    }

    /** Modifica el Stock de un determinado producto verificando la disponibilidad del mismo*/
    public function modifyStock(Request $request, Stock $stock)
    {
        $validated = $request->validate(['quantity' => 'required|numeric']);
        
        $available = $stock->quantity;
        $remanent = $available + $validated['quantity'];

        if ($remanent>0)
        {
            //Hacer la modificación del stock.
        }
        else
        {
            //Modificar como mandar el error de forma coherente con el resto de errores
            return response()->json('No hay stock suficiente', 400);
        }
    }

    /** Comprueba la disponibilidad de un producto según la cantidad solicitada */
    private function checkAvalability(Stock $stock, $quantity)
    {
        $available = $stock->quantity;
        $availableQuantity = $available + $quantity;

        if ($availableQuantity >= 0)
        {
            return $availableQuantity;
        }
        else
        {
            return false;
        }
    }

}

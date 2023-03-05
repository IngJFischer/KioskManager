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
        //return response()->json($request->getContent());
        $stock -> update($request->validated());
        return response()->json($stock, 200);
    }

    /** Modifica el Stock de un determinado producto verificando la disponibilidad del mismo*/
    public function modifyStock(Request $request, Stock $stock)
    {
        //Validamos el request
        $validated = $request->validate(['quantity' => 'required|numeric']);
        
        if ($stock->checkStock($validated['quantity']))
        {
            //Si hay stock suficiente, seteamos el Stock en la cantidad resultante
            $data = ['product_id' => $stock->getRouteKey(),
                    'quantity' => $stock->quantity + $validated['quantity']];
            $stock -> update($data);
            return response()->json($stock, 200);
        }
        else
        {
            //Si no hay stock suficiente, devolvemos el mensaje correspondiente
            return response()->json('No hay stock suficiente', 400);
        }
    }

    /** Comprueba la disponibilidad de un producto según la cantidad solicitada */
    public function checkStock(Request $request, Stock $stock)
    {
        $validated = $request->validate(['quantity' => 'required|numeric|min:0']);
        return response()->json($stock->checkStock($validated['quantity']), 200);
        /*if ($validated['quantity'] > $stock->quantity)
        {
            return response()->json(false, 200);
        }
        else
        {
            return response()->json(true, 200);
        }*/
    }

}

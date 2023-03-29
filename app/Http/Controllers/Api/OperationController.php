<?php

namespace App\Http\Controllers\Api;

use Throwable;

use App\Models\Operation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operation\StoreRequest;

class OperationController extends Controller
{
    /** Devuelve un listado de las operaciones realizadas
     *  Si  Si la solucitud posee un encabezado indicando el parametro 'paginate'
     *  devolvera los resultados paginados según las cantidades indicadas en dicho valor.
     *  Si el parámetro 'paginate' no fue enviado, devolverá todas las operaciones.
    */
    public function index(Request $request)
    {
        //Revisar comentarios de funcionamiento en controlador del proveedor
        if ($request->hasHeader('paginate'))
        {
            try {
                $data = Operation::paginate($request->header('paginate'));
            } catch (Throwable $error) {
                return response()->json('Error durante la paginación', 400);
            }
        } 
        else 
        {
            $data = Operation::get()->all();            
        }
        return response()->json($data, 200);
    }

    /** */
    public function show(Operation $operation)
    {
        return response()->json($operation, 200);
    }


    /**  */
    public function store(StoreRequest $request)
    {
        //
    }


    /** */
    public function update(Request $request, Operation $operation)
    {
        //
    }

    /** */
    public function destroy(Operation $operation)
    {
        //
    }
}

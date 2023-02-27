<?php

namespace App\Http\Controllers\Api;

use Throwable;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\PutRequest;
use App\Http\Requests\Provider\StoreRequest;

class ProviderController extends Controller
{
 
    /**
     * Devuelve un listado de todos los proveedores.
     * Si la solucitud posee un encabezado indicando el parametro 'paginate'
     * devolvera los resultados paginados según las cantidades indicadas en dicho valor.
     * Si el parámetro 'paginate' no fue enviado, devolverá todos los proveedores.
    */
    public function index(Request $request)
    {
        //Chequeamos que se haya enviado el valor 'paginate' en el encabezado del request.
        if ($request->hasHeader('paginate'))
        {
            try {
                $data = Provider::paginate($request->header('paginate'));
                return response()->json($data,200);
            } catch (Throwable $error) {
                return response()->json('Parametro de paginación incorrecto', 400);
            }
        }
        //Si no, devolvemos todos los proveedores.
        else
        {
            $data = Provider::get()->all();
            return response()->json($data, 200);
        }
    }

    /**
     * Devuelve un listado de todos los productos de un determinado proveedor.
     * Si el encabezado del request posee el valor 'paginate' los devuelve paginados,
     * al igual que en la función index.
    */
    public function getProducts(Request $request, Provider $provider)
    {
        
        //Chequeamos que se haya enviado el valor 'paginate' en el encabezado del request.
        if ($request->hasHeader('paginate'))
        {
            try {
                $products = Product::with('provider')
                ->where('provider_id', $provider->id)
                ->paginate($request->header('paginate'));
                return response()->json($products, 200);            
            } catch (Throwable $error) {
                return response()->json('Parametro de paginación incorrecto', 400);
            }
        }
        //Si no, devolvemos todos los productos.
        else
        {
            $products = Product::with/*Por el momento usamos las mismas reglas de validación
            ya que se trata de un controlador simple.*/('provider')
            ->where('provider_id', $provider->id)
            ->get();
            return response()->json($products, 200);            
        }
    }

    /**Devuelve los datos de un proveedor */
    public function show(Provider $provider)
    {
        return response()->json($provider, 200);
    }

    /**Almacena un nuevo proveedor*/
    public function store(StoreRequest $request)
    {
        return response()->json(Provider::create($request->all()));
    }

    /**Actualiza los datos de un proveedor */
    public function update(PutRequest $request, Provider $provider)
    {
        $provider->update($request->validated());
        return response()->json($provider, 200);
    }

    /**Eliminamos un proveedor */
    public function destroy(Provider $provider)
    {
        /*Debido a la forma en que declaramos la clave foranea en Products
        la eliminación de un proveedor eliminará todos sus productos tambien,
        y a raíz de esto, tambien eliminaremos el stock*/
        $provider->delete();
        return response()->json('Proveedor Eliminado', 200);
    }
}

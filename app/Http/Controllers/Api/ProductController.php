<?php

namespace App\Http\Controllers\Api;

use Throwable;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\PutRequest;
use App\Http\Requests\Product\StoreRequest;

class ProductController extends Controller
{
    /**
     * Devuelve un listado de todos los productos con los datos de su proveedor y los datos de stock.
     * Si la solucitud posee un encabezado indicando el parametro 'paginate'
     * devolvera los resultados paginados según las cantidades indicadas en dicho valor.
     * Si el parámetro 'paginate' no fue enviado, devolverá todos los proveedores.
    */
    public function index(Request $request)
    {
        //Revisar comentarios de funcionamiento en controlador del proveedor
        if ($request->hasHeader('paginate'))
        {
            try {
                $data = Product::with('provider')->with('stock')->paginate($request->header('paginate'));
            } catch (Throwable $error) {
                return response()->json('Error durante la paginación', 400);
            }
        } 
        else 
        {
            $data = Product::with('provider')->with('stock')->get()->all();            
        }
        return response()->json($data, 200);
    }

    /**Almacena un nuevo producto */
    public function store(StoreRequest $request)
    {
        //Al crear un nuevo producto, inicializamos su stock en 0.
        try {
            //Por ahora utilizamos $request->all(), deberíamos analizar especificamente cada item por cuestiones de seguridad
            $id = Product::create($request->all())->id;
            $stock = [
                'product_id' => $id,
                'quantity' => 0,
            ];
            //return response()->json($stock, 200);
            Stock::create($stock);
            return response()->json(Product::where('id', $id)->get(), 200);
        } catch (Throwable $error) {
            return response()->json('Error en la creación del producto', 400);
        }
    }

    /** Muestra los datos de un producto */
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    /** Actualiza los datos de un producto */
    public function update(PutRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product, 200);
    }

    /** Elimina un producto */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('Producto Eliminado', 200);
    }
    
}

<?php

namespace App\Http\Controllers\Api;

use Throwable;

use App\Models\Operation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operation\StoreRequest;

class OperationController extends Controller
{
    /** Devuelve un listado de las operaciones realizadas*/
    public function index(Request $request)
    {
        //
    }


    /**  */
    public function store(StoreRequest $request)
    {
        //
    }

    /** */
    public function show(Operation $operation)
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

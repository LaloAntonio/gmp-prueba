<?php

namespace App\Http\Controllers;

use App\Exports\ProductosExport;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProducto(Request $request)
    {
        
        $seachProducto = Producto::where('clave','=',$request->claveProducto)->first();
        if ($seachProducto != null) {
              $response = array(
                    'status' => 'finded',
                );
        }else {
              $response = array(
                    'status' => 'not_finded',
                );
        }
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $productos = $request->input('productos');
            foreach ($productos as $producto) {
              
              $nuevo_producto = new Producto();
              $nuevo_producto->clave        =$producto['clave'];
              $nuevo_producto->categoria    =$producto['categoria'];
              $nuevo_producto->producto     =$producto['producto'];
              $nuevo_producto->precio       =$producto['precio'];

              $nuevo_producto->save(); 
            }
            $response = array(
                'status' => 'success',
                'message' => 'Productos Guardados'
            );
        } catch (Exception $e) {
            $response = array(
                'status' => 'failed',
                'message' => $e->getMessage()
            );
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');   //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}

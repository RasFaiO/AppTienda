<?php

namespace App\Http\Controllers;

use App\Http\Requests\VentaRequest;
use App\Models\Articulo;
use App\Models\DetalleVenta;
use App\Models\Persona;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            $query = $request->get('searchText');
            $ventas = Venta::with('cliente')
            ->with('detalleVentas')
            ->where('num_comprobante','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(5);
        }
        return view('ventas.venta.index',[
            'searchText' => $query,
            'ventas' => $ventas
        ]);
    }

    public function create()
    {
        $personas = Persona::where('tipo_persona','Cliente')->get();
        $articulos = Articulo::with('detalle_ingresos')
        ->where('estado','Activo')
        ->where('stock','>',0)
        ->get();

        foreach ($articulos as $columna) {
            foreach ($columna->detalle_ingresos as $detalle) {
                foreach ($detalle as $det){
                    $avg = $detalle->precio_venta;
                }
                $subtotal =  $columna->precio_promedio += $avg;
            }
            $cantidad = count($columna->detalle_ingresos);
            $columna->precio_promedio = $subtotal / $cantidad;
        }
        return view('ventas.venta.create',[
            'personas' => $personas,
            'articulos' => $articulos
        ]);
    }

    public function store(VentaRequest $request)
    {
        //
        try {
            DB::beginTransaction();
            $venta = new Venta();
            $venta->cliente_id = $request->cliente_id;
            $venta->tipo_comprobante = $request->tipo_comprobante;
            $venta->serie_comprobante = $request->serie_comprobante;
            $venta->num_comprobante = $request->num_comprobante;
            $venta->impuesto = '19';
            $venta->total_venta = $request->total_venta;
            $venta->estado = 'Activo';
            $venta->save();

            $articulo_id = $request->articulo_id;
            $cantidad = $request->cantidad;
            $precio_venta = $request->precio_venta;
            $descuento = $request->descuento;
            
            $contador = 0;
            while ($contador < count($articulo_id)) {
                // tabla en DB detalle_ingreso
                // Estamos implementando observer, así que si creamos un registro en DetalleIngreso con $detalle lo estamos pasando a DetallesObserver para actualizar el valor del stock del articulo
                $detalle = DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'articulo_id' => $articulo_id[$contador],
                    'cantidad' => $cantidad[$contador],
                    'precio_venta' => $precio_venta[$contador],
                    'descuento' => $descuento[$contador]
                ]);

                $contador++;
            }
            // Enviamos un commit para la transacción
            DB::commit();
        } catch (\Exception $e) {
            // En caso de que haya algún error, anula la transacción
            DB::rollBack();
        }
        return to_route('venta.index')->with('status','created');
    }

    public function show(String $id)
    {
        //
        $venta = Venta::with('cliente')
        ->with('detalleVentas')
        ->where('id',$id)->get();

        $detalles = DetalleVenta::with('articulos')
        ->where('venta_id',$id)->get();

        foreach ($detalles as $detalle) {
            $detalle->subtotal = ($detalle->cantidad * $detalle->precio_venta) - $detalle->descuento;
        }
        return 
        // $detalles;
        view('ventas.venta.show',[
            'ingreso' => $venta,
            'detalles' => $detalles
        ]);
    }

    public function destroy(String $id)
    {
        //
        $venta = Venta::with('detalleVentas')->where('id',$id)->get();
        foreach ($venta as $columna) {
            foreach ($columna->detalleVentas as $detalle) {
                $articulo_id = $detalle->articulo_id;
                $cantidad = $detalle->cantidad;
                $articulo = Articulo::findOrFail($articulo_id);
                $articulo->stock = $articulo->stock + $cantidad;
                $articulo->update();
            }
        }

        $upVenta = Venta::findOrFail($id);
        $upVenta->estado = 'Cancelado';
        $upVenta->update();
        return to_route('venta.index')->with('status','canceled');
    }
}

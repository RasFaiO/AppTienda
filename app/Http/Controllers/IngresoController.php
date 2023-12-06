<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresoRequest;
use App\Models\Articulo;
use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

// Por medio de este controlador vamos a estar cargando los ingresos a la DB y luego a travéz de un array cargamos todos sus detalles
class IngresoController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request) {
            
            // DB::table('ingresos as i')
            // ->join('personas as p','i.id_proveedor','=','p.id')
            // ->join('detalle_ingresos as di','i.id','=','di.id_ingreso')
            // ->select(
                //     'i.id',
                //     'i.created_at',
                //     'i.updated_at',
                //     'p.nombre',
                //     'i.tipo_comprobante',
                //     'i.serie_comprobante',
                //     'i.num_comprobante',
                //     'i.impuesto',
                //     'i.estado',
                //     'di.cantidad',
                //     'di.precio_compra',
                //     DB::raw('sum(di.cantidad*precio_compra) as total')
            //     )
            // ->where('i.num_comprobante','LIKE','%'.$query.'%')
            // ->orderBy('id','desc')
            // ->groupBy(
                //     'i.id',
                //     'i.created_at',
                //     'i.updated_at',
                //     'p.nombre',
                //     'i.tipo_comprobante',
                //     'i.serie_comprobante',
                //     'i.num_comprobante',
                //     'i.impuesto',
                //     'i.estado',
                //     'di.cantidad',
                //     'di.precio_compra'
                // )
                // ->paginate(5);
                
            $query = $request->get('searchText');
            $ingresos = Ingreso::with('persona')
            ->with('detalle_ingresos')
            ->where('num_comprobante','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(5);
            foreach ($ingresos as $ingreso) {
                $ingreso->totalizado = 0;
                foreach ($ingreso->detalle_ingresos as $detalle) {
                    $detalle->total = 0;
                    foreach ($detalle as $detail){
                        $detalle->total = $detalle->cantidad * $detalle->precio_compra;
                    };
                    $ingreso->totalizado += $detalle->total;
                }
            }
        }
        return
        view('compras.ingreso.index',[
            'searchText' => $query,
            'ingresos' => $ingresos
        ]);
    }

    public function create()
    {
        //
        $personas = Persona::where('tipo_persona','Proveedor')->get();
        $articulos = Articulo::
        // select(DB::raw('CONCAT(codigo," ",nombre) AS articulo'),'id_articulo')
        where('estado','Activo')
        ->get();
        return view('compras.ingreso.create',[
            'personas' => $personas,
            'articulos' => $articulos
        ]);
    }

    public function store(IngresoRequest $request)
    {
        //
        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->id_proveedor = $request->id_proveedor;
            $ingreso->tipo_comprobante = $request->tipo_comprobante;
            $ingreso->serie_comprobante = $request->serie_comprobante;
            $ingreso->num_comprobante = $request->num_comprobante;
            $ingreso->impuesto = '19';
            $ingreso->estado = 'Activo';
            $ingreso->save();

            $id_articulo = $request->id_articulo;
            $cantidad = $request->cantidad;
            $precio_compra = $request->precio_compra;
            $precio_venta = $request->precio_venta;
            
            $contador = 0;
            while ($contador < count($id_articulo)) {
                // tabla en DB detalle_ingreso
                // Estamos implementando observer, así que si creamos un registro en DetalleIngreso con $detalle lo estamos pasando a DetallesObserver para actualizar el valor del stock del articulo
                $detalle = DetalleIngreso::create([
                    'id_ingreso' => $ingreso->id,
                    'id_articulo' => $id_articulo[$contador],
                    'cantidad' => $cantidad[$contador],
                    'precio_compra' => $precio_compra[$contador],
                    'precio_venta' => $precio_venta[$contador]
                ]);

                $contador++;
            }
            // Enviamos un commit para la transacción
            DB::commit();
        } catch (\Exception $e) {
            // En caso de que haya algún error, anula la transacción
            DB::rollBack();
        }
        return to_route('tienda.ingreso')->with('status','created');
    }

    public function show(String $id)
    {
        //
        $ingreso = Ingreso::with('persona')
        ->with('detalle_ingresos')
        ->where('id',$id)->get();

        $detalles = DetalleIngreso::with('articulos')
        ->where('id_ingreso',$id)->get();
        
        foreach ($ingreso as $columna) {
            $columna->total = 0;
            foreach ($columna->detalle_ingresos as $detalle) {
                $detalle->subtotal = 0;
                foreach ($detalle as $sub) {
                    $detalle->subtotal = $detalle->cantidad * $detalle->precio_compra;
                }
                $columna->total += $detalle->subtotal;
            }
        }
        return view('compras.ingreso.show',[
            'ingreso' => $ingreso,
            'detalles' => $detalles
        ]);
    }

    public function destroy(String $id)
    {
        //
        $ingreso = Ingreso::with('detalle_ingresos')->where('id',$id)->get();

        foreach ($ingreso as $columna) {
            foreach ($columna->detalle_ingresos as $detalle) {
                $id_articulo = $detalle->id_articulo;
                $cantidad = $detalle->cantidad;
                $articulo = Articulo::findOrFail($id_articulo);
                $articulo->stock = $articulo->stock - $cantidad;
                $articulo->update();
            }
        }

        $upIngreso = Ingreso::findOrFail($id);
        $upIngreso->estado = 'Cancelado';
        $upIngreso->update();
        return to_route('tienda.ingreso')->with('status','canceled');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresoRequest;
use App\Models\Articulo;
use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Store a newly created resource in storage.
     */
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
                $detalle = new DetalleIngreso;
                $detalle->id_ingreso = $ingreso->id;
                $detalle->id_articulo = $id_articulo[$contador];
                $detalle->cantidad = $cantidad[$contador];
                $detalle->precio_compra = $precio_compra[$contador];
                $detalle->precio_venta = $precio_venta[$contador];
                $detalle->save();

                $contador = $contador+1;
            }
            // Enviamos un commit para la transacción
            DB::commit();
        } catch (\Exception $e) {
            // En caso de que haya algún error, anula la transacción
            DB::rollBack();
        }
        
        return to_route('tienda.ingreso')->with('status','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $ingreso = Ingreso::with('personas')
        ->with('detalle_ingresos')
        ->select(DB::raw('sum(cantidad*precio_compra) AS total'))
        ->where('id_ingreso',$request->id)
        ->first();

        $detalles = DetalleIngreso::with('articulo')
        ->where('id_ingreso',$request->id)->get();

        return view('compras.ingreso.show',[
            'ingreso' => $ingreso,
            'detalles' => $detalles
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ingreso = Ingreso::findOrFail($id)->get();
        $ingreso->estado = 'Cancelado';
        $ingreso->update();
        return to_route('ingreso.index')->with('state','canceled');
    }
}

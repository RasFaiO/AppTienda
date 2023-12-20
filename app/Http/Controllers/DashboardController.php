<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\DetalleVenta;
use App\Models\Ingreso;
use App\Models\Venta;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Index
    public function index(){
        return view('welcome');
    }
    // Dashboard
    public function dashboard(){
        // compras
        $compras = Ingreso::where('estado','Activo')->get();        
        $ene = $feb = $mar = $abr = $may = $jun = $jul = $ago = $sep = $oct = $nov = $dic = 0;
        $purc = [];
        foreach ($compras as $compra) {
            $mesCompra = $compra->created_at;
            $mesCompra = Carbon::create($mesCompra)->month;
            if ($mesCompra == 1) {
                $ene++;
            } else {
                if ($mesCompra == 2) {
                    $feb++;
                } else {
                    if ($mesCompra == 3){
                        $mar++;
                    } else {
                        if ($mesCompra == 4){
                            $abr++;
                        } else {
                            if ($mesCompra == 5){
                                $may++;
                            } else {
                                if ($mesCompra == 6){
                                    $jun++;
                                } else {
                                    if ($mesCompra == 7){
                                        $jul++;
                                    } else {
                                        if ($mesCompra == 8){
                                            $ago++;
                                        } else {
                                            if ($mesCompra == 9){
                                                $sep++;
                                            } else {
                                                if ($mesCompra == 10){
                                                    $oct++;
                                                } else {
                                                    if ($mesCompra == 11){
                                                        $nov++;
                                                    } else {
                                                        $dic++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $purc['compras'][] = $ene;
        $purc['compras'][] = $feb;
        $purc['compras'][] = $mar;
        $purc['compras'][] = $abr;
        $purc['compras'][] = $may;
        $purc['compras'][] = $jun;
        $purc['compras'][] = $jul;
        $purc['compras'][] = $ago;
        $purc['compras'][] = $sep;
        $purc['compras'][] = $oct;
        $purc['compras'][] = $nov;
        $purc['compras'][] = $dic;
        $purc['purc'] = json_encode($purc);

        // Ventas
        $ventas = Venta::where('estado','Activo')->get();
        $ene = $feb = $mar = $abr = $may = $jun = $jul = $ago = $sep = $oct = $nov = $dic = 0;
        $sell = [];
        foreach ($ventas as $venta) {
            $mesVenta = $venta->created_at;
            $mesVenta = Carbon::create($mesVenta)->month;
            if ($mesVenta == 1) {
                $ene++;
            } else {
                if ($mesVenta == 2) {
                    $feb++;
                } else {
                    if ($mesVenta == 3){
                        $mar++;
                    } else {
                        if ($mesVenta == 4){
                            $abr++;
                        } else {
                            if ($mesVenta == 5){
                                $may++;
                            } else {
                                if ($mesVenta == 6){
                                    $jun++;
                                } else {
                                    if ($mesVenta == 7){
                                        $jul++;
                                    } else {
                                        if ($mesVenta == 8){
                                            $ago++;
                                        } else {
                                            if ($mesVenta == 9){
                                                $sep++;
                                            } else {
                                                if ($mesVenta == 10){
                                                    $oct++;
                                                } else {
                                                    if ($mesVenta == 11){
                                                        $nov++;
                                                    } else {
                                                        $dic++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $sell['ventas'][] = $ene;
        $sell['ventas'][] = $feb;
        $sell['ventas'][] = $mar;
        $sell['ventas'][] = $abr;
        $sell['ventas'][] = $may;
        $sell['ventas'][] = $jun;
        $sell['ventas'][] = $jul;
        $sell['ventas'][] = $ago;
        $sell['ventas'][] = $sep;
        $sell['ventas'][] = $oct;
        $sell['ventas'][] = $nov;
        $sell['ventas'][] = $dic;
        $sell['sell'] = json_encode($sell);

        // Articulos
        $articulos = Articulo::with('detalleVentas')->get();
        $article = [];
        foreach ($articulos as $articulo) {
            $articulo->cantidadesVendidas = 0;
            $subtotal = 0;
            foreach ($articulo->detalleVentas as $venta) {
                $cantidad = $venta->cantidad;
                $subtotal = $subtotal+$cantidad;
            }
            $articulo->cantidadesVendidas = $subtotal;
            $article['articulos'][] = [
                'nombre' => $articulo->nombre,
                'cantidad' => $articulo->cantidadesVendidas
            ];
        }
        $article['article'] = json_encode($article);

        // Ventas Diarias
        $lastDays = Carbon::today()->sub(15,'days');
        $ventDiarias = Venta::where('estado','Activo')
        ->where('created_at','>=',$lastDays)
        ->get();
        $contDias = 0;
        $dia = [];
        foreach ($ventDiarias as $vDia) {
            $vDia->ultimos15 = 0;
            $fechaVenta = $vDia->created_at; // 19-12-2023
            $diaVenta = Carbon::create($fechaVenta)->day; // 07
            $currentDia15 = Carbon::create($lastDays)->day; // 04
            if ($diaVenta != $currentDia15){
                $contDias = $diaVenta-$currentDia15;  // 07 - 04 = 03
            }
            $vDia->ultimos15 = $contDias; // 03
            $dia['data'][] = [
                'dia' => $contDias,
                'fechaVenta' => Carbon::create($fechaVenta)->isoFormat('D/M/Y')
            ];
            
        }
        $dia['data'] = json_encode($dia);
        // return $dia;
        // $dia['labels'][] = $lastDays;
        

        return view('dashboard', [
            'article' => $article['article'],
            'sell' => $sell['sell'],
            'purc' => $purc['purc'],
            'day' => $dia['data']
        ]);
    }
}

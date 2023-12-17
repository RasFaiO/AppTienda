<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\DetalleVenta;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
// Index
public function index(){
    return view('welcome');
}
    // Dashboard
    public function dashboard(){
        // Ventas
        $ventas = Venta::where('estado','Activo')->get();
        $ene = $feb = $mar = $abr = $may = $jun = $jul = $ago = $sep = $oct = $nov = $dic = 0;
        $sell = [];
        foreach ($ventas as $venta) {
            $mesVenta = $venta->created_at;
            $mesVenta = Carbon::create($mesVenta)->month;
            if ($mesVenta == 1) {
                $ene = $ene+1;
            } else {
                if ($mesVenta == 2) {
                    $feb = $feb+1;
                } else {
                    if ($mesVenta == 3){
                        $mar = $mar+1;
                    } else {
                        if ($mesVenta == 4){
                            $abr = $abr+1;
                        } else {
                            if ($mesVenta == 5){
                                $may = $may+1;
                            } else {
                                if ($mesVenta == 6){
                                    $jun = $jun+1;
                                } else {
                                    if ($mesVenta == 7){
                                        $jul = $jul+1;
                                    } else {
                                        if ($mesVenta == 8){
                                            $ago = $ago+1;
                                        } else {
                                            if ($mesVenta == 9){
                                                $sep = $sep+1;
                                            } else {
                                                if ($mesVenta == 10){
                                                    $oct = $oct+1;
                                                } else {
                                                    if ($mesVenta == 11){
                                                        $nov = $nov+1;
                                                    } else {
                                                        $dic = $dic+1;
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
        // return  $sell;

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
        return view('dashboard', [
            'article' => $article['article'],
            'sell' => $sell['sell']
        ]);
    }
    //

}

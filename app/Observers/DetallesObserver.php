<?php

namespace App\Observers;

use App\Models\DetalleIngreso;
use App\Models\Articulo;

class DetallesObserver
{
    /**
     * Handle the DetalleIngreso "created" event.
     */
    public function created(DetalleIngreso $detalle): void
    {   
        // Para implementar este DetallesObserver tenemos que pasarlo en la configuración del EventServiceProvider en la carpeta Providers
        $totalStock = 0;
        $articulo = Articulo::findOrFail($detalle->id_articulo);
        $stock = $articulo->stock;
        $totalStock = $stock + $detalle->cantidad;
        $articulo->stock = $totalStock;
        $articulo->update();
    }

    /**
     * Handle the DetalleIngreso "updated" event.
     */
    public function updated(DetalleIngreso $detalleIngreso): void
    {
        //
    }

    /**
     * Handle the DetalleIngreso "deleted" event.
     */
    public function deleted(DetalleIngreso $detalleIngreso): void
    {
        //
    }

    /**
     * Handle the DetalleIngreso "restored" event.
     */
    public function restored(DetalleIngreso $detalleIngreso): void
    {
        //
    }

    /**
     * Handle the DetalleIngreso "force deleted" event.
     */
    public function forceDeleted(DetalleIngreso $detalleIngreso): void
    {
        //
    }
}

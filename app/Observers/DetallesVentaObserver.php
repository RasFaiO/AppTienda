<?php

namespace App\Observers;

use App\Models\Articulo;
use App\Models\DetalleVenta;

class DetallesVentaObserver
{
    /**
     * Handle the DetalleVenta "created" event.
     */
    public function created(DetalleVenta $detalleVenta): void
    {
        // Para implementar este DetallesObserver tenemos que pasarlo en la configuración del EventServiceProvider en la carpeta Providers
        $totalStock = 0;
        $articulo = Articulo::findOrFail($detalleVenta->articulo_id);
        $stock = $articulo->stock;
        $totalStock = $stock - $detalleVenta->cantidad;
        $articulo->stock = $totalStock;
        $articulo->update();
    }

    /**
     * Handle the DetalleVenta "updated" event.
     */
    public function updated(DetalleVenta $detalleVenta): void
    {
        //
    }

    /**
     * Handle the DetalleVenta "deleted" event.
     */
    public function deleted(DetalleVenta $detalleVenta): void
    {
        //
    }

    /**
     * Handle the DetalleVenta "restored" event.
     */
    public function restored(DetalleVenta $detalleVenta): void
    {
        //
    }

    /**
     * Handle the DetalleVenta "force deleted" event.
     */
    public function forceDeleted(DetalleVenta $detalleVenta): void
    {
        //
    }
}

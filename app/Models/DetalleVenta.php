<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'venta_id',
        'articulo_id',
        'cantidad',
        'precio_venta',
        'descuento'
    ];

    public function venta(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Venta::class,'venta_id');
    }
    public function articulos(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Articulo::class,'articulo_id');
    }
}

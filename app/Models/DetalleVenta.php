<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function venta(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Venta::class);
    }
    public function articulos(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsToMany(Articulo::class);
    }
}

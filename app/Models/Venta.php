<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cliente(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Persona::class);
    }
    public function detalleVentas(){
        return $this->hasMany(DetalleVenta::class);
    }
}

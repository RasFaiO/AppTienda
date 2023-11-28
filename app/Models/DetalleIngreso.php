<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function articulos(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsToMany(Articulo::class);
    } 
    public function ingreso(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Ingreso::class);
    }
    
}

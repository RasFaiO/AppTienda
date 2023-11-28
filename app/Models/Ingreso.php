<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    private $guarded = [];

    public function detalleIngresos(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsToMany(DetalleIngreso::class);
    }
    public function persona(){
        return $this->hasOne(Persona::class); 
    }
}

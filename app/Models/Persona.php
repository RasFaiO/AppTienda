<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'categorias_id',
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];
    
    public function ingresos(){
        return $this->hasMany(Ingreso::class);
    }
    public function ventas(){
        return $this->hasMany(Venta::class);
    }
}

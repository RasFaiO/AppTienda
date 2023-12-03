<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    
    // public function ingresos(): HasMany{
    //     return $this->hasMany(Ingreso::class,'id_proveedor');
    // }
    public function ventas(): HasMany{
        return $this->hasMany(Venta::class);
    }
}

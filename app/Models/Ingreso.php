<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ingreso extends Model
{
    // Un ingreso tiene muchos detalles de ingreso?**
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'id_proveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'created_at',
        'impuesto',
        'estado'
    ];

    public function persona(): BelongsTo{
        return $this->belongsTo(Persona::class,'id_proveedor'); 
    }
    public function detalle_ingresos(){
        // Un ingreso pertenece muchos detalle de ingreso
        return $this->hasMany(DetalleIngreso::class,'id_ingreso');
    }
}

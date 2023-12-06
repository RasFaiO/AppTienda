<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DetalleIngreso extends Model
{
    // DetalleIngreso tiene las fk de articulo e ingreso!!
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'id_ingreso',
        'id_articulo',
        'cantidad',
        'precio_compra',
        'precio_venta',
        'created_at'
    ];

    public function articulos(): BelongsTo{
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Articulo::class,'id_articulo');
    } 
    public function ingresos(): BelongsTo{
        // un detalle de ingreso tiene un ingreso
        return $this->belongsTo(Ingreso::class,'id_ingreso');
    }
    
}

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

    public function articulos(): BelongsToMany{
        // Contiene la llave foranea, es belongsTo
        return $this->belongsToMany(Articulo::class);
    } 
    public function ingresos(): BelongsTo{
        // un detalle de ingreso tiene un ingreso
        return $this->belongsTo(Ingreso::class,'id_ingreso');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'cliente_id',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'impuesto',
        'total_venta',
        'estado'
    ];

    public function cliente(){
        // Contiene la llave foranea, es belongsTo
        return $this->belongsTo(Persona::class,'cliente_id');
    }
    public function detalleVentas(){
        return $this->hasMany(DetalleVenta::class,'venta_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Articulo extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'categorias_id',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'image_uri',
        'estado'
    ];

    public function categorias(): BelongsTo{
        // Contiene la llave foranea, es belongsTo
        // El modelo Articulo pertenece a una categoría 
        return $this->belongsTo(Categoria::class);
    }
    // belongsToMany?
    public function detalle_ingresos(): HasMany{
        return $this->hasMany(DetalleIngreso::class,'id_articulo');
    }
    public function detalleVentas(): HasMany{
        return $this->hasMany(DetalleVenta::class,'articulo_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Categoria extends Model
{
    use HasFactory;
    // $guarded[], $casts[], $table[], $hidden[]
    protected $fillable = [
        'nombre',
        'descripcion',
        'condicion'
    ];

    public function articulo(): HasMany{
        // Una Categoría tiene muchos Artículos
        return $this->hasMany(Articulo::class);
    }
}

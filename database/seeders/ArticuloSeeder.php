<?php

namespace Database\Seeders;

use App\Models\Articulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $articulo = Articulo::create([
            'categorias_id' => 1,
            'codigo' => '1234',
            'nombre' => 'Ejemplo',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'activo'
        ]);
        $articulo = Articulo::create([
            'categorias_id' => 2,
            'codigo' => '2345',
            'nombre' => 'Ejemplo dos',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'activo'
        ]);
        $articulo = Articulo::create([
            'categorias_id' => 3,
            'codigo' => '3456',
            'nombre' => 'Ejemplo tres',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'activo'
        ]);
        $articulo = Articulo::create([
            'categorias_id' => 4,
            'codigo' => '4567',
            'nombre' => 'Ejemplo cuatro',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'activo'
        ]);
    }
}

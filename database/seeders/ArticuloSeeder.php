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
            'codigo' => 'AAA111',
            'nombre' => 'Resma de Papel Carta',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'Activo'
        ]);
        $articulo = Articulo::create([
            'categorias_id' => 2,
            'codigo' => 'AAA112',
            'nombre' => 'Resma de Papel Oficio',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'Activo'
        ]);
        $articulo = Articulo::create([
            'categorias_id' => 3,
            'codigo' => 'AAA113',
            'nombre' => 'Resma Papel Reciclable',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'Activo'
        ]);
        $articulo = Articulo::create([
            'categorias_id' => 4,
            'codigo' => 'AAA114',
            'nombre' => 'Cuadernos',
            'stock' => '1',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste,',
            'image_uri' => 'notiene',
            'estado' => 'Activo'
        ]);
    }
}

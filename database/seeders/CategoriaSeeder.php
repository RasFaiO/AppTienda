<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categoria = Categoria::create([
          'nombre' => 'Equipos de computo',
          'descripcion' => 'Accesorios de cómputo',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Útiles',
          'descripcion' => 'Útiles',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Limpieza',
          'descripcion' => 'Artículos de limpieza',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Medicina',
          'descripcion' => 'Artículos medicinales',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Liquidos',
          'descripcion' => 'Líquidos',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Comida',
          'descripcion' => 'Productos de Comida',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Vestuario',
          'descripcion' => 'Artículos de Vestuario',
          'condicion' => 1  
        ]);
        $categoria = Categoria::create([
          'nombre' => 'Servicios',
          'descripcion' => 'Servicios',
          'condicion' => 1  
        ]);
    }
}

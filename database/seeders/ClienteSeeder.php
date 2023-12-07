<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cliente = Persona::create([
            'tipo_persona' => 'Cliente',
            'nombre' => 'Juan Diaz',
            'tipo_documento' => 'CC',
            'num_documento' => '1111111111',
            'direccion' => 'Calle A # B - 03',
            'telefono' => '3000000000',
            'email' => 'juan@diaz.com',
            'created_at' => '2023-12-06 08:35:51',
            'updated_at' => '2023-12-06 08:35:51'
        ]);
        $cliente = Persona::create([
            'tipo_persona' => 'Cliente',
            'nombre' => 'Manuel Gonzales',
            'tipo_documento' => 'CC',
            'num_documento' => '2222222222',
            'direccion' => 'Calle B # C - 04',
            'telefono' => '3010000000',
            'email' => 'manuel@gonzales.com',
            'created_at' => '2023-12-06 08:35:51',
            'updated_at' => '2023-12-06 08:35:51'
        ]);
        $proveedor = Persona::create([
            'tipo_persona' => 'Proveedor',
            'nombre' => 'Recarcomputo',
            'tipo_documento' => 'NIT',
            'num_documento' => '1111111111',
            'direccion' => 'Calle A # B - 03',
            'telefono' => '3000000000',
            'created_at' => '2023-12-06 08:35:51',
            'updated_at' => '2023-12-06 08:35:51'
        ]);
        $proveedor = Persona::create([
            'tipo_persona' => 'Proveedor',
            'nombre' => 'OklaHoma',
            'tipo_documento' => 'NIT',
            'num_documento' => '2222222222',
            'direccion' => 'Calle B # C - 04',
            'telefono' => '3010000000',
            'created_at' => '2023-12-06 08:35:51',
            'updated_at' => '2023-12-06 08:35:51'
        ]);
    }
}

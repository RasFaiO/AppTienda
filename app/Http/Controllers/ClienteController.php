<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonaRequest;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if ($request){
            $query = $request->get('searchText');
            $personas = Persona::where('tipo_persona','Cliente')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where('tipo_persona','Cliente')
            ->orderBy('id','desc')
            ->paginate(5);
            return view('ventas.cliente.index',[
                'personas' => $personas,
                'searchText' => $query
            ]);
        }
    }

    public function create(Request $request)
    {
        return view('ventas.cliente.create');
    }
    
    public function store(PersonaRequest $request)
    {
        $persona = new Persona;
        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();
        return to_route('persona.cliente')->with('status','created');
    }

    public function show(string $id)
    {
        $persona = Persona::findOrFail($id);
        return view('ventas.cliente.show',[
            'persona' => $persona
        ]);

    }

    public function edit(String $id)
    {
        $persona = Persona::findOrFail($id);
        return view('ventas.cliente.edit',[
            'persona' => $persona
        ]);
    }

    public function update(PersonaRequest $request, string $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->update();

        return to_route('persona.cliente')->with('status','updated');
    }

    public function destroy(string $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Inactivo';
        $persona->update();

        return to_route('persona.cliente')
        ->with('status','deleted');
    }
}

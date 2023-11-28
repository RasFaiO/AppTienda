<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        // Devuelve la vista con los parametros solicitados
        if ($request){
            $query = $request->get('searchText');
            $categorias = Categoria::where('condicion',1)->Where('nombre','LIKE','%'.$query.'%')->orderBy('id','desc')->paginate(3);
            return view('tienda.categoria.index',[
                'categorias' => $categorias,
                'searchText' => $query
            ]);
        }
    }

    public function create()
    {
        // Devuelve la vista de crear
        return view('tienda.categoria.create');
    }


    public function store(Request $request)
    {
        // Almacena en la DB el registro
        $request->input('condicion',1);
        $validar = $request->validate([
            'nombre' => ['required','min:5','max:20'],
            'descripcion' => ['required','min:5'],
            'condicion' => []
        ]);
        Categoria::create($validar);
        return to_route('tienda.categoria.index')
        ->with('status','created');
    }

    public function show(string $id)
    {
        // Muestra la vista de la categoria
        $id = Categoria::findOrFail($id);
        return view('tienda.categoria.show',[
            'categoria' => $id
        ]);
    }

    public function edit(Categoria $categoria)
    {
        // Muestra la vista para editar
        return view('tienda.categoria.edit',[
            'categoria' => $categoria
        ]);
    }

    public function update(Request $request, Categoria $categoria)
    {
        // Actualiza los Datos en la DB, finalmente retorna a la ruta index
        $validar = $request->validate([
            'nombre' => ['required','min:5','max:50'],
            'descripcion' => ['required','min:5'],
            'condicion' => ['boolean']
        ]);
        $categoria->update($validar);
        return to_route('tienda.categoria.index')
        ->with('status','updated');
    }

    public function destroy(Categoria $categoria)
    {
        // Elimina los datos de la DB, en este caso solo actualizamos la condicion a 0
        $categoria->condicion = 0;
        $categoria->update();
        return to_route('tienda.categoria.index')
        ->with('status','deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

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


    public function store(CategoriaRequest $request)
    {
        // Almacena en la DB el registro
        // $request->input('condicion',1);
        // $validar = $request->validate([
        //     'nombre' => ['required','min:5','max:20'],
        //     'descripcion' => ['required','min:5'],
        //     'condicion' => []
        // ]);
        // Categoria::create($validar);
        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = 1;
        $categoria->save();
        return to_route('categoria.index')
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

    public function edit(String $id)
    {
        // Muestra la vista para editar
        $categoria = Categoria::findOrFail($id);
        return view('tienda.categoria.edit',[
            'categoria' => $categoria
        ]);
    }

    public function update(CategoriaRequest $request, String $id)
    {
        // Actualiza los Datos en la DB, finalmente retorna a la ruta index
        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = 1;
        $categoria->update();
        return to_route('categoria.index')
        ->with('status','updated');
    }

    public function destroy(String $id)
    {
        // Elimina los datos de la DB, en este caso solo actualizamos la condicion a 0
        // $categoria->condicion = 0;
        // $categoria->update();
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = 0;
        $categoria->update();

        return to_route('categoria.index')
        ->with('status','deleted');
    }
}

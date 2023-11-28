<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloRequest;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request){
            $query = $request->get('searchText');
            // with() = join
            $articulos = Articulo::with('categorias')
            ->where('estado','activo')
            ->Where('nombre','LIKE','%'.$query.'%')
            ->orWhere('codigo','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(3);
        }
        return view('tienda.articulo.index',[
            'articulos' => $articulos,
            'searchText' => $query
        ]);
    }

    public function create(Request $request)
    {
        //Pasamos las categorias para asignarselas al momento de crear, en este caso le pasamos la condición 1 que es son las categorias que hay habilitadas
        $categorias = Categoria::where('condicion',1)->get();
        return view('tienda.articulo.create',[
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticuloRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('image_uri')){
            
            //Creamos el nombre del archivo
            $fileName = md5(uniqid(rand(),true)).'.jpg';

            // // Movemos el fichero al lugar que necesitamos
            $almacenarImage = $request->file('image_uri')->storeAs('public/images/articulos',$fileName) ;

        }
        // Almacena el nuevo artículo
        $articulo = new Articulo;
        $articulo->categorias_id = $request->categorias_id;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->image_uri = $fileName;
        $articulo->estado = 'Activo';
        $articulo->save();

        // dd( $request->hasFile('image_uri')) ;
        return to_route('tienda.articulo.index')
        ->with('status','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        $categorias = Categoria::where('condicion',$articulo->condicion)->get();
        return view('tienda.articulo.show',[
            'articulo' => $articulo,
            'categorias' => $categorias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        // Muestra la vista para editar
        $categorias = Categoria::where('condicion',1)->get();
        return view('tienda.articulo.edit',[
            'articulo' => $articulo,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticuloRequest $request, Articulo $articulo)
    {
        $fileName = $articulo->image_uri;

        if ($request->hasFile('image_uri')) {    
            $imgActual = $articulo->image_uri;
            // Creamos el nombre de la imagen
            $fileName = md5(uniqid(rand(),true)).'.jpg';
            // Almacenamos la imagen en directorio específico
            $request->file('image_uri')->storeAs('public/images/articulos',$fileName);
            // Borra la imagen actual 
            Storage::delete('public/images/articulos/'.$imgActual);
            
        }
        $article = $articulo;
        $article->nombre = $request->nombre;
        $article->codigo = $request->codigo;
        $article->stock = $request->stock;
        $article->descripcion = $request->descripcion;
        $article->categorias_id = $request->categorias_id;
        $article->image_uri = $fileName;
        $article->update();
        
        // return $articulo->image_uri;
        return to_route('tienda.articulo.index')
        ->with('status','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        $articulo->estado = 'Inactivo';
        $articulo->update();
        return to_route('tienda.articulo.index')
        ->with('status','deleted');
    }
}

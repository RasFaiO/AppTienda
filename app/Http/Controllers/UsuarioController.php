<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request){
            $query = $request->get('searchText');
            $usuarios = User::Where('name','LIKE','%'.$query.'%')->orderBy('id','desc')->paginate(7);
            return view('seguridad.usuario.index',[
                'usuarios' => $usuarios,
                'searchText' => $query
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('seguridad.usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        //
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return to_route('usuario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('seguridad.usuario.edit',[
            'usuario' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, string $id)
    {
        //
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->update();
        return to_route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = User::where('id',$id)->delete();
        return to_route('usuario.index');
    }
}

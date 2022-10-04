<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::simplePaginate(10);

        return response()->json($usuarios); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $usuario = new Usuario;
        // $usuario->nome = $request->input('nome');
        // $usuario->email = $request->input('email');
        // $usuario->password = bcrypt($request->input('password'));
        // $usuario->save();

        $usuario = Usuario::create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json([
            "data" => $usuario
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($usuario)
    {
        $usuario = Usuario::find($usuario);

        if($usuario == null) {
            return response()->json([
                "msg" => "Usuário não encontrado"
            ], 404);
        }

        return response()->json([
            "data" => $usuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsuarioRequest  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->password = bcrypt($request->input('password'));
        $usuario->save();

        return response()->json([
            "data" => $usuario
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        Usuario::destroy($usuario->id);

        return response()->json([
            "msg" => "Usuário " . $usuario->nome . " removido com sucesso"
        ]);
    }
}
 
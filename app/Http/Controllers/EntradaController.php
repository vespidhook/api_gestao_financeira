<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Http\Requests\StoreEntradaRequest;
use App\Http\Requests\UpdateEntradaRequest;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas = Entrada::simplePaginate(10);

        return response()->json($entradas); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEntradaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entrada = Entrada::create([
            'nome' => $request->input('nome'),
            'valor' => $request->input('valor'),
        ]);

        return response()->json([
            "data" => $entrada
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        $entrada = Entrada::find($entrada);

        if($entrada == null) {
            return response()->json([
                "msg" => "Entrada não encontrada"
            ], 404);
        }

        return response()->json([
            "data" => $entrada
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntradaRequest  $request
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrada $entrada)
    {
        $entrada->nome = $request->input('nome');
        $entrada->valor = $request->input('valor');
        $entrada->save();

        return response()->json([
            "data" => $entrada
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        Entrada::destroy($entrada->id);

        return response()->json([
            "msg" => "A entrada " . $entrada->nome . " removido com sucesso"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::simplePaginate(10);

        return response()->json($compras); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compra = Compra::create([
            'nome' => $request->input('nome'),
            'metodo' => $request->input('metodo'),
            'valor' => $request->input('valor'),
        ]);

        return response()->json([
            "data" => $compra
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        $compra = Compra::find($compra);

        if($compra == null) {
            return response()->json([
                "msg" => "Compra não encontrada"
            ], 404);
        }

        return response()->json([
            "data" => $compra
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraRequest  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        $compra->nome = $request->input('nome');
        $compra->metodo = $request->input('metodo');
        $compra->valor = $request->input('valor');
        $compra->save();

        return response()->json([
            "data" => $compra
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        Compra::destroy($compra->id);

        return response()->json([
            "msg" => "A compra " . $compra->nome . " removida com sucesso"
        ]);
    }
}

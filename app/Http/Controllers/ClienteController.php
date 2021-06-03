<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->cliente->all();

        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            $this->cliente->rules(), $this->cliente->feedback()
        );

        $cliente = $this->cliente->create($request->all());

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $cliente = $this->cliente->find($id);

        if ($cliente === null) {
            return response()->json([
                'erro' => 'Recurso pesquisado nao existe'
            ], 404);
        }

        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $cliente = $this->cliente->find($id);

        if ($cliente === null) {
            return response()->json([
                'erro' => 'Impossivel realizar atualizacao. O recurso solicitado nao existe.'
            ], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = [];

            foreach ($cliente->rules() as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $rule;
                }
            }

            $request->validate(
                $regrasDinamicas, $cliente->feedback()
            );    
        } else { // seguir com método PUT
            $request->validate(
                $cliente->rules(), $cliente->feedback()
            );    
        }

        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $cliente = $this->cliente->find($id);

        if ($cliente === null) {
            return response()->json([
                'erro' => 'Impossivel realizar exclusao. O recurso solicitado nao existe.'
            ], 404);
        }

        $cliente->delete();
        return response()->json([
            'msg' => 'O cliente foi removido com sucesso'
        ], 200);
    }
}
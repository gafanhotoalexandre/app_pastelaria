<?php

namespace App\Http\Controllers;

use App\Mail\NovoPedidoMail;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = $this->pedido->with(['cliente', 'pasteis'])->get();

        return response()->json($pedidos, 200);
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
            $this->pedido->rules(), $this->pedido->feedback()
        );

        $pedido = $this->pedido->create($request->all());

        $pastel = $pedido->pasteis->pluck('nome')->all();
        $pastel = $pastel[0];
        
        $destinatario = $pedido->cliente->email;
        Mail::to($destinatario)->send(new NovoPedidoMail($pedido, $pastel));

        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pedido = $this->pedido->with(['cliente', 'pasteis'])->find($id);

        if ($pedido === null) {
            return response()->json([
                'erro' => 'Recurso pesquisado nao existe.'
            ], 404);
        }

        return response()->json($pedido, 200);
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
        $pedido = $this->pedido->find($id);

        if ($pedido === null) {
            return response()->json([
                'erro' => 'Impossivel realizar atualizacao. O recurso solicitado nao existe.'
            ], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = [];

            foreach ($pedido->rules() as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $rule;
                }
            }

            $request->validate(
                $regrasDinamicas, $pedido->feedback()
            );    
        } else { // seguir pelo método PUT
            $request->validate(
                $pedido->rules(), $pedido->feedback()
            );    
        }

        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $pedido = $this->pedido->find($id);

        if ($pedido === null) {
            return response()->json([
                'erro' => 'Impossivel realizar exclusao. O recurso solicitado nao existe.'
            ], 404);
        }

        $pedido->delete();
        return response()->json([
            'msg' => 'O registro do pedido foi deletado com sucesso.'
        ], 200);
    }
}

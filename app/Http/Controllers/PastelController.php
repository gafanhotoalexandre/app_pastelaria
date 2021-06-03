<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PastelController extends Controller
{

    public function __construct(Pastel $pastel)
    {
        $this->pastel = $pastel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasteis = $this->pastel->all();

        return response()->json($pasteis, 200);
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
            $this->pastel->rules(), $this->pastel->feedback()
        );

        $foto = $request->file('foto');
        $urn_foto = $foto->store('imagens', 'public');

        $pastel = $this->pastel->create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'foto' => $urn_foto,
        ]);

        return response()->json($pastel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pastel = $this->pastel->find($id);

        if ($pastel === null) {
            return response()->json([
                'erro' => 'Recurso pesquisado nao existe'
            ], 404);
        }

        return response()->json($pastel, 200);
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
        $pastel = $this->pastel->find($id);

        if ($pastel === null) {
            return response()->json([
                'erro' => 'Impossivel realizar atualizacao. O recurso solicitado nao existe.'
            ], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = [];

            foreach ($pastel->rules() as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $rule;
                }
            }

            $request->validate(
                $regrasDinamicas, $pastel->feedback()
            );
        } else { // seguir pelo método PUT
            $request->validate(
                $pastel->rules(), $pastel->feedback()
            );    
        }

        if ($request->file('foto')) {
            // removendo antigo arquivo caso um novo seja encaminhado pelo request
            Storage::disk('public')->delete($pastel->foto);

            // inserindo nova imagem
            $foto = $request->file('foto');
            $urn_foto = $foto->store('imagens', 'public');    
        }

        $pastel->fill($request->all());
        $pastel->foto = $urn_foto ?? $pastel->foto;
        $pastel->save();

        return response()->json($pastel, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $pastel = $this->pastel->find($id);

        if ($pastel === null) {
            return response()->json([
                'erro' => 'Impossivel realizar exclusao. O recurso solicitado nao existe.'
            ], 404);
        }

        // removendo arquivo
        Storage::disk('public')->delete($pastel->foto);

        $pastel->delete();
        return response()->json([
            'msg' => 'O registro de pastel foi deletado com sucesso.'
        ], 200);
    }
}

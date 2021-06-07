<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all(['email', 'password']);

        // autenticação (usuário e senha)
        $token = auth('api')->attempt($credenciais);
        if (! $token) {
            return response()->json(['erro' => 'Usuario ou senha invalido!'], 403);
        }

        // retornar JWT
        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function me()
    {
        return 'me';
    }
}

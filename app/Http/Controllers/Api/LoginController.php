<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Realiza a autenticação do usuário
     * 
     * Este método tenta autenticar o usuário com as credenciais fornecidas.
     * Se a autenticação for bem-sucedida, retorna o usuário autenticado juntamente com um token de acesso.
     * Se a autenticação falhar, retorna uma mensagem de erro
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            // Recuperar os dados do usuŕio logado
            $user = Auth::user();

            // Criar o token para o usuário logado. "api-token" é o ome do toke e plainTextToken, transforma em texto plano
            // Fazer uso da trait "use Laravel\Sanctum\HasApiTokens;" na model User
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'message' => $user
            ],200);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login ou senha incorreta.'
            ], 404);
        }
    }
}

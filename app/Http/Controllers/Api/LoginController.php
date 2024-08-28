<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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


    /**
     * Realiza o lougout do usuário
     * 
     * Este método revoga todos os tokens de acesso associado ao usuário, efetuando assim o logout.
     * Se o logout for bem-sucedido retorna uma resposta JSON indicando o sucesso.
     * Se ocorrer algum erro durante o logout, retorna uma resposta JSON indicando a falha
     * @param \App\Model\User $user O usuário para o qual o logout será efetuado
     * @return \Illuminate\Http\JsonResponse Uma resposta JSON indicando o status do logout e uma mensagem correspondente
     */
    public function logout(): JsonResponse
    {
        try{

            // Checa se o usuário está logado. 
            // Se estiver logado atribui a $authUserId o id do usuário logado, caso contrário atribui vazio ''
            $authUserId = Auth::check() ? Auth::id() : '';

            // Retorna a mensagem de erro quando o usuário não estiver logado, ou seja está vazio ''
            if(!$authUserId){
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário não está logado!'
                ],400);
            }

            // Recupera os dados do usuário logado
            $user = User::where('id', $authUserId)->first();

            // Excluir os tokens do usuário logado
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Deslogado com sucesso!'
            ], 200);

        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Login ou senha incorreta - (Não deslogado)!'
            ], 400);
        }

    }
}

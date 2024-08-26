<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApiRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Retorna lista de usuários
     * @return JsonResponse Retorna os usuários
     */
    public function index(): JsonResponse
    {
        // Recupera os usuários do banco de dados
        // $users = User::get();

        // Recupera os usuários do banco de dados com paginação
        $users = User::orderBy('id', 'DESC')->paginate(40);


        // Retornar os dados em formato de objeto e status 200
        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }


    /**
     * Recuperar os detelhes de um usuárioi específico
     * @param \App\Models\User $user o id para recuperar os dados do usuario
     * @return \Illuminate\Http\JsonResponse Retorna os dados do usuŕio em formato JSON
     */
    public function show(User $user): JsonResponse
    {
        // Obs: o id do usuárioi é informado na URL, o módel User recuperar o usuário com base no id informado e injeta os dados recuperados na variável $user

        // Retornar os dados em formato de objeto e status 200
        return response()->json([
            'status' => true,
            'users' => $user,
        ], 200);
    }

    public function store(UserApiRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Retornar os dados em formato de objeto e status 201(conseguiu cadastrar)
        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'Usuário cadastrado com sucesso!'
        ], 201);

    }
}

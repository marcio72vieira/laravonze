<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApiRequest;
use App\Http\Requests\UserApiPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

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

        // Inicia a transação
        DB::beginTransaction();

        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            // Depois de cadastrar o usuário, atribui-se o papel convidado caso o papel não tenha sido definido, caso contrário, atriui-se o papel definido
            // O papel "Convidado" com id = 6, deve está previamente cadastrado no banco. Não esquecer!
            if(!isset($request->roles)){
                $user->assignRole(6);
            } else {
                $user->assignRole($request->roles);
            }

            // Operação é concluída com êxito
            DB::commit();

            // Retornar os dados em formato de objeto e status 201(conseguiu cadastrar)
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário cadastrado com sucesso!'
                //'papel' => $user->getRoleNames(), //'papel' => $user->roles[0]['name'],
            ], 201);

        } catch (Exception $e) {

            // Operação não foi concluida com êxito
            DB::rollback();

            // Retornar os dados em formato de objeto e status 400(não conseguiu cadastrar)
            return response()->json([
                'status' => false,
                'message' => 'Usuário não cadastrado!',
            ], 400);

        }

    }

    /**
     * Atualizar os dados de um usuário existente com bas nos dados fornecidos na requisição.
     *
     * @param \App\Http\Request\UserApiRequest $request O objeto de requisição contendo os dados do usuário a ser atualizado
     * @param \App\Models\User $user O usuário a ser atualizado
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserApiRequest $request, User $user): JsonResponse
    {
        // Inicia a transação
        DB::beginTransaction();

        try{

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Obs: A senha e o papel não serão editados, permanecendo os mesmos, quando cadastrados.

            // Operação é concluída com êxito
            DB::commit();

            // Retornar os dados em formato de objeto e status 200(conseguiu recuperar)
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário editado com sucesso!'
            ], 200);

        } catch (Exception $e) {

            // Operação não foi concluida com êxito
            DB::rollback();

            // Retornar os dados em formato de objeto e status 400(não conseguiu editado)
            return response()->json([
                'status' => false,
                'message' => 'Usuário não editado!',
            ], 400);

        }

    }


    /**
     * Atualizar as senha de um usuário existente com base nos dados fornecidos na requisição.
     * 
     * @param  \App\Http\Requests\UserPasswordRequest  $request O objeto de requisição contendo os dados do usuário a ser atualizado.
     * @param  \App\Models\User  $user O usuário a ser atualizado.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(UserApiPasswordRequest $request, User $user): JsonResponse
    {

        // Iniciar a transação
        DB::beginTransaction();

        try {

            $user->update([
                'password' => $request->password,
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Retornar os dados em formato de objeto e status 200
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Senha editada com sucesso!',
            ], 200);

        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Retornar os dados em formato de objeto e status 400
            return response()->json([
                'status' => false,
                'message' => 'Senha não editada!',
            ], 400);

        }
    }



    /**
     * Excluir o usuário no banco de dados.
     * @param \App\Models\User $user O usuário a ser excluido
     * @return \Illuminae\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {

        try{
            // Excluir o registro do banco de dados
            $user->delete();

            // Retornar os dados em formato de objeto e status 200(conseguiu excluir)
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário excluido com sucesso!'
            ], 200);

        } catch(Exception $e) {

            // Retornar os dados em formato de objeto e status 400(não conseguiu excluir)
            return response()->json([
                'status' => false,
                'message' => 'Usuário não excluido!',
            ], 400);

        }

    }
}

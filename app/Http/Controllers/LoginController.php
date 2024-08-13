<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    // Login
    public function index()
    {
        // Carregar a view
        return view('login.index');
    }


    // Validar os dados do usuário no login
    public function loginProcess(LoginRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Validar o usuário e a senha com as informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // Se o usuário não foi autenticado (!), significa que os dados estão incorretos
        if(!$authenticated){

            // Salvar log
            Log::warning('E-mail ou senha inválido', ['email' => $request->email]);

            // Redirecionar o usuário para página anterior "login(área restrita)", mantendo os dados digitados e enviar a mensagem de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválido!');
        }

        // Depois de autenticado, deve-se obter o usuário autenticado
        $user = Auth::user();
        $user = User::find($user->id);

        // Verifica se o usuário possui o papel "Super Admin"
        if($user->hasRole('Super Admin')){
            // Recupera no banco TODAS as permissões, apenas o nome(pluck) em forma de array(toArray)
            $permissions = Permission::pluck('name')->toArray();
        }else{
            // Recupera no banco SÓ SÓ as permissõoes que o papel do usuário possui. Apenas o nome em forma de array
            // Obs: o usuário possui um papel, o papel possui permissões, portando obtém as permissões do usuári via papel
            $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        }

        // Ao usuário é atribuída só as permissões que o mesmo possui.
        // Obs: o método "syscPermissions", recebe um array. "$permissions" é um array(... toArray())
        $user->syncPermissions($permissions);


        // Redirecionar o usuário para o Dashboard, caso o mesmo seja autenticado
        return redirect()->route('dashboard.index')->with('success', 'Seja bem vindo!');
    }


    // Carregar o formulário cadastrar novo usuário
    public function create()
    {
        // Carregr a view
        return view('login.create');
    }

    public function store(LoginUserRequest $request)
    {
         // Validar o formulário
         $request->validated();

         // Marca o ponto inicial de uma transação
         DB::beginTransaction();

         try {

            // Cadastrar no banco de dados na tabela usuários
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id, $user->name]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {

            // Salvar log
            Log::warning('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    // Deslogar o usuário
    public function destroy()
    {
        // Deslogar o usuário
        Auth::logout();

        // Redireciona o usuário enviando a mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');

    }
}

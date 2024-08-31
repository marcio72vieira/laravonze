<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    // Listar os usuários
    public function index(Request $request)
    {
        // Recuperar os registros do banco dados sem pesquisa
        // $users = User::orderByDesc('created_at')->paginate(10);

        // Tabelas utilizadas: users, roles e model_has_roles(tabela pivot). Obs: model_has_roles é o mesmo que "users_has_roles"
        $users = DB::table('users')
            ->join('model_has_roles', 'model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.id', 'users.name AS userName','users.email','users.created_at',
                    'roles.name AS roleName')
            ->when($request->has('name'), function($query) use($request) {
                $query->where('users.name', 'like', '%'. $request->name . '%');
            })
            ->when($request->has('email'), function($query) use($request) {
                $query->where('users.email', 'like', '%'. $request->email . '%');
            })
            ->when($request->has('role'), function($query) use($request) {
                $query->where('roles.name', 'like', '%'. $request->role . '%');
            })
            ->when($request->filled('data_cadastro_inicio'), function($query) use($request) {
                $query->where('users.created_at', '>=', \Carbon\Carbon::parse($request->data_cadastro_inicio)->format('Y-m-d H:i:s'));
            })
            ->when($request->filled('data_cadastro_fim'), function($query) use($request) {
                $query->where('users.created_at', '<=', \Carbon\Carbon::parse($request->data_cadastro_fim)->format('Y-m-d H:i:s'));
            })
            ->orderByDesc('created_at')
            ->paginate(10);
            
            //->withQueryString();        // Através deste método é possível enviar a string(nome e email) que está sendo utilizada para pesquisar. Este método não existe com QueryBuilder

        // Carregar a VIEW
        return view('users.index', [
            'menu' => 'users',
            'users' => $users,
            'name' => $request->name,                                   // Enviando para a view o nome para pesquisa
            'email' => $request->email,                                 // Enviando para a view o email para pesquisa
            'role' => $request->role,                                   // Enviando para a view o papel para pesquisa
            'data_cadastro_inicio' => $request->data_cadastro_inicio,   // Enviando para a view o cadastroinicio para pesquisa
            'data_cadastro_fim' => $request->data_cadastro_fim          // Enviando para a view o cadastrofim para pesquisa
        ]);
    }



    // Detalhes do usuario
    public function show(User $user)
    {

        // Recuperar os dados do usuário logado
        $authenticatedUser = auth()->user();

        // Verificar se o usuário autenticado tem uma ordem de papel maior ou igual ao do usuário a ser visualizado
        if ($authenticatedUser->roles[0]->order_roles > $user->roles[0]->order_roles) {

            // Salvar log
            Log::info('Sem permissão de visualizar usuário com papel superior.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.index', ['user' => $user->id])->with('error', 'Sem permissão de visualizar usuário!');
        }

        // Salvar log
        Log::info('Visualizar usuário.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('users.show', ['menu' => 'users', 'user' => $user]);
    }

    // Carregar o formulário cadastrar novo usuário
    public function create()
    {
        // Recuperar só o nome de todos os Papeis cadastrados
        $roles = Role::pluck('name')->all();

        // Carregar a VIEW
        return view('users.create', ['menu' => 'users', 'roles' => $roles]);
    }

    // Cadastrar no banco de dados o novo usuário
    public function store(UserRequest $request)
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

            // Depois de cadastrar o usuário atribui-se o PAPEL conforme escolhido no formulário de cadastro.
            $user->assignRole($request->roles);

            // Salvar log:  Usuário cadastrado e o usuário que cadastrou
            Log::info('Usuário cadastrado.', ['id' => $user->id, $user->name, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    // Carregar o formulário editar usuário
    public function edit(User $user)
    {
        // Recuperar os dados do usuário logado
        $authenticatedUser = auth()->user();

        // Verificar se o usuário autenticado tem uma ordem de papel maior ou igual ao do usuário a ser visualizado
        if ($authenticatedUser->roles[0]->order_roles > $user->roles[0]->order_roles) {

            // Salvar log
            Log::info('Sem permissão de editar usuário com papel superior.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.index', ['user' => $user->id])->with('error', 'Sem permissão de editar usuário!');
        }

        // Recuperar só o nome de todos os Papeis cadastrados
        $roles = Role::pluck('name')->all();

        // Recupera o papel do Usuário (Isto porque a busca é na tabela model_has_hole)
        $userRoles = $user->roles->pluck('name')->first();

        // Salvar log
        Log::info('Carregar formulário editar usuário.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('users.edit', ['menu' => 'users', 'user' => $user, 'roles' => $roles, 'userRoles' => $userRoles]);
    }

    // Editar no banco de dados o usuário
    public function update(UserRequest $request, User $user)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Depois de editar o usuário atribui-se o novo PAPEL conforme escolhido no formulário de edição.
            $user->syncRoles($request->roles);

            // Salvar log: Usuário atualizado e o usuário que atualizou
            Log::info('Usuário editado.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Usuário editado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não editado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado!');
        }
    }

    // Carregar o formulário editar senha do usuário
    public function editPassword(User $user)
    {

        // Carregar a VIEW
        return view('users.editPassword', ['menu' => 'users', 'user' => $user]);
    }

    // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request, User $user)
    {

        // Validar o formulário
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Senha do usuário editada.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Senha do usuário não editada.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        }
    }

    // Excluir o usuário do banco de dados
    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            // Remover todos os papeis atribuidos ao usuário, Atribuindo um array vazio
            $user->syncRoles([]);

            // Salva no log: Usuário excluido e o usuário que excluiu
            Log::info('Usuário excluído.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não excluído.', ['error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('course.index')->with('error', 'Usuário não excluído!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            // Redirecionar o usuário para página anterior "login(área restrita)", mantendo os dados digitados e enviar a mensagem de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválido!');
        }

        // Redirecionar o usuário para o Dashboard, caso o mesmo seja autenticado
        return redirect()->route('dashboard.index')->with('success', 'Seja bem vindo!');

    }

    // Carregar o formulário cadastrar novo usuário
    public function create()
    {
        // Carregr a view
        return view('login.create');

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

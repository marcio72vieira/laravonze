<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index()
    {
        // carregar a view
        return view('courses.index');
    }

    // Visualizar o curso
    public function show()
    {
        // carregar a view
        return view('courses.show');
    }

    // Carregar o formulário cadastrar novo curso
    public function create()
    {
        // carregar a view
        return view('courses.create');
    }

    // Cadastrar no banco de dados o novo curso
    public function store()
    {
        dd("Cadastrar no banco de dados o novo curso");
    }

    // Carregar o formulário editar curso
    public function edit()
    {
        // carregar a view
        return view('courses.edit');
    }

    // Atualizar no banco de dados o curso
    public function update()
    {
        dd("Editar o curso do banco de dados");
    }


    // Excluir o curso do banco de dados
    public function destroy()
    {
        dd("Excluir o curso do banco de dados");
    }
}

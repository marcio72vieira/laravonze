<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseApiRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * 
     * Retorna lista de cursos
     * @return JsonResponse Retorna os cursos
     */

    public function index() : JsonResponse
    {

        //Verifica se o usuário authenticado possui a permissão para acessar este recurso
        if(Auth::user()->hasPermissionTo('index-course')) {

            // Recupera os cursos do banco de dados com paginação
            $courses = Course::orderBy('id', 'DESC')->paginate(40);

            // Retornar os dados em formato de objeto e status 200
            return response()->json([
                'status' => true,
                'courses' => $courses,
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Authorização negada!',
            ], 403);
        }
    }


    public function show(Course $course): JsonResponse
    {
        //Verifica se o usuário authenticado possui a permissão para acessar este recurso
        if(Auth::user()->hasPermissionTo('show-course')){
            return response()->json([
                'status' => true,
                'course' => $course
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Authorização negada!',
            ], 403);
        }
    }



    public function store(CourseApiRequest $request)
    {
        //Verifica se o usuário authenticado possui a permissão para acessar este recurso
        if(Auth::user()->hasPermissionTo('create-course')){
            
            // Inicia a transação
            DB::beginTransaction();

            try{
                $course = Course::create([
                    'name' => $request->name,
                    'price' => $request->price,
                ]);

                // Operação é concluída com êxito
                DB::commit();

                // Retornar os dados em formato de objeto e status 201(conseguiu cadastrar)
                return response()->json([
                    'status' => true,
                    'course' => $course,
                    'message' => 'Curso cadastrado com sucesso!'
                ], 201);

            } catch (Exception $e) {

                // Operação não foi concluida com êxito
                DB::rollback();

                // Retornar os dados em formato de objeto e status 400(não conseguiu cadastrar)
                return response()->json([
                    'status' => false,
                    'message' => 'Curso não cadastrado!',
                    'erro' => $e,
                ], 400);
            }
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Authorização negada!',
            ], 403);
        }
    }


    public function update(CourseApiRequest $request, Course $course): JsonResponse
    {
        //Verifica se o usuário authenticado possui a permissão para acessar este recurso
        if(Auth::user()->hasPermissionTo('edit-course')){

            // Inicia a transação
            DB::beginTransaction();

            try{

                $course->update([
                    'name' => $request->name,
                    'price' => $request->price,
                ]);

                // Operação é concluída com êxito
                DB::commit();

                // Retornar os dados em formato de objeto e status 200(conseguiu editar)
                return response()->json([
                    'status' => true,
                    'course' => $course,
                    'message' => 'Curso editado com sucesso!'
                ], 200);

            } catch (Exception $e) {

                // Operação não foi concluida com êxito
                DB::rollback();

                // Retornar os dados em formato de objeto e status 400(não conseguiu editado)
                return response()->json([
                    'status' => false,
                    'message' => 'Curso não editado!',
                ], 400);
            }
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Authorização negada!',
            ], 403);
        }
    }


    public function destroy(Course $course): JsonResponse
    {
        //Verifica se o usuário authenticado possui a permissão para acessar este recurso
        if(Auth::user()->hasPermissionTo('destroy-course')){

            try{
                // Excluir o registro do banco de dados
                $course->delete();

                // Retornar os dados em formato de objeto e status 200(conseguiu excluir)
                return response()->json([
                    'status' => true,
                    'course' => $course,
                    'message' => 'Curso excluido com sucesso!'
                ], 200);

            } catch(Exception $e) {

                // Retornar os dados em formato de objeto e status 400(não conseguiu excluir)
                return response()->json([
                    'status' => false,
                    'message' => 'Curso não excluido!',
                ], 400);

            }
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Authorização negada!',
            ], 403);
        }
    }

} 
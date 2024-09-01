<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
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

     public function store(UserApiRequest $request)
     {
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

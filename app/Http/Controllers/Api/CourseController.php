<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Retorna lista de cursos
     * @return JsonResponse Retorna os cursos
     */

     public function index() : JsonResponse
     {
        // Recupera os cursos do banco de dados com paginação
        $courses = Course::orderBy('id', 'DESC')->paginate(40);

        // Retornar os dados em formato de objeto e status 200
        return response()->json([
            'status' => true,
            'courses' => $courses,
        ], 200);
     }
}

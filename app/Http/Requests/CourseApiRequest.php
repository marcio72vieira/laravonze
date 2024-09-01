<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Manipular falha de validação e retornar uma resposta JSON com os erros de validação
     * @param Illuminate\Contracts\Validation\Validator $validator O objeto de validação que contém os erros de validação
     * @throws Illuminate\Http\Exceptions\HttpResponseException;
     * 422 O código de status 422 significa "Unprocessably entity (Entidade não processável)" Esse código é usado
     * quando o servidor entende a requisição do cliente, mas não pode processá-la devido a erros de validação no lado do servidor
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator->errors(),
        ], 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Recuperar o id do curso na url
        $courseId = $this->route('course');

        return [
            'name' => 'required|unique:courses,name,' . ($courseId ? $courseId->id : null),
            'price' => 'required|max:10'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome  do curso é obrigatório!',
            'name.unique' => 'Este nome já  está sendo utilizado!',
            'price.required' => 'Campo preço do curso é obrigatório!',
            'price.max' => 'O preço só pode ter no máximo 8 números!',
        ];
    }
}

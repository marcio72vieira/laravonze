<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserApiRequest extends FormRequest
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
     * Retorna as regras de validação para os dados do usuário
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Recuperar o id do usuário na url
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required_if:password,!=,null|min:6'
            // Se o campo senha for igual a null, ou seja, ele não for informado, ele não será requerido. Issoo será aplicado no EDIT. Se o campo
            // senha for informado, ele deverá ter um valor e esse valor e esse valor deverá atender as regras de requerido e ter no minimo 6 caracteres
        ];
    }


    /**
     * Retorna as mensagens de erro personalizadas para as regras de validação
     */
    public function messages(): array
    {
        return[
            'name.required' => 'Campo nome é obrigatório!',
            'email.required' => 'Campo e-mail é obrigatório!',
            'email.email' => 'Necessário enviar e-mail válido!',
            'email.unique' => 'O e-mail já está cadastrado!',
            //'password.required' => 'Campo senha é obrigatório!',
            'password.required_if' => 'Campo senha é obrigatório!',
            'password.min' => 'Senha com no mínimo :min caracteres!',
        ];
    }
}

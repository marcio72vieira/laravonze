<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'aplication' => 'required|max:3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome  do papel é obrigatório!',
            'aplication.required' => 'Campo aplicação é obrigatório!',
            'aplication.max' => 'O campo aplicação só pode ter no máximo 3 caracteres!',
        ];
    }
}

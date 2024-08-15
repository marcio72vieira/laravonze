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
        $roleId = $this->route('role');

        return [
            'name' => 'required|unique:roles,name,' . ($roleId ? $roleId->id : null),
            'guard_name' => 'required|max:3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo papel é obrigatório!',
            'name.unique' => 'O nome deste papel já está sendo utilizado!',
            'guard_name.required' => 'Campo aplicação é obrigatório!',
            'guard_name.max' => 'O campo aplicação só pode ter no máximo 3 caracteres!',
        ];
    }
}

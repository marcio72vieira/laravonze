<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
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
            'course_id' => 'required_if:course_id,!=,null', // Só valida o campo course_id, se o mesmo existir. Neste caso só será validado no create, no edit não.
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Necessário enviar o Id do  curso!',
            'name.required' => 'Campo nome  da aula é obrigatório!',
            'description.required' => 'Campo descrição da aula é obrigatório!',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsFormRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Zà-ÿÀ-ÿ\s]{3,}$/', 
            'departament' => 'required|regex:/^[A-Za-z0-9]{4,5}$/',
            'local' => 'required|regex:/^[a-zA-Zà-ÿÀ-ÿ\s]{3,}$/',
            'branch_id_1' => 'required|exists:branches,id', // Ramal 1 é obrigatório
            'branch_id_2' => 'nullable|exists:branches,id' // Ramal 2 é opcional
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.regex' => 'O campo nome deve conter pelo menos 3 letras (sem números ou caracteres especiais).',
            
            'departament.required' => 'O campo departamento é obrigatório.',
            'departament.regex' => 'O campo departamento deve conter de 4 a 5 letras e/ou números (sem espaços).',

            'local.required' => 'O campo local é obrigatório.',
            'local.regex' => 'O campo local deve conter pelo menos 3 letras (sem números ou caracteres especiais).',

            'branch_id_1.required' => 'O campo ramal é obrigatório.',
            'branch_id_1.exists' => 'O ramal selecionado não existe.',

            'branch_id_2.exists' => 'O segundo ramal selecionado não existe.',
        ];
    }
}

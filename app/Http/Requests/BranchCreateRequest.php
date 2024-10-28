<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite qualquer usuário
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branch' => 'required|regex:/^\d{3}#$/|unique:branches,branch' 
        ];
    }

    public function messages() 
    {
        return [
            'branch.required' => 'O campo branch é obrigatório.',
            'branch.regex' => 'O campo branch deve ter 3 dígitos seguidos de uma tralha (#).',
            'branch.unique' => 'Este ramal já está cadastrado.', 
        ];
    }
}

<?php

use Illuminate\Foundation\Http\FormRequest;

class BranchesFormRequest extends FormRequest
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
            'branch_id_1' => 'required|exists:branches,id|unique:contacts,branch_id_1', // Ramal 1 é obrigatório
            'branch_id_2' => 'nullable|exists:branches,id|unique:contacts,branch_id_2', // Ramal 2 é opcional
        ];
    }

    public function messages() 
    {
        return [
            'branch_id_1.required' => 'O campo Ramal 1 é obrigatório.',
            'branch_id_1.exists' => 'O Ramal 1 selecionado não existe.',
            'branch_id_1.unique' => 'Este ramal já está cadastrado.', 
            'branch_id_2.exists' => 'O Ramal 2 selecionado não existe.',
            'branch_id_2.unique' => 'Este ramal já está cadastrado.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $branchId = $this->input('branch_id_1'); // Ramal 1
            $newBranch = $this->input('branch_id_2'); // Ramal 2

            // Verifica se o ramal 2 não é igual ao ramal 1
            if ($newBranch === $branchId) {
                $validator->errors()->add('branch_id_2', 'O Ramal 2 não pode ser igual ao Ramal 1.');
            }
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchCreateRequest;
use App\Http\Requests\BranchesFormRequest;
use App\Http\Requests\BranchFormRequest;
use App\Models\Branch; // Adicione esta linha
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all(); // Recupere todos os ramais do banco de dados
        return view('branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchCreateRequest $request)
    {
        // Crie um novo ramal no banco de dados
        $branch = Branch::create($request->validated());

        return to_route('contacts.with.branches')
            ->with('mensagem.sucesso', "Ramal criado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementar lógica para mostrar um ramal específico, se necessário
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementar lógica para editar um ramal, se necessário
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implementar lógica para atualizar um ramal, se necessário
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implementar lógica para remover um ramal, se necessário
    }
}

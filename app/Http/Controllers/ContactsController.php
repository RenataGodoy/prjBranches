<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsFormRequest;
use App\Models\Contact;
use App\Models\Branch; // Certifique-se de importar a model Branch
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all(); // Obtém todos os ramais do banco de dados
        return view('contacts.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactsFormRequest $request)
{
    // Captura os dados do request
    $data = $request->validated(); // Captura os dados validados pelo FormRequest

    $data['branch_id_1'] = $request->branch_id_1;
    $data['branch_id_2'] = $request->branch_id_2; 

    // Cria o contato
    Contact::create($data);
    
    return to_route('contacts.with.branches')
        ->with('mensagem.sucesso', 'Contato criado com sucesso!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Aqui você pode implementar a lógica para exibir um contato específico
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        $branches = Branch::all(); 
        return view('contacts.edit', compact('contact', 'branches'))
            ->with('mensagem.sucesso', 'Contato atualizado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->only(['name', 'departament', 'local', 'branch_id_1', 'branch_id_2']));

        return to_route('contacts.with.branches')
            ->with('mensagem.sucesso', 'Contato atualizado com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->active = false; 
        $contact->save(); 

        return redirect()->route('contacts.with.branches')->with('mensagem.sucesso', 'Contato desativado com sucesso!');
    }

    /**
     * List contacts with branches and apply filters.
     */
    public function listWithBranches(Request $request)
    {
        // Iniciar a query com ambos os relacionamentos de branches carregados
        $query = Contact::with(['branch', 'secondBranch'])->where('active', true);
    
        // Aplicar filtros conforme os parâmetros de pesquisa
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->filled('departament')) {
            $query->where('departament', 'like', '%' . $request->departament . '%');
        }
    
        if ($request->filled('local')) {
            $query->where('local', 'like', '%' . $request->local . '%');
        }
    
        if ($request->filled('branch_id')) {
            $query->where(function ($q) use ($request) {
                // Filtra tanto pelo primeiro quanto pelo segundo ramal
                $q->whereHas('branch', function ($subQuery) use ($request) {
                    $subQuery->where('branch', 'like', '%' . $request->branch_id . '%');
                })
                ->orWhereHas('secondBranch', function ($subQuery) use ($request) {
                    $subQuery->where('branch', 'like', '%' . $request->branch_id . '%');
                });
            });
        }
    
        // Obter resultados após aplicar os filtros
        $contacts = $query->get();
    
        return view('contacts.list_with_branches', compact('contacts'));
    }
    
}

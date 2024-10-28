<x-layout> 
    <div class="container mt-4">
        <h1>Lista de Contatos com Ramais</h1>
        <form action="{{ route('contacts.with.branches') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ request('name') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="departament">Setor</label>
                        <input type="text" name="departament" class="form-control" placeholder="Ex: GATI" value="{{ request('departament') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="local">Local</label>
                        <input type="text" name="local" class="form-control" placeholder="Ex: Juridico" value="{{ request('local') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="branch_id">Ramal</label>
                        <input type="text" name="branch_id" class="form-control" placeholder="000#" value="{{ request('branch_id') }}">
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col text-end">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="{{ route('contacts.with.branches') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </div>
        </form>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Departamento</th>
                    <th>Local</th>
                    <th>Ramal</th>
                    @auth
                        <th>Ações</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @if($contacts->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Nenhum contato encontrado.</td>
                    </tr>
                @else
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->departament }}</td>
                            <td>{{ $contact->local }}</td>
                            <td>{{ $contact->branch ? $contact->branch->branch : 'N/A' }}
                                {{ $contact->secondBranch ? ', ' . $contact->secondBranch->branch : '' }}                            </td> 
                            @auth
                                <td>
                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja marcar como inativo?');">Excluir</button>
                                    </form>    
                                </td>
                            @endauth 
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    </x-layout>
    
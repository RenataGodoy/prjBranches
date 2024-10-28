<x-layout>
    <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $contact->name) }}">
        </div>
    
        <div class="form-group">
            <label for="departament">Departamento:</label>
            <input type="text" class="form-control" id="departament" name="departament" required value="{{ old('departament', $contact->departament) }}">
        </div>
    
        <div class="form-group">
            <label for="local">Local:</label>
            <input type="text" class="form-control" id="local" name="local" required value="{{ old('local', $contact->local) }}">
        </div>
    
        <div class="form-group">
            <label for="branch_id_1">Selecione um ramal:</label>
            <select class="form-control" id="branch_id_1" name="branch_id_1" required>
                <option value="" disabled>--- Selecione um ramal ---</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $branch->id == old('branch_id_1', $contact->branch_id_1) ? 'selected' : ''}}>
                        {{ $branch->branch }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="branch_id_2">Ramal 2 (Opcional)</label>
            <select name="branch_id_2" id="branch_id_2" class="form-control">
                <option value="">Selecione um Ramal</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $branch->id == old('branch_id_2', $contact->branch_id_2) ? 'selected' : '' }}>
                        {{ $branch->branch }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Atualizar Contato</button>
    </form>
</x-layout>

<x-layout>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
<form method="POST" action="{{ route('contacts.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="departament">Departamento:</label>
        <input type="text" class="form-control" id="departament" name="departament" required>
    </div>

    <div class="form-group">
        <label for="local">Local:</label>
        <input type="text" class="form-control" id="local" name="local" required>
    </div>

    <div class="form-group">
        <label for="branch_id_1">Ramal 1</label>
        <select name="branch_id_1" id="branch_id_1" class="form-control">
            <option value="">Selecione um Ramal</option>
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="branch_id_2">Ramal 2 (Opcional)</label>
        <select name="branch_id_2" id="branch_id_2" class="form-control">
            <option value="">Selecione um Ramal</option>
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
            @endforeach
        </select>
    </div>
    

    <button type="submit" class="btn btn-primary">Criar Contato</button>
</form>

</x-layout>
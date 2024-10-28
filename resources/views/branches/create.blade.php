<x-layout>
    
    <form method="POST" action="{{ route('branches.store') }}">
        @csrf
        <div class="form-group">
            <label for="branch">Inserir Ramal:</label>
            <input type="text" class="form-control" id="branch" name="branch" required>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Ramal</button>
    </form>
</x-layout>
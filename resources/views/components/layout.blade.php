<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Ramais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if (session('mensagem.sucesso'))
        <div id="mensagemSucesso" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensagem.sucesso') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sucessoMsg = document.getElementById('mensagemSucesso');
            if (sucessoMsg) {
                setTimeout(function() {
                    const alert = new bootstrap.Alert(sucessoMsg);
                    alert.close();
                }, 2000); 
            }
        });
    </script>

    <nav class="navbar expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href=" {{route ('contacts.with.branches')}}" class="navbar-brand">Homme</a>
            @auth
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Sair</button>
            </form>
            @endauth
            @guest
            <a href="{{ route('login') }}"> Entrar </a>
            @endguest
        </div>
    </nav>    

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    @auth
                    <a href="{{ route('branches.create') }}" class="list-group-item list-group-item-action">
                        Criar Ramal
                    </a>
                    <a href="{{ route('contacts.create') }}" class="list-group-item list-group-item-action">
                        Criar Funcionário
                    </a>
                    @endauth
                    <a href="{{ route('contacts.with.branches') }}" class="list-group-item list-group-item-action">
                        Listar Ramais
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                {{ $slot }} 
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>

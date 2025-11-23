<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Galeria</title>
    <link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">

    @if(session('sucesso'))
    <div class="alert">
        {{ session('sucesso') }}
    </div>
    @endif

    <header>
        <div>
            <h1>Galeria de Fotos</h1>
            <small>
                Olá, <a href="{{ route('perfil.index') }}" style="color: inherit; font-weight: bold;">{{ Auth::user()->nome }}</a>
            </small>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">

            <a href="{{ route('tema.alternar') }}" class="btn-trocar-tema" title="Alternar Tema">
                <div></div>
            </a>

            <a href="{{ route('fotos.create') }}" class="btn btn-add">+ Nova Foto</a>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn btn-sair">Sair</button>
            </form>
        </div>
    </header>

    <main class="galeria-container">
        @forelse($fotos as $foto)
        <div class="card">
            <img src="{{ asset('storage/' . $foto->nome_arquivo) }}" alt="{{ $foto->titulo }}" class="card-img">

            <div class="card-body">
                <h3 class="card-title">{{ $foto->titulo }}</h3>

                <p class="card-date">
                    Enviada em: {{ $foto->created_at->format('d/m/Y H:i') }}
                </p>

                <div class="actions">
                    <a href="{{ route('fotos.edit', $foto->id) }}" class="btn btn-edit">Editar</a>

                    <form action="{{ route('fotos.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Tem certeza?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-del">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p style="grid-column: 1/-1; text-align: center; color: #666;">
            Nenhuma foto encontrada.
        </p>
        @endforelse
    </main>

</body>

</html>
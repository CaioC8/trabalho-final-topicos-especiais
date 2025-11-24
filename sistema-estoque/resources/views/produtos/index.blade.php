<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Produtos</title>
    <link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
    <style>
        .card-price {
            color: #2563eb;
            font-weight: bold;
            font-size: 1.1rem;
            margin: 5px 0;
        }

        .badge-container {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }

        .badge {
            background: #e5e7eb;
            color: #374151;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
        }

        body.dark-mode .badge {
            background: #374151;
            color: #e5e7eb;
        }

        .btn-cat {
            background-color: #8b5cf6;
        }

        /* Roxo para categorias */
    </style>
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">

    @if(session('sucesso'))
    <div class="alert">{{ session('sucesso') }}</div>
    @endif

    <header>
        <div>
            <h1>Estoque de Produtos</h1>
            <small>Olá, <a href="{{ route('perfil.index') }}" style="color: inherit; font-weight: bold;">{{ Auth::user()->nome }}</a></small>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('tema.alternar') }}" class="btn-trocar-tema" title="Alternar Tema">
                <div></div>
            </a>

            <a href="{{ route('categorias.create') }}" class="btn btn-cat" style="font-size:0.8rem;">+ Categoria</a>

            <a href="{{ route('produtos.create') }}" class="btn btn-add">+ Novo Produto</a>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn btn-sair">Sair</button>
            </form>
        </div>
    </header>

    <main class="galeria-container">
        @forelse($produtos as $produto)
        <div class="card">
            <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" class="card-img">

            <div class="card-body">
                <h3 class="card-title">{{ $produto->nome }}</h3>

                <p class="card-price">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

                <div class="badge-container">
                    @foreach($produto->categorias as $cat)
                    <span class="badge">{{ $cat->nome }}</span>
                    @endforeach
                </div>

                <div class="actions">
                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-edit">Editar</a>

                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Excluir este produto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-del">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p style="grid-column: 1/-1; text-align: center; color: #666;">
            Nenhum produto cadastrado.
        </p>
        @endforelse
    </main>
</body>

</html>
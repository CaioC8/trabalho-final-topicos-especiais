<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
    <link rel="stylesheet" href="{{ asset('css/categorias/index.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">

    <header>
        <h1>Gerenciar Categorias</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('produtos.index') }}" class="btn" style="background-color: #6b7280;">Voltar aos Produtos</a>
            <a href="{{ route('categorias.create') }}" class="btn btn-add">+ Nova Categoria</a>
        </div>
    </header>

    <main class="tabela-container">
        @if(session('sucesso'))
        <div class="alert">{{ session('sucesso') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nome da Categoria</th>
                    <th style="width: 200px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nome }}</td>
                    <td class="actions-cell">
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-edit btn-sm">Editar</a>

                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('Tem certeza? Isso removerá esta categoria de todos os produtos.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-del btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($categorias->isEmpty())
        <p style="text-align: center; color: #666; margin-top: 20px;">Nenhuma categoria cadastrada.</p>
        @endif
    </main>
</body>

</html>
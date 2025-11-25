<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/categorias/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gerais.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    @if(session('sucesso'))
    <p class="alert">{{ session('sucesso') }}</p>
    @endif

    <div class="form">
        <h2>Nova Categoria</h2>

        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" placeholder="Ex: Roupas, Tecnologia..." required autofocus>
                @error('nome')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-salvar">Adicionar Categoria</button>
            <a href="{{ route('produtos.index') }}" class="btn-voltar">Voltar aos Produtos</a>
        </form>
    </div>
</body>

</html>
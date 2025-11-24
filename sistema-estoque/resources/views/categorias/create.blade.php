<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="upload-container" style="max-width: 400px;">
        <h2>Nova Categoria</h2>

        @if(session('sucesso'))
        <p style="color: green; text-align: center;">{{ session('sucesso') }}</p>
        @endif

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
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/categorias/edit.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="edit-container">
        <h2>Editar Categoria</h2>

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $categoria->nome) }}" required>
                @error('nome')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-atualizar">Salvar Alterações</button>
            <a href="{{ route('categorias.index') }}" class="btn-voltar">Cancelar</a>
        </form>
    </div>
</body>

</html>
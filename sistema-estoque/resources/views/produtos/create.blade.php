<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="upload-container">
        <h2>Adicionar Produto</h2>

        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
            </div>

            <div class="form-group">
                <label for="preco">Preço (R$)</label>
                <input type="number" step="0.01" name="preco" id="preco" placeholder="0.00" value="{{ old('preco') }}" required>
            </div>

            <div class="form-group">
                <label>Categorias</label>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px;">
                    @foreach($categorias as $categoria)
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}" id="cat-{{ $categoria->id }}" style="width: auto;">
                        <label for="cat-{{ $categoria->id }}" style="margin: 0; font-weight: normal;">{{ $categoria->nome }}</label>
                    </div>
                    @endforeach
                </div>
                @if($categorias->isEmpty())
                <small style="color: #666;">Nenhuma categoria cadastrada. <a href="{{ route('categorias.create') }}">Criar uma?</a></small>
                @endif
            </div>

            <div class="form-group">
                <label for="foto">Foto do Produto</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
            </div>

            <button type="submit" class="btn-salvar">Salvar Produto</button>
            <a href="{{ route('produtos.index') }}" class="btn-voltar">Voltar</a>
        </form>
    </div>
</body>

</html>
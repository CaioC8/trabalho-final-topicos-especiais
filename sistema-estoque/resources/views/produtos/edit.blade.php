<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="edit-container">
        <h2>Editar Produto</h2>

        <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $produto->nome) }}" required>
            </div>

            <div class="form-group">
                <label for="preco">Preço (R$)</label>
                <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco', $produto->preco) }}" required>
            </div>

            <div class="form-group">
                <label>Categorias</label>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                    @foreach($categorias as $categoria)
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox"
                            name="categorias[]"
                            value="{{ $categoria->id }}"
                            id="cat-{{ $categoria->id }}"
                            style="width: auto;"
                            {{ $produto->categorias->contains($categoria->id) ? 'checked' : '' }}>
                        <label for="cat-{{ $categoria->id }}" style="margin: 0; font-weight: normal;">{{ $categoria->nome }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Alterar Foto (Opcional)</label>
                <input type="file" name="foto" id="foto" accept="image/*">

                <p style="font-size: 0.9rem; color: #666; margin-bottom: 5px;">Atual:</p>
                <img src="{{ asset('storage/' . $produto->foto) }}" alt="Foto atual" class="img-preview">
            </div>

            <button type="submit" class="btn-atualizar">Salvar Alterações</button>
            <a href="{{ route('produtos.index') }}" class="btn-voltar">Cancelar</a>
        </form>
    </div>
</body>

</html>
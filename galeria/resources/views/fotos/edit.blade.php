<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Foto - Galeria</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="edit-container">
        <h2>Editar Foto</h2>

        <form action="{{ route('fotos.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título da Foto</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $foto->titulo) }}" required>
                @error('titulo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="arquivo">Alterar Imagem (Deixe vazio para manter a atual)</label>
                <input type="file" name="arquivo" id="arquivo" accept="image/png, image/jpeg">

                <p style="font-size: 0.9rem; color: #666; margin-bottom: 5px;">Imagem Atual:</p>
                <img src="{{ asset('storage/' . $foto->nome_arquivo) }}" alt="Imagem atual" class="img-preview">

                @error('arquivo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-atualizar">Salvar Alterações</button>
            <a href="{{ route('fotos.index') }}" class="btn-voltar">Cancelar</a>
        </form>
    </div>
</body>

</html>
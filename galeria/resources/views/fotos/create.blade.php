<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Foto - Galeria</title>
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="upload-container">
        <h2>Adicionar Nova Foto</h2>

        <form action="{{ route('fotos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo">Título da Foto</label>
                <input type="text" name="titulo" id="titulo" placeholder="Ex: Pôr do sol na praia" value="{{ old('titulo') }}" required>
                @error('titulo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="arquivo">Selecione a Imagem (JPG ou PNG)</label>
                <input type="file" name="arquivo" id="arquivo" accept="image/png, image/jpeg" required>
                @error('arquivo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-salvar">Salvar Foto</button>
            <a href="{{ route('fotos.index') }}" class="btn-voltar">Cancelar e Voltar</a>
        </form>
    </div>
</body>

</html>
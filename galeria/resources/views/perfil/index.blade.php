<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Galeria</title>
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="perfil-container">
        <h2>Meus Dados</h2>
        <p class="subtitle">Gerencie suas informações pessoais</p>

        @if(session('sucesso'))
        <div class="alert">
            {{ session('sucesso') }}
        </div>
        @endif

        <form action="{{ route('perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $usuario->nome) }}" required>
                @error('nome')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="senha">Nova Senha <small style="font-weight: normal;">(Deixe em branco para manter a atual)</small></label>
                <input type="password" name="senha" id="senha">
                @error('senha')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="senha_confirmation">Confirmar Nova Senha</label>
                <input type="password" name="senha_confirmation" id="senha_confirmation">
            </div>

            <button type="submit" class="btn-salvar">Salvar Alterações</button>
        </form>

        <a href="{{ route('fotos.index') }}" class="btn-voltar">← Voltar para a Galeria</a>

        <hr>

        <div class="danger-zone">
            <h3>Zona de Perigo</h3>
            <p>Ao excluir sua conta, todas as suas fotos serão apagadas permanentemente. Esta ação não pode ser desfeita.</p>

            <form action="{{ route('perfil.destroy') }}" method="POST" onsubmit="return confirm('ATENÇÃO: Tem certeza absoluta que deseja excluir sua conta e TODAS as suas fotos? Essa ação é irreversível!');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-excluir">Excluir minha conta</button>
            </form>
        </div>
    </div>
</body>

</html>
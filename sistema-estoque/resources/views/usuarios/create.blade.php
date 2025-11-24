<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - Galeria</title>
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="container">
        <h2>Criar Conta</h2>

        <form action="{{ route('cadastro.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input placeholder="João Silva" type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
                @error('nome')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input placeholder="email@example.com" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input placeholder="Sua senha" type="password" name="senha" id="senha" required>
                @error('senha')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="senha_confirmation">Confirmar Senha</label>
                <input placeholder="Confirme a senha" type="password" name="senha_confirmation" id="senha_confirmation" required>
            </div>

            <button type="submit">Cadastrar</button>
        </form>

        <div class="login-link">
            Já tem conta? <a href="/login">Fazer Login</a>
        </div>
    </div>
</body>

</html>
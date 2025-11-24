<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galeria</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') === 'escuro' ? 'dark-mode' : '' }}">
    <div class="login-container">
        <h2>Entrar</h2>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input placeholder="email@example.com" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
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

            <button type="submit">Entrar</button>
        </form>

        <div class="links">
            Ainda não tem conta? <a href="{{ route('cadastro.create') }}">Cadastre-se aqui</a>
        </div>
    </div>
</body>

</html>
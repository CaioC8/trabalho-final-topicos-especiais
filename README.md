# Como Executar

1. Condfigurar .env na raiz de acordo com o .env.example

2. Rodar o banco com docker:
   
```bash
docker-compose up -d
```

- Dentro de ./sistema-estoque

3. Instalar dependências do PHP

```bash
composer install
```

4. Configurar .env de acordo com o .env.example

5. Gerar chave de criptografia

```bash
php artisan key:generate
```

6. Rodar migrations do banco

```bash
php artisan migrate
```

7. Rodar o projeto

```bash
php artisan serve
```

# AGENTS.md

## 🧱 Tecnologias Utilizadas

- Laravel 10.48.29
- PHP 8.1.32
- MySQL (via `DB_CONNECTION=mysql`)
- PHPUnit (pré-configurado com `phpunit.xml`)
- Sanctum (para autenticação API, se necessário)
- Faker (para factories em testes)

## 📦 Instalação e Setup

Execute os comandos abaixo para preparar o ambiente:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

> Certifique-se de configurar corretamente as variáveis de banco de dados no `.env`.

---

## 🧪 Testes

Para rodar todos os testes:

```bash
php artisan test
```

Você pode também rodar testes específicos com:

```bash
php artisan test --filter=NomeDoTeste
```

---

## 📁 Estrutura de Pastas

Utilizamos uma estrutura de domínio e separação de responsabilidades. Sempre que for criar um novo módulo (ex: Produto), crie:

- `app/Http/Controllers/ProductController.php`
- `app/Services/ProductService.php`
- `app/Repositories/ProductRepository.php`
- `app/Http/Requests/Product/ProductStoreRequest.php`
- `app/Http/Requests/Product/ProductUpdateRequest.php`
- `app/Models/Product.php`
- `routes/api.php` (adicione aqui as rotas)
- `tests/Feature/ProductTest.php` (testes de feature obrigatórios)
- `tests/Unit/ProductServiceTest.php` (testes de unidade obrigatórios)

---

## ⚙️ Regras para o Codex

- ✅ O código deve ser sempre criado em **inglês** e **sem comentários** de explicação.
- ✅ Siga sempre os padrões do Laravel, não invente estrutura nova.
- ✅ Utilize sempre injeção de dependência via construtor.
- ✅ Utilize `Request` para validação, nunca dentro do controller.
- ✅ Crie `Service` e `Repository` sempre que possível.
- ✅ Crie todos os testes necessários junto com os arquivos.
- ✅ O nome de cada arquivo deve seguir o padrão Laravel.
- ✅ Todas as migrations, requests, controllers, services, repositories e testes devem ser criados com nomes claros e alinhados.
- ✅ As factories devem ser utilizadas apenas em testes de feature.
- ❌ Nos testes unitários, **não utilize `Model::factory()`**. Use instâncias diretas com `new Model([...])` para evitar dependências externas.
- ❌ Nunca utilizar comentários no código.
- ❌ Nunca escrever código em português.
- ❌ Nunca deixar arquivos faltando.

---

## 🌍 Convenções de Linguagem e Nomenclatura

- Todo o **código, nomes de arquivos, nomes de pastas, nomes de classes, métodos e variáveis** devem ser escritos **inteiramente em inglês**.
- Todas as **branches do Git**, **mensagens de commit** e **títulos e descrições de pull requests** também devem ser **escritas 100% em inglês**.
- Nunca misture português com inglês em nenhuma parte do código ou operações do Git.
- Não inclua comentários explicativos a menos que solicitado explicitamente. Mantenha o código limpo e autoexplicativo.

---

## 📚 Documentação da API

- Sempre que uma nova rota for criada ou modificada (em `routes/api.php`), a documentação da API deve ser atualizada.
- A documentação deve estar em `docs/api.md`, no formato Markdown.
- Para cada endpoint, inclua:
  - Método HTTP (GET, POST, PUT, DELETE, etc.)
  - Caminho da rota
  - Campos de entrada com validações (se aplicável)
  - Exemplo de requisição e de resposta (em JSON)
- Toda a documentação deve estar em **inglês**.
- Nunca deixar endpoints sem documentação.


# AGENTS.md

## 🧱 Tecnologias Utilizadas

- Laravel 10.48.29
- PHP 8.1.32
- MySQL (`DB_CONNECTION=mysql`)
- PHPUnit (pré-configurado com `phpunit.xml`)
- Faker (para criação de dados fictícios nos testes)
- Laravel Sanctum (autenticação por token, se necessário)

---

## 📦 Setup e Instalação

Para configurar o ambiente local:

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

Estrutura esperada:

- `tests/Feature/`: testes de rotas, controllers, endpoints
- `tests/Unit/`: testes de regras internas, services ou helpers

Use `Model Factories` e `Faker` para simular dados nos testes.  
Evite valores fixos. Prefira banco em memória (SQLite) nos testes, se possível.

---

## 📁 Estrutura de Pastas

| Caminho                    | Descrição                                    |
|----------------------------|----------------------------------------------|
| `app/Http/Controllers/`    | Controllers da aplicação                     |
| `app/Models/`              | Models Eloquent                              |
| `routes/api.php`           | Rotas da API REST                            |
| `database/migrations/`     | Estrutura do banco de dados                  |
| `database/seeders/`        | Dados fictícios iniciais (opcional)          |
| `tests/Feature/`           | Testes de API e integração                   |
| `tests/Unit/`              | Testes unitários de lógica interna           |

---

## 🤖 Regras para o Codex (Agente de Código)

> ❗ **Siga todas as instruções abaixo com precisão.**

- ✅ Sempre escreva **código limpo, direto e legível**.
- ✅ Toda nomenclatura de classes, arquivos, métodos e variáveis deve ser em **inglês**.
- ✅ **Não crie comentários** de explicação.
- 🚫 **Não crie abstrações desnecessárias** (como serviços ou camadas extras sem necessidade real).
- ✅ **Crie sempre os testes automatizados necessários** para qualquer funcionalidade implementada.
- ✅ Prefira `Feature Tests` para qualquer endpoint, rota ou controller criado.
- ✅ Use `Unit Tests` apenas para lógica puramente interna (ex: regras em Services, Helpers).
- ✅ Utilize `Model Factories` com `Faker` para geração de dados nos testes.
- ✅ Use comandos como `php artisan make:controller`, `make:model`, `make:test`, etc.
- ✅ Nomeie branches com o prefixo `codex/`, por exemplo: `codex/add-student-endpoint`.
- ✅ Commits devem ser claros e objetivos, como:
  - `Add GET /api/students endpoint`
  - `Create StudentController with test coverage`
- 🚫 **Nunca adicione dependências externas sem autorização.**
- 🚫 **Não edite arquivos de configuração global** (como `app.php`, `config/database.php`, etc) sem instrução explícita.
- 🚫 **Não altere estrutura de diretórios** já existente no projeto.

---

## ✨ Estilo de Código

- Siga o padrão **PSR-12**.
- Use Laravel Pint para formatação de código:
  ```bash
  ./vendor/bin/pint
  ```
- Use nomes objetivos em inglês para variáveis, métodos e arquivos (ex: `getAllStudents`, `storeUser`, `StudentController`).
- Evite comentários desnecessários. O código deve se explicar sozinho.

---

Este arquivo serve como guia para agentes automatizados (como Codex do ChatGPT) e para desenvolvedores que colaborarem com este repositório.  
**Siga todas as orientações para manter a padronização, qualidade e confiabilidade do código.**

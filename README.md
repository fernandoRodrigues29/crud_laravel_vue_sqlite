# CRUD Laravel 9 + Vue 2 + SQLite

[![Laravel](https://img.shields.io/badge/Laravel-9.x-red.svg)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-2.x-green.svg)](https://vuejs.org)
[![PHP](https://img.shields.io/badge/PHP-7.4.16%2B-blue.svg)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-lightgrey.svg)](https://sqlite.org)

Sistema CRUD completo com **Laravel 9 (API RESTful)** no backend e **Vue 2 + Vue Router + Axios** no frontend, usando **SQLite** como banco de dados.  
Projeto ideal como base/boilerplate para novos sistemas full-stack com Laravel + Vue.

## Funcionalidades

- CRUD completo de itens (Create, Read, Update, Delete)
- API RESTful protegida por validação
- Frontend SPA com Vue 2 + Bootstrap 4
- Banco de dados SQLite (zero configuração)
- Migrações e seeders prontos
- Validação de formulários no backend (Form Requests)
- Mensagens de feedback com Toast (sweetalert2)

## Pré-requisitos

- PHP >= 7.4.16 (testado até 8.3)
- Composer
- Node.js + NPM
- Git

## Instalação Rápida (menos de 5 minutos)

```bash
# 1. Clone o repositório
git clone https://github.com/fernandoRodrigues29/crud_laravel_vue_sqlite.git
cd crud_laravel_vue_sqlite

# 2. Instale as dependências do PHP
composer install

# 3. Copie o arquivo de ambiente
cp .env.example .env

# 4. Crie o banco SQLite (arquivo será criado automaticamente)
touch database/database.sqlite

# 5. Rode as migrations + seeders (cria tabela + dados de exemplo)
php artisan migrate --seed

# 6. Instale as dependências do frontend
npm install

# 7. Compile os assets
npm run dev
# ou npm run watch (durante desenvolvimento)

# 8. Inicie o servidor
php artisan serve
Acesse: http://localhost:8000
Estrutura de Pastas Principal
textapp/
├── Http/Controllers/Api/ItemController.php     → API REST
├── Models/Item.php                            → Eloquent Model
resources/
├── js/
│   ├── app.js                                 → Bootstrap Vue
│   ├── components/                            → Componentes Vue
│   └── router/index.js                        → Vue Router
database/
├── migrations/                                → Tabela items
├── seeders/ItemSeeder.php                     → Dados de exemplo
routes/
├── api.php                                    → Rotas da API
└── web.php                                    → Rotas do frontend Vue
Endpoints da API



































MétodoURLDescriçãoGET/api/itemsLista todos os itensGET/api/items/{id}Mostra um itemPOST/api/itemsCria novo itemPUT/api/items/{id}Atualiza itemDELETE/api/items/{id}Remove item
Tecnologias Utilizadas

Laravel 9.x
Vue.js 2.6 + Vue Router
Axios
Bootstrap 4 + Bootswatch (tema Cyborg)
SweetAlert2 (toasts)
Laravel Mix (webpack)
SQLite (banco em arquivo único)

Comandos Úteis
Bash# Limpar cache (caso precise)
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Reconstruir assets em produção
npm run production

# Rodar testes (se adicionar)
php artisan test

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Vue 2 + Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="container mt-5">
        <h1 class="mb-4">Gerenciar Produtos</h1>

        <!-- Formulário -->
        <div class="card mb-4">
            <div class="card-header">
                @{{ editing ? 'Editar' : 'Novo' }} Produto
            </div>
            <div class="card-body">
                <form @submit.prevent="saveProduct">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" v-model="form.name"
                               :class="{ 'is-invalid': errors.name }">
                        <div class="invalid-feedback" v-if="errors.name">
                            @{{ errors.name[0] }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" v-model="form.description"
                                  :class="{ 'is-invalid': errors.description }" rows="3"></textarea>
                        <div class="invalid-feedback" v-if="errors.description">
                            @{{ errors.description[0] }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="price" v-model="form.price"
                               :class="{ 'is-invalid': errors.price }">
                        <div class="invalid-feedback" v-if="errors.price">
                            @{{ errors.price[0] }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        @{{ editing ? 'Atualizar' : 'Salvar' }}
                    </button>
                    <button type="button" class="btn btn-secondary" @click="resetForm" v-if="editing">
                        Cancelar
                    </button>
                </form>
            </div>
        </div>

        <!-- Lista de Produtos -->
        <div class="card">
            <div class="card-header">
                Lista de Produtos
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <td>@{{ product.name }}</td>
                            <td>@{{ product.description }}</td>
                            <td>R$ @{{ product.price }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" 
                                        @click="editProduct(product)">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                        @click="deleteProduct(product.id)">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        <tr v-if="products.length === 0">
                            <td colspan="4" class="text-center">Nenhum produto cadastrado</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
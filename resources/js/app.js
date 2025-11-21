require('./bootstrap');
import Vue from 'vue';

// Componente principal
new Vue({
    el: '#app',
    data: {
        products: [],
        form: {
            id: null,
            name: '',
            description: '',
            price: ''
        },
        editing: false,
        errors: {}
    },
    mounted() {
        this.loadProducts();
    },
    methods: {
        async loadProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data;
            } catch (error) {
                console.error('Erro ao carregar produtos:', error);
            }
        },

        async saveProduct() {
            try {
                this.errors = {};
                
                if (this.editing) {
                    await axios.put(`/api/products/${this.form.id}`, this.form);
                } else {
                    await axios.post('/api/products', this.form);
                }

                this.resetForm();
                this.loadProducts();
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            }
        },

        editProduct(product) {
            this.form = { ...product };
            this.editing = true;
        },

        async deleteProduct(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                try {
                    await axios.delete(`/api/products/${id}`);
                    this.loadProducts();
                } catch (error) {
                    console.error('Erro ao excluir produto:', error);
                }
            }
        },

        resetForm() {
            this.form = {
                id: null,
                name: '',
                description: '',
                price: ''
            };
            this.editing = false;
            this.errors = {};
        }
    }
});
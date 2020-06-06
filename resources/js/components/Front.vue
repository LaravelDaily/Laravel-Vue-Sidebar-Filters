<template>
    <div class="container" :class="{'loading': loading}">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4">Shop Catalog</h1>
                <div class="list-group">
                    <a class="list-group-item" v-for="category in categories">
                        {{ category.name }}
                    </a>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6 mb-4" v-for="product in products">
                        <div class="card h-100">
                            <a href="#">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#">{{ product.name }}</a>
                                </h4>
                                <h5>$ {{ product.price }}</h5>
                                <p class="card-text">{{ product.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                categories: [],
                products: [],
                loading: true
            }
        },

        mounted() {
            this.loadCategories();
            this.loadProducts();
        },

        methods: {
            loadCategories: function () {
                axios.get('/api/categories')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadProducts: function () {
                axios.get('/api/products')
                    .then((response) => {
                        this.products = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>

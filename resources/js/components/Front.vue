<template>
    <div class="container" :class="{'loading': loading}">
        <div class="row" v-if="!loading">
            <div class="col-lg-3 mb-4">
                <h1 class="mt-4">Filters</h1>

                <h3 class="mt-2">Price</h3>
                <div class="form-check" v-for="(price, index) in prices">
                    <input class="form-check-input" type="checkbox" :value="index" :id="'price'+index" v-model="selected.prices">
                    <label class="form-check-label" :for="'price' + index">
                        {{ price.name }} ({{ price.products_count }})
                    </label>
                </div>

                <h3 class="mt-2">Categories</h3>
                <div class="form-check" v-for="(category, index) in categories">
                    <input class="form-check-input" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.categories">
                    <label class="form-check-label" :for="'category' + index">
                        {{ category.name }} ({{ category.products_count }})
                    </label>
                </div>

                <h3 class="mt-2">Manufacturers</h3>
                <div class="form-check" v-for="(manufacturer, index) in manufacturers">
                    <input class="form-check-input" type="checkbox" :value="manufacturer.id" :id="'manufacturer'+index" v-model="selected.manufacturers">
                    <label class="form-check-label" :for="'manufacturer' + index">
                        {{ manufacturer.name }} ({{ manufacturer.products_count }})
                    </label>
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
                prices: [],
                categories: [],
                manufacturers: [],
                products: [],
                loading: true,
                selected: {
                    prices: [],
                    categories: [],
                    manufacturers: []
                }
            }
        },

        mounted() {
            this.loadData();
        },

        watch: {
            selected: {
                handler: function () {
                    this.loadData();
                },
                deep: true
            }
        },

        methods: {
            loadData: function () {
                this.loading = true;

                Promise.all([
                        this.loadCategories(),
                        this.loadManufacturers(),
                        this.loadPrices(),
                        this.loadProducts(),
                        false
                    ])
                    .then((values) => {
                        [this.categories, this.manufacturers, this.prices, this.products, this.loading] = values;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadCategories: function () {
                return axios.get('/api/categories', {
                        params: _.omit(this.selected, 'categories')
                    })
                    .then((response) => response.data.data);
            },

            loadProducts: function () {
                return axios.get('/api/products', {
                        params: this.selected
                    })
                    .then((response) => response.data.data);
            },

            loadManufacturers: function () {
                return axios.get('/api/manufacturers', {
                        params: _.omit(this.selected, 'manufacturers')
                    })
                    .then((response) => response.data.data);
            },

            loadPrices: function () {
                return axios.get('/api/prices', {
                        params: _.omit(this.selected, 'prices')
                    })
                    .then((response) => response.data);
            }
        }
    }
</script>

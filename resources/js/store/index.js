import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
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
    },

    mutations: {
        setProducts (state, data) {
            state.products = data;
        },

        setCategories (state, data) {
            state.categories = data;
        },

        setManufacturers (state, data) {
            state.manufacturers = data;
        },

        setPrices (state, data) {
            state.prices = data;
        },

        setLoading (state, data) {
            state.loading = data;
        }
    },

    actions: {
        loadProducts ({commit, state}) {
            axios.get('/api/products', {
                    params: state.selected
                })
                .then((response) => {
                    commit('setProducts', response.data.data);
                    commit('setLoading', false);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        loadCategories ({commit, state}) {
            axios.get('/api/categories', {
                    params: _.omit(state.selected, 'categories')
                })
                .then((response) => {
                    commit('setCategories', response.data.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        loadManufacturers ({commit, state}) {
            axios.get('/api/manufacturers', {
                    params: _.omit(state.selected, 'manufacturers')
                })
                .then((response) => {
                    commit('setManufacturers', response.data.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        loadPrices ({commit, state}) {
            axios.get('/api/prices', {
                    params: _.omit(state.selected, 'prices')
                })
                .then((response) => {
                    commit('setPrices', response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
})

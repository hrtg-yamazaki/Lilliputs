/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
if (document.getElementsByClassName("category-search")[0]) {
    Vue.component('category-search', require('./components/CategorySearch.vue').default);
    const categorySearch = new Vue({
        el: '.category-search',
    });
}

if (document.getElementsByClassName("roulette")[0]) {
    Vue.component('recipe-roulette', require('./components/RecipeRoulette.vue').default);
    const categorySearch = new Vue({
        el: '.roulette',
    });
}

if (document.getElementsByClassName("ingredient-form")[0]) {
    Vue.component('ingredient-form', require('./components/IngredientFields.vue').default);
    const categorySearch = new Vue({
        el: '.ingredient-form',
    });
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

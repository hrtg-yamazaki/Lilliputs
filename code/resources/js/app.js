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
    const roulette = new Vue({
        el: '.roulette',
    });
}

if (document.getElementsByClassName("js-create-ingredients")[0]) {
    Vue.component('create-ingredients', require('./components/IngredientFields.vue').default);
    const createIngredients = new Vue({
        el: '.js-create-ingredients',
    });
}

if (document.getElementsByClassName("js-edit-ingredients")[0]) {
    Vue.component('edit-ingredients', require('./components/EditIngredients.vue').default);
    const editIngredients = new Vue({
        el: '.js-edit-ingredients',
    });
}

if (document.getElementsByClassName("js-create-processes")[0]) {
    Vue.component('create-processes', require('./components/CreateProcesses.vue').default);
    const editIngredients = new Vue({
        el: '.js-create-processes',
    });
}

if (document.getElementsByClassName("js-edit-processes")[0]) {
    Vue.component('edit-processes', require('./components/EditProcesses.vue').default);
    const editIngredients = new Vue({
        el: '.js-edit-processes',
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

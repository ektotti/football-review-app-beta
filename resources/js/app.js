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

Vue.component('ExampleComponent', require('./components/ExampleComponent.vue').default);
Vue.component('Field', require('./components/Field.vue').default);
Vue.component('TacticalBoardButtons', require('./components/TacticalBoardButtons.vue').default);
Vue.component('TacticalBoard', require('./components/TacticalBoard.vue').default);

Vue.filter('formatPlayerName',function(value){
    console.log(typeof value);
    let nameSeparatedWithSpace = value.split('　');
    console.log(value);
    if([...nameSeparatedWithSpace[0]].length < 5 ){
        return nameSeparatedWithSpace[0];
    }else{
        return nameSeparatedWithSpace[0].substr(0, 4);
    }
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
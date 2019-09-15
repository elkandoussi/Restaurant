
import Vue from 'vue';
import VueRouter from 'vue-router';
import Dessert from '../components/Dessert';
import Plat from '../components/Plat'
import Entree from '../components/Entree';

Vue.use(VueRouter);
//Definition des routes

const routes = [
    {path: '/desserts', component: Dessert },
    {path: '/plats', component: Plat },
    {path: '/entrees', component: Entree }
];

const router = new VueRouter({routes: routes});

//permettre à l'application tout entiere d'étre à l'écoute du router
/*const app = new Vue({
    router,
}).$mount('#app');
*/

new Vue({
    el: '#menu',
    router,
});

require('./boostrap');

import { createApp } from "vue";

import App from "./components/App.vue";

// importamos axios
import VueAxios from "vue-axios";
import axios from "axios";

// config vue router
import { createRouter, createWebHistory, RouterView } from "vue-router";
createApp.arguments(RouterView);
createApp.arguments(VueAxios, axios);

const Home = ()=> import('./components/Home.vue');
const Contacto = ()=> import('./components/Contacto.vue');

// importamos components para el CRUD de usuarios

const Mostrar = ()=> import('./components/users/Mostrar.vue');
const Crear = ()=> import('./components/users/Crear.vue');
const Editar = ()=> import('./components/users/Editar.vue');

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'contacto',
        path: '/contacto',
        component: Contacto
    },
    {
        name: 'mostrarUsers',
        path: '/users',
        component: Mostrar
    },
    {
        name: 'crearUser',
        path: '/crear',
        component: Crear
    },
    {
        name: 'editarUser',
        path: '/editar/:id',
        component: Editar
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes: routes
});


const app = createApp({
    components: {
        App,
    },
}).mount("#app");

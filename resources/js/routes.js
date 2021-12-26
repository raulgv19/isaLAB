import { createRouter } from 'vue-router';

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
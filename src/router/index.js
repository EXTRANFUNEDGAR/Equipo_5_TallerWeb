import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

import Registro from '../components/RegistroForm.vue'
import Editar from '../components/EditarUsuarios.vue'
import Login from '../components/LoginForm.vue'
import Listar from '../components/ListarUsuarios.vue'
import Prueba from '../components/PruebaAc.vue'



const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/registro',
    name: 'Registro',
    component: Registro
  },
  {
    path: '/editar/:id',
    name: 'Editar',
    component: Editar
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/listar',
    name: 'Listar',
    component: Listar
  },
  {
    path: '/prueba',
    name: 'prueba',
    component: Prueba
  },

  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

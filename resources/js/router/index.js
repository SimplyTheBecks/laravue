import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    redirect: '/employees',
  },
  {
    name: 'index',
    path: '/index',
    component: () => import('../views/Index/Index'),
    children: [
      {
        name: 'employees',
        path: '/employees',
        component: () => import('../views/Index/Employees/Employees'),
      },
    ],
  },
  {
    name: 'auth',
    path: '/auth',
    component: () => import('../views/Auth/Auth'),
    children: [
      {
        name: 'login',
        path: '/login',
        component: () => import('../views/Auth/Login/Login'),
      },
    ],
  },
  {
    name: 'page-not-found',
    path: '*',
    component: () => import('../views/PageNotFound'),
  },
];

const router = new VueRouter({
  mode: 'history',
  routes,
});

export default router;

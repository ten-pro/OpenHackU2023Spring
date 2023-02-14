import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';
import Mytodo from '../components/Mytodo.vue';

const routes = [
  {
    path: '/',
    component: Hello,
  },
  {
    path: '/Mytodo',
    component: Mytodo,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
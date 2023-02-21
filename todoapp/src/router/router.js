import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';
import Mytodo from '../components/Mytodo.vue';
import Hakkou from '../components/Hakkou.vue';

const routes = [
  {
    path: '/',
    component: Hello,
  },
  {
    path: '/Mytodo',
    component: Mytodo,
  },
  {
    path: '/Hakkou',
    component: Hakkou,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
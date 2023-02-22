import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';
import Mytodo from '../components/Mytodo.vue';
import Hakkou from '../components/Hakkou.vue';
import Grouptodo from '../components/Grouptodo.vue';

const routes = [
  {
    path: '/',
    component:Mytodo,
  },
  {
    path: '/Mytodo',
    component: Mytodo,
  },
  {
    path: '/Hakkou',
    component: Hakkou,
  },
  {
    path: '/Grouptodo',
    component: Grouptodo,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
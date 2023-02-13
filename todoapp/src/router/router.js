import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';

const routes = [
  {
    path: '/',
    component: Hello,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
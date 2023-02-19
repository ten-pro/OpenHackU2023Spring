import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';
import Achievement from '../components/Achievement.vue'
import Achievement from '../components/Achievement.vue'

const routes = [
  {
    path: '/',
    component: Hello,
  },
  {
    path: '/achievement',
    component: Achievement,
  },
  {
    path: '/achievement',
    component: Achievement,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
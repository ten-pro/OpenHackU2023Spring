import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';
import Achievement from '../components/Achievement.vue'
import CompletionPost from '../components/CompletionPost.vue'

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
    path: '/completionpost',
    component: CompletionPost,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
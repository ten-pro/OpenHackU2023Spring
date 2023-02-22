import { createRouter, createWebHistory } from 'vue-router'
import Hello from '../components/Hello.vue';
import Mytodo from '../components/Mytodo.vue';
import Hakkou from '../components/Hakkou.vue';
import Grouptodo from '../components/Grouptodo.vue';
import Achievement from '../components/Achievement.vue'
import CompletionPost from '../components/CompletionPost.vue'
import Home from '../components/Home.vue'

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
  {
    path:'/home',
    component:Home,
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
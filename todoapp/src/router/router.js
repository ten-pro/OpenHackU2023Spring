import { createRouter, createWebHistory } from 'vue-router'
import Login from'../components/login.vue';
import Create from'../components/accountCreate.vue';
import Mytodo from '../components/Mytodo.vue';
import Hakkou from '../components/Hakkou.vue';
import Grouptodo from '../components/Grouptodo.vue';
import Achievement from '../components/Achievement.vue'
import CompletionPost from '../components/CompletionPost.vue'
import Home from '../components/Home.vue'
import Group from '../components/groupList.vue'
import GroupCreate from '../components/groupCreate.vue'
import Setting from '../components/setting.vue'
import Add from '../components/additional.vue'
import Social from '../components/Social.vue'

const routes = [
  {
    path: '/',
    component:Login,
  },
  {
    path: '/create',
    component:Create,
  },
  {
    path:'/home',
    component:Home,
  },
  {
    path: '/mytodo',
    component: Mytodo,
  },
  {
    path: '/completionpost',
    component: CompletionPost,
  },
  {
    path: '/hakkou',
    component: Hakkou,
  },
  {
    path: '/group',
    component: Group,
  },
  {
    path: '/groupcreate',
    component: GroupCreate,
  },
  {
    path: '/grouptodo',
    component: Grouptodo,
  },
  {
    path: '/setting',
    component: Setting,
  },
  {
    path: '/add',
    component: Add,
  },
  {
    path: '/achievement',
    component: Achievement,
  },
  {
    path: '/social',
    component: Social,
  },
  
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
<template>
  <div>
    <Header />
    <router-view>
    </router-view>
    <Footer />
  </div>
  </template>
<script setup lang="ts">
import Header from "./components/Header.vue"
import Footer from "./components/Footer.vue"
// import groupList from "./components/groupList.vue"
// import groupCreate from "./components/groupCreate.vue"
import setting from "./components/setting.vue"
// import additional from "./components/additional.vue"
//   import HelloWorld from './components/HelloWorld.vue'
//   import login from "./components/login.vue"
// import accountCreate from "./components/accountCreate.vue";
</script>
<style scoped>
</style>
<template>
  <div>
    <div v-show="state.login && state.create">
      <Header />
    </div>
    <router-view>
    </router-view>
    <div v-show="state.login && state.create">
      <Footer />
    </div>
  </div>
  </template>
<script setup lang="ts">
import { reactive } from "vue";
import Header from "./components/Header.vue"
import Footer from "./components/Footer.vue"
//今いるリンクと比較
let state = reactive({
  login:location.href!='http://localhost:5173/',
  create:location.href!='http://localhost:5173/create'
})
</script>
<style scoped>
</style>
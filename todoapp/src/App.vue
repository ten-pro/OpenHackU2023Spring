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
// import HelloWorld from './components/HelloWorld.vue'
</script>
<style scoped>

</style>

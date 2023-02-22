<template>
    <div class="footer">
        <img class="footer_icon" src="./PNG/home.png"/>
        <img class="footer_icon" src="./PNG/todo.png"/>
        <img class="footer_icon" src="./PNG/post.png"/>
        <img class="footer_icon" src="./PNG/group.png"/>
        <img class="footer_icon" src="./PNG/sns.png"/>
    </div>
</template>
<script setup lang="ts">
</script>
<style scoped>
.footer{
    display: flex;
    justify-content: center;
    align-items: center;
    gap:3vw;
    position:fixed;
    /* position: absolute;を変更 */
    width:90vw;
    height:8vh;
    bottom:2vh;
    left:4.7vw;
    border-radius: 50px;
    border: solid 0.7vw black;
    background-color: #33CFC6;
}
.footer_icon{
    width:12vw;
    height:12vw;
}
</style>
  
<template>
    <div class="footer"  v-show="footer.state">
        <a href="/home"><img class="footer_icon" src="./PNG/home.png"/></a>
        <a href="/mytodo"><img class="footer_icon" src="./PNG/todo.png"/></a>
        <a href="/hakkou"><img class="footer_icon" src="./PNG/post.png"/></a>
        <a href="/group"><img class="footer_icon" src="./PNG/group.png"/></a>
        <a href="/Social"><img class="footer_icon" src="./PNG/sns.png"/></a>
        <div class="sita" @click="close">↓</div>
    </div>
    <div class="ue" v-show="footer.state==false" @click="open">↑</div>
</template>
<script setup>
import { reactive } from 'vue';
let footer=reactive({
    state:true,
})
const close=()=>{
    footer.state=false;
}
const open=()=>{
    footer.state=true;
}
</script>
<style scoped>
.footer{
    display: flex;
    justify-content: center;
    align-items: center;
    gap:5vw;
    position:fixed;
    /* position: absolute;を変更 */
    width:90vw;
    height:8vh;
    bottom:2vh;
    left:4.7vw;
    border-radius: 50px;
    border: solid 0.7vw #33CFC6;
    background-color: #33CFC6;
}
.footer_icon{
    width:10vw;
    height:10vw;
}
.sita{
    position: absolute;
    right:1vw;
    color:white;
    font-weight: bold;
    font-size:3vh;
}
.ue{
    position: absolute;
    right:3vw;
    bottom:1vh;
    color:black;
    font-weight: bold;
    font-size:3vh;
}
</style>
  
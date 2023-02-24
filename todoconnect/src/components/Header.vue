<template>
    <div class="header">
        <div class="username">{{ userdata.name }}</div>
        <div class="title">{{ userdata.title }}</div>
    </div>
</template>
<script setup lang="ts">
import axios from 'axios';
import { reactive } from 'vue';

let userdata=reactive({
    name:"",
    title:"",
})

axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
        user_id:2,
        get_header: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function(res){
        userdata.name=res.data.name;
        userdata.title=res.data.title.name;
    })
</script>
<style scoped>
.header{
    display: flex;
    justify-content:space-around;
    align-items: center;
    width:90vw;
    height:6.5vh;
    margin:auto;
    margin-top:2vh;
    left: 4.7vw;
    border-radius: 50px;
    font-size:2.5vh;
    border: solid 0.7vw #33CFC6;
    background-color: #ffffff;
    color:#000000;
    font-weight: bold;
}
</style>
  
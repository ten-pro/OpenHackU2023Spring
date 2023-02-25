<template>
    <div class="header">
        <div class="id">id {{ userdata.id }}</div>
        <div class="username">{{ userdata.name }}</div>
        <div class="title">{{ userdata.title }}</div>
    </div>
</template>
<script setup>
import axios from 'axios';
import { reactive } from 'vue';

let userdata=reactive({
    name:"",
    title:"",
    id:0,
})
let state = reactive({
  login:location.href!='https://candid-zuccutto-3151b7.netlify.app/',
  create:location.href!='https://candid-zuccutto-3151b7.netlify.app/create'
})
if(sessionStorage.getItem("id")==null && state.login && state.create){
    location.href="/";
}
axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
        user_id:sessionStorage.getItem("id"),
        get_header: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function(res){
        try{
        userdata.name=res.data.name;
        userdata.id=sessionStorage.getItem("id");
        userdata.title=res.data.title.name;
        }catch{
            userdata.title="称号なし"
        }
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
  
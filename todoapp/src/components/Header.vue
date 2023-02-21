<template>
    <div class="header">
        <div class="username">上田匡成</div>
        <div class="title">１日目</div>
    </div>
</template>
<script setup lang="ts">
import axios from 'axios';
axios
    .post('http://mp-class.chips.jp/group_task/main.php', {
        user_id:1,
        rank_count: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(
        (response) => (console.log(response.data))
    )
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
    border-radius: 50px;
    font-size:2.5vh;
    border: solid 0.7vw #33CFC6;
    background-color: #ffffff;
    color:#000000;
    font-weight: bold;
}
</style>
  
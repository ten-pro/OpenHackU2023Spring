<template>
    <div>
        <div class="main">
            <div class="topLeft">グループ一覧</div>
            <div class="underLine"></div>
            <div class="list">
                <div class="con">
                    <div class="title">転プロ</div>
                </div>
                <div class="con">
                    <div class="title">転プロ</div>
                </div>
                <div class="con">
                    <div class="title">転プロ</div>
                </div>
                <div class="con">
                    <div class="title">転プロ</div>
                </div>
            </div>
            <div class="around">
            <button class="create">グループを作成</button>
        </div>
        </div>
    </div>
  </template>
  <script setup lang="ts">
  // import HelloWorld from './components/HelloWorld.vue'
  </script>
  <style scoped>
  .main {
    padding: 0 5%;
    margin: 10% 0 0 0;
  }
.topLeft {
    background-color: #5AB4BD;
    color: white;
    font-size: 7vw;
    padding: 10px 0px;
    width: 50%;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    font-weight: bold;
    font-family: sans-serif;
}
.underLine {

width: 100%;
height: 5px;
background-color: #5AB4BD;
}
.list {
    background-color: white;
    width: 100%;
    height: 55vh;
    overflow: scroll;
    -ms-overflow-style: none;
    scrollbar-width: none;
    text-align: center;
    justify-content: center;
}
.list::-webkit-scrollbar {
    display:none;
}
.con {
    margin: 0 auto;
    margin-top: 3%;
    width: 95%;
    border-radius: 10px;
    height: auto;
    border: 1px solid #5AB4BD;
    text-align: center;
}
.title {
margin: 10% 0 10% 0;
font-size: 7vw;
font-family: sans-serif;
font-weight: bold;
}
.create {
    background-color: #5AB4BD;
    color: white;
    font-size: 7vw;
    font-family: sans-serif;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
    margin: 5% 0 0 0;
}
.around {
    text-align: center;
}
  </style>
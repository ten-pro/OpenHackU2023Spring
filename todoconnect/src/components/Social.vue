<template>
      <div class="topbutton">
      <a href="/home">
          <div class="return">
              <img class="left" src="./PNG/left.png" />
          </div>
      </a>
    </div>
      <div class="tabs">
        <div class="todos">
          <div class="tab_content" id="mi_content" v-for="(mitodo,index) in mitodos" :key="index">
            <div class="mikanryou">
              <h3>{{ mitodo.title }}</h3>
              <h4>{{ mitodo.name }}</h4>
              <p>期限日：{{ mitodo.day }}</p>
              <p>ランク：{{ mitodo.rank }}</p>
              <p>ジャンル：{{ mitodo.genre }}</p>
              <p>掲示板許可：{{ mitodo.keiji }}</p>
              <p>完了条件：{{ mitodo.jouken }}</p>
              <p class="syousai" v-show="detail[index]">詳細：{{ mitodo.shousai }}</p>
              <img v-show="detail[index]" :src="mitodo.gazou" style="max-width:50vw;max-height:30vh;"/>
              <img src="./PNG/sita.png" alt="" class="sita" v-show="!sita[index]" @click="zen(index)">
              <img src="./PNG/ue.png" alt="" class="ue" v-show="ue[index]" @click="kakusu(index)">
            </div>
          </div>
        </div>
      </div>
  </template>
  <script setup>
  import axios from 'axios'
  import {reactive} from 'vue'
  import { ref } from "vue";
  let detail = reactive([false])
  let ue = reactive([false])
  let sita = reactive([false])
  let mitodos = reactive([])
  
  // create uploadFile method and expose it to template

  axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
        get_bulletinboard: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function(res){

        try {
          if (res.data!= null) {
            console.log(res.data)
            for (let i = 0; i < res.data.length; i++) {
              let image;
              if(res.data[i].image_pass!=null){
                image=res.data[i].image_pass;
                image="https://mp-class.chips.jp/group_task"+image.slice(1);
              }
              mitodos[i] = {
                id: res.data[i].todo_id,
                title: res.data[i].title,
                name: res.data[i].name,
                state: res.data[i].state,
                day: res.data[i].deadline,
                rank: res.data[i].rank,
                jouken: res.data[i].todo_condition,
                shousai: res.data[i].messsage,
                genre: res.data[i].genre.genre_name,
                genre_color: res.data[i].genre.genre_color,
                keiji: res.data[i].permission==1?"許可":"拒否",
                gazou: image,
              }
            }
            console.log(mitodos)
          }
        } catch (error) {
  
        }
    })

  const zen =(i)=>{
    detail[i] = !detail[i]
    sita[i] = !sita[i]
    ue[i] = !ue[i]
  }
  const kakusu = (i) =>{
    ue[i] = !ue[i]
    detail[i] = !detail[i]
    sita[i] = !sita[i]
  }
  
  </script>
  <style scoped>
  select {
    appearance: none;
    width: 20%;
    padding: 10px;
    border: 1px solid #999;
    background: #eee;
    text-align: center;
    margin-left: 75%;
    margin-top: 2%;
    margin-bottom: 2%;
    border-radius: 10px;
    position: fixed;
    top:20vw;
  }
   .left{
      width:15vw;
      height:4.5vh;
   }
  /*タブ切り替え全体のスタイル*/
  .tabs {
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 90%;
    height: 65vh;
    margin: 0 auto;
    position: fixed;
    top: 37vw;
    left: 5vw;
    overflow: auto;
  }
  .todos{
    width: 100%;
    height: 57vh;
    
  }
  
  /*タブのスタイル*/
  .tab_item {
    width: calc(100%/3);
    height: 50px;
    border-bottom: 3px solid #5ab4bd;
    background-color: #d9d9d9;
    line-height: 50px;
    font-size: 16px;
    text-align: center;
    color: #565656;
    display: block;
    float: left;
    text-align: center;
    font-weight: bold;
    transition: all 0.2s ease;
  }
  .tab_item:hover {
    opacity: 0.75;
  }
  
  /*ラジオボタンを全て消す*/
  input[name="tab_item"] {
    display: none;
  }
  
  /*タブ切り替えの中身のスタイル*/
  .tab_content {
    padding: 20px 20px 20px;
    clear: both;
  }
  
  
  /*選択されているタブのコンテンツのみを表示*/
  #all:checked ~ #mi_content,
  #programming:checked ~ #kari_content,
  #design:checked ~ #kan_content {
    display: block;
  }
  
  /*選択されているタブのスタイルを変える*/
  .tabs input:checked + .tab_item {
    background-color: #5ab4bd;
    color: #fff;
  }
  
  .mikanryou{
    position: relative;
    border: 2px solid #5ab4bd;
    border-radius: 10px;
  }
  .karikanryou{
    position: relative;
    border: 2px solid #5ab4bd;
    border-radius: 10px;
  }
  .kanryou{
    position: relative;
    border: 2px solid #5ab4bd;
    border-radius: 10px;
  }
  .button_area{
    position: absolute;
    top:0vw;
    left:55vw;
    width: 23vw;
    height: 12vh;
  }
  .button_area1{
    position: absolute;
    top:3vw;
    left:55vw;
    width: 23vw;
    height: 12vh;
  }
  .button_area2{
    position: absolute;
    top:3vw;
    left:55vw;
    width: 23vw;
    height: 12vh;
  }
  .button {
        width: 20vw;
        height: 4vh;
        border-radius: 8px;
        font-size: 0.9em;
        background-color: #5ab4bd;
        color: white;
        margin-top: 2vw;
      }
      h3{
        margin-left: 4vw;
      }
      h4{
        margin-left: 4vw;
      }
      p{
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 4vw;
        margin-right: 2vw;
        border-bottom:2px solid #999;
      }
      .sita{
        width: 5vw;
        position: absolute;
        bottom:0px;
        left: 70vw;
      }
      .ue{
        width: 5vw;
        position: absolute;
        bottom: 1vw;
        left: 70vw;
      }
      .sita1{
        width: 5vw;
        position: absolute;
        bottom:0px;
        left: 70vw;
      }
      .ue1{
        width: 5vw;
        position: absolute;
        bottom: 1vw;
        left: 70vw;
      }
      .sita2{
        width: 5vw;
        position: absolute;
        bottom:0px;
        left: 70vw;
      }
      .ue2{
        width: 5vw;
        position: absolute;
        bottom: 1vw;
        left: 70vw;
      }
      .kari_gazou{
        width:50vw;
        height: 20vh;
        padding: 4vw;
      }
  
      .topbutton{
        display: flex;
        align-items: center;
        margin-top:1.2vh;
      }
.return{
  display: flex;
  justify-content: center;
  align-items: center;
  margin-left:5vw;
    width:30vw;
    height:6vh;
    background-color: white;
    border: solid 2px #5ab4bd;
    border-radius: 20px;
  }
  
      /* ポストの方 */
  .left{
    width:15vw;
    height:4.5vh;
  }
  .image_area{
    width:90vw;
    height:55vh;
    margin:auto;
    margin-top:3vh;
    background-color: white;
    border: solid 2px #5AB4BD;
    border-radius: 10px;
    overflow: auto;
  }
  .title{
    margin-top:3vh;
    margin-bottom: 2vh;
    font-size: 4.5vh;
    text-align: center;
    font-weight: bold;
  }
  .subtitle{
    margin-bottom: 3vh;
    font-size:3vh;
    text-align: center;
    font-weight: bold;
  }
  .text{
    text-align: center;
    margin-bottom: 5vh;
  }
  .select{
    font-size:2.5vh;
  }
  .postlabel{
    padding: 1vh 3.5vh;
    color: #ffffff;
    background-color:#5AB4BD;
    cursor: pointer;
  }
  .postinput{
    display: none;
  }
  .upload_button_wrap{
    text-align: center;
    color:#ffffff;
  }
  .upload_button{
    margin-top: 3vh;
    width:30vw;
    height:5vh;
    background-color: #5AB4BD;
    color: white;
    font-weight: bold;
    font-size: 2.5vh;
    border-radius: 120px;
  }
  </style>
  
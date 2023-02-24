<template>
    <div>
      <icon />
      <div class="appName">To Do コネクト</div>
        <div class="main">
        <input type="text" placeholder="@mail" class="mail" v-model="userData.mailaddress">
        <input type="text" placeholder="userName" class="userName" v-model="userData.userName">
        <input type="password" placeholder="password" class="password" v-model="userData.password">
        <button class="login" @click="createAccount">Sign Up</button>
        <div class="error" v-show="userData.error1">入力内容を再確認してくだい</div>
        <div class="error" v-show="userData.error2">全て必須入力です</div>
        <div class="touroku" @click="touroku">登録画面へ</div>
    </div>
    </div>
  </template>
  <script setup lang="ts">
  // import HelloWorld from './components/HelloWorld.vue'
  import icon from './icon.vue'
  import axios from 'axios'
  import { reactive } from "vue"
  let userData = reactive({
    mailaddress: "",
    userName: "",
    password: "",
    error1: false,
    error2: false,
  })
  let createAccount = () => {
    if(userData.mailaddress == '' || userData.userName == '' || userData.password == ''){
userData.error2 = true
    }else{
accountCreate()
    }
  }
  let accountCreate = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    name: userData.userName,
                    pass: userData.password,
                    mail: userData.mailaddress,
                    create_user: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                    if(res.data == false) {
                        userData.error1 = true
                    }else{
                        sessionStorage.setItem('id',res.data);
                        location.href
                    }
                    console.log(res)

                })
  }
  let touroku = () => {
    location.href="/"
  }
  </script>
  <style scoped>
  .appName {
display: block;
    text-align: center;
    font-size: 7vw;
    font-weight: bold;
    margin: 0 auto;
  }
  .main {
    padding: 5% 0 5% 0;
    margin: 10% 10% 5%  5%;
    border-radius: 20px;
    box-shadow: 2px 2px gray;
    background-color: white;
    text-align: center;
  }
  .mail, .userName, .password {
    width: 60vw;
    height: 15vw;
    border: 3px solid #5AB4BD;
    border-radius: 50px;
    display: block;
    font-size: 6vw;
    text-align: center;
    color: #5AB4BD;

    opacity: 0.9;
    margin: 0 auto 5% auto;
  }
  ::placeholder{
    color: #5AB4BD;
    font-size: 9vw;
  }
  .login {
    background-color: #5AB4BD;
    width: 60vw;
    height: 15vw;
    border-radius: 25px;
    color: white;
    font-size: 9vw;
    font-weight: bold;
  }
  .touroku {
    color: blue;
    text-decoration: underline;
    font-size: 7vw;
    margin: 5% auto 0 auto;
    font-weight: bold;
  }
  .error {
    color: red;
    font-size: 5vw;
    margin: 3% auto 0 auto;
  }
  </style>
  
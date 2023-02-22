<template>
    <div>
        <div class="main">
        <input type="text" placeholder="@mail" class="mail" v-model="userData.mailaddress">
        <input type="password" placeholder="password" class="pass" v-model="userData.password">
        <button @click="loginCheck" class="login">Login</button>
        <div class="error" v-show="userData.loginerror">ログイン失敗</div>
        <div class="shinkiVue" @click="accountCreate">登録画面へ</div>
        </div>
    </div>
  </template>
  <script setup lang="ts">
  // import HelloWorld from './components/HelloWorld.vue'
  import axios from 'axios'
  import { reactive } from "vue"
  let userData = reactive({
    mailaddress: "",
    password: "",
    loginerror: false
  })
//   let mailaddress = reactive({value: ""});
//   let password = reactive({value: ""});
//   let loginerr = reactive({ message: false});
let loginCheck = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                      mail: userData.mailaddress,
                      pass: userData.password,
                    login_user: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (res) {
                    if(res.data == false) {
                        userData.loginerror = true
                    }else{
                        sessionStorage.setItem('id',res.data.id);
                        // location.href
                    }
                   console.log(res)
                })
}
const accountCreate = () => {
  location.href="create"
}
  </script>
  <style scoped>
  .main {
    margin: 50% auto;
    text-align: center;
  }
  .mail {
    width: 60vw;
    height: 15vw;
    border: 5px solid #5AB4BD;
    border-radius: 50px;
    display: block;
    font-size: 6vw;
    text-align: center;
    color: #5AB4BD;
    font-weight: bold;
    opacity: 0.9;
    margin: 0 auto 5% auto;
  }
  ::placeholder{
    color: #5AB4BD;
    font-size: 9vw;
  }
  .pass {
    width: 60vw;
    height: 15vw;
    border: 5px solid #5AB4BD;
    border-radius: 50px;
    display: block;
    font-size: 6vw;
    text-align: center;
    color: #5AB4BD;
    font-weight: bold;
    opacity: 0.9;
    margin: 0 auto 5% auto;
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
  .shinkiVue {
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
  
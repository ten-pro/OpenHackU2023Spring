<template>
    <div>
        <div class="main">
            <a href="/setting">
                <div class="return">
                    <img class="left" src="./PNG/leftorange.png" />
                </div>
            </a>
            <div class="con">
                <div class="groupName">
                    <div class="name">ユーザーID</div>
                    <input type="text" class="gName" v-model="userData.id">
                </div>
                <button class="display" @click="getUserName">ユーザー名表示</button>
                <div class="textarea" v-show="userData.show1">{{ userData.userName }}</div>
                <div class="underLine" v-show="userData.show2"></div>
            </div>
            <button class="create" @click="addMember">メンバー追加</button>
        </div>
    </div>
</template>
  <script setup lang="ts">
  // import HelloWorld from './components/HelloWorld.vue'
  import axios from 'axios'
  import { reactive } from 'vue'
  import swal from 'sweetalert'
  let userData = reactive({
    id: '',
userName: '',
show1: false,
show2: false})
  let back = () => {
    location.href
  }
  let addMember = () => {
            axios
                .post('https://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.id,
                    group_id: sessionStorage.getItem("group_id"),
                    add_affiliation: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res) {
                    if(res.data == false) {
                        swal("失敗","すでに所属しているか、存在しないユーザーです。","error");
                    }else{
                        swal("追加成功","グループ一覧画面に遷移します。","success",)
                        .then(function() {
                            location.href = "/group"
                        })
                    }
                    console.log(res)
                })
            }
            let getUserName = () => {
                axios
                .post('https://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.id,
                    get_username: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                    userData.userName = res.data
                    userData.show1 = true
                    userData.show2 = true
                    console.log(res)
                })
            }
           
  </script>
  <style scoped>
  .main {
    margin: 10% 5%;
  }
  .return{
    margin-left:5vw;
    display: flex;
    justify-content: center;
    align-items: center;
    width:30vw;
    height:6vh;
    background-color: white;
    border: solid 2px #e58900;
    border-radius: 20px;
  }
 .left{
    width:15vw;
    height:4.5vh;
 }
  .arrow {
    border: 1px solid #e58900;
    background-color: white;
    width: 25vw;
    height: 10vw;
    text-align: center;
    border-radius: 10px;
    cursor: pointer;
  }
.con {
    width: 100%;
    height: 40vh;
    background-color: white;
    border-radius: 10px;
}
.groupName {
    margin: 5% 0 0 0;
    display: flex;
    padding: 10% 5% 0 5%;  
    align-items: center;  
}
.name {
    font-family: sans-serif;
    font-weight: bold;
    margin: 0 10% 0 0;
    vertical-align:baseline;
    white-space: nowrap;
    font-size: 5vw;
}
.gName {
    border: 1px solid #e58900;
    border-radius: 10px;
    height: 6vh;
    width: 100%;
    font-size: 7vw;
    padding: 0 3%;
}

.create {
    background-color: #e58900;
    color: white;
    border-radius: 10px;
    padding: 3% 7%;
    font-size: 7vw;
    font-family: sans-serif;
    font-weight: bold;
    margin: 8% auto 0 auto;
    display: flex;
    cursor: pointer;
}
.display {
    margin: 15% auto 0 auto;
    box-shadow: 2px 2px rgb(129, 128, 128);
    padding: 3% 5%;
    display: flex;
    background-color: #e58900;
    color: white;
    font-size: 6vw;
    font-weight: bold;
    font-family: sans-serif;
    border-radius: 10px;
    cursor: pointer;
}
.underLine {
    width: 70%;
    margin: 0% auto;
    height: 2px;
    background-color: #e58900;
}
.textarea {
    text-align: center;
    margin: 10% auto 0 auto;
    font-size: 7vw;
    font-family: sans-serif;
}
  </style>
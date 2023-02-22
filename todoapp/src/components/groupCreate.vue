<template>
    <div>
        <div class="main">
            <a href="/group">
                <div class="return">
                    <img class="left" src="./PNG/left.png" />
                </div>
            </a>
            <div class="con">
                <div class="groupName">
                    <div class="name">グループ名</div>
                    <input type="text" class="gName" v-model="group.groupName">
                </div>
                <div class="userId">
                    <div class="id">ユーザーID</div>
                    <input type="text" class="uName" v-model="group.userID">
                </div>
                <div class="plusCircle">
                    <div class="plus" @click="add">+</div>
                </div>
            </div>
            <button class="create" @click="groupInfo">グループ作成</button>
        </div>
    </div>
</template>
  <script setup lang="ts">
  // import HelloWorld from './components/HelloWorld.vue'
  import axios from 'axios'
  import { reactive } from "vue"
  import swal from 'sweetalert'
  let group = reactive({
    groupName: "",
    userID: ""
  })
  let back = () => {
    location.href
  }
  let add = () => {

  }
  let groupInfo = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    name: group.groupName,
                    user_id: group.userID,
                    create_group: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                    if(res.data == false) {
                        swal("作成失敗","入力を再度確認してください。","error");
                    }else{
                        swal("作成成功","グループ一覧画面に遷移します。","success",)
                        .then(function() {
                            location.href = ""
                        })
                    }
                    console.log(res.data)
                })
  }

  </script>
  <style scoped>
  .main {
    margin: 15% 5%;
  }
  .return{
    margin-left:5vw;
    display: flex;
    justify-content: center;
    align-items: center;
    width:30vw;
    height:6vh;
    background-color: white;
    border: solid 2px #5AB4BD;
    border-radius: 20px;
  }
 .left{
    width:15vw;
    height:4.5vh;
 }
  .arrow {
    border: 1px solid #5AB4BD;
    background-color: white;
    width: 25vw;
    height: 10vw;
    text-align: center;
    border-radius: 10px;
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
    margin: 0 5% 0 0;
    vertical-align:baseline;
    white-space: nowrap;
    font-size: 7vw;
}
.gName {
    border: 1px solid #5AB4BD;
    border-radius: 10px;
    height: 6vh;
    width: 100%;
    font-size: 7vw;
    padding: 0 3%;
}
.userId {
    margin: 5% 0 0 0;
    display: flex;
    padding: 10% 5% 0 5%;  
    align-items: center;  
}
.id {
    font-family: sans-serif;
    font-weight: bold;
    margin: 0 5% 0 0;
    vertical-align:baseline;
    white-space: nowrap;
    font-size: 7vw;
}
.uName {
    border: 1px solid #5AB4BD;
    border-radius: 10px;
    height: 6vh;
    width: 100%;
    font-size: 7vw;
    padding: 0 3%;
}
.plusCircle {
    width: 50px;
    height: 50px;
    border-radius: 100px;
    border: 1px solid #5AB4BD;
    text-align: center;
    margin: 5% auto 0 auto;
    cursor: pointer;
}
.plus {
    color: #5AB4BD;
    font-size: 10vw;
    font-weight: bold;
}
.create {
    background-color: #5AB4BD;
    color: white;
    border-radius: 10px;
    padding: 3% 7%;
    font-size: 7vw;
    font-family: sans-serif;
    font-weight: bold;
    margin: 10% auto ;
    display: flex;
}
  </style>
<template>
    <div>
        <div class="main">
            <a href="/group">
                <div class="return">
                    <img class="left" src="./PNG/leftorange.png" />
                </div>
            </a>
            <div class="con">
                <div class="groupName">
                    <div class="name">グループ名</div>
                    <input type="text" class="gName" v-model="group_name[0]">
                </div>
                <div class="userId">
                    <div class="id">ユーザーID</div>
                    <input type="text" class="uName" v-model="addid[0]">
                </div>
                <div class="plusCircle">
                    <div class="plus" @click="add">+</div>
                </div>
                <div v-for="(user,index) in users" :key="index" class="tuika">
                   <p class="userhai">{{ user }}</p> 
                </div>
            </div>
            <button class="create" @click="groupInfo">グループ作成</button>
        </div>
    </div>
</template>
  <script setup>
  import axios from 'axios'
  import { reactive } from "vue"
  import swal from 'sweetalert'
  let group_name = reactive([])
  let userid = reactive([])
  let users= reactive([])
  let addid=reactive([])
  let back = () => {
    location.href
  }
  const add =()=> {
            axios
                .post('https://mp-class.chips.jp/group_task/main.php', {
                    user_id: addid[0],
                    get_username: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                    console.log(res.data)
                    userid[userid.length]=addid[0];
                    users[users.length]=res.data;
                })
  }
  const groupInfo = () => {
    console.log(group_name[0])
    console.log(userid)
            axios
                .post('https://mp-class.chips.jp/group_task/main.php', {
                    name: group_name[0],
                    user_id: userid,
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
                            location.href = "/group"
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
    position: absolute;
    top: 20vw;
    left: 2vw;
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
  }
.con {
    position: relative;
    top: 3vw;
    width: 100%;
    height: 50vh;
    background-color: white;
    border-radius: 10px;
    overflow: auto;
}
.groupName {
    /* margin: 5% 0 0 0; */
    display: flex;
    padding: 4vw;
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
    border: 1px solid #e58900;
    border-radius: 10px;
    height: 6vh;
    width: 100%;
    font-size: 7vw;
    padding: 0 3%;
}
.userId {
    /* margin: 5% 0 0 0; */
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
    border: 1px solid #e58900;
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
    border: 1px solid #e58900;
    text-align: center;
    margin: 7% auto 0 auto;
    cursor: pointer;
}
.plus {
    color: #e58900;
    font-size: 10vw;
    font-weight: bold;
}
.create {
    background-color: #e58900;
    color: white;
    border-radius: 10px;
    padding: 3% 7%;
    font-size: 7vw;
    font-family: sans-serif;
    font-weight: bold;
    margin: 10% auto ;
    display: flex;
}
.tuika{
    position: relative;
    left: 30vw;
}
.userhai{
    font-size: 4vw;
    font-weight: bold;
    font-family: sans-serif;
}
  </style>
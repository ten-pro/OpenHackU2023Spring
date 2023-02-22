<template>
    <div>
        <div class="main">
            <div class="arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" fill="#5AB4BD"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </div>
            <div class="con">
                <div class="groupName">
                    <div class="name">グループ名変更</div>
                    <input type="text" class="gName">
                </div>
                <div class="memberAll">メンバー一覧</div>
                <div class="over">
                <div class="memberList" v-for="(item, index) in userData.membarArray" :key="index">
                    <div class="memName">{{ item }}</div>
                    <button class="delete" @click="deleteMember(index)">削除</button>
                </div>
            </div>
                <!-- <div class="memberList">
                    <div class="memName">メンバー２</div>
                    <button class="delete">削除</button>
                </div>
                <div class="memberList">
                    <div class="memName">メンバー３</div>
                    <button class="delete">削除</button>
                </div> -->
            </div>
            <button class="create" @click="deleteMember">グループ脱退</button>
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
    membarLength: '',
    membarArray:[new Array(length)],
    session_group_id: 13,
    usr_id: '',
  })
let addMember = () => {
    location.href
}
                axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: 2,
                    get_user_information: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res) {
                    let p = 0
                    if(res.data[p].group_id == userData.session_group_id){
                    userData.membarLength = res.data[0].group_user_list.length
                    for(let i = 0; i < res.data[0].group_user_list.length; i ++) {
                        userData.membarArray[i] = res.data[p].group_user_list[i].name
                    }
                }
                    console.log(res.data)
                })

            let deleteMember = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.usr_id,
                    group_id: 13,
                    delete_affiliation: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                    if(res.data[0] == true){
                        swal('脱退しました。','遷移します。','success')
                        .then(function(){
                            location.href
                        })
                    }
                }
                )}
  </script>
  <style scoped>
  .main {
    margin: 15% 5%;
  }
  .over {
    overflow: scroll;
    width: 100%;
    height: 50%;
  }
  .over::-webkit-scrollbar {
    display: none;
  }
  .arrow {
    border: 1px solid #5AB4BD;
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
    margin: 0 5% 0 0;
    vertical-align:baseline;
    white-space: nowrap;
    font-size: 5vw;
}
.gName {
    border: 1px solid #5AB4BD;
    border-radius: 10px;
    height: 6vh;
    width: 100%;
    font-size: 7vw;
    padding: 0 3%;
}

.create {
    background-color: #5AB4BD;
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
.memberAll {
    margin: 5% 5% 2% 5%;
    font-weight: bold;
    font-family: sans-serif;
    font-size: 6vw;

}
.memberList {
    display: flex;
    margin: 4% 0 0 0;
    align-items: center;
    width:100%;
    justify-content: space-around;
}
.memName {
    font-size: 5vw;
    font-weight: bold;
    font-family: sans-serif;
    margin: 0 ;
}
.delete {
    background-color: #5AB4BD;
    color: white;
    border-radius: 10px;
    padding: 1% 9%;
    font-size: 5vw;
    font-family: sans-serif;
    font-weight: bold;
    cursor: pointer;
}
  </style>
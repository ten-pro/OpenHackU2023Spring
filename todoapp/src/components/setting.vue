<template>
    <div>
        <div class="main">
            <a href="/grouptodo">
                <div class="return" @click="rename">
                    <img class="left" src="./PNG/left.png" />
                </div>
            </a>
            <div class="con">
                <div class="groupName">
                    <div class="name">グループ名変更</div>
                    <input type="text" class="gName" v-model="userData.groupName">
                </div>
                <div class="memberAll">メンバー一覧</div>
                <div class="over">
                <div class="memberList" v-for="(item, index) in userData.membarArray" :key="index">
                    <div class="memName">{{ item }}</div>
                    <button class="delete" @click="deleteID(index)">削除</button>
                </div>
            </div>
            </div>
            <button class="create" @click="dattai">グループ脱退</button>
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
    session_user_id: 2,
    groupName: '',
    deleteName: [''],
    deleteID: '',
    // session_group_id: sessionStorage.getItem("group_id"),
    session_group_id: 12,
  })
let addMember = () => {
    location.href="/add"
}
let rename = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.session_user_id,
                    group_id: userData.session_group_id,
                    group_name: userData.groupName,
                    rename_group: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    // (response) => (console.log(response.data))
                )
}
function deleteID(index: number) {
    // console.log(userData.membarArray[index])
    userData.deleteName = userData.membarArray[index]
    // console.groupCollapsed(userData.deleteName)
    axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:userData.session_user_id,
                    get_user_information: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res) {
                    for(let i = 0; i < res.data[0].group_user_list.length; i ++) {
                        if(userData.deleteName == res.data[0].group_user_list[i].name) {
                            userData.deleteID = res.data[0].group_user_list[i].id
                            // console.log(userData.deleteID)
                        }
                    }
                    console.log(res)
                    deleteUser()
                }
                
                )
}

let deleteUser = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.deleteID,
                    group_id: userData.session_group_id,
                    delete_affiliation: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                    location.href = ''
                    // 再読み込みして欲しい
                }
                )
            }
                // グループ情報を取得
                axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.session_user_id,
                    get_user_information: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res) {
                    userData.groupName = res.data[0].group_name
                    let p = 0
                    if(res.data[p].group_id == userData.session_group_id){
                    userData.membarLength = res.data[0].group_user_list.length
                    for(let i = 0; i < res.data[0].group_user_list.length; i ++) {
                        userData.membarArray[i] = res.data[p].group_user_list[i].name
                    }}
                })


            let dattai = () => {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: userData.session_user_id,
                    group_id: userData.session_group_id,
                    delete_affiliation: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(res){
                        swal('脱退しました。','遷移します。','success')
                        .then(function(){
                            location.href="/group"
                        })
                    
                }
                )}
  </script>
  <style scoped>
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
  .main {
    margin: 10% 5%;
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
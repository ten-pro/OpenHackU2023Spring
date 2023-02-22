<template>
    <div>
        <div class="main">
            <!-- <span class="topLeft">グループ一覧</span> -->
            <div class="topLeft">グループ一覧</div>
            <div class="underLine"></div>
            <div class="list">
                <div v-for="(item, groupIndex) in groupData.groupName" :key="groupIndex" class="con">
                    <div class="title">{{ item }}</div>
                    <div class="over">
                    <div class="members">
                    <div v-for="(member, memberIndex) in groupData.groupMember[groupIndex]" :key="memberIndex"
                        class="members">
                        {{ member }} &nbsp;&nbsp;
                    </div>
                </div>
            </div>
            </div>
        </div>
            <div class="around">
                <button class="create" @click="create">グループを作成</button>
            </div>
        </div>

    </div>
</template>
  <script setup lang="ts">
import axios from 'axios'
import { reactive } from "vue"
let groupData = reactive({
    groupLength: '',
    memberLength: '',
    groupName: new Array(length),
    groupMember: [[new Array(length)],[]],
})
let create = () => {
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
                .then(function(res){
                    groupData.groupLength = res.data.length;
                    for(let i = 0;i < res.data.length; i ++) {
                        groupData.groupName[i] = res.data[i].group_name;
                        groupData.memberLength = res.data[i].group_user_list.length
                        for(let j = 0; j < res.data[i].group_user_list.length; j ++){
                            groupData.groupMember[i][j] = res.data[i].group_user_list[j].name
                        }
                    }
                    console.log(res.data[1].group_user_list.length)
                })
  </script>
  <style scoped>
  .over {
    overflow-x: scroll;
    padding: 0 5%;
    margin: 0 auto 3% auto;
    width: 80% !important;
  }
  .over::-webkit-scrollbar {
    display: none;
  }
  .members {
    display: flex;
    text-align: center;
    font-family: sans-serif;
    font-size: 5vw;
    white-space: nowrap;
  }
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
margin: 10% 0 5% 0;
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
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
                <div class="memberList">
                    <div class="memName">メンバー１</div>
                    <button class="delete">削除</button>
                </div>
                <div class="memberList">
                    <div class="memName">メンバー２</div>
                    <button class="delete">削除</button>
                </div>
                <div class="memberList">
                    <div class="memName">メンバー３</div>
                    <button class="delete">削除</button>
                </div>
            </div>
            <button class="create">グループ脱退</button>
            <button class="create">メンバー追加</button>
        </div>
    </div>
</template>
  <script setup lang="ts">
  // import HelloWorld from './components/HelloWorld.vue'
  </script>
  <style scoped>
  .main {
    margin: 15% 5%;
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
    margin: 5%;
    font-weight: bold;
    font-family: sans-serif;
    font-size: 6vw;

}
.memberList {
    display: flex;
    margin: 6% 0 0 0;
    align-items: center;
    width:100%;
}
.memName {
    font-size: 5vw;
    font-weight: bold;
    font-family: sans-serif;
    margin: 0 20%;
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
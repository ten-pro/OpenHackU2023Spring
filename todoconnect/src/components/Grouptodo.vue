<template>
  <div>
    <div class="topbutton">
      <a href="/group">
          <div class="return">
              <img class="left" src="./PNG/leftorange.png" />
          </div>
      </a>
      <a href="/setting"><div class="setting">設定</div></a>
    </div>
    <!-- <select>
      <option value="">並び替え</option>
      <option value="">昇順</option>
      <option value="">降順</option>
    </select> -->
    
    <div class="tabs">
      <input id="all" type="radio" name="tab_item" checked @click="mihai()">
      <label class="tab_item" for="all">未完了</label>
      <input id="programming" type="radio" name="tab_item" @click="karihai()">
      <label class="tab_item" for="programming">仮完了</label>
      <input id="design" type="radio" name="tab_item" @click="kanhai()">
      <label class="tab_item" for="design">完了</label>
      <div class="todos">
        <h3 style="text-align: center;" v-show="nulls.mi && swith.mi">現在未完了TODOはありません</h3>
        <div class="tab_content" id="mi_content" v-for="(mitodo,index) in mitodos" :key="index" v-show="swith.mi">
          <div class="mikanryou">
            <h3>{{ mitodo.title }}</h3>
            <h4>{{ mitodo.name }}</h4>
            <p :class="{tyouka:date.year>=mitodo.day.slice(0,4) && date.month>=mitodo.day.slice(5,7) && date.day>mitodo.day.slice(8,10)}">期限日：{{ mitodo.day.slice(0,11) + mitodo.day.slice(19) }}</p>
            <p>ランク：{{ mitodo.rank }}</p>
            <p>ジャンル：{{ mitodo.genre }}</p>
            <p>掲示板許可：{{ mitodo.keiji }}</p>
            <p>完了条件：{{ mitodo.jouken }}</p>
            <p v-show="mitodo.comment!=null">拒否理由：{{ mitodo.comment }}</p>
            <p class="syousai" v-show="detail[index]">詳細：{{ mitodo.shousai }}</p>
            <img src="./PNG/sitaorange.png" alt="" class="sita" v-show="!sita[index]" @click="zen(index)">
            <img src="./PNG/ueorange.png" alt="" class="ue" v-show="ue[index]" @click="kakusu(index)">
          </div>
        </div>
        <h3 style="text-align: center;" v-show="nulls.kari && swith.kari">現在仮完了TODOはありません</h3>
        <div class="tab_content" id="kari_content" v-for="(karitodo,index) in karitodos" :key="index" v-show="swith.kari">
          <div class="karikanryou">
            <h3>{{ karitodo.title }}</h3>
            <h4>{{ karitodo.name }}</h4>
            <p :class="{tyouka:date.year>=karitodo.day.slice(0,4) && date.month>=karitodo.day.slice(5,7) && date.day>karitodo.day.slice(8,10)}">期限日：{{ karitodo.day.slice(0,11) + karitodo.day.slice(19) }}</p>
            <p>ランク：{{ karitodo.rank }}</p>
            <p>ジャンル：{{ karitodo.genre }}</p>
            <p>掲示板許可：{{ karitodo.keiji }}</p>
            <p>完了条件：{{ karitodo.jouken }}</p>
            <p class="syousai" v-show="detail[index]">詳細：{{ karitodo.shousai }}</p>
            <img  alt="">
            <div class="button_area">
              <button class="button kan" @click="okfunk(index)">承認</button>
              <!-- <paper-ripple fit></paper-ripple> -->
              <button class="button saku" @click="nofunk(index)">拒否</button>
            </div>
            <img v-show="detail[index]" :src="karitodo.gazou" style="max-width:50vw;max-height:30vh;"/>
            <img src="./PNG/sitaorange.png" alt="" class="sita1" v-show="!sita[index]" @click="zen(index)">
            <img src="./PNG/ueorange.png" alt="" class="ue1" v-show="ue[index]" @click="kakusu(index)">
          </div>
        </div>
        <h3 style="text-align: center;" v-show="nulls.kan && swith.kan">現在完了TODOはありません</h3>
        <div class="tab_content" id="kan_content" v-for="(kantodo,index) in kantodos" :key="index" v-show="swith.kan">
          <div class="kanryou">
            <h3>{{ kantodo.title }}</h3>
            <h4>{{ kantodo.name }}</h4>
            <p>期限日：{{ kantodo.day.slice(0,11) + kantodo.day.slice(19) }}</p>
            <p>ランク：{{ kantodo.rank }}</p>
            <p>ジャンル：{{ kantodo.genre }}</p>
            <p>掲示板許可：{{ kantodo.keiji }}</p>
            <p>完了条件：{{ kantodo.jouken }}</p>
            <p v-show="kantodo.comment!=null">承認理由:{{ kantodo.comment }}</p>
            <p class="syousai" v-show="detail[index]">詳細：{{ kantodo.shousai }}</p>
            <img v-show="detail[index]" :src="kantodo.gazou" style="max-width:50vw;max-height:30vh;"/>
            <img src="./PNG/sitaorange.png" alt="" class="sita2" v-show="!sita[index]" @click="zen(index)">
            <img src="./PNG/ueorange.png" alt="" class="ue2" v-show="ue[index]" @click="kakusu(index)">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" v-show="modalstate.show" >
    <div class="modal-content">
      <img class="batu" src="./PNG/batu.png" @click="modalstate.show=false">
      <div class="top">
        理由を書いてください
      </div>
      <div class="modal_title">
        {{modalstate.state}}
      </div>
      <div class="textareawrap">
      <textarea class="textarea" v-model="modalstate.text"></textarea>
      </div>
      <div style="text-align:center;">
        <button class="submit" @click="submit">
          送信
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
import axios from 'axios'
import {reactive} from 'vue'
let detail = reactive([false])
let ue = reactive([false])
let sita = reactive([false])
let swith = reactive({
  mi:true,
  kari:false,
  kan:false
})
let mitodos = reactive([])
let karitodos = reactive([])
let kantodos = reactive([])
let modalstate = reactive({
  state:"",
  text:"",
  show:false,
  post:true,
  todo_id:0,
  user_id:sessionStorage.getItem("id")
})
let nulls = reactive({
  mi:false,
  kari:false,
  kan:false,
})
let now = new Date()
let date = reactive({
    year: now.getFullYear(),
    month: now.getMonth() + 1,
    day: now.getDate(),
    youbi: ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"][now.getDay()]
})

window.onload = function () {
  axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
      group_id: sessionStorage.getItem("group_id"),
      get_todolist: ''
    }, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(function (res) {
      console.log(res.data)
      //未完了
      try{
        if (res.data[0].group_information.uncompletion != null) {
          for (let i = 0; i < res.data[0].group_information.uncompletion.length; i++) {
            let kari ={
              id: res.data[0].group_information.uncompletion[i].todo_id,
              title: res.data[0].group_information.uncompletion[i].title,
              name: res.data[0].group_information.uncompletion[i].name,
              state: res.data[0].group_information.uncompletion[i].state,
              day: res.data[0].group_information.uncompletion[i].deadline,
              rank: res.data[0].group_information.uncompletion[i].rank,
              jouken: res.data[0].group_information.uncompletion[i].todo_condition,
              shousai: res.data[0].group_information.uncompletion[i].messsage,
              comment: res.data[0].group_information.uncompletion[i].comment,
              genre: res.data[0].group_information.uncompletion[i].genre.genre_name,
              genre_color: res.data[0].group_information.uncompletion[i].genre.genre_color,
              keiji: res.data[0].group_information.uncompletion[i].permission==1?"許可":"拒否",
            }
            mitodos[i] = kari;
          }
        }else{
          nulls.mi=true;
        }
      }catch(error){

      }
      //仮完了
      try {
        if (res.data[0].group_information.tentative != null) {
          for (let i = 0; i < res.data[0].group_information.tentative.length; i++) {
            karitodos[karitodos.length] = {
              id: res.data[0].group_information.tentative[i].todo_id,
              user_id:res.data[0].group_information.tentative[i].user_id,
              title: res.data[0].group_information.tentative[i].title,
              name: res.data[0].group_information.tentative[i].name,
              state: res.data[0].group_information.tentative[i].state,
              day: res.data[0].group_information.tentative[i].deadline,
              rank: res.data[0].group_information.tentative[i].rank,
              jouken: res.data[0].group_information.tentative[i].todo_condition,
              shousai: res.data[0].group_information.tentative[i].messsage,
              genre: res.data[0].group_information.tentative[i].genre.genre_name,
              genre_color: res.data[0].group_information.tentative[i].genre.genre_color,
              keiji: res.data[0].group_information.tentative[i].permission==1?"許可":"拒否",
              gazou: "https://mp-class.chips.jp/group_task" + res.data[0].group_information.tentative[i].image_pass.slice(1)
            }
          }
        }else{
          nulls.kari=true;
        }
      } catch (error) {

      }
      //完了
      try {
        if (res.data[0].group_information.completion != null) {
          for (let i = 0; i < res.data[0].group_information.completion.length; i++) {
            kantodos[kantodos.length] = {
              id: res.data[0].group_information.completion[i].todo_id,
              title: res.data[0].group_information.completion[i].title,
              name: res.data[0].group_information.completion[i].name,
              state: res.data[0].group_information.completion[i].state,
              day: res.data[0].group_information.completion[i].deadline,
              rank: res.data[0].group_information.completion[i].rank,
              jouken: res.data[0].group_information.completion[i].todo_condition,
              shousai: res.data[0].group_information.completion[i].messsage,
              comment: res.data[0].group_information.completion[i].comment,
              genre: res.data[0].group_information.completion[i].genre.genre_name,
              genre_color: res.data[0].group_information.completion[i].genre.genre_color,
              keiji: res.data[0].group_information.completion[i].permission==1?"許可":"拒否",
              gazou: "https://mp-class.chips.jp/group_task" + res.data[0].group_information.completion[i].image_pass.slice(1)
            }
          }
        }else{
          nulls.kan=true;
        }
        
      } catch (error) {

      }
    })
}
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
const mihai =() =>{
  swith.mi=true;
  swith.kari=false;
  swith.kan=false;
}
const karihai =() =>{
  swith.mi=false;
  swith.kari=true;
  swith.kan=false;
}
const kanhai =() =>{
  swith.mi=false;
  swith.kari=false;
  swith.kan=true;
}

const okfunk=(i)=>{
  console.log(karitodos[i].user_id+" "+modalstate.user_id)
  if(karitodos[i].user_id==modalstate.user_id){
    swal("自分のタスクは承認できません","","error")
  }else{
    modalstate.state="承認";
    modalstate.show=true;
    modalstate.post=true;
    modalstate.todo_id=karitodos[i].id
  }
}
const nofunk=(i)=>{
  // if(karitodos[i].user_id==modalstate.user_id){
  //   swal("自分のタスクは拒否できません","","error")
  // }else{
    modalstate.state="拒否";
    modalstate.show=true;
    modalstate.post=false;
    modalstate.todo_id=karitodos[i].id
  // }
}
const submit=()=>{
  if(modalstate.text==""){
    swal("理由を入力してください","","error")
  }else{
    axios
      .post('https://mp-class.chips.jp/group_task/main.php', {
          approval: modalstate.state,//true or false
          comment:modalstate.text,//承認or拒否理由
          todo_id: modalstate.todo_id,
          user_id: sessionStorage.getItem("id"),
          group_id: sessionStorage.getItem("group_id"),
          approval_todo: ''
      }, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
      })
      .then(function(res){
        console.log(res)
        swal("送信完了",modalstate.state+"情報を送信しました","success")
        .then(function(){
          location.href="./grouptodo"
        })
      })
    }
}
</script>
<style scoped>
.tyouka{
  color:red;
}
.modal{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 999;
}
.modal-content {
  position: fixed;
  width:70%;
  height:60%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fefefe;
  border: 0.3vh solid #ACD9DE;
  border-radius: 20px;
  z-index: 1000;
}
.batu{
  position:absolute;
  right:-2vh;
  top:-2vh;
  width:5vh;
  height:5vh;
  font-size:5vh;
  border-radius: 50%;
  background-color: #e58900;
}
.top{
  display: flex;
  justify-content: center;
  align-items: center;
  color:white;
  background-color: #e58900;
  border-radius: 20px;
  font-size:3vh;
  width: 100%;
  height:25%;
}
.modal_title{
  color:#e58900;
  font-size:3vh;
  text-align: center;
  margin-top:3vh;
}
.textareawrap{
  height:20vh;
  text-align: center;
  margin-top:3vh;
  margin-bottom: 5vh;
}
.textarea{
  width:80%;
  height:20vh;
  border: solid 0.3vh #e58900;
  border-radius: 10px;
}
.submit{
  width:40%;
  height:5vh;
  background-color: #e58900;
  border-radius: 10px;
  color:white;
  font-size: 2.5vh;
  margin:auto;
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
    border: solid 2px #e58900;
    border-radius: 20px;
  }
  .setting{
    display: flex;
  justify-content: center;
  align-items: center;
  margin-left:40vw;
  width:20vw;
  height:4.5vh;
  border-radius: 10px;
  color:white;
  background-color: #e58900;
  border-radius: 10px;
}
 .left{
    width:15vw;
    height:4.5vh;
 }
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
}
.todos{
  width: 100%;
  height: 57vh;
  overflow: auto;
}

/*タブのスタイル*/
.tab_item {
  width: calc(100%/3);
  height: 50px;
  border-bottom: 3px solid #e58900;
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
  background-color: #e58900;
  color: #fff;
}

.mikanryou{
  position: relative;
  border: 2px solid #e58900;
  border-radius: 10px;
}
.karikanryou{
  position: relative;
  border: 2px solid #e58900;
  border-radius: 10px;
}
.kanryou{
  position: relative;
  border: 2px solid #e58900;
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
      background-color: #e58900;
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
      left: 70vw;
      bottom:1vw;
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
      bottom:1vw;
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
      bottom:1vw;
      left: 70vw;
    }
    .ue2{
      width: 5vw;
      position: absolute;
      bottom: 1vw;
      left: 70vw;
    }
    
</style>

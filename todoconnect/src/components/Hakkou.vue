<template>
  <div >
    <div class="hakkou_area">

      <!-- <div style="display:flex">
        <div class="name_area">
          <h3>タイトル</h3>
          <h3>期限日</h3>
          <h3>完了条件</h3>
          <h3>ランク</h3>
          <h3>ジャンル</h3>
          <h3>詳細</h3>
        </div>
        <div class="input_area">
          <input type="text" v-model="select.title" placeholder="買い物（チャーハンの材料）">
          <input type="date" v-model="select.kigen">
          <input type="text" v-model="select.jouken" placeholder="ネギ、卵、ベーコンを購入">
          <select v-model="select.rank">
            <option value=""></option>
            <option value="S">S</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select>
          <select v-model="select.janru">
            <option value=""></option>
            <option value="1">買い物</option>
            <option value="2">勉強・仕事</option>
            <option value="3">予定・締め切り</option>
            <option value="4">その他</option>
          </select>
          <textarea type="text" v-model="select.syousai" placeholder="ネギは緑色が濃ゆいものを、卵は10個入り、ベーコンはブロックで２５０円ぐらいの物を選択"></textarea>
        </div>
      </div> -->
      <div style="text-align:right;font-size:3vw;color:#5AB4BD;">
        セレクトボックスの文字拡大<input type="checkbox" v-model="select.zoom"/>
      </div>
      <div class="title_area">
        <h3>タイトル</h3>
        <input type="text" class="text_area title" v-model="select.title" placeholder="買い物（チャーハンの材料）">
      </div>
      <div class="kigen_area">
        <h3>期限日</h3>
        <input type="date" class="text_area" v-model="select.kigen">
      </div>
      <div class="jouken_area">
        <h3>完了条件</h3>
        <input type="text" class="text_area" v-model="select.jouken" placeholder="ネギ、卵、ベーコンを購入">
      </div>
      <div class="rank_area">
        <h3>ランク</h3>
        <select class="select3" v-model="select.rank" :class="{zoom:select.zoom}">
          <option value="S">S</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
        </select>
      </div>
      <div class="janru_area">
        <h3>ジャンル</h3>
        <select class="select4" v-model="select.janru" :class="{zoom:select.zoom}">
          <option value=""></option>
          <option value="1">買い物</option>
          <option value="2">勉強・仕事</option>
          <option value="3">予定・締め切り</option>
          <option value="4">その他</option>
        </select>
      </div>
      <div class="syousai_area">
        <h3 class="sc">詳細</h3>
        <textarea type="text" class="text_area syousai" v-model="select.syousai" placeholder="ネギは緑色が濃ゆいものを、卵は10個入り、ベーコンはブロックで２５０円ぐらいの物を選択"></textarea>
      </div>
      <div class="radio_area">
        <div class="keizi_area">
          <h4 class="h4_1">掲示板<br>表示</h4>
          <div class="button1 r1" id="button-11">
                <input type="checkbox" class="checkbox1" @click="keizi[0]=!keizi[0]" />
                <div class="knobs1"></div>
                <div class="layer1"></div>
          </div>
          </div>
          <div class="saki_area">
            <h4>発行先</h4>
            <div class="button2 r2" id="button-12">
                <input type="checkbox" class="checkbox2"  @click="atesaki()"/>
                <div class="knobs2"></div>
                <div class="layer2"></div>
            </div>
          </div>
        </div>
        <div>
          <select class="select1" @change="group_click" v-model="select.group_id" :class="{zoom:select.zoom}">
          <option value="0">グループ名</option>
          <option :value="item.id" v-for="(item,index) in group_data" :key="index">
            {{item.groupname}}
          </option>
          </select>
        </div>
        <div>
          <div v-for="(item,i) in group_data" :key="i">
            <div v-show="nowgroup.number==i">
              <select class="select2" v-show="sele[0]" v-model="select.user_id" :class="{zoom:select.zoom}">
              <option value="0">ユーザー名</option>
              <option :value="item.id" v-for="(item,index) in group_data[nowgroup.number].groupusers" :key="index">{{ item.name }}</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <button class="hakkou_btn" @click="create_todo()">発行</button>
    </div>
</template>
<script setup>
import axios from 'axios'
import { reactive } from "vue"
import swal from 'sweetalert';

let title = reactive([])
let kigen = reactive([])
let jouken = reactive([])
let rank = reactive([])
let janru = reactive([])
let syousai = reactive([])
const keizi = reactive([true])
let keizi_sum =1
let sele = reactive([false])
let nowgroup = reactive({
  number:0,
})
const atesaki = () =>{
  sele[0] = !sele[0]
}
let group_data = reactive([])
let select = reactive({
  title:"",
  group_id:0,
  user_id:0,
  rank:"C",
  janru:"1",
  syousai:"",
  kigen:"",
  jouken:"",
  zoom:false,
})


axios
  .post('https://mp-class.chips.jp/group_task/main.php', {
    user_id: sessionStorage.getItem("id"),
    get_user_information: ''
  }, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(function (res) {
    console.log(res)
    try{
      for (let i = 0; i < res.data.length; i++) {
        group_data[group_data.length] = {
          id: res.data[i].group_id,
          groupname: res.data[i].group_name,
          groupusers: res.data[i].group_user_list
        }
        console.log(res.data[i].group_id)
      }
    }catch(error){
      swal("グループを作ろう","グループを先に作成してからTODOを発行してください","error")
      .then(function(){
        location.href="/group";
      })
    }
    console.log(group_data)
  })
//後ここだけ
const create_todo = () => {
  if (keizi[0] == true) {
    keizi_sum = 1//許可
  } else {
    keizi_sum = 0//拒否
  }
  if(sele[0]!=true){
    select.user_id=sessionStorage.getItem("id");
  }
  console.log([select.user_id,select.title,select.syousai,select.group_id,select.janru,select.kigen,select.rank,keizi_sum,select.jouken])
  if(select.user_id!=0 &&
     select.title!="" &&
     select.syousai!="" &&
     select.group_id!=0 &&
     select.janru!="" &&
     select.kigen!="" &&
     select.rank!="" &&
     select.jouken!=""){
  axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
      create_todo: '',
      title: select.title,
      message: select.syousai, //詳細
      user_id: select.user_id,
      group_id: select.group_id,
      genre_id: select.janru, //ジャンルID
      deadline: select.kigen, //期限
      rank: select.rank,
      permission: keizi_sum,
      todo_condition: select.jouken //条件
    }, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(function (res) {
      console.log("発行完了")
      console.log(res.data)
      swal("発行完了","TODOを発行しました","success")
      .then(function(){
        // location.href="/mytodo"
      })
    })
  }else{
    swal("情報不足","全て入力してください","error")
  }
}

const group_click=(event)=>{
  console.log(event.target.selectedIndex - 1)
  nowgroup.number=event.target.selectedIndex - 1
}
</script>
<style scoped>
/* .name_area{
  display: flex;
  flex-flow:column;
  justify-content: space-around;
  width:35vw;
  height:40vh;
  margin-top:3vh;
  margin-left:3vw;
  text-align: right;
}
.input_area{
  display: flex;
  flex-flow:column;
  justify-content: space-around;
  width:40vw;
  height:40vh;
  margin-top:3vh;
  margin-left:3vw;
  text-align: right;
} */
.zoom{
  font-size:10vw;
}





.sc {
  white-space: nowrap;
}

.syousai {
  padding: 2% 1% 5% 1%;
}
textarea::-webkit-scrollbar {
  display: none;
}
.syousai::placeholder {
  text-align: left;
}
::placeholder {
  color: #7c7c7c;
  text-align: center;
  font-size: 4vw;
  opacity: 0.9;
  font-weight: bold;
}
.hakkou_area{
  width: 90%;
  height: 70vh;
  background-color: white;
  position: relative;
  top: 3vw;
  left: 5vw;
  overflow: auto;
}
.hakkou_btn{
  width: 40vw;
  height: 6vh;
  border-radius: 8px;
  font-size: 1.7em;
  background-color: #5ab4bd;
  color: white;
  position: relative;
  top: 5vw;
  left: 30vw;
}
.title_area{
  display: flex;
  position: absolute;
  top: 7vw;
  left: 7vw;
}
.kigen_area{
  display: flex;
  position: absolute;
  top: 20vw;
  left: 12vw;
}
.jouken_area{
  display: flex;
  position: absolute;
  top: 34vw;
  left: 7vw;
}
.rank_area{
  display: flex;
  position: absolute;
  top: 48vw;
  left: 12vw;
}
.janru_area{
  display: flex;
  position: absolute;
  top: 61vw;
  left: 7vw;
}
.syousai_area{
  display: flex;
  position: absolute;
  top: 74vw;
  left: 17vw;
}
.text_area{
  
  width: 50vw;
  height: 4vh;
  margin: 1vw;
  word-wrap: break-word;
  border: 1px solid #5AB4BD;
  border-radius: 3px;
}
h3{
  margin: 0;
  padding: 2vw;
  color: #5AB4BD;
}


/* button1個目 */
.knobs1,
.layer1 {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.button1 {
  position: relative;
  top: 50%;
  width: 74px;
  height: 36px;
  overflow: hidden;
}

.button1.r1,
.button1.r1 .layer1 {
  border-radius: 100px;
}

.button1 {
  border-radius: 2px;
}

.checkbox1 {
  position: relative;
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
  opacity: 0;
  cursor: pointer;
  z-index: 3;
}

.knobs1 {
  z-index: 2;
}

.layer1 {
  width: 100%;
  background-color: #d8f1f6;
  transition: 0.3s ease all;
  z-index: 1;
}
#button-11 .knobs1:before {
  content: "ON";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 20px;
  height: 10px;
  color: #fff;
  font-size: 10px;
  font-weight: bold;
  text-align: center;
  line-height: 1;
  padding: 9px 4px;
  background-color: #93c5ec;
  border-radius: 50%;
  transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
}

#button-11 .checkbox1:checked + .knobs1:before {
  content: "OFF";
  left: 42px;
  background-color: #7ab5e2;
}

#button-11 .checkbox1:checked ~ .layer1 {
  background-color: #7ab5e2;
  opacity: 0.3;
}

#button-11 .knobs1,
#button-11 .knobs1:before,
#button-11 .layer1 {
  transition: 0.3s ease all;
}

/* button2個目 */
.knobs2,
.layer2 {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.button2 {
  position: relative;
  top: 50%;
  width: 74px;
  height: 36px;
  overflow: hidden;
}

.button2.r2,
.button2.r2 .layer2 {
  border-radius: 100px;
}

.button2 {
  border-radius: 2px;
}

.checkbox2 {
  position: relative;
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
  opacity: 0;
  cursor: pointer;
  z-index: 3;
}

.knobs2 {
  z-index: 2;
}

.layer2 {
  width: 100%;
  background-color: #d8f1f6;
  transition: 0.3s ease all;
  z-index: 1;
}
#button-12 .knobs2:before {
  content: "自分";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 20px;
  height: 10px;
  color: #fff;
  font-size: 10px;
  font-weight: bold;
  text-align: center;
  line-height: 1;
  padding: 9px 4px;
  background-color: #93c5ec;
  border-radius: 50%;
  transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
}

#button-12 .checkbox2:checked + .knobs2:before {
  content: "相手";
  left: 42px;
  background-color: #93c5ec;
}

#button-12 .checkbox1:checked ~ .layer2 {
  background-color: #E27A93;
  opacity: 0.3;
}

#button-12 .knobs2,
#button-12 .knobs2:before,
#button-12 .layer2 {
  transition: 0.3s ease all;
}
.keizi_area{
  display: flex;
  position: absolute;
  top: 90vw;
  left: 7vw;
  margin: 3vw;
}
h4{
  margin: 0;
  color: #5AB4BD;
  padding: 2vw;
}
.saki_area{
  display: flex;
  position: absolute;
  top: 90vw;
  left: 43vw;
  margin: 3vw;
}

.select1 {
  width: 30vw;
  height:4.5vh;
  border: 1px solid #5AB4BD;
  background-color: white;
  color: #5AB4BD;
  text-align: center;
  border-radius: 10px;
  position: absolute;
  top:110vw;
  left: 10vw;
}
.select2 {
  width: 30vw;
  height:4.5vh;
  border: 1px solid #5AB4BD;
  background-color: white;
  color: #5AB4BD;
  text-align: center;
  border-radius: 10px;
  position: absolute;
  top:110vw;
  left: 50vw;
}
.h4_1{
  margin: 0;
  color: #5AB4BD;
  padding:0
}
.select3 {
  width:52vw ;
  height:4.5vh;
  border: 1px solid #5AB4BD;
  background-color: white;
  color: #5AB4BD;
  border-radius: 3px;
  position: absolute;
  left: 20vw;
}
.select4 {
  height:4.5vh;
  width:52vw ;
  border: 1px solid #5AB4BD;
  background-color: white;
  color: #5AB4BD;
  border-radius: 3px;
  position: absolute;
  left: 25vw;
}
</style>
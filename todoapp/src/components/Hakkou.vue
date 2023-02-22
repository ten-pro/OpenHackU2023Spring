<template>
  <div>
    <div class="hakkou_area">
      <div class="title_area">
        <h3>タイトル</h3>
        <input type="text" class="text_area" v-model="title">
      </div>
      <div class="kigen_area">
        <h3>期限日</h3>
        <input type="date" class="text_area" v-model="kigen">
      </div>
      <div class="jouken_area">
        <h3>完了条件</h3>
        <input type="text" class="text_area" v-model="jouken">
      </div>
      <div class="rank_area">
        <h3>ランク</h3>
        <input type="text" class="text_area" v-model="rank">
      </div>
      <div class="janru_area">
        <h3>ジャンル</h3>
        <input type="text" class="text_area" v-model="janru">
      </div>
      <div class="syousai_area">
        <h3>詳細</h3>
        <input type="text" class="text_area" v-model="syousai">
      </div>
      <div class="radio_area">
        <div class="keizi_area">
          <h4 class="h4_1">掲示板<br>表示</h4>
          <div class="button1 r1" id="button-11">
                <input type="checkbox" class="checkbox1" @click="keizi=!keizi" />
                <div class="knobs1"></div>
                <div class="layer1"></div>
          </div>
          </div>
          <div class="saki_area">
            <h4>発行先</h4>
            <div class="button2 r2" id="button-12">
                <input type="checkbox" class="checkbox2"  @click="atesaki(i)"/>
                <div class="knobs2"></div>
                <div class="layer2"></div>
            </div>
          </div>
        </div>
        <div>
          <select class="select1">
          <option value="">グループ名</option>
          <option value="1">A</option>
          <option value="2">B</option>
          </select>
        </div>
        <div>
          <select class="select2" v-show="sele[i]">
          <option value="">ユーザー名</option>
          <option value="">A</option>
          <option value="">B</option>
          </select>
        </div>
      </div>
      <button class="hakkou_btn" @click="create_todo()">発行</button>
    </div>
</template>
<script setup>
import axios from 'axios'
import { reactive } from "vue"

let title = reactive([])
let kigen = reactive([])
let jouken = reactive([])
let rank = reactive([])
let janru = reactive([])
let syousai = reactive([])
const keizi = reactive([true])
let keizi_sum =1
let sele = reactive([false])
const atesaki = (i) =>{
  sele[i] = !sele[i]
}

const create_todo=() =>{
    if(keizi == true){
      keizi_sum = 1
    }else{
      keizi_sum = 0
    }
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    create_todo: '',
                    title: title,
                    message:syousai,//詳細
                    user_id: 1,
                    group_id: 1,
                    genre_id: 1,//ジャンルID
                    deadline: kigen,//期限
                    rank: rank,
                    permission: keizi_sum,
                    todo_condition: jouken//条件
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (res) {
                  console.log("発行完了")
                    console.log(res.data)

                })
        }
</script>
<style scoped>
.hakkou_area{
  width: 90%;
  height: 70vh;
  background-color: white;
  position: relative;
  top: 21vw;
  left: 5vw;
}
.hakkou_btn{
  width: 40vw;
  height: 6vh;
  border-radius: 8px;
  font-size: 1.7em;
  background-color: #5ab4bd;
  color: white;
  position: relative;
  top: 22vw;
  left: 30vw;
}
.title_area{
  display: flex;
  position: absolute;
  top: 4vw;
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
  appearance: none;
  width: 30%;
  padding: 10px;
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
  appearance: none;
  width: 30%;
  padding: 10px;
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

</style>
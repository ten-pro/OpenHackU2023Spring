<template>
  <div>
    <select>
      <option value="">並び替え</option>
      <option value="">昇順</option>
      <option value="">降順</option>
    </select>
    <div class="tabs">
      <input id="all" type="radio" name="tab_item" checked @click="mihai(v)">
      <label class="tab_item" for="all">未完了</label>
      <input id="programming" type="radio" name="tab_item" @click="karihai(v)">
      <label class="tab_item" for="programming">仮完了</label>
      <input id="design" type="radio" name="tab_item" @click="kanhai(v)">
      <label class="tab_item" for="design">完了</label>
      <div class="todos">
        <div class="tab_content" id="mi_content" v-for="mitodo in mitodos" :key="mitodo" v-show="mihairetu[v]">
          <div class="mikanryou">
            <h3>{{ mitodo.title }}</h3>
            <p>期限日：{{ mitodo.day }}</p>
            <p>ランク：{{ mitodo.rank }}</p>
            <p>ジャンル：{{ mitodo.janru }}</p>
            <p>掲示板許可：{{ mitodo.keiji }}</p>
            <p>完了条件：{{ mitodo.jouken }}</p>
            <p class="syousai" v-show="detail[i]">詳細：{{ mitodo.shousai }}</p>
            <div class="button_area">
              <button class="button kan">完了</button>
              <paper-ripple fit></paper-ripple>
              <button class="button saku">削除</button>
            </div>
            <img src="./PNG/sita.png" alt="" class="sita" v-show="!sita[i]" @click="zen(i)">
            <img src="./PNG/ue.png" alt="" class="ue" v-show="ue[i]" @click="kakusu(i)">
          </div>
        </div>
        <div class="tab_content" id="kari_content" v-for="karitodo in karitodos" :key="karitodo" v-show="karihairetu[v]">
          <div class="karikanryou">
            <h3>{{ karitodo.title }}</h3>
            <p>期限日：{{ karitodo.day }}</p>
            <p>ランク：{{ karitodo.rank }}</p>
            <p>ジャンル：{{ karitodo.janru }}</p>
            <p>掲示板許可：{{ karitodo.keiji }}</p>
            <p>完了条件：{{ karitodo.jouken }}</p>
            <p class="syousai" v-show="detail[i]">詳細：{{ karitodo.shousai }}</p>
            <img  alt="">
            <div class="button_area1">
              <button class="button kan">完了</button>
              <paper-ripple fit></paper-ripple>
            </div>
            <img src="./PNG/sita.png" alt="" class="sita1" v-show="!sita[i]" @click="zen(i)">
            <img src="./PNG/ue.png" alt="" class="ue1" v-show="ue[i]" @click="kakusu(i)">
          </div>
        </div>
        <div class="tab_content" id="kan_content" v-for="kantodo in kantodos" :key="kantodo" v-show="kanryouhairetu[v]">
          <div class="kanryou">
            <h3>{{ kantodo.title }}</h3>
            <p>期限日：{{ kantodo.day }}</p>
            <p>ランク：{{ kantodo.rank }}</p>
            <p>ジャンル：{{ kantodo.janru }}</p>
            <p>掲示板許可：{{ kantodo.keiji }}</p>
            <p>完了条件：{{ kantodo.jouken }}</p>
            <p class="syousai" v-show="detail[i]">詳細：{{ kantodo.shousai }}</p>
            <div class="button_area2">
              <button class="button kan">完了</button>
              <paper-ripple fit></paper-ripple>
            </div>
            <img src="./PNG/sita.png" alt="" class="sita2" v-show="!sita[i]" @click="zen(i)">
            <img src="./PNG/ue.png" alt="" class="ue2" v-show="ue[i]" @click="kakusu(i)">
          </div>
        </div>
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
let mihairetu = reactive([true])
let karihairetu = reactive([true])
let kanryouhairetu = reactive([true])

// let mitodos = ([
//   {
//     todo_id:1,
//   title:'チャーハン材料',
//   state:'未完了',
//   day:'２月２日',
//   rank:'A',
//   jouken:'ネギ、卵、ベーコンを買ってくる',
//   keiji:'ON',
//   janru:'買い物',
//   shousai:'ネギは緑色が濃ゆいものを買ってください。卵は１０個入りをお願いします。ベーコンはぷろっくのもので、２５０円くらいのものをお願いします。'
//   },
//   {
//     todo_id:2,
//   title:'日用品を買う',
//   state:'未完了',
//   day:'２月１３日',
//   rank:'B',
//   jouken:'シャンプー、コンディショナーを買ってくる',
//   keiji:'ON',
//   janru:'買い物',
//   shousai:'ひまわりのやつをお願いします。あったらモウのアイスもｗ'
//   }
// ])

// let karitodos = ([
//   {
//     todo_id:3,
//   title:'バレンタイン材料',
//   state:'仮完了',
//   day:'２月5日',
//   rank:'A',
//   jouken:'チョコを買ってくる',
//   keiji:'OFF',
//   janru:'買い物',
//   shousai:'ガーナのチョコをお願いします'
//   },
//   {
//     todo_id:4,
//   title:'vue３の課題を進める',
//   state:'仮完了',
//   day:'２月１5日',
//   rank:'B',
//   jouken:'仮完了',
//   keiji:'ON',
//   janru:'買い物',
//   shousai:'Vue３のテキストを１０ページ進める'
//   }
// ])

// let kantodos = ([
//   {
//     todo_id:5,
//   title:'バレンタイン材料2',
//   state:'完了',
//   day:'２月5日',
//   rank:'A',
//   jouken:'チョコを買ってくる',
//   keiji:'OFF',
//   janru:'買い物',
//   shousai:'ガーナのチョコをお願いします'
//   },
//   {
//     todo_id:6,
//   title:'vue３の課題を進める2',
//   state:'完了',
//   day:'２月１5日',
//   rank:'B',
//   jouken:'仮完了',
//   keiji:'ON',
//   janru:'買い物',
//   shousai:'Vue３のテキストを１０ページ進める'
//   }
// ])

window.onload = function() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:1,
                    get_user_information: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
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
const mihai =(v) =>{
  mihairetu[v] = true
  karihairetu[v] = false
  kanryouhairetu[v] = false
}
const karihai =(v) =>{
  mihairetu[v] = false
  karihairetu[v] = true
  kanryouhairetu[v] = false
}
const kanhai =(v) =>{
  karihairetu[v] = false
  mihairetu[v] = false
  kanryouhairetu[v] = true
}
</script>
<style scoped>
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
  border-bottom: 3px solid #5ab4bd;
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
  background-color: #5ab4bd;
  color: #fff;
}

.mikanryou{
  position: relative;
  border: 2px solid #5ab4bd;
  border-radius: 10px;
}
.karikanryou{
  position: relative;
  border: 2px solid #5ab4bd;
  border-radius: 10px;
}
.kanryou{
  position: relative;
  border: 2px solid #5ab4bd;
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
      background-color: #5ab4bd;
      color: white;
      margin-top: 2vw;
    }
    h3{
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
      top:53vw;
      left: 70vw;
    }
    .ue{
      width: 5vw;
      position: absolute;
      bottom: 3vw;
      left: 70vw;
    }
    .sita1{
      width: 5vw;
      position: absolute;
      top:46vw;
      left: 70vw;
    }
    .ue1{
      width: 5vw;
      position: absolute;
      bottom: 3vw;
      left: 70vw;
    }
    .sita2{
      width: 5vw;
      position: absolute;
      top:46vw;
      left: 70vw;
    }
    .ue2{
      width: 5vw;
      position: absolute;
      bottom: 3vw;
      left: 70vw;
    }
    
</style>

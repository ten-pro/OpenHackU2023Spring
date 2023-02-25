<template>
  <div v-show="swith.complete_page==false">
    <div class="topbutton">
      <a href="/home">
          <div class="return">
              <img class="left" src="./PNG/left.png" />
          </div>
      </a>
    </div>
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
            <p :class="{tyouka:date.year>=mitodo.day.slice(0,4) && date.month>=mitodo.day.slice(5,7) && date.day>mitodo.day.slice(8,10)}">期限日：{{ mitodo.day.slice(0,11)+mitodo.day.slice(19) }}</p>
            <p>ランク：{{ mitodo.rank }}</p>
            <p>ジャンル：{{ mitodo.genre }}</p>
            <p>掲示板許可：{{ mitodo.keiji }}</p>
            <p>完了条件：{{ mitodo.jouken }}</p>
            <p v-show="mitodo.comment!=null">拒否理由：{{ mitodo.comment }}</p>
            <p class="syousai" v-show="detail[index]">詳細：{{ mitodo.shousai }}</p>
            <div class="button_area">
              <button class="button kan" @click="todocomplete(index)">完了</button>
              <button class="button saku" @click="sakujo(mitodo.id)">削除</button>
            </div>
            <img src="./PNG/sita.png" alt="" class="sita" v-show="!sita[index]" @click="zen(index)">
            <img src="./PNG/ue.png" alt="" class="ue" v-show="ue[index]" @click="kakusu(index)">
          </div>
        </div>
        <h3 style="text-align: center;" v-show="nulls.kari && swith.kari">現在仮完了TODOはありません</h3>
        <div class="tab_content" id="kari_content" v-for="(karitodo,index) in karitodos" :key="index" v-show="swith.kari">
          <div class="karikanryou">
            <h3>{{ karitodo.title }}</h3>
            <p :class="{tyouka:date.year>=karitodo.day.slice(0,4) && date.month>=karitodo.day.slice(5,7) && date.day>karitodo.day.slice(8,10)}">期限日：{{ karitodo.day.slice(0,11) + karitodo.day.slice(19) }}</p>
            <p>ランク：{{ karitodo.rank }}</p>
            <p>ジャンル：{{ karitodo.genre }}</p>
            <p>掲示板許可：{{ karitodo.keiji }}</p>
            <p>完了条件：{{ karitodo.jouken }}</p>
            <p class="syousai" v-show="detail[index]">詳細：{{ karitodo.shousai }}</p>
            <img v-show="detail[index]" :src="karitodo.gazou" style="max-width:50vw;max-height:30vh;"/>
            <img src="./PNG/sita.png" alt="" class="sita1" v-show="!sita[index]" @click="zen(index)">
            <img src="./PNG/ue.png" alt="" class="ue1" v-show="ue[index]" @click="kakusu(index)">
          </div>
        </div>
        <h3 style="text-align: center;" v-show="nulls.kan && swith.kan">現在完了TODOはありません</h3>
        <div class="tab_content" id="kan_content" v-for="(kantodo,index) in kantodos" :key="index" v-show="swith.kan">
          <div class="kanryou">
            <h3>{{ kantodo.title }}</h3>
            <p>期限日：{{ kantodo.day.slice(0,11) + kantodo.day.slice(19) }}</p>
            <p>ランク：{{ kantodo.rank }}</p>
            <p>ジャンル：{{ kantodo.genre }}</p>
            <p>掲示板許可：{{ kantodo.keiji }}</p>
            <p>完了条件：{{ kantodo.jouken }}</p>
            <p v-show="kantodo.comment!=null">承認理由:{{ kantodo.comment }}</p>
            <p class="syousai" v-show="detail[index]">詳細：{{ kantodo.shousai }}</p>
            <img v-show="detail[index]" :src="kantodo.gazou" style="max-width:50vw;max-height:30vh;"/>
            <img src="./PNG/sita.png" alt="" class="sita2" v-show="!sita[index]" @click="zen(index)">
            <img src="./PNG/ue.png" alt="" class="ue2" v-show="ue[index]" @click="kakusu(index)">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-show="swith.complete_page==true" style="overflow:auto;height:80vh;">
    <div class="return" style="margin-top:1.5vh;">
      <img class="left" src="./PNG/left.png" @click="swith.complete_page=false"/>
    </div>
    <div class="image_area">
      <div class="title">{{con_data.con_title}}</div>
      <div class="subtitle">完了条件</div>
      <div class="text">{{con_data.con_jouken}}</div>
      <div class="subtitle select">画像選択</div>
      <div class="text">
        <label class="postlabel">
          <input ref="fileInput" type="file" accept='image/*' @change="previewImage($event.target)" class="postinput">ファイルを選択
        </label>
      </div>
      <div class="title"><img id="preview" :src="previewSrc" style="max-width:50vw;max-height:50vh;"></div>
    </div>
    <div class="upload_button_wrap"><button @click="uploadFile" class="upload_button">送信</button></div>
  </div>
</template>
<script setup>
import axios from 'axios'
import swal from 'sweetalert'
import {reactive} from 'vue'
import { ref } from "vue";
let detail = reactive([false])
let ue = reactive([false])
let sita = reactive([false])
let swith = reactive({
  mi:true,
  kari:false,
  kan:false,
  complete_page:false,
})
let mitodos = reactive([])
let karitodos = reactive([])
let kantodos = reactive([])
let con_data = reactive({
  con_title:"",
  con_data:"",
  todoid:0,
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

const previewSrc = ref("")

const fileInput = ref(null);

// create uploadFile method and expose it to template


  axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
        user_id:sessionStorage.getItem("id"),
        get_user_todolist: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function (res) {
      console.log(res.data)
      //未完了
      try{
        if (res.data.uncompletion != null) {
          for (let i = 0; i < res.data.uncompletion.length; i++) {
            console.log(res.data.uncompletion[i].todo_id)
            let kari ={
              id: res.data.uncompletion[i].todo_id,
              title: res.data.uncompletion[i].title,
              state: res.data.uncompletion[i].state,
              day: res.data.uncompletion[i].deadline,
              rank: res.data.uncompletion[i].rank,
              jouken: res.data.uncompletion[i].todo_condition,
              shousai: res.data.uncompletion[i].messsage,
              comment: res.data.uncompletion[i].comment,
              genre: res.data.uncompletion[i].genre.genre_name,
              genre_color: res.data.uncompletion[i].genre.genre_color,
              keiji: res.data.uncompletion[i].permission==1?"許可":"拒否",
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
        if (res.data.tentative != null) {
          for (let i = 0; i < res.data.tentative.length; i++) {
            karitodos[i] = {
              id: res.data.tentative[i].todo_id,
              title: res.data.tentative[i].title,
              state: res.data.tentative[i].state,
              day: res.data.tentative[i].deadline,
              rank: res.data.tentative[i].rank,
              jouken: res.data.tentative[i].todo_condition,
              shousai: res.data.tentative[i].messsage,
              genre: res.data.tentative[i].genre.genre_name,
              genre_color: res.data.tentative[i].genre.genre_color,
              keiji: res.data.tentative[i].permission==1?"許可":"拒否",
              gazou: "https://mp-class.chips.jp/group_task" + res.data.tentative[i].image_pass.slice(1)
            }
          }
          console.log(karitodos)
        }
        else{
          nulls.kari=true;
        }
      } catch (error) {

      }
      //完了
      try {
        if (res.data.completion != null) {
          for (let i = 0; i < res.data.completion.length; i++) {
            kantodos[i] = {
              id: res.data.completion[i].todo_id,
              title: res.data.completion[i].title,
              state: res.data.completion[i].state,
              day: res.data.completion[i].deadline,
              rank: res.data.completion[i].rank,
              jouken: res.data.completion[i].todo_condition,
              shousai: res.data.completion[i].messsage,
              comment: res.data.completion[i].comment,
              genre: res.data.completion[i].genre.genre_name,
              genre_color: res.data.completion[i].genre.genre_color,
              keiji: res.data.completion[i].permission==1?"許可":"拒否",
              gazou: "https://mp-class.chips.jp/group_task" + res.data.completion[i].image_pass.slice(1)
            }
          }
        }
        else{
          nulls.kan=true;
        }
      } catch (error) {

      }
    })
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

const todocomplete=(i)=>{
  swith.complete_page=true;
  con_data.id=mitodos[i].id;
  con_data.todoid=mitodos[i].id;
  con_data.con_title=mitodos[i].title;
  con_data.con_jouken=mitodos[i].jouken;
}
// 削除機能です！！
const sakujo = (todo_id)=>{
  swal({
    title: "確認",
    text: "本当に削除してよろしいですか？",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
.then((willDelete) => {
  if (willDelete) {
    axios
      .post('https://mp-class.chips.jp/group_task/main.php', {
          delete_todo: '',
          todo_id:todo_id
      }, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
      })
      .then(function (res) {
        location.href = ""
          console.log(res.data)
      })
    }
  })
}


const uploadFile = () => {
  const file = fileInput.value.files[0];
  if (!file) return;

  // create FormData object and append file object
  const formData = new FormData();
  formData.append('image', file);
  formData.append('user_id', sessionStorage.getItem("id"));
    formData.append('todo_id', con_data.id);
    console.log(con_data.id)

  // send FormData object to php using axios post method
  axios.post('https://mp-class.chips.jp/group_task/upload.php',formData)
    .then(response => {
      // handle success response
      console.log(response.data);
      swal("送信完了","未完了TODOの完了報告を送信しました","success")
      .then(function(){
        location.href="./mytodo";
      })
    })
    .catch(error => {
      // handle error response
      console.error(error);
    });
}
defineExpose({
  uploadFile,
});

const previewImage = (obj) => {
  try{
  const fileReader = new FileReader()
  fileReader.onload = () => {
    previewSrc.value = fileReader.result
  }
  fileReader.readAsDataURL(obj.files[0])
  }catch(error){
    swal("エラー","エラーが発生しました。画像を選択し直してください。","error")
    .then(function(){
      previewSrc.value="";
    })
  }
}
</script>
<style scoped>
.tyouka{
  color:red;
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
 .left{
    width:15vw;
    height:4.5vh;
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
      margin-bottom: 5vh;
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
      bottom:1vw;
      left: 70vw;
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
    .kari_gazou{
      width:50vw;
      height: 20vh;
      padding: 4vw;
    }



    /* ポストの方 */
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
    border: solid 2px #5AB4BD;
    border-radius: 20px;
  }
.left{
  width:15vw;
  height:4.5vh;
}
.image_area{
  width:90vw;
  height:55vh;
  margin:auto;
  margin-top:3vh;
  background-color: white;
  border: solid 2px #5AB4BD;
  border-radius: 10px;
  overflow: auto;
}
.title{
  margin-top:3vh;
  margin-bottom: 2vh;
  font-size: 4.5vh;
  text-align: center;
  font-weight: bold;
}
.subtitle{
  margin-bottom: 3vh;
  font-size:3vh;
  text-align: center;
  font-weight: bold;
}
.text{
  text-align: center;
  margin-bottom: 5vh;
}
.select{
  font-size:2.5vh;
}
.postlabel{
  padding: 1vh 3.5vh;
  color: #ffffff;
  background-color:#5AB4BD;
  cursor: pointer;
}
.postinput{
  display: none;
}
.upload_button_wrap{
  text-align: center;
  color:#ffffff;
}
.upload_button{
  margin-top: 3vh;
  width:30vw;
  height:5vh;
  background-color: #5AB4BD;
  color: white;
  font-weight: bold;
  font-size: 2.5vh;
  border-radius: 120px;
}
</style>

<template>
    <div class="topbutton">
      <a href="/home">
          <div class="return">
              <img class="left" src="./PNG/left.png" />
          </div>
      </a>
    </div>
    <div class="wrap">
        <div class="flex">
            <div v-for="(item, index) in login" :key="index" class="flex_none">
                <div  class="childwrap" :class="{noget:item.noget==false}" @click="loginfunc(index)">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=login.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in renlogin" :key="index" class="flex_none">
                <div  class="childwrap" :class="{noget:item.noget==false}">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=renlogin.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in sum" :key="index" class="flex_none">
                <div  class="childwrap" :class="{noget:item.noget==false}">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=sum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in buysum" :key="index" class="flex_none">
                <div  class="childwrap" :class="{noget:item.noget==false}">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=buysum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in studysum" :key="index" class="flex_none">
                <div  class="childwrap" :class="{noget:item.noget==false}">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=studysum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in limitsum" :key="index" class="flex_none">
                <div  class="childwrap" :class="{noget:item.noget==false}">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=limitsum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import swal from 'sweetalert';
let login = reactive([{title:"",text:"",noget:false}])
let renlogin = reactive([{title:"",text:"",noget:false}])
let sum = reactive([{title:"",text:"",noget:false}])
let buysum = reactive([{title:"",text:"",noget:false}])
let studysum = reactive([{title:"",text:"",noget:false}])
let limitsum = reactive([{title:"",text:"",noget:false}])

axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
        user_id:2,
        get_title: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function(res){
        console.log(res.data)
        for(let i=0;i<8;i++){
            let kari={title:"",text:"",noget:false};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            kari.noget=res.data[i].get;
            login[i]=kari;
        }
        login[0].noget=true;
        for(let i=8;i<16;i++){
            let kari={title:"",text:"",noget:false};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            kari.noget=res.data[i].get;
            renlogin[i-8]=kari;
        }
        for(let i=16;i<24;i++){
            let kari={title:"",text:"",noget:false};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            kari.noget=res.data[i].get;
            sum[i-16]=kari;
        }
        for(let i=24;i<32;i++){
            let kari={title:"",text:"",noget:false};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            kari.noget=res.data[i].get;
            buysum[i-24]=kari;
        }
        for(let i=32;i<40;i++){
            let kari={title:"",text:"",noget:false};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            kari.noget=res.data[i].get;
            studysum[i-32]=kari;
        }
        for(let i=40;i<48;i++){
            let kari={title:"",text:"",noget:false};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            kari.noget=res.data[i].get;
            limitsum[i-40]=kari;
        }
        console.log(renlogin);
    })

const loginfunc=(i)=>{
    if(login[i].noget==true){

    }else{
        swal("設定失敗","この実績は獲得していません","error")
    }
}
</script>
<style scoped>
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
.wrap{
    width:100vw;
    height:71.5vh;
    overflow:auto;
    overflow-x:auto;
}
.childwrap{
    min-width:40vw;
    min-height:10vh;
    background-color: #ffffff;
    border:solid 0.2vh #33CFC6;
    border-radius: 20px;
}
.yajirusi{
    width:20vw;
    height:3vh;
    margin:auto;
}
.flex{
    display: flex;
    margin-top:3vh;
    margin-left:5vw;
}
.flex_none{
    display: flex;
}
.title{
    text-align: center;
    font-size: 5vw;
    font-weight: bold;
}
.text{
    margin-top:1vh;
    text-align: center;
}
.noget{
    color:grey;
}
</style>
  
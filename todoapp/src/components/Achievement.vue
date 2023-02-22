<template>
    <div class="wrap">
        <div class="flex">
            <div v-for="(item, index) in login" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=login.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in renlogin" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=renlogin.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in sum" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=sum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in buysum" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=buysum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in studysum" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=studysum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in limitsum" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=limitsum.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import OneAchievement from './achievement/OneAchievement.vue'
import axios from 'axios';
import { reactive } from 'vue';

let login = reactive([{title:"",text:""}])
let renlogin = reactive([{title:"",text:""}])
let sum = reactive([{title:"",text:""}])
let buysum = reactive([{title:"",text:""}])
let studysum = reactive([{title:"",text:""}])
let limitsum = reactive([{title:"",text:""}])

axios
    .post('http://mp-class.chips.jp/group_task/main.php', {
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
            let kari={title:"",text:""};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            login[i]=kari;
        }
        for(let i=8;i<16;i++){
            let kari={title:"",text:""};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            renlogin[i-8]=kari;
        }
        for(let i=16;i<24;i++){
            let kari={title:"",text:""};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            sum[i-16]=kari;
        }
        for(let i=24;i<32;i++){
            let kari={title:"",text:""};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            buysum[i-24]=kari;
        }
        for(let i=32;i<40;i++){
            let kari={title:"",text:""};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            studysum[i-32]=kari;
        }
        for(let i=40;i<48;i++){
            let kari={title:"",text:""};
            kari.title=res.data[i].name;
            kari.text=res.data[i].conditions;
            limitsum[i-40]=kari;
        }
        console.log(renlogin);
    })
</script>
<style scoped>
.wrap{
    width:100vw;
    height:80.5vh;
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

</style>
  
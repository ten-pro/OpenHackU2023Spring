<template>
    <div style="overflow:auto;height:80vh">
        <div class="yyyymmdd">
            {{ date.year }}/{{ date.month }}/{{ date.day }}({{ date.youbi }})
        </div>
        <div class="toro" @click="achievement">
        <torofi />
    </div>
        <div class="sum">
            <div class="suminner">
                {{ todo.sum }}
            </div>
        </div>
        <div class="rank">
            <div class="flex">
                <div class="imgposi Simg">
                    <div class="text Sposi">
                        {{ todo.s }}
                    </div>
                </div>
                <div class="imgposi Aimg">
                    <div class="text Aposi">
                        {{ todo.a }}
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="imgposi Bimg">
                    <div class="text Bposi">
                        {{ todo.b }}
                    </div>
                </div>
                <div class="imgposi Cimg">
                    <div class="text Cposi">
                        {{ todo.c }}
                    </div>
                </div>
            </div>
        </div>

        <div class="today">
            <div class="title">
                <div class="title_message" v-show="nulls.error==false">{{ todo.title }}</div>
                <div class="title_message" v-show="nulls.error==true">未完了TODOはありません</div>
                    <div class="task">
                        <div class="ran">ランク</div><div class="rank_text">{{ todo.rank }}</div>
                        <div class="kan">完了条件</div><div class="condition_text">{{ todo.todo_condition }}</div>
                        <div class="syou">詳細</div>
                        <div class="message_text">{{ todo.message }}</div>
                    </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { reactive } from 'vue';
import axios from 'axios';
import torofi from './torofi.vue'
let now = new Date()
let date = reactive({
    year: now.getFullYear(),
    month: now.getMonth() + 1,
    day: now.getDate(),
    youbi: ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"][now.getDay()]
})
let achievement = () => {
    location.href = './achievement'
}
let todo = reactive({
    sum:0,
    s:0,
    a:0,
    b:0,
    c:0,
    title:"",
    message:"",
    todo_condition:"",
    rank:"",
})
let nulls = reactive({
    error:false,
})
axios
    .post('https://mp-class.chips.jp/group_task/main.php', {
        user_id:2,
        rank_count: ''
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function(res){
        console.log(res.data)
        try{
        let data=res.data;
            todo.sum=data[4].all;
            todo.s=data[0].count;
            todo.a=data[1].count;
            todo.b=data[2].count;
            todo.c=data[3].count;
            todo.title=data[5].title;
            todo.message=data[5].messsage;
            todo.todo_condition=data[5].todo_condition;
            todo.rank=data[5].rank;
        }catch(error){
            nulls.error=true;
        }
    })
</script>
<style scoped>
.toro {
    text-align: right;
    margin: 0 5% 0 0;
}
.flex{
    display: flex;
}
.yyyymmdd{
    text-align: center;
    font-weight: bold;
    font-size:7vw;
    margin-top:2vh;
}
.sum{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    margin:auto;
    margin-top:0vh;
    width:40vw;
    height:40vw;
    background-color: #6AD3DD;
    border: solid 0.1vh;
}
.suminner{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    width:30vw;
    height:30vw;
    background-color: #5AB4BD;
    color:white;
    font-weight: bold;
    font-size:7vh
}
.rank{
    position: relative;
    margin:auto;
    margin-top:3vh;
    width:55vw;
    height:9vh;
}
.imgposi{
    margin-bottom: 5vw;
    width:25vw;
    height:5.5vh;
    background-size: 25vw 5.5vh;
}
.Simg{
    margin-right:5vw;
    background-image: url("./PNG/Srank.png");
}
.Aimg{
    background-image: url("./PNG/Arank.png");
}
.Bimg{
    margin-right:5vw;
    background-image: url("./PNG/Brank.png");
}
.Cimg{
    background-image: url("./PNG/Crank.png");
}
.text{
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    width:20vw;
    height:5vh;
    font-size: 3vh;
    color:white;
}
.Sposi{
    left:8.5vw;
}
.Aposi{
    left:38.5vw;
}
.Bposi{
    left:8.5vw;
}
.Cposi{
    left:38.5vw;
}

.today{
    width:80vw;
    height:30vh;
    margin:auto;
    margin-top:6.5vh;
    background-color: rgb(196, 196, 196);
    border:solid 0.1vh black;
    border-radius: 20px;
    
}
.title{
    position: relative;
    width:80vw;
    height:30vh;
    background-color:#6AD3DD;
    border:solid 0.1vh black;
    border-radius: 20px;
    margin-left:-0.1vh;
    margin-top:-0.1vh;
}
.title_message{
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width:80vw;
    height:5vh;
    color:white;
    overflow: auto;
}
.task{
    position: relative;
    display:grid;
    grid-template-rows: 2vh 5vh 7vh 17vh;
    grid-template-columns: 3vw 20vw 3vw 51vw 3vw;
    width:80vw;
    height:25vh;
    margin-top:5vh;
    background-color: white;
    border:solid 0.1vh black;
    border-radius: 20px;
    margin-left:-0.1vh;
    overflow: auto;
}
.ran{
    position: absolute;
    width:20vw;
    grid-row: 2/3;
    grid-column: 2/3;
    text-align: center;
    border-bottom: solid 3px grey;
    bottom:0px;
}
.rank_text{
    position: absolute;
    width:54vw;
    font-size: 2vh;
    grid-row: 2/3;
    grid-column: 4/5;
    border-bottom: solid 3px grey;
    bottom:0px;
}
.kan{
    position: absolute;
    width:20vw;
    grid-row: 3/4;
    grid-column: 2/3;
    text-align: center;
    border-bottom: solid 3px grey;
    bottom:0px;
}
.condition_text{
    position: absolute;
    width:54vw;
    font-size: 2vh;
    grid-row: 3/4;
    grid-column: 4/5;
    border-bottom: solid 3px grey;
    bottom:0px;
}
.syou{
    position: absolute;
    width:20vw;
    text-align: center;
    grid-row: 4/5;
    grid-column: 2/3;
    top:1vh;
}
.message_text{
    position: absolute;
    font-size: 2vh;
    grid-row: 4/5;
    grid-column: 4/5;
    top:1vh;
}
</style>
  
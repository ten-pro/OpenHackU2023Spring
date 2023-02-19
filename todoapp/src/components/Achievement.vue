<template>
    <div class="wrap">
        <div class="flex">
            <div v-for="(item, index) in itirans" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=itirans.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in itirans" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=itirans.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in itirans" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=itirans.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in itirans" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=itirans.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in itirans" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=itirans.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
        <div class="flex">
            <div v-for="(item, index) in itirans" :key="index" class="flex_none">
                <div  class="childwrap">
                    <div class="title">{{ item.title }}</div>
                    <div class="text">{{ item.text }}</div>
                </div>
                <img v-if="index!=itirans.length - 1" src="./PNG/right.png" class="yajirusi"/>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import OneAchievement from './achievement/OneAchievement.vue'
import { reactive } from 'vue';

let itirans = reactive([
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
  {title:"aaa",text:"bbb"},
])
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
    background-color: #33CFC6;
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
    color:white;
    text-align: center;
    font-size: 7vw;
}
.text{
    color:white;
    text-align: center;
}

</style>
  
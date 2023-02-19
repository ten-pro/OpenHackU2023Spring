<template>
  <div class="return">
    <img class="left" src="./PNG/left.png" />
  </div>
  <div class="image_area">
    <div class="title">チャーハン材料</div>
    <div class="subtitle">完了条件</div>
    <div class="text">ネギ、卵、ベーコンを買ってくる</div>
    <div class="subtitle select">画像選択</div>
    <input type="file" ref="fileInput" class="">
  </div>
  <button @click="uploadFile">Upload</button>
</template>
<script setup lang="ts">
import axios from "axios"
import { ref } from "vue";

const fileInput = ref(null);

// create uploadFile method and expose it to template
const uploadFile = () => {
  const file = fileInput.value.files[0];
  if (!file) return;

  // create FormData object and append file object
  const formData = new FormData();
  formData.append('image', file);
  formData.append('user_id', 4);
    formData.append('todo_id', 1);

  // send FormData object to php using axios post method
  axios.post('http://mp-class.chips.jp/group_task/upload.php',formData)
    .then(response => {
      // handle success response
      console.log(response.data);
    })
    .catch(error => {
      // handle error response
      console.error(error);
    });
//   axios.post('http://mp-class.chips.jp/group_task/upload.php', {
//     formData:formData,
//     user_id:1,
//     todo_id:1
//     }, {
//         headers: {
//             'Content-Type': 'multipart/form-data'
//         }
//     })
//     .then(response => {
//       // handle success response
//       console.log(response.data);
//     })
//     .catch(error => {
//       // handle error response
//       console.error(error);
//     });
}

// use defineExpose function to explicitly expose properties and methods to template
defineExpose({
  uploadFile,
});
</script>
<style scoped>
.return{
  display: flex;
  justify-content: center;
  align-items: center;
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
  margin:auto;
  background-color: white;
  border: solid 2px #5AB4BD;
  border-radius: 10px;
}
.title{
  font-size: 4.5vh;
  text-align: center;
  font-weight: bold;
}
.subtitle{
  font-size:3vh;
  text-align: center;
  font-weight: bold;
}
.text{
  text-align: center;
}
.select{
  font-size:2.5vh;
}
</style>

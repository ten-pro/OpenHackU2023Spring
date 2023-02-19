<template>
  <div class="return">
    <img class="left" src="./PNG/left.png" />
  </div>
  <div class="image_area">
    <div class="title">チャーハン材料</div>
    <div class="subtitle">完了条件</div>
    <div class="text">ネギ、卵、ベーコンを買ってくる</div>
    <div class="subtitle select">画像選択</div>
    <div class="text">
      <label>
        <input type="file" accept='image/*' @change="previewImage($event.target)">ファイルを選択
      </label>
    </div>
    <div class="title"><img id="preview" :src="previewSrc" style="max-width:50vw;max-height:50vh;"></div>
  </div>
  <div class="upload_button_wrap"><button @click="uploadFile" class="upload_button">送信</button></div>
</template>
<script setup lang="ts">
import axios from "axios"
import { ref } from "vue";

const previewSrc = ref("")

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

const previewImage = (obj) => {
  const fileReader = new FileReader()
  fileReader.onload = () => {
    previewSrc.value = fileReader.result
  }
  fileReader.readAsDataURL(obj.files[0])
}
</script>
<style scoped>
.return{
  margin-top:3vh;
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
label{
  padding: 1vh 3.5vh;
  color: #ffffff;
  background-color:#5AB4BD;
  cursor: pointer;
}
input{
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
